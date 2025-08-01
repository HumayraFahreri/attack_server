@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-white/80">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

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
