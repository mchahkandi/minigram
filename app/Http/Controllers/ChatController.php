<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function show(int $user_id = null)
    {
        // Validate that user_id is provided and exists
        if (!$user_id || !User::find($user_id)) {
            abort(404, 'User not found');
        }

        $user = User::find($user_id)->toArray();

        if (auth()->user()->contacts()->where('contact_id', $user_id)->exists()) {
            $user['name'] = auth()->user()->contacts()->where('contact_id', $user_id)->first()->name;
        }

        $chat = Chat::findChat(auth()->id(), $user_id)->first();

        $messages = $chat?->messages()?->orderBy('created_at', 'asc')->get();

        return Inertia::render('chats/Show',[
            'user' => $user,
            'chat' => $chat,
            'messages' => $messages,
        ]);

    }


    public function destroy(Chat $chat)
    {
        if (Auth::id() != $chat->user_one_id && Auth::id() != $chat->user_two_id) {
            abort(403, 'Unauthorized action.');
        }
        $chat->delete();

        return redirect()->route('dashboard');
    }
}
