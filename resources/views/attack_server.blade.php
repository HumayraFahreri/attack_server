@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-[#fff]">
    
    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto bg-gray-400/30 ml-64">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-2xl font-semibold text-[#5A5252]">Attack Server</h1>
                    <p class="text-sm text-[#5A5252]/80 mt-1">Manage and execute planned attacks</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('attack-server.create') }}" class="flex items-center gap-2 px-4 py-2 bg-[#4F46E5] hover:bg-[#3b35a9] rounded-md text-sm text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4v16m8-8H4"/>
                        </svg>
                        New Attack
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Attacks List -->
            <div class="bg-white rounded-lg shadow-sm border border-[#5A5252]/20 overflow-hidden">
                <div class="px-6 py-4 border-b border-[#5A5252]/10">
                    <h2 class="text-lg font-semibold text-[#5A5252]">Pending Attacks</h2>
                </div>

                @if($attacks->count())
                    <div class="divide-y divide-[#5A5252]/10">
                        @foreach($attacks as $attack)
                            <div class="px-6 py-4 hover:bg-[#5A5252]/5 transition-colors">
                                <div class="flex flex-col md:flex-row md:items-center justify-between">
                                    <div class="mb-3 md:mb-0">
                                        <a href="{{ route('attack.show', $attack->id) }}" class="block font-medium text-[#4F46E5] hover:text-[#3b35a9] hover:underline">
                                            {{ $attack->nama_serangan }}
                                        </a>
                                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1 text-sm text-[#5A5252]/80">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $attack->ip_target }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                </svg>
                                                Port: {{ $attack->port }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Duration: {{ $attack->durasi }} seconds
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <form method="POST" action="{{ route('attack-server.execute', $attack) }}" onsubmit="return confirm('Are you sure you want to execute this attack? The system is not responsible for any errors. Make sure you fill in the data correctly!');">
                                            @csrf
                                            <button type="submit" class="flex items-center px-4 py-2 bg-[#4F46E5] hover:bg-[#3b35a9] rounded-md text-white text-sm font-medium transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                Execute
                                            </button>
                                        </form>
                                        <a href="{{ route('attack-server.edit', $attack->id) }}" class="flex items-center px-4 py-2 bg-[#5A5252]/10 hover:bg-[#5A5252]/20 rounded-md text-[#5A5252] text-sm font-medium transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <svg class="w-12 h-12 mx-auto text-[#5A5252]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-[#5A5252]">No attacks scheduled</h3>
                        <p class="mt-1 text-sm text-[#5A5252]/70">Create your first attack to get started</p>
                        <div class="mt-6">
                            <a href="{{ route('attack-server.create') }}" class="inline-flex items-center px-4 py-2 bg-[#4F46E5] hover:bg-[#3b35a9] rounded-md text-white text-sm font-medium transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                New Attack
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection