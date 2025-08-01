@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row ">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

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