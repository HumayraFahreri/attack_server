@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-white/80">

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
            <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 rounded-lg hover:bg-[#5A5252]/10 transition-colors">
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

    {{-- Main content --}}
        <main class="flex-1 p-6 overflow-y-auto bg-gray-400/30 ml-64">
            <div class="mb-8">
                <h1 class="text-2xl font-semibold text-[#5A5252]">Recent Attack Monitoring</h1>
            </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
        <div class="bg-white p-6 rounded-lg shadow-2xl border-l-4 border-pink-500">
            <p class="text-sm text-[#5A5252]">Total Attacks</p>
            <h3 class="text-xl font-bold text-[#5A5252]">{{ number_format($stats['total_attacks']) }}</h3>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-2xl border-l-4 border-green-500">
            <p class="text-sm text-[#5A5252]">Blocked</p>
            <h3 class="text-xl font-bold text-[#5A5252]">{{ number_format($stats['blocked_attacks']) }}</h3>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-2xl border-l-4 border-blue-500">
            <p class="text-sm text-[#5A5252]">TCP Attacks</p>
            <h3 class="text-xl font-bold text-[#5A5252]">{{ number_format($stats['tcp_attacks']) }}</h3>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-2xl border-l-4 border-yellow-500">
            <p class="text-sm text-[#5A5252]">Critical</p>
            <h3 class="text-xl font-bold text-[#5A5252]">{{ number_format($stats['critical_attacks']) }}</h3>
        </div>
    </div>

        {{-- Filters --}}
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-lg font-semibold text-[#5A5252] mb-4">Filter Attacks</h2>
            <div class="grid grid-cols-4 gap-6">
                <!-- Date Range -->
                <div>
                <label class="block text-sm font-medium text-[#5A5252]/80 mb-2">Date Range</label>
                <select id="date_range" class="block w-full border border-[#c9c9c9] rounded-md py-2 px-3 text-sm text-[#5A5252]">
                    <option value="" disabled selected hidden>Select range...</option>
                    <option value="7day">Last 7 Days</option>
                    <option value="30day">Last 30 Days</option>
                    <option value="custom">Custom Range</option>
                </select>

                <!-- Custom Range Input -->
                <div id="custom-range-inputs" class="mt-4 hidden">
                    <label class="block text-sm font-medium text-[#5A5252]/80 mb-1">From</label>
                    <input type="date" id="start_date" class="block w-full mb-3 border border-[#c9c9c9] rounded-md py-2 px-3 text-sm text-[#5A5252]">

                    <label class="block text-sm font-medium text-[#5A5252]/80 mb-1">To</label>
                    <input type="date" id="end_date" class="block w-full border border-[#c9c9c9] rounded-md py-2 px-3 text-sm text-[#5A5252]">
                </div>
                </div>

                <!-- Attack Type -->
                <div>
                <label class="block text-sm font-medium text-[#5A5252]/80 mb-2">Attack Type</label>
                <select id="attack_type" class="block w-full border border-[#c9c9c9] rounded-md py-2 px-3 text-sm text-[#5A5252]">
                    <option value="" selected disabled hidden>Select attack type...</option>
                    <option value="all">All Types</option>
                    <option value="tcp">TCP Flood</option>
                    <option value="udp">UDP Flood</option>
                    <option value="icmp">ICMP Flood</option>
                </select>
                </div>

                <!-- Severity -->
                <div>
                <label class="block text-sm font-medium text-[#5A5252]/80 mb-2">Severity</label>
                <select id="severity" class="block w-full border border-[#c9c9c9] rounded-md py-2 px-3 text-sm text-[#5A5252]">
                    <option value="" selected disabled hidden>Select severity...</option>
                    <option value="allLevel">All Levels</option>
                    <option value="critical">Critical</option>
                    <option value="high">High</option>
                    <option value="med">Medium</option>
                    <option value="low">Low</option>
                </select>
                </div>

                <!-- Button -->
                <div class="flex items-end">
                <button id="apply_filters" class="w-full text-sm bg-[#000]/50 hover:bg-[#000]/60 text-white py-2 px-4 rounded transition-colors duration-200">
                    Apply Filters
                </button>
                </div>
            </div>
            </div>


        {{-- Attack Table --}}
        <div id="attack-table-container" class="bg-white shadow-lg rounded-lg overflow-hidden">
        @include('partials.attack-table', ['attacks' => $attacks])
    </div>
</main>

</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateRange = document.getElementById("date_range");
    const customInputs = document.getElementById("custom-range-inputs");
    const startDate = document.getElementById("start_date");
    const endDate = document.getElementById("end_date");
    const attackType = document.getElementById("attack_type");
    const severity = document.getElementById("severity");
    const applyButton = document.getElementById("apply_filters");
    const tableContainer = document.getElementById("attack-table-container");

    // Toggle custom range input
    dateRange.addEventListener("change", () => {
        customInputs.classList.toggle("hidden", dateRange.value !== "custom");
    });

    // Fungsi untuk mengambil data dengan filter
    function fetchFilteredAttacks(url = "{{ route('attacks.filter') }}") {
        const filters = {
            date_range: dateRange.value,
            start_date: startDate.value,
            end_date: endDate.value,
            attack_type: attackType.value,
            severity: severity.value,
        };

        console.log("Applying filters:", filters);

        // Menampilkan loading spinner (opsional)
        tableContainer.innerHTML = '<div class="text-center p-10">Loading...</div>';

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json",
            },
            body: JSON.stringify(filters),
        })
        .then(res => res.json())
        .then(data => {
            // Ganti isi container dengan HTML baru dari server
            tableContainer.innerHTML = data.html;
        })
        .catch(err => {
            console.error("Error fetching filtered attacks:", err);
            tableContainer.innerHTML = '<div class="text-center p-10 text-red-500">Failed to load data.</div>';
        });
    }

    // Terapkan filter saat tombol diklik
    applyButton.addEventListener("click", (e) => {
        e.preventDefault();
        fetchFilteredAttacks();
    });

    // Event Delegation untuk link paginasi
    // Ini penting karena link paginasi dibuat ulang setiap kali filter diterapkan
    tableContainer.addEventListener('click', function (e) {
        // Cek apakah yang diklik adalah link di dalam elemen paginasi
        if (e.target.tagName === 'A' && e.target.closest('.pagination')) {
            e.preventDefault(); // Mencegah browser redirect
            const url = e.target.href;
            if (url) {
                fetchFilteredAttacks(url);
            }
        }
    });
});
</script>
@endsection
