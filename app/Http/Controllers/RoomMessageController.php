<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Events\RoomMessageSent;
use App\Models\Chat;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomMessageController extends Controller
{
    public function store(Room $room, Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'reply_id' => 'nullable|integer|exists:messages,id',
        ]);

        if($room->type == 'channel' && Auth::id() !== $room->owner_id) {
            abort(403,"you are not admin");
        }

        if( $room->type == 'group' && !$room->members->contains(Auth::id())) {
            abort(403, "you are not joined in this group");
        }

        $message = $room->messages()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'reply_id' => $request->input('reply_id'),
        ]);

        broadcast(new RoomMessageSent($message));

        return back()->with(['message' => $message]);
    }
}
