@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row ">

        {{-- Sidebar --}}
    <aside class="fixed top-0 left-0 h-screen z-50 w-full md:w-64 bg-[#fff] text-[#5A5252] flex-shrink-0 flex flex-col justify-between fixed left-0 top-0">
        <div class="p-4 flex flex-col items-center border-b border-[#5A5252]">
            <img src="{{ asset('image/logo.jpeg') }}" class="w-12 h-auto mb-1">
            @auth
                <p class="text-lg font-medium text-[#5A5252] mt-2">
                    Welcome, <span class="font-semibold">{{ auth()->user()->name ?? auth()->user()->email ?? 'User' }}</span>
                </p>
            @endauth
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-400/30 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('attack-server.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-400/30 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Attack Server
            </a>
            <a href="{{ route('recent-attacks') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-400/30 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Recent Attack
            </a>
            <a href="{{ route('users.index') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-400/30 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                User Management
            </a>
        </nav>

        <div class="p-4 border-t border-[#5A5252]">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center py-2 px-4 rounded-lg text-white bg-[#4F46E5] hover:bg-[#3b35a9] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto bg-gray-400/30 ml-64">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border border-[#5A5252]/10 overflow-hidden">
            <!-- Header -->
            <div class="bg-[#5A5252]/5 p-6 border-b border-[#5A5252]/10">
                <h1 class="text-xl font-semibold text-[#5A5252]">Attack Parameters</h1>
                <p class="text-sm text-[#5A5252]/70 mt-1">Configure your attack settings precisely</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('attack-server.store') }}" class="p-6 space-y-5">
                @csrf

                <!-- Attack Name -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#5A5252] flex items-center justify-between">
                        <span>Attack Name</span>
                        <span class="text-xs text-[#5A5252]/50">Required</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_serangan" 
                        id="nama_serangan" 
                        class="block w-full border border-[#5A5252]/70 rounded-md py-2 px-3 text-sm placeholder-[#5A5252]/40 focus:border-[#4F46E5] focus:ring-1 focus:ring-[#4F46E5]/30 transition"
                        placeholder="e.g. Main Server Attack"
                        required
                    >
                </div>

                <!-- DOS Type -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#5A5252]">DOS Type</label>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <input type="radio" name="dos_type" value="TCP_Flood" id="tcp" class="hidden peer" required>
                            <label for="tcp" class="block cursor-pointer text-center px-3 py-2 rounded-md border border-[#4F46E5]/20 text-sm text-[#5A5252] hover:border-[#4F46E5]/40 peer-checked:bg-[#4F46E5] peer-checked:text-white peer-checked:border-[#4F46E5] transition">
                                TCP Flood
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="dos_type" value="ICMP_Flood" id="icmp" class="hidden peer" required>
                            <label for="icmp" class="block cursor-pointer text-center px-3 py-2 rounded-md border border-[#4F46E5]/20 text-sm text-[#5A5252] hover:border-[#4F46E5]/40 peer-checked:bg-[#4F46E5] peer-checked:text-white peer-checked:border-[#4F46E5] transition">
                                ICMP Flood
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="dos_type" value="UDP_Flood" id="udp" class="hidden peer" required>
                            <label for="udp" class="block cursor-pointer text-center px-3 py-2 rounded-md border border-[#4F46E5]/20 text-sm text-[#5A5252] hover:border-[#4F46E5]/40 peer-checked:bg-[#4F46E5] peer-checked:text-white peer-checked:border-[#4F46E5] transition">
                                UDP Flood
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Source Server -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#5A5252]">Source Server</label>
                    <select 
                        id="source_server" 
                        name="source_server" 
                        class="block w-full border border-[#5A5252]/70 rounded-md py-2 px-3 text-sm text-[#5A5252] focus:border-[#4F46E5] focus:ring-1 focus:ring-[#BF5A4B]/30 transition"
                        required
                    >
                        <option value="" selected disabled hidden>Select server...</option>
                        <option value="zeus">Zeus</option>
                        <option value="posseidon">Posseidon</option>
                        <option value="athena">Athena</option>
                        <option value="triton">Triton</option>
                        <option value="aphrodite">Aphrodite</option>
                    </select>
                </div>

                <!-- Target IP -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#5A5252] flex items-center justify-between">
                        <span>Target IP</span>
                        <span class="text-xs text-[#5A5252]/50">Required</span>
                    </label>
                    <input 
                        type="text" 
                        name="ip_target" 
                        id="ip_target" 
                        class="block w-full border border-[#5A5252]/70 rounded-md py-2 px-3 text-sm placeholder-[#5A5252]/40 focus:border-[#4F46E5] focus:ring-1 focus:ring-[#4F46E5]/30 transition"
                        placeholder="e.g. 192.168.1.1"
                        required
                    >
                </div>

                <!-- Target Port -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#5A5252] flex items-center justify-between">
                        <span>Target Port</span>
                        <span class="text-xs text-[#5A5252]/50">Required</span>
                    </label>
                    <input 
                        type="number" 
                        name="port" 
                        id="port" 
                        class="block w-full border border-[#5A5252]/70 rounded-md py-2 px-3 text-sm placeholder-[#5A5252]/40 focus:border-[#4F46E5] focus:ring-1 focus:ring-[#4F46E5]/30 transition"
                        placeholder="e.g. 80"
                        required
                    >
                </div>

                <!-- Duration -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#5A5252] flex items-center justify-between">
                        <span>Duration (seconds)</span>
                        <span class="text-xs text-[#5A5252]/50">Required</span>
                    </label>
                    <input 
                        type="number" 
                        name="durasi" 
                        id="durasi" 
                        class="block w-full border border-[#5A5252]/70 rounded-md py-2 px-3 text-sm placeholder-[#5A5252]/40 focus:border-[#4F46E5] focus:ring-1 focus:ring-[#4F46E5]/30 transition"
                        placeholder="e.g. 60"
                        required
                    >
                </div>

                <!-- datasize -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#5A5252] flex items-center justify-between">
                        <span>Data Size (MB)</span>
                        <span class="text-xs text-[#5A5252]/50">Required</span>
                    </label>
                    <input 
                        type="number" 
                        name="data_size" 
                        id="data_size" 
                        class="block w-full border border-[#5A5252]/70 rounded-md py-2 px-3 text-sm placeholder-[#5A5252]/40 focus:border-[#4F46E5] focus:ring-1 focus:ring-[#4F46E5]/30 transition"
                        placeholder="e.g. 100"
                        required
                    >
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-[#4F46E5] hover:bg-[#3b35a9] text-white font-medium rounded-md transition-all focus:outline-none focus:ring-2 focus:ring-[#BF5A4B]/50 focus:ring-offset-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Save Attack
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection