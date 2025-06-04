<?php

namespace App\Http\Controllers;

use App\Events\RoomMessageSent;
use App\Models\Message;
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

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $name = strtolower($room->getTable());

                $path = $file->store($name . '/' . $room->id);

                $message->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_size' => $file->getSize()
                ]);
            }
        }

        broadcast(new RoomMessageSent($message));

        return back()->with(['message' => $message]);
    }

    public function search(Room $room, Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $res = $room->messages()
            ->where('content', 'LIKE', '%' . $data['content'] . '%')
            ->get();

        return response()->json($res);
    }

    public function seen(Room $room, Message $message)
    {
        $message->markAsSeen();

        return response()->json(['messsage' => 'ok']);
    }

    public function destroy(Room $room, Message $message)
    {
        if ($room->type == 'channel' && $room->owner_id !== Auth::id()) {
            abort(403, "you are not admin");
        }

        if ($room->type == 'group' && !$room->members->contains(Auth::id()) && $message->user_id !== Auth::id() ) {
            abort(403, 'Unauthorized action.');
        }

        $message->delete();

        return back()->with(['message' => 'deleted successfully'], 200);
    }
}
