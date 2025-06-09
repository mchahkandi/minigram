<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'link' => 'nullable',
            'avatar' => 'nullable|image',
            'type' => 'required',
        ]);

        $data['owner_id'] = Auth::id();

        $room = Room::create($data);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');
            $room->avatar = $path;
        }
        $room->save();

        $room->members()->attach(Auth::id());

        return to_route('rooms.show', $room->id);
    }

    public function show(Room $room)
    {
        return Inertia::render('rooms/Show', [
            'room' => $room->load('members'),
            'messages' => $room->messages->keyBy('id')->load(['user','replied']),
        ]);
    }

    public function leave(Room $room)
    {
        $room->members()->detach(Auth::id());

        return redirect()->route('dashboard');

    }

    public function destroy(Room $room)
    {
        if (Auth::id() !== $room->owner_id) {
            abort(403);
        }
        $room->delete();

        return redirect()->route('dashboard');
    }

    public function addUsers(Room $room, Request $request)
    {
        $validated = $request->validate([
            'members' => 'required|array',
            'members.*' => 'exists:users,id',
        ]);

        $room->members()->syncWithoutDetaching($validated['members']);

        return response()->json(['message' => 'success'], 200);
    }
}
