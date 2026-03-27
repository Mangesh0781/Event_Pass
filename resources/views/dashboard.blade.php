<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-2xl text-gray-900 leading-tight">
                    {{ Auth::user()->role == 'organizer' ? 'Organizer Dashboard' : 'Event Explorer' }}
                </h2>
                <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.2em] mt-1">
                    {{ Auth::user()->role == 'organizer' ? 'Manage your hosting' : 'Your Personal Ticket Office' }}
                </p>
            </div>
            
            @if(Auth::user()->role == 'organizer' && (Auth::user()->is_approved || Auth::user()->isSuperAdmin()))
                <a href="{{ route('events.create') }}" class="bg-gray-900 text-white px-5 py-2.5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 transition shadow-xl shadow-gray-200">
                    + Host New Event
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-10 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            @if(Auth::user()->role == 'organizer' && !Auth::user()->is_approved && !Auth::user()->isSuperAdmin())
                <div class="p-5 bg-orange-50 border-l-4 border-orange-500 rounded-r-2xl shadow-sm mb-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-500 p-2 rounded-lg text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-black text-orange-800 uppercase tracking-widest">Account Pending Verification</h3>
                            <p class="text-xs text-orange-600 mt-1 font-medium">Mangesh (Admin) needs to review your profile. You will be able to host events once approved.</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="p-4 bg-green-500 text-white rounded-2xl shadow-lg font-bold flex items-center animate-pulse">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($myBookings->isNotEmpty())
                <section>
                    <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-[0.3em] mb-6">Your Confirmed Passes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($myBookings as $booking)
                            <div class="bg-white p-6 rounded-[2rem] border border-blue-50 shadow-sm hover:shadow-md transition group">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="bg-blue-600 text-white p-3 rounded-2xl text-center min-w-[55px]">
                                        <span class="block text-[10px] font-black uppercase leading-none">{{ \Carbon\Carbon::parse($booking->event->event_date)->format('M') }}</span>
                                        <span class="block text-xl font-black">{{ \Carbon\Carbon::parse($booking->event->event_date)->format('d') }}</span>
                                    </div>
                                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Cancel this booking?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-200 hover:text-red-500 transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                                <h4 class="font-black text-gray-900 text-lg mb-1">{{ $booking->event->title }}</h4>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">{{ $booking->event->venue }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
                <hr class="border-gray-100">
            @endif

            <section>
                <h3 class="text-gray-400 text-[10px] font-black uppercase tracking-[0.3em] mb-8 italic">Available Experiences</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($events as $event)
                        <div class="bg-white rounded-[2.5rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl transition duration-500 group flex flex-col">
                            <div class="p-8 flex-grow">
                                <div class="flex justify-between items-center mb-6">
                                    <span class="bg-green-100 text-green-600 text-[9px] font-black px-3 py-1 rounded-full uppercase italic tracking-widest">Open</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-4 leading-tight group-hover:text-blue-600 transition">{{ $event->title }}</h3>
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-8">{{ $event->description }}</p>
                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-400 text-[10px] font-black uppercase tracking-widest">
                                        <div class="w-2 h-2 rounded-full bg-blue-500 mr-3"></div>{{ $event->venue }}
                                    </div>
                                    <div class="flex items-center text-gray-400 text-[10px] font-black uppercase tracking-widest">
                                        <div class="w-2 h-2 rounded-full bg-orange-400 mr-3"></div>{{ \Carbon\Carbon::parse($event->event_date)->format('D, M d • h:i A') }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-8 pt-0 mt-auto">
                                @php
                                    $isBooked = \App\Models\Booking::where('user_id', auth()->id())->where('event_id', $event->id)->exists();
                                @endphp

                                @if($isBooked)
                                    <div class="w-full py-4 bg-blue-50 text-blue-600 rounded-2xl text-center text-[10px] font-black uppercase tracking-widest border border-blue-100 italic">
                                        ✓ Admission Secured
                                    </div>
                                @else
                                    <a href="{{ route('checkout', $event->id) }}" class="w-full block text-center py-4 bg-gray-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-xl shadow-gray-200">
                                        Get Tickets
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            @if(Auth::user()->isSuperAdmin())
                <section class="mt-20 pt-10 border-t-2 border-dashed border-gray-200">
                    <div class="bg-white p-10 rounded-[3rem] shadow-2xl border border-gray-100">
                        <div class="flex items-center mb-8">
                            <div class="bg-black text-white p-3 rounded-2xl mr-4 shadow-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-gray-900">Admin Command Center</h3>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Approve new event organizers</p>
                            </div>
                        </div>
                        
                        @php
                            $pendingOrganizers = \App\Models\User::where('role', 'organizer')->where('is_approved', false)->where('id', '!=', Auth::id())->get();
                        @endphp

                        <div class="grid gap-4">
                            @forelse($pendingOrganizers as $org)
                                <div class="flex justify-between items-center p-6 bg-gray-50 rounded-[2rem] hover:bg-blue-50 transition border border-transparent hover:border-blue-100 group">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center font-black text-blue-600 shadow-sm mr-4">
                                            {{ substr($org->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-gray-800">{{ $org->name }}</p>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $org->email }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route('admin.approve', $org->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition shadow-lg group-hover:shadow-blue-200">
                                            Verify & Approve
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <div class="text-gray-300 mb-2 font-black text-4xl">✓</div>
                                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest italic">All systems clear. No pending approvals.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </div>
    @if(Auth::user()->isSuperAdmin())
    <section class="mt-20 pt-10 border-t-2 border-dashed border-gray-200">
        <div class="bg-white p-10 rounded-[3rem] shadow-2xl border border-gray-100">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="bg-black text-white p-3 rounded-2xl mr-4 shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Admin Control Panel</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em]">Pending Organizer Verifications</p>
                    </div>
                </div>
                <span class="bg-gray-100 text-gray-500 text-[10px] font-black px-4 py-1.5 rounded-full uppercase">System Root</span>
            </div>
            
            @php
                // Fetch users who are organizers but not yet approved, excluding the admin themselves
                $pendingOrganizers = \App\Models\User::where('role', 'organizer')
                                    ->where('is_approved', false)
                                    ->where('id', '!=', Auth::id())
                                    ->get();
            @endphp

            <div class="grid gap-4">
                @forelse($pendingOrganizers as $org)
                    <div class="flex justify-between items-center p-6 bg-gray-50 rounded-[2rem] hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-blue-100 group">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center font-black text-white shadow-lg mr-5 text-xl">
                                {{ substr($org->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-black text-gray-900 text-lg">{{ $org->name }}</p>
                                <p class="text-xs text-blue-500 font-bold tracking-wide">{{ $org->email }}</p>
                                <p class="text-[9px] text-gray-400 font-black mt-1 uppercase tracking-widest">Requested Access: {{ $org->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        <form action="{{ route('admin.approve', $org->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-900 text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-blue-600 hover:scale-105 transition-all shadow-xl shadow-gray-200 active:scale-95">
                                Grant Organizer Access
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="text-center py-16 border-2 border-dashed border-gray-100 rounded-[2.5rem]">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-50 text-green-500 rounded-full mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h4 class="text-gray-900 font-black text-sm uppercase tracking-widest">Queue Empty</h4>
                        <p class="text-gray-400 text-[10px] font-bold mt-1 uppercase">All pending organizers have been processed.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endif
</x-app-layout>