<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    public function store(int $user_id,Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'reply_id' => 'nullable|integer|exists:messages,id',
        ]);

        $chat = Chat::createIfNotExist(Auth::id(), $user_id);

        $message = $chat->messages()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'reply_id' => $request->input('reply_id'),
        ]);

        broadcast(new ChatMessageSent($message));

        return back()->with(['message' => $message]);
    }

    public function destroy(Message $message)
    {
        $chat = $message->messagable;

        if (!($chat instanceof Chat)) {
            abort(403, 'Unauthorized action.');
        }

        if (Auth::id() !== $chat->user_one_id || Auth::id() !== $chat->user_two_id) {
            abort(403, 'Unauthorized action.');
        }

        $message->delete();

        return back()->with(['message' => 'deleted successfully'], 200);
    }
}
