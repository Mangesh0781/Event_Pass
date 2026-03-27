<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// 1. Public Homepage
Route::get('/', function () {
    $events = Event::latest()->get();
    return view('welcome', compact('events'));
});

// 2. Dashboard
Route::get('/dashboard', [EventController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // 3. Event Management
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    // 4. RSVP / Checkout Logic
    Route::get('/events/{event}/checkout', [EventController::class, 'showCheckout'])->name('checkout');
    Route::post('/events/{event}/rsvp', [EventController::class, 'rsvp'])->name('rsvp');
    Route::delete('/bookings/{booking}', [EventController::class, 'cancelBooking'])->name('bookings.cancel');

    // 5. Organizer: Manage My Events & Guest List
    Route::get('/my-events', function () {
        if (Auth::user()->role !== 'organizer') abort(403);

        $myEvents = Event::where('user_id', Auth::id())
                        ->with('bookings.user')
                        ->latest()
                        ->get();

        return view('organizer.my-events', compact('myEvents'));
    })->name('organizer.events');

    // 6. Admin: Security & Approvals Section
    // THIS WAS THE MISSING ROUTE CAUSING YOUR ERROR
    Route::get('/admin/approvals', function () {
        if (Auth::user()->email !== 'pandit.mangesh002@gmail.com') abort(403);

        $pendingOrganizers = User::where('role', 'organizer')
                                ->where('is_approved', false)
                                ->get();

        return view('admin.approvals', compact('pendingOrganizers'));
    })->name('admin.approvals');

    Route::post('/admin/approve/{user}', function (User $user) {
        if (Auth::user()->email !== 'pandit.mangesh002@gmail.com') abort(403);
        $user->update(['is_approved' => true]);
        return back()->with('success', "Account for {$user->name} approved!");
    })->name('admin.approve');

    Route::delete('/admin/reject/{user}', function (User $user) {
        if (Auth::user()->email !== 'pandit.mangesh002@gmail.com') abort(403);
        $user->delete();
        return back()->with('success', "Application rejected and removed.");
    })->name('admin.reject');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';