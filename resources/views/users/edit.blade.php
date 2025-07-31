@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-[#fff]">

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

    <main class="flex-1 p-6 ml-64 ">
        <div class="max-w-4xl mx-auto p-3 bg-white rounded-xl shadow-sm border border-[#5A5252]/10 overflow-hidden">
            <!-- Header -->
            <div class="bg-[#5A5252]/5 p-6 border-b border-[#5A5252]/10">
                <h1 class="text-xl font-semibold text-[#5A5252]">Attack Parameters</h1>
                <p class="text-sm text-[#5A5252]/70 mt-1">Configure your attack settings precisely</p>
            </div>

            {{-- Form Section --}}
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-6 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    {{-- Name and Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name Field --}}
                        <div class="space-y-1">
                            <label for="name" class="block text-sm font-medium text-gray-600">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#BF5A4B] focus:border-[#BF5A4B] transition text-gray-700 placeholder-gray-400"
                                placeholder="Name">
                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div class="space-y-1">
                            <label for="email" class="block text-sm font-medium text-gray-600">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#BF5A4B] focus:border-[#BF5A4B] transition text-gray-700 placeholder-gray-400"
                                placeholder="name@gmail.com">
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Password Fields --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Password --}}
                        <div class="space-y-1">
                            <label for="password" class="block text-sm font-medium text-gray-600">Password (Optional)</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#BF5A4B] focus:border-[#BF5A4B] transition text-gray-700 placeholder-gray-400"
                                    placeholder="Leave blank if unchanged">
                                <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="space-y-1">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirm Password</label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-1 focus:ring-[#BF5A4B] focus:border-[#BF5A4B] transition text-gray-700 placeholder-gray-400"
                                    placeholder="••••••••">
                                <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="flex justify-end space-x-3 pt-2">
                    <a href="{{ route('users.index') }}"
                    class="px-4 py-2 border border-gray-200 rounded-md text-gray-600 hover:bg-gray-50 transition-colors text-sm">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 text-white rounded-md bg-[#4F46E5] hover:bg-[#3b35a9] focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-[#BF5A4B] transition-colors text-sm">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    // Password toggle functionality
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.querySelector('svg').classList.toggle('text-gray-600');
        });
    });
</script>
@endsection