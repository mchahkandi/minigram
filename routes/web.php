<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard'); // Name added

    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');

    Route::get('chats/{id?}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('chats/{user_id}/messages', [ChatMessageController::class, 'store'])->name('messages.store');
    Route::delete('messages/{message}', [ChatMessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    Route::post('rooms', [RoomController::class, 'store'])->name('rooms.store');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
