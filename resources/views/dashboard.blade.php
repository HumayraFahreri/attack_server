@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-[#C9C9C9]">

    {{-- Sidebar --}}
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
            <a href="{{ route('parameter.serangan') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-400/30 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Attack Server
            </a>
            <a href="#" class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-400/30 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Attack History
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

    {{-- Main content --}}
    <main class="flex-1 p-6 overflow-y-auto bg-white/80 ml-64">
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-[#5A5252]">Dashboard</h1>
            <p class="text-[#5A5252]/80">Monitor network activity and statistics</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-[#BF5A4B] rounded-lg p-4 text-white shadow">
                <div class="text-sm font-medium">TCP Attacks</div>
                <div class="text-2xl font-bold mt-1">245</div>
                <div class="text-xs opacity-80 mt-2">+12% from last week</div>
            </div>
            <div class="bg-[#BF5A4B] rounded-lg p-4 text-white shadow">
                <div class="text-sm font-medium">UDP Attacks</div>
                <div class="text-2xl font-bold mt-1">183</div>
                <div class="text-xs opacity-80 mt-2">+8% from last week</div>
            </div>
            <div class="bg-[#BF5A4B] rounded-lg p-4 text-white shadow">
                <div class="text-sm font-medium">ICMP Attacks</div>
                <div class="text-2xl font-bold mt-1">92</div>
                <div class="text-xs opacity-80 mt-2">+5% from last week</div>
            </div>
            <div class="bg-[#BF5A4B] rounded-lg p-4 text-white shadow">
                <div class="text-sm font-medium">Total Attacks</div>
                <div class="text-2xl font-bold mt-1">520</div>
                <div class="text-xs opacity-80 mt-2">+9% from last week</div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg shadow p-4 border border-[#5A5252]/10 w-full max-w-[600px]">
                <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-[#5A5252]">Network Traffic</h2>
                <select class="text-sm border border-[#5A5252]/20 rounded px-2 py-1 bg-[#C9C9C9]/30">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>Last 90 days</option>
                </select>
                </div>
                <div class="flex justify-center">
                <canvas id="trafficChart" class="w-full max-w-[500px] h-64"></canvas>
                </div>
            </div>
        </div>



        {{-- Recent Events --}}
        <div class="bg-white rounded-lg shadow p-4 border border-[#5A5252]/10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-[#5A5252]">Recent Events</h2>
                <button class="text-sm text-[#BF5A4B] hover:text-[#BF5A4B]/80">View All</button>
            </div>
            <div class="space-y-3">
                <div class="flex items-start p-3 hover:bg-[#C9C9C9]/20 rounded-lg transition-colors">
                    <div class="bg-[#BF5A4B]/10 p-2 rounded-full mr-3">
                        <svg class="w-5 h-5 text-[#BF5A4B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h3 class="font-medium text-[#5A5252]">New TCP Attack</h3>
                            <span class="text-xs text-[#5A5252]/60">2 min ago</span>
                        </div>
                        <p class="text-sm text-[#5A5252]/80 mt-1">Attack initiated on 192.168.1.1</p>
                    </div>
                </div>
                <div class="flex items-start p-3 hover:bg-[#C9C9C9]/20 rounded-lg transition-colors">
                    <div class="bg-[#BF5A4B]/10 p-2 rounded-full mr-3">
                        <svg class="w-5 h-5 text-[#BF5A4B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h3 class="font-medium text-[#5A5252]">Attack Blocked</h3>
                            <span class="text-xs text-[#5A5252]/60">15 min ago</span>
                        </div>
                        <p class="text-sm text-[#5A5252]/80 mt-1">UDP flood from 103.21.45.67</p>
                    </div>
                </div>
                <div class="text-center py-4 text-[#5A5252]/60 text-sm">
                    No more events to show
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Egress Chart
    const egressCtx = document.getElementById('egressChart').getContext('2d');
    new Chart(egressCtx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'MB/s',
                data: [12, 19, 3, 5, 2, 3, 9],
                backgroundColor: '#BF5A4B',
                borderColor: '#BF5A4B',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#5A525220'
                    },
                    ticks: {
                        color: '#5A5252'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#5A5252'
                    }
                }
            }
        }
    });

    // Ingress Chart
        const trafficCtx = document.getElementById('trafficChart').getContext('2d');
        new Chart(trafficCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [
                    {
                        label: 'Egress',
                        data: [12, 19, 3, 5, 2, 3, 9],
                        backgroundColor: '#BF5A4B'
                    },
                    {
                        label: 'Ingress',
                        data: [8, 15, 5, 7, 4, 6, 12],
                        backgroundColor: '#5A5252'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#5A525220'
                        },
                        ticks: {
                            color: '#5A5252'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#5A5252'
                        }
                    }
                }
            }
        });

</script>
@endsection