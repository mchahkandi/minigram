<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $room->members()->attach(Auth::id());

        return back()->with(['message' => 'deleted successfully'], 200);
    }
}
