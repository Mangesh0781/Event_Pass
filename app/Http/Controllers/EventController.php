<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // 1. Show the form to create an event
    public function create()
    {
        return view('events.create');
    }

    // 2. Save the event to the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'venue' => 'required',
            'event_date' => 'required|date',
            'total_seats' => 'required|integer|min:1',
        ]);

        Event::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'venue' => $request->venue,
            'event_date' => $request->event_date,
            'total_seats' => $request->total_seats,
            'booked_seats' => 0,
        ]);

        return redirect()->route('dashboard')->with('success', 'Event created successfully!');
    }
    public function index()
    {
        $events = Event::latest()->get();

        // This fetches only the bookings made by the logged-in user
        $myBookings = \App\Models\Booking::where('user_id', auth()->id())
            ->with('event')
            ->get();

        return view('dashboard', compact('events', 'myBookings'));
    }
    // Add this inside your EventController class
    public function rsvp(Event $event)
    {
        // 1. Check if user is already booked to prevent double-booking
        $exists = \App\Models\Booking::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already joined this event!');
        }

        // 2. Check for empty seats
        if ($event->booked_seats < $event->total_seats) {
            \App\Models\Booking::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id,
            ]);

            $event->increment('booked_seats');
            return back()->with('success', 'Ticket Booked! See you there.');
        }

        return back()->with('error', 'Sorry, no seats left.');
    }

    public function cancelBooking($id) {
    $booking = \App\Models\Booking::findOrFail($id);
    if ($booking->user_id == auth()->id()) {
        $event = $booking->event;
        $event->decrement('booked_seats');
        $booking->delete();
        return back()->with('success', 'Ticket successfully cancelled.');
    }
    return back()->with('error', 'Action failed.');
}
public function showCheckout(Event $event)
{
    // Make sure user hasn't already booked
    $isBooked = \App\Models\Booking::where('user_id', auth()->id())->where('event_id', $event->id)->exists();
    if($isBooked) return redirect()->route('dashboard');

    return view('events.checkout', compact('event'));
}

// Your existing rsvp function stays the same, 
// it just gets called by the button on the checkout page now!
}