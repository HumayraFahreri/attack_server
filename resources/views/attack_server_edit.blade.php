@extends('layouts.app')
@section('content')
<div class="min-h-screen flex flex-col md:flex-row">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <main class="flex-1 p-6 overflow-y-auto bg-gray-50 ml-64">
        <div class="max-w-4xl mx-auto">

            {{-- Form Section --}}
            <form action="{{ route('attack-server.update', $attack) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 space-y-6">

                    {{-- Header Section --}}
                    <div class="pb-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Edit Attack: {{ $attack->nama_serangan }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Update the attack parameters below</p>
                    </div>

                    <div class="space-y-6">
                        {{-- Attack Name --}}
                        <div>
                            <label for="nama_serangan" class="block text-sm font-medium text-gray-700 mb-1">Attack Name</label>
                            <input type="text" id="nama_serangan" name="nama_serangan" value="{{ old('nama_serangan', $attack->nama_serangan) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            @error('nama_serangan')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- DOS Type & Source Server --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="dos_type" class="block text-sm font-medium text-gray-700 mb-1">DOS Type</label>
                                <div class="flex rounded-md shadow-sm">
                                    <select id="dos_type" name="dos_type" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-l-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                        @foreach($dosTypes as $type)
                                            <option value="{{ $type->name }}" {{ old('dos_type', $attack->dos_type) == $type->name ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" id="openDosTypeModalBtn" class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('dos_type')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="source_server_type" class="block text-sm font-medium text-gray-700 mb-1">Source Server</label>
                                <div class="flex rounded-md shadow-sm">
                                    <select id="source_server_type" name="source_server" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-l-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                        @foreach($sourceServerTypes as $type)
                                            <option value="{{ $type->name }}" {{ old('source_server', $attack->source_server) == $type->name ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" id="openSourceServerModalBtn" class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('source_server_type')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Target Details --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <label for="ip_target" class="block text-sm font-medium text-gray-700 mb-1">IP Target</label>
                                <input type="text" id="ip_target" name="ip_target" value="{{ old('ip_target', $attack->ip_target) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                @error('ip_target')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="port" class="block text-sm font-medium text-gray-700 mb-1">Port</label>
                                <input type="number" id="port" name="port" value="{{ old('port', $attack->port) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                @error('port')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="durasi" class="block text-sm font-medium text-gray-700 mb-1">Duration (s)</label>
                                <input type="number" id="durasi" name="durasi" value="{{ old('durasi', $attack->durasi) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                @error('durasi')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="data_size" class="block text-sm font-medium text-gray-700 mb-1">Data Size (MB)</label>
                                <input type="number" id="data_size" name="data_size" value="{{ old('data_size', $attack->data_size) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                @error('data_size')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('attack-server.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors text-sm">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors text-sm">
                            Update Attack
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

{{-- DOS Type Management Modal --}}
<div id="manageDosTypeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-lg font-bold">Manage DOS Types</h3>
            <button id="closeDosTypeModalBtn" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="mt-4 space-y-4">
            <form id="dosTypeForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Add/Edit DOS Type</label>
                    <input type="hidden" id="dosTypeId">
                    <div class="flex space-x-2">
                        <input type="text" id="dosTypeName" placeholder="DOS Type Name" 
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm">
                            Save
                        </button>
                        <button type="button" id="cancelEditBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 text-sm hidden">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>

            <div class="border-t border-gray-200 pt-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Available DOS Types</h4>
                <div class="overflow-y-auto max-h-60">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="dosTypeTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Filled by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Source Server Management Modal --}}
<div id="manageSourceServerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-lg font-bold">Manage Source Server Types</h3>
            <button id="closeSourceServerModalBtn" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="mt-4 space-y-4">
            <form id="sourceServerForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Add/Edit Source Server</label>
                    <input type="hidden" id="sourceServerId">
                    <div class="flex space-x-2">
                        <input type="text" id="sourceServerName" placeholder="Source Server Name" 
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm">
                            Save
                        </button>
                        <button type="button" id="cancelSourceEditBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 text-sm hidden">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>

            <div class="border-t border-gray-200 pt-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Available Source Servers</h4>
                <div class="overflow-y-auto max-h-60">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sourceServerTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Filled by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Element Selectors ---
    const modal = document.getElementById('manageDosTypeModal');
    const openBtn = document.getElementById('openDosTypeModalBtn');
    const closeBtn = document.getElementById('closeDosTypeModalBtn');
    const tableBody = document.getElementById('dosTypeTableBody');
    const mainSelect = document.getElementById('dos_type');

    const dosTypeForm = document.getElementById('dosTypeForm');
    const dosTypeIdField = document.getElementById('dosTypeId');
    const dosTypeNameField = document.getElementById('dosTypeName');
    const cancelEditBtn = document.getElementById('cancelEditBtn');

    const csrfToken = '{{ csrf_token() }}';

    // --- Core Functions ---
    async function fetchAndRenderAll() {
        try {
            const response = await fetch('{{ route('dos-types.index') }}');
            if (!response.ok) throw new Error('Network response was not ok');
            const types = await response.json();

            tableBody.innerHTML = '';
            types.forEach(type => {
                const row = `
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">${type.name}</td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full ${type.is_custom ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
                                ${type.is_custom ? 'Custom' : 'Default'}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                            ${type.is_custom ? `
                                <button onclick="window.prepareEditDos(${type.id}, '${type.name}')" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                <button onclick="window.deleteDosType(${type.id})" class="text-red-600 hover:text-red-900">Delete</button>
                            ` : '<span class="text-gray-400">N/A</span>'}
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });

            // Update main select dropdown on the form
            const selectedValue = mainSelect.value;
            mainSelect.innerHTML = '';
            types.forEach(type => {
                const option = new Option(type.name, type.name);
                if (type.name === selectedValue) {
                    option.selected = true;
                }
                mainSelect.add(option);
            });

        } catch (error) {
            console.error('Fetch error:', error);
            tableBody.innerHTML = `<tr><td colspan="3" class="px-4 py-2 text-sm text-red-600">Failed to load data.</td></tr>`;
        }
    }

    function resetForm() {
        dosTypeForm.reset();
        dosTypeIdField.value = '';
        cancelEditBtn.classList.add('hidden');
    }

    // --- Event Listeners ---
    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        fetchAndRenderAll();
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    cancelEditBtn.addEventListener('click', resetForm);

    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            modal.classList.add('hidden');
        }
    });

    dosTypeForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = dosTypeIdField.value;
        const isUpdating = !!id;
        const url = isUpdating ? `/dos-types/${id}` : '{{ route('dos-types.store') }}';
        const method = isUpdating ? 'PUT' : 'POST';

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ name: dosTypeNameField.value })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to save data.');
            }

            resetForm();
            await fetchAndRenderAll(); 

        } catch (error) {
            console.error('Submit error:', error);
            alert(`Error: ${error.message}`);
        }
    });

    window.prepareEditDos = (id, name) => {
        dosTypeIdField.value = id;
        dosTypeNameField.value = name;
        cancelEditBtn.classList.remove('hidden');
        dosTypeNameField.focus();
    };

    window.deleteDosType = async (id) => {
        if (!confirm('Are you sure you want to delete this DOS type?')) return;

        try {
            const response = await fetch(`/dos-types/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to delete data.');
            }
            await fetchAndRenderAll();
        } catch (error) {
            console.error('Delete error:', error);
            alert(`Error: ${error.message}`);
        }
    };
});

// Source Server Management
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('manageSourceServerModal');
    const openBtn = document.getElementById('openSourceServerModalBtn');
    const closeBtn = document.getElementById('closeSourceServerModalBtn');
    const tableBody = document.getElementById('sourceServerTableBody');
    const mainSelect = document.getElementById('source_server_type');
    const form = document.getElementById('sourceServerForm');
    const idField = document.getElementById('sourceServerId');
    const nameField = document.getElementById('sourceServerName');
    const cancelBtn = document.getElementById('cancelSourceEditBtn');
    const csrfToken = '{{ csrf_token() }}';

    async function fetchAndRender() {
        try {
            const response = await fetch('{{ route('source-types.index') }}');
            const types = await response.json();
            
            tableBody.innerHTML = '';
            types.forEach(type => {
                const row = `
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">${type.name}</td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full ${type.is_custom ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
                                ${type.is_custom ? 'Custom' : 'Default'}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                            ${type.is_custom ? `
                                <button onclick="prepareEditSource(${type.id}, '${type.name}')" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                <button onclick="deleteSource(${type.id})" class="text-red-600 hover:text-red-900">Delete</button>
                            ` : '<span class="text-gray-400">N/A</span>'}
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });

            // Update main select dropdown
            const selectedValue = mainSelect.value;
            mainSelect.innerHTML = '';
            types.forEach(type => {
                const option = new Option(type.name, type.name);
                if (type.name === selectedValue) option.selected = true;
                mainSelect.add(option);
            });
        } catch (error) { 
            console.error('Fetch error:', error);
            tableBody.innerHTML = `<tr><td colspan="3" class="px-4 py-2 text-sm text-red-600">Failed to load data.</td></tr>`;
        }
    }

    function resetForm() {
        form.reset();
        idField.value = '';
        cancelBtn.classList.add('hidden');
        nameField.focus();
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = idField.value;
        const url = id ? `/source-server-types/${id}` : '{{ route('source-types.store') }}';
        const method = id ? 'PUT' : 'POST';
        try {
            const response = await fetch(url, {
                method, 
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': csrfToken, 
                    'Accept': 'application/json' 
                },
                body: JSON.stringify({ name: nameField.value })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to save data.');
            }

            resetForm();
            await fetchAndRender();
        } catch (error) { 
            console.error('Submit error:', error);
            alert(`Error: ${error.message}`); 
        }
    });

    window.prepareEditSource = (id, name) => { 
        idField.value = id; 
        nameField.value = name; 
        cancelBtn.classList.remove('hidden'); 
    };

    window.deleteSource = async (id) => {
        if (!confirm('Are you sure you want to delete this source server type?')) return;
        try { 
            const response = await fetch(`/source-server-types/${id}`, { 
                method: 'DELETE', 
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to delete data.');
            }

            await fetchAndRender();
        } catch (error) { 
            console.error('Delete error:', error);
            alert('Failed to delete'); 
        }
    };

    openBtn.addEventListener('click', () => { 
        modal.classList.remove('hidden'); 
        fetchAndRender(); 
    });
    
    closeBtn.addEventListener('click', () => { 
        modal.classList.add('hidden'); 
    });
    
    cancelBtn.addEventListener('click', resetForm);
});
</script>
@endpush