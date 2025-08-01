@extends('layouts.app')
@section('content')
<div class="min-h-screen flex flex-col md:flex-row">

{{-- Sidebar --}}
@include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto bg-gray-400/30 ml-64">
        <div class="max-w-4xl mx-auto p-6 space-y-6">
            

            {{-- Form Section --}}
            <form action="{{ route('attack-server.update', $attack) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 space-y-6">

                {{-- Header Section --}}
                    <div class="pb-4 border-gray-200 bg-[#5A5252]/5 p-6 border-b border-[#5A5252]/10 rounded-xl ">
                        <h2 class="text-2xl font-semibold text-gray-800">Edit Attack: {{ $attack->nama_serangan }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Update the attack parameters below</p>
                    </div>

                    {{-- Attack Name --}}
                    <div class="space-y-2">
                        <label for="nama_serangan" class="block text-sm font-medium text-gray-700">Attack Name</label>
                        <input type="text" id="nama_serangan" name="nama_serangan" value="{{ old('nama_serangan', $attack->nama_serangan) }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#4F46E5] focus:border-[#4F46E5] transition text-sm text-gray-500">
                        @error('nama_serangan')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- DOS Type & Source Server --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="dos_type" class="block text-sm font-medium text-gray-700">DOS Type</label>
                            <select id="dos_type" name="dos_type" class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#4F46E5] focus:border-[#4F46E5] transition text-sm text-gray-500">
                                <option value="TCP Flood" {{ old('dos_type', $attack->dos_type) == 'TCP Flood' ? 'selected' : '' }}>TCP Flood</option>
                                <option value="ICMP Flood" {{ old('dos_type', $attack->dos_type) == 'ICMP Flood' ? 'selected' : '' }}>ICMP Flood</option>
                                <option value="UDP Flood" {{ old('dos_type', $attack->dos_type) == 'UDP Flood' ? 'selected' : '' }}>UDP Flood</option>
                            </select>
                            @error('dos_type')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="source_server" class="block text-sm font-medium text-gray-700">Source Server</label>
                            <select id="source_server" name="source_server" class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#4F46E5] focus:border-[#4F46E5] transition text-sm text-gray-500">
                                <option value="zeus" {{ old('source_server', $attack->source_server) == 'zeus' ? 'selected' : '' }}>Zeus</option>
                                <option value="posseidon" {{ old('source_server', $attack->source_server) == 'posseidon' ? 'selected' : '' }}>Posseidon</option>
                                <option value="athena" {{ old('source_server', $attack->source_server) == 'athena' ? 'selected' : '' }}>Athena</option>
                                <option value="triton" {{ old('source_server', $attack->source_server) == 'triton' ? 'selected' : '' }}>Triton</option>
                                <option value="aphrodite" {{ old('source_server', $attack->source_server) == 'aphrodite' ? 'selected' : '' }}>Aphrodite</option>
                            </select>
                            @error('source_server')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Target Details --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="space-y-2">
                            <label for="ip_target" class="block text-sm font-medium text-gray-700">IP Target</label>
                            <input type="text" id="ip_target" name="ip_target" value="{{ old('ip_target', $attack->ip_target) }}" 
                                   class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#4F46E5] focus:border-[#4F46E5] transition text-sm text-gray-500">
                            @error('ip_target') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="port" class="block text-sm font-medium text-gray-700">Port</label>
                            <input type="number" id="port" name="port" value="{{ old('port', $attack->port) }}" 
                                   class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#4F46E5] focus:border-[#4F46E5] transition text-sm text-gray-500">
                            @error('port') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="durasi" class="block text-sm font-medium text-gray-700">Duration (s)</label>
                            <input type="number" id="durasi" name="durasi" value="{{ old('durasi', $attack->durasi) }}" 
                                   class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#4F46E5] focus:border-[#4F46E5] transition text-sm text-gray-500">
                            @error('durasi') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="data_size" class="block text-sm font-medium text-gray-700">Data Size (MB)</label>
                            <input type="number" id="data_size" name="data_size" value="{{ old('data_size', $attack->data_size) }}" 
                                   class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#4F46E5] focus:border-[#4F46E5] transition text-sm text-gray-500">
                            @error('data_size') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex justify-end space-x-3 pt-2">
                        <a href="{{ route('attack-server.index') }}" 
                        class="px-4 py-2 border border-gray-200 rounded-md text-gray-600 hover:bg-gray-50 transition-colors text-sm">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-[#4F46E5] text-white rounded-md hover:bg-[#4338CA] focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-[#4F46E5] transition-colors text-sm">
                            Update Attack
                        </button>
                    </div>
                </div>

                
            </form>
        </div>
    </main>
</div>
@endsection