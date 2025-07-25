	
@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-white/80">

    {{-- Sidebar --}}
    <aside class="w-64 bg-[#C9C9C9] text-white flex flex-col">
        <div class="p-4 text-center border-b border-[#5A5252]">
            <img src="{{ asset('image/ABH-LOGO-HORIZONTAL_RED.png') }}" class="w-32 mx-auto mb-2">
            @auth
                <h1 class="text-lg font-medium text-[#5A5252] mt-2">
                    Welcome, <span class="font-semibold">
                        {{ auth()->user()->name ?? auth()->user()->email ?? 'User' }}
                    </span>
                </h1>
            @endauth
        </div>   

       <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="block py-2 px-4 text-[#5A5252] rounded-lg hover:bg-gray-400/30 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Dashboard
            </a>
            <a href="#" class="block py-2 px-4 text-[#5A5252] rounded-lg hover:bg-gray-400/30 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Attack Server
            </a>
            <a href="{{ route('recent-attacks') }}" class="block py-2 px-4 text-[#5A5252] rounded-lg hover:bg-gray-400/30 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Monitor Recent Victim
            </a>
            <a href="{{ route('user-management') }}" class="block py-2 px-4 text-[#5A5252] rounded-lg hover:bg-[#5A5252]/10 transition-colors font-medium duration-200">
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

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            {{-- Header Section --}}
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-800">Add New User</h2>
                    <a href="{{ route('user-management') }}" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <p class="mt-1 text-sm text-gray-600">Fill in the form below to create a new user account</p>
            </div>

            {{-- Form Section --}}
            <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- Name Field --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="John Doe">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                               placeholder="john@example.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Password Fields --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                   placeholder="••••••••">
                            <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                   placeholder="••••••••">
                            <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Roles Section --}}
                <div>
                    <p class="block text-sm font-medium mb-1">Assign Roles</p>
                    <div class="space-y-2">
                        @foreach($roles as $role)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                @if(in_array($role->name, old('roles',[]))) checked @endif>
                            <span class="ml-2 text-sm">{{ $role->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('roles') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                {{-- Form Actions --}}
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('user-management') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-[#BF5A4B]/90 text-white rounded-md hover:hover:bg-[#a84a3b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Create User
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
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'pass  word';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    }); 

    // Form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Add any additional client-side validation here
        });
    }
});
</script>
@endsection