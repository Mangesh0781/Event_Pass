<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 uppercase tracking-tight">Event Control Room</h2>
        <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.2em]">Manage your attendees and bookings</p>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 gap-10">
                @forelse($myEvents as $event)
                    <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-100 overflow-hidden">
                        <div class="p-10 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center">
                            <div>
                                <span class="bg-blue-50 text-blue-600 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">Active Event</span>
                                <h3 class="text-3xl font-black text-gray-900 mt-4">{{ $event->title }}</h3>
                                <p class="text-gray-400 text-xs font-bold mt-1 uppercase">{{ $event->venue }} • {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
                            </div>
                            
                            <div class="flex space-x-6 mt-6 md:mt-0">
                                <div class="text-center">
                                    <p class="text-3xl font-black text-gray-900">{{ $event->bookings->count() }}</p>
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Guests Joined</p>
                                </div>
                                <div class="text-center border-l border-gray-100 pl-6">
                                    <p class="text-3xl font-black text-blue-600">{{ $event->total_seats - $event->bookings->count() }}</p>
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Seats Left</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-10 bg-gray-50/50">
                            <h4 class="text-xs font-black text-gray-900 uppercase tracking-[0.3em] mb-6 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Verified Guest List
                            </h4>

                            @if($event->bookings->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($event->bookings as $booking)
                                        <div class="bg-white p-5 rounded-[2rem] border border-gray-100 flex items-center shadow-sm hover:shadow-md transition-all">
                                            <div class="w-10 h-10 bg-gray-900 rounded-xl flex items-center justify-center text-white font-black text-xs mr-4">
                                                {{ substr($booking->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-gray-900 leading-tight">{{ $booking->user->name }}</p>
                                                <p class="text-[10px] text-gray-400 font-bold lowercase tracking-tighter">{{ $booking->user->email }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-10 border-2 border-dashed border-gray-200 rounded-[2rem]">
                                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest italic">No one has booked this experience yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 shadow-sm">
                        <h3 class="text-gray-400 font-black text-sm uppercase tracking-widest">No Events Found</h3>
                        <a href="{{ route('events.create') }}" class="inline-block mt-4 text-blue-600 font-black text-[10px] uppercase tracking-widest hover:underline">Start Hosting Now →</a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>