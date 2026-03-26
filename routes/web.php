<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; // 1. Import your Controller
use Illuminate\Support\Facades\Route;
use App\Models\Event; // Import Event model for the welcome page

// Public Homepage - Shows all events to everyone
Route::get('/', function () {
    $events = Event::latest()->get();
    return view('welcome', compact('events'));
});

// Updated Dashboard - Now calls the Controller to show events
Route::get('/dashboard', [EventController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Event Management Routes
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    
    // The "Book Now" Logic
    Route::post('/event/{event}/rsvp', [EventController::class, 'rsvp'])->name('rsvp');

    // Profile Routes (Default Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';