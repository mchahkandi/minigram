<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    public function store(int $user_id, Request $request)
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

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $name = strtolower($chat->getTable());

                $path = $file->store($name . '/' . $chat->id);

                $message->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_size' => $file->getSize()
                ]);
            }
        }

        broadcast(new ChatMessageSent($message));

        return back()->with(['message' => $message]);
    }

    public function destroy(Message $message)
    {
        $chat = $message->messagable;

        if (!($chat instanceof Chat)) {
            abort(403, 'Unauthorized action.');
        }

        if (Auth::id() !== $chat->user_one_id && Auth::id() !== $chat->user_two_id) {
            abort(403, 'Unauthorized action.');
        }

        $message->delete();

        return back()->with(['message' => 'deleted successfully'], 200);
    }

    public function search(int $user_id, Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $chat = Chat::findChat(auth()->id(), $user_id)->first();

        $res = $chat->messages()
            ->where('content', 'LIKE', '%' . $data['content'] . '%')
            ->get();

        return response()->json($res);
    }

    public function seen(int $user_id, Message $message)
    {
        $message->markAsSeen();

        return response()->json(['messsage' => 'ok']);

    }
}
