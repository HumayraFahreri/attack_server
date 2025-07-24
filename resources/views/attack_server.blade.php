@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-[#C9C9C9]">
    
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-screen z-50 w-full md:w-64 bg-[#C9C9C9] text-[#5A5252] flex-shrink-0 flex flex-col justify-between fixed left-0 top-0">
        <div class="p-4 flex flex-col items-center border-b border-[#5A5252]">
            <img src="{{ asset('image/ABH-LOGO-HORIZONTAL_RED.png') }}" class="w-32 h-auto mb-2">
            @auth
                <p class="text-lg font-medium text-[#5A5252] mt-2">
                    Welcome, <span class="font-semibold">{{ auth()->user()->name ?? auth()->user()->email ?? 'User' }}</span>
                </p>
            @endauth
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-[#5A5252]/10 transition-colors font-medium">
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
            <a href= "{{ route('recent-attacks') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-400/30 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Recent Attack
            </a>
            <a href="#" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-400/30 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                User Management
            </a>
        </nav>


        <div class="p-4 border-t border-[#5A5252]">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center py-2 px-4 rounded-lg text-white bg-[#BF5A4B] hover:bg-[#BF5A4B]/90 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
     <main class="flex-1 p-6 overflow-y-auto bg-white/80 ml-64">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border border-[#5A5252]/10 overflow-hidden">
            <!-- Header -->
            <div class="bg-[#5A5252]/5 p-6 border-b border-[#5A5252]/10">
                <h1 class="text-xl font-semibold text-[#5A5252]">Attack Server</h1>
                <p class="text-sm text-[#5A5252]/70 mt-1">Planned attacks for this server are listed below</p>
            </div>

            <div class="flex justify-end p-4">
                <a href="{{ route('parameter.serangan') }}"
                class="flex items-center gap-2 px-4 py-2 bg-[#4CAF50] hover:bg-[#45A049] text-white text-sm font-semibold rounded-lg shadow transition duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4v16m8-8H4"/>
                    </svg>
                    attack
                </a>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('parameter.serangan.store') }}" class="p-6 space-y-5">
                @csrf

                <!-- Daftar Serangan -->
                <div class="p-6 border-t border-[#5A5252]/80">
                    <h2 class="text-md font-semibold text-[#5A5252] mb-4">Daftar Serangan</h2>

                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($attacks->count())
                        <ul class="space-y-3">
                            @foreach($attacks as $attack)
                                <li>
                                    <a href="{{ route('attack.show', $attack->id) }}" class="block bg-white border border-[#5A5252]/80 p-4 rounded-lg shadow-lg hover:bg-gray-100 transition">
                                        <p class="font-semibold text-sm text-[#5A5252]">{{ $attack->nama_serangan }}</p>
                                        <p class="text-sm text-[#5A5252]/80">IP: {{ $attack->ip_target }} | Port: {{ $attack->port }} | Durasi: {{ $attack->durasi }} detik</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    @else
                        <p class="text-sm text-[#5A5252]/70">Belum ada data serangan.</p>
                    @endif
                </div>

