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

    {{-- Main content --}}
    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-[#5A5252]">User Management</h1>
            <a href="{{ route('users.create') }}"class="px-4 py-2 bg-[#BF5A4B]/90 text-white rounded-md hover:hover:bg-[#a84a3b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Add User
            </a>

        </div>

    {{-- user Table --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 border-b border-[#C9C9C9]">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-[#5A5252]">User</h2>
                    <div class="relative">
                        <input type="text" placeholder="Search attacks..." class="border border-[#C9C9C9] rounded-md pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#BF5A4B] focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-[#5A5252]"></i>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#C9C9C9]">
                    <thead class="bg-[#5A5252]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Roles</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#C9C9C9]">
                        <!-- Critical Attack -->
                        <tr class="hover:bg-[#f5f5f5]">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#5A5252]">wawa</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5A5252]">najwa@gmail.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5A5252]">admin</td>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <button class="text-[#BF5A4B] hover:text-[#a84a3b] mr-3"><i class="fas fa-trash"></i></button>
                                <button class="text-[#5A5252] hover:text-[#3d3636]"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
@endsection

@section('scripts')
<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    // You can add any specific JavaScript for this page here
    // For example, sorting functionality for the table
    document.addEventListener('DOMContentLoaded', function() {
        // Add interactive functionality here
    });
</script>
@endsection
