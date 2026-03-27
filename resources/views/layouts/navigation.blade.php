<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-blue-600 tracking-tight">
                        Event<span class="text-gray-800">Pass</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Explore Events') }}
                    </x-nav-link>

                    @if(Auth::user()->role == 'organizer')
                        <x-nav-link :href="route('organizer.events')" :active="request()->routeIs('organizer.events')">
                            {{ __('Manage My Events') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->isSuperAdmin())
                        <x-nav-link :href="route('admin.approvals')" :active="request()->routeIs('admin.approvals')" class="flex items-center">
                            {{ __('Approvals') }}
                            @php
                                $pendingCount = \App\Models\User::where('role', 'organizer')->where('is_approved', false)->count();
                            @endphp
                            @if($pendingCount > 0)
                                <span class="ml-2 px-2 py-0.5 text-[10px] bg-red-500 text-white rounded-full font-black animate-pulse">
                                    {{ $pendingCount }}
                                </span>
                            @endif
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role == 'organizer' && (Auth::user()->is_approved || Auth::user()->isSuperAdmin()))
                        <x-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')">
                            {{ __('Host New Event') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 transition">
                            <div class="mr-1">Hello, {{ Auth::user()->name }}</div>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('My Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>