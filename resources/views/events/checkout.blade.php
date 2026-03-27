<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 leading-tight">Checkout</h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen flex justify-center px-4">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100">
                <div class="bg-blue-600 p-8 text-white text-center">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80 mb-2">Complete Your Booking</p>
                    <h3 class="text-2xl font-black italic">{{ $event->title }}</h3>
                </div>

                <div class="p-8 space-y-8">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <span class="text-gray-400 font-bold uppercase text-xs">Ticket Price</span>
                        <span class="text-xl font-black text-gray-900">₹0.00 <span class="text-[10px] text-blue-500 uppercase">(Student Demo)</span></span>
                    </div>

                    <div class="text-center space-y-4">
                        <p class="text-xs font-bold text-gray-500 uppercase">Scan to Pay (Demo Only)</p>
                        <div class="inline-block p-4 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=EventPassDemo" alt="Mock QR" class="mx-auto opacity-50">
                        </div>
                        <p class="text-[10px] text-gray-400 italic">This is a simulated payment gateway for project demonstration.</p>
                    </div>

                    <form action="{{ route('rsvp', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-5 bg-blue-600 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-gray-900 transition-all shadow-xl shadow-blue-200">
                            I have paid • Confirm Ticket
                        </button>
                    </form>

                    <a href="{{ route('dashboard') }}" class="block text-center text-xs font-bold text-gray-400 uppercase hover:text-gray-600 transition">Cancel and Go Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>