@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-[#C9C9C9]/20">
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-6xl mx-auto space-y-6">
            
            <!-- Page Header with Breadcrumb -->
            <div class="space-y-2">
                <nav class="flex items-center text-sm text-[#5A5252]/70">
                    <a href="{{ route('attack-server.index') }}" class="hover:text-[#BF5A4B] transition-colors">Attack Server</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#5A5252]">Attack Details</span>
                </nav>
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-[#5A5252]">Attack Configuration Details</h1>
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-[#BF5A4B]/10 text-[#BF5A4B]">
                            {{ $attack->status ?? 'Completed' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Two-Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Attack Summary -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Configuration Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-[#5A5252]/50 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-[#5A5252]">{{ $attack->nama_serangan }}</h2>
                            <span class="text-xs text-[#5A5252]/50">Created: {{ optional($attack->created_at)->format('M d, Y H:i') }}</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Attack Parameters -->
                            <div class="space-y-4">
                                <h3 class="text-md font-medium text-[#5A5252] border-b border-[#5A5252]/50 pb-2">Attack Parameters</h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-[#5A5252]/50 mb-1">Attack Type</p>
                                        <p class="text-sm font-medium text-[#5A5252]">{{ $attack->dos_type }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[#5A5252]/50 mb-1">Source Server</p>
                                        <p class="text-sm font-medium text-[#5A5252]">{{ $attack->source_server }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[#5A5252]/50 mb-1">Data Size</p>
                                        <p class="text-sm font-medium text-[#5A5252]">{{ $attack->data_size }} MB</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Target Information -->
                            <div class="space-y-4">
                                <h3 class="text-md font-medium text-[#5A5252] border-b border-[#5A5252]/50 pb-2">Target Information</h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-[#5A5252]/50 mb-1">IP Address</p>
                                        <p class="text-sm font-medium text-[#5A5252]">{{ $attack->ip_target }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[#5A5252]/50 mb-1">Port</p>
                                        <p class="text-sm font-medium text-[#5A5252]">{{ $attack->port }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[#5A5252]/50 mb-1">Duration</p>
                                        <p class="text-sm font-medium text-[#5A5252]">{{ $attack->durasi }} seconds</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Execution Timeline -->
                    <div class="bg-white rounded-lg shadow-sm border border-[#5A5252]/10 p-6">
                        <h3 class="text-md font-medium text-[#5A5252] mb-4">Execution Timeline</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="mt-1 flex-shrink-0 h-2 w-2 rounded-full bg-[#4F46E5]"></div>
                                <div>
                                    <p class="text-sm font-medium text-[#5A5252]">Packets flooding</p>
                                    <p class="text-xs text-[#5A5252]/50">
                                        @if($attack->created_at)
                                            {{ $attack->created_at->addSeconds(5)->format('H:i:s') }}
                                        @endif
                                    </p>
                                    {{-- GUNAKAN DATA DARI $stats --}}
                                    <p class="text-xs text-[#5A5252]/70 mt-1">{{ number_format($stats['packets_sent']) }} packets sent ({{ $stats['data_transferred'] }} MB)</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <div class="mt-1 flex-shrink-0 h-2 w-2 rounded-full bg-[#4F46E5]"></div>
                                <div>
                                    <p class="text-sm font-medium text-[#5A5252]">
                                        @if($attack->created_at)
                                            Attack completed at {{ $attack->created_at->addSeconds($attack->durasi)->format('H:i:s') }}
                                        @else
                                            Attack completed
                                        @endif
                                    </p>
                                    <p class="text-xs text-[#5A5252]/70 mt-1">Attack complete in {{ $attack->formatted_duration }}</p>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Stats & Actions -->
                <div class="space-y-6">

                    <!-- Statistics Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-[#5A5252]/10 p-6">
                        <h3 class="text-md font-medium text-[#5A5252] mb-4">Statistics</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-[#5A5252]/50 mb-1">Packets Sent</p>
                                <p class="text-sm font-medium text-[#5A5252]">
                                    {{ number_format($stats['packets_sent'], 0) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-[#5A5252]/50 mb-1">Data Transferred</p>
                                <p class="text-sm font-medium text-[#5A5252]">
                                    {{ $stats['data_transferred'] }} MB
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-[#5A5252]/50 mb-1">Average Rate</p>
                                <p class="text-sm font-medium text-[#5A5252]">
                                    {{ number_format($stats['average_rate'], 0) }} pkt/s
                                </p>                            
                            </div>
                        </div>
                    </div>

                    <!-- Actions Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-[#5A5252]/10 p-6">
                        <h3 class="text-md font-medium text-[#5A5252] mb-4">Actions</h3>
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-[#4F46E5] hover:bg-[#3b35a9]  text-white text-sm font-medium rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Execute Again
                            </button>
                            <a href="{{ route('attack-server.index') }}" class="block w-full text-center px-4 py-2 border border-[#5A5252]/20 text-[#5A5252] text-sm font-medium rounded hover:bg-[#5A5252]/5 transition-colors">
                                Back to List
                            </a>
                            <button class="w-full flex items-center justify-center gap-2 px-4 py-2 border border-[#5A5252]/20 text-[#5A5252] text-sm font-medium rounded hover:bg-[#5A5252]/5 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Export Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection