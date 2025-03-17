<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatMessageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard'); // Name added

    Route::resource('contacts', ContactController::class)->names('contacts');
    Route::get('chats/{id?}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('chats/{user_id}/messages', [ChatMessageController::class, 'store'])->name('messages.store');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
