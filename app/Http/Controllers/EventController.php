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
    // Fetch all events from the database
    $events = Event::latest()->get();
    
    // Return the dashboard view with the events data
    return view('dashboard', compact('events'));
}
// Add this inside your EventController class
public function rsvp(Event $event) 
{
    // Check if seats are available
    if ($event->booked_seats < $event->total_seats) {
        
        // Create the booking record
        \App\Models\Booking::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
        ]);

        // Increase the booked count by 1
        $event->increment('booked_seats');

        return back()->with('success', 'Spot reserved successfully!');
    }

    return back()->with('error', 'Sorry, this event is full.');
}
}