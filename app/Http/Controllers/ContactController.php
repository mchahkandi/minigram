<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\User;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = auth()->user()->contacts()->with('user')->get();

        return response()->json($contacts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|digits:11|exists:users,phone_number',
        ]);

        $user = User::where('phone_number', $data['phone_number'])->first();

        if ($user->id === auth()->id()) {
            return back()->withErrors(['phone_number' => 'شما نمی توانید خودتان را به عنوان مخاطب اضافه کنید.']);
        }

        $contactData = [
            'contact_id' => $user->id,
            'user_id' => auth()->id()
        ];

        auth()->user()->contacts()->updateOrCreate(
            $contactData,
            ['name' => $data['name']]
        );

        // Redirect back with success message
        return response()->json(['message' => 'success'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
