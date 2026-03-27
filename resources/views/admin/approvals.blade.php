<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-5">
                <div class="bg-gray-900 p-4 rounded-[1.25rem] text-white shadow-2xl shadow-blue-200/50">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-3xl text-gray-900 leading-tight tracking-tight">Security Clearances</h2>
                    <div class="flex items-center mt-1">
                        <span class="flex h-2 w-2 rounded-full bg-blue-500 mr-2"></span>
                        <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.25em]">Administrative Authorization Terminal</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="group flex items-center bg-white px-5 py-3 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-gray-900">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Console
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Pending Requests</p>
                    <p class="text-3xl font-black text-gray-900 mt-1">{{ $pendingOrganizers->count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">System Status</p>
                    <p class="text-3xl font-black text-green-500 mt-1">Active</p>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Security Level</p>
                    <p class="text-3xl font-black text-blue-600 mt-1">Root</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 p-5 bg-gray-900 text-white rounded-[2rem] shadow-2xl flex items-center animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="bg-blue-500 p-2 rounded-xl mr-4">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="text-xs font-black uppercase tracking-widest">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white p-2 rounded-[3.5rem] shadow-2xl border border-gray-100 overflow-hidden">
                <div class="bg-gray-50/50 p-8 rounded-[3rem]">
                    <div class="space-y-4">
                        @forelse($pendingOrganizers as $org)
                            <div class="flex flex-col md:flex-row justify-between items-center p-8 bg-white rounded-[2.5rem] border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-500 group">
                                
                                <div class="flex items-center mb-6 md:mb-0">
                                    <div class="relative">
                                        <div class="w-16 h-16 bg-gradient-to-tr from-gray-900 to-blue-800 rounded-2xl flex items-center justify-center font-black text-white shadow-xl text-xl group-hover:rotate-6 transition-transform duration-500">
                                            {{ substr($org->name, 0, 1) }}
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-orange-500 border-4 border-white rounded-full"></div>
                                    </div>
                                    <div class="ml-6">
                                        <p class="font-black text-gray-900 text-xl tracking-tight leading-none group-hover:text-blue-600 transition-colors">{{ $org->name }}</p>
                                        <p class="text-xs text-gray-400 font-bold tracking-tighter mt-1">{{ $org->email }}</p>
                                        <div class="flex items-center mt-3 space-x-3">
                                            <span class="px-3 py-1 bg-gray-100 rounded-full text-[8px] text-gray-500 font-black uppercase tracking-tighter italic">Applied {{ $org->created_at->diffForHumans() }}</span>
                                            <span class="text-[9px] text-blue-500 font-black uppercase tracking-tighter">UID: #{{ $org->id }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <form action="{{ route('admin.reject', $org->id) }}" method="POST" class="flex-grow md:flex-grow-0" onsubmit="return confirm('Permanently revoke this application?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full bg-white text-gray-400 border border-gray-100 px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-all active:scale-95">
                                            Reject
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.approve', $org->id) }}" method="POST" class="flex-grow md:flex-grow-0">
                                        @csrf
                                        <button type="submit" class="w-full bg-gray-900 text-white px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-xl hover:shadow-blue-200 active:scale-95">
                                            Authorize
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-gray-100">
                                <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 text-blue-500 rounded-full mb-6 shadow-inner animate-pulse">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <h4 class="text-gray-900 font-black text-xl uppercase tracking-widest">No Pending Clearances</h4>
                                <p class="text-gray-400 text-xs font-bold mt-2 uppercase tracking-tighter italic px-10">The authorization queue is currently empty. All registered organizers have been processed.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>