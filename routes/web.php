<?php

use App\Http\Controllers\ContactController;
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

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
