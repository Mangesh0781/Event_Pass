<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Event Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="venue" :value="__('Venue / Location')" />
                                <x-text-input id="venue" name="venue" type="text" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('venue')" />
                            </div>

                            <div>
                                <x-input-label for="event_date" :value="__('Event Date & Time')" />
                                <x-text-input id="event_date" name="event_date" type="datetime-local" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('event_date')" />
                            </div>
                        </div>

                        <div class="w-full md:w-1/3">
                            <x-input-label for="total_seats" :value="__('Total Available Seats')" />
                            <x-text-input id="total_seats" name="total_seats" type="number" class="mt-1 block w-full" required min="1" />
                            <x-input-error class="mt-2" :messages="$errors->get('total_seats')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Publish Event') }}</x-primary-button>
                            
                            @if (session('success'))
                                <p class="text-sm text-green-600">{{ session('success') }}</p>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>