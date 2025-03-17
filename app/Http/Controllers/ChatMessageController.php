<?php

namespace App\Http\Controllers;

use App\Models\Chat;
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
        ]);

        return back()->with(['message' => $message]);
    }
}
