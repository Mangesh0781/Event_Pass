<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Available Events') }}
            </h2>
            <a href="{{ route('events.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Host New Event
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-blue-500">
                        <h3 class="text-xl font-bold text-gray-900">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600 mt-2">{{ $event->venue }}</p>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y @ h:i A') }}</p>
                        
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-xs font-bold uppercase px-2 py-1 bg-gray-100 rounded">
                                {{ $event->total_seats - $event->booked_seats }} Seats Left
                            </span>
                            
                            <form action="{{ route('rsvp', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Book Now
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>