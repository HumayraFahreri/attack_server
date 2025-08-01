@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main content --}}
    <main class="flex-1 p-6 overflow-y-auto bg-gray-400/30 ml-64">
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-[#5A5252]">Dashboard</h1>
            <p class="text-[#5A5252]/80">Monitor network activity and statistics</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
            <div class="bg-white p-6 rounded-lg shadow-2xl border-l-4 border-red-500">
                <p class="text-sm text-[#5A5252]">TCP Attacks</p>
                <h3 id="stats-tcp-attacks" class="text-xl font-bold text-[#5A5252]">{{ number_format($stats->tcp_attacks) }}</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-2xl border-l-4 border-yellow-500">
                <p class="text-sm text-[#5A5252]">UDP Attacks</p>
                <h3 id="stats-udp-attacks" class="text-xl font-bold text-[#5A5252]">{{ number_format($stats->udp_attacks) }}</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-2xl border-l-4 border-green-500">
                <p class="text-sm text-[#5A5252]">ICMP Attacks</p>
                <h3 id="stats-icmp-attacks" class="text-xl font-bold text-[#5A5252]">{{ number_format($stats->icmp_attacks) }}</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-2xl border-l-4 border-blue-500">
                <p class="text-sm text-[#5A5252]">Total Attacks</p>
                <h3 id="stats-total-attacks" class="text-xl font-bold text-[#5A5252]">{{ number_format($stats->total_attacks) }}</h3>
            </div>
        </div>

        {{-- Charts --}}
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg shadow p-4 border border-[#5A5252]/10 w-full">
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
                <button class="text-sm text-[#4F46E5] hover:text-[#3b35a9]">View All</button>
            </div>
            <div class="space-y-3">
                <div class="flex items-start p-3 hover:bg-[#C9C9C9]/20 rounded-lg transition-colors">
                    <div class="bg-[#4F46E5]/10 p-2 rounded-full mr-3">
                        <svg class="w-5 h-5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                    <div class="bg-[#4F46E5]/10 p-2 rounded-full mr-3">
                        <svg class="w-5 h-5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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