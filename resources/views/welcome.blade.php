<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventPass | Discover Your Next Experience</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="antialiased bg-gray-50 text-gray-900">
    <nav class="flex items-center justify-between px-8 py-6 max-w-7xl mx-auto">
        <div class="text-2xl font-black text-blue-600 tracking-tighter italic">EventPass</div>
        <div class="space-x-4 font-semibold text-sm">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Log in</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-full hover:bg-gray-900 transition shadow-lg">Register</a>
                @endauth
            @endif
        </div>
    </nav>

    <section class="py-20 text-center px-6">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6">
            Connecting People <br><span class="text-blue-600 underline decoration-blue-200">Through Events.</span>
        </h1>
        <p class="text-gray-500 max-w-2xl mx-auto text-lg mb-10">
            Book your spot at the most exciting workshops, conferences, and meetups. 
            The easiest way to host or attend local events.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-gray-900 text-white px-8 py-4 rounded-xl font-bold shadow-2xl hover:scale-105 transition transform">Get Started Free</a>
            <a href="#events" class="bg-white border border-gray-200 px-8 py-4 rounded-xl font-bold hover:bg-gray-50 transition">Explore Events</a>
        </div>
    </section>

    <section id="events" class="max-w-7xl mx-auto px-6 py-20 border-t border-gray-100">
        <h2 class="text-3xl font-bold mb-12">Happening Soon</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($events->take(3) as $event)
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm hover:shadow-xl transition duration-300">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 font-bold">
                        {{ $loop->iteration }}
                    </div>
                    <h3 class="font-bold text-xl mb-2">{{ $event->title }}</h3>
                    <p class="text-gray-500 text-sm mb-4">{{ Str::limit($event->description, 80) }}</p>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $event->venue }}</span>
                        <a href="{{ route('login') }}" class="text-blue-600 font-bold text-sm">Join Event</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <footer class="py-12 text-center text-gray-400 text-sm">
        &copy; 2026 EventPass. All rights reserved.
    </footer>
</body>
</html>