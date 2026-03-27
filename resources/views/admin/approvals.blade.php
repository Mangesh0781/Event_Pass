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
                    <p class="text-3xl font-black text-gray-900 mt-1">
                        {{ $allOrganizers->where('is_approved', false)->count() }}
                    </p>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">System Status</p>
                    <p class="text-3xl font-black text-green-500 mt-1">Active</p>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Organizers</p>
                    <p class="text-3xl font-black text-blue-600 mt-1">{{ $allOrganizers->count() }}</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 p-5 bg-gray-900 text-white rounded-[2rem] shadow-2xl flex items-center">
                    <div class="bg-blue-500 p-2 rounded-xl mr-4">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="text-xs font-black uppercase tracking-widest">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white p-2 rounded-[3.5rem] shadow-2xl border border-gray-100 overflow-hidden">
                <div class="bg-gray-50/50 p-8 rounded-[3rem]">
                    <div class="space-y-4">
                        @forelse($allOrganizers as $org)
                            <div class="flex flex-col md:flex-row justify-between items-center p-8 bg-white rounded-[2.5rem] border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-500 group">
                                
                                <div class="flex items-center mb-6 md:mb-0">
                                    <div class="relative">
                                        <div class="w-16 h-16 bg-gradient-to-tr from-gray-900 to-blue-800 rounded-2xl flex items-center justify-center font-black text-white shadow-xl text-xl">
                                            {{ substr($org->name, 0, 1) }}
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 border-4 border-white rounded-full {{ $org->is_approved ? 'bg-green-500' : 'bg-orange-500 animate-pulse' }}"></div>
                                    </div>
                                    <div class="ml-6">
                                        <div class="flex items-center space-x-2">
                                            <p class="font-black text-gray-900 text-xl tracking-tight leading-none">{{ $org->name }}</p>
                                            @if($org->is_approved)
                                                <span class="text-[8px] bg-green-100 text-green-600 px-2 py-0.5 rounded-md font-black uppercase tracking-widest">Verified</span>
                                            @else
                                                <span class="text-[8px] bg-orange-100 text-orange-600 px-2 py-0.5 rounded-md font-black uppercase tracking-widest">Awaiting Approval</span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-400 font-bold tracking-tighter mt-1">{{ $org->email }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <form action="{{ route('admin.reject', $org->id) }}" method="POST" onsubmit="return confirm('Permanently remove this user?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-4 bg-gray-50 text-gray-400 rounded-2xl hover:text-red-500 hover:bg-red-50 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.approve', $org->id) }}" method="POST">
                                        @csrf
                                        @if($org->is_approved)
                                            <button type="submit" class="w-full md:w-40 bg-white border border-gray-200 text-gray-900 px-6 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-gray-900 hover:text-white transition-all shadow-sm">
                                                Revoke Access
                                            </button>
                                        @else
                                            <button type="submit" class="w-full md:w-40 bg-gray-900 text-white px-6 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-xl">
                                                Authorize
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-20">
                                <p class="text-gray-400 text-xs font-black uppercase tracking-[0.3em]">No registered organizers found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>