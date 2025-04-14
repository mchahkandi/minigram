<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomMessageController;
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
    Route::delete('chats/{chat}', [ChatController::class, 'destroy'])->name('chats.destroy');
    Route::post('chats/{user_id}/messages', [ChatMessageController::class, 'store'])->name('messages.store');
    Route::delete('messages/{message}', [ChatMessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::delete('rooms/{room}/leave', [RoomController::class, 'leave'])->name('rooms.leave');
    Route::post('rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::post('rooms/{room}/messages', [RoomMessageController::class, 'store'])->name('rooms.messages.store');


});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
