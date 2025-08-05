@extends('layouts.app')
@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-gray-50">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <main class="flex-1 p-6 overflow-y-auto ml-64">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            {{-- Header --}}
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h1 class="text-xl font-semibold text-gray-800">Attack Parameters</h1>
                <p class="text-sm text-gray-500">Configure your attack settings precisely</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('attack-server.store') }}" class="p-6 space-y-6">
                @csrf

                {{-- Attack Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 flex justify-between">
                        <span>Attack Name</span>
                        <span class="text-xs text-gray-400">Required</span>
                    </label>
                    <input type="text" name="nama_serangan" id="nama_serangan" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="e.g. Main Server Attack" required>
                </div>

                {{-- DOS Type & Source Server --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- DOS Type --}}
                    <div>
                        <label for="dos_type" class="block text-sm font-medium text-gray-700 mb-1">DOS Type</label>
                        <div class="flex rounded-md shadow-sm">
                            <select id="dos_type" name="dos_type" 
                                    class="flex-1 min-w-0 block w-full px-3 py-2 rounded-l-md border border-gray-300 text-sm text-gray-500 focus:ring-indigo-500 focus:border-indigo-500" required>
                                <option value="" disabled selected>Select DOS type...</option>
                                @foreach($dosTypes as $type)
                                    <option value="{{ $type->name }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" id="openDosTypeModalBtn" 
                                    class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Source Server --}}
                    <div>
                        <label for="source_server_type" class="block text-sm font-medium text-gray-700 mb-1">Source Server</label>
                        <div class="flex rounded-md shadow-sm">
                            <select id="source_server_type" name="source_server" 
                                    class="flex-1 min-w-0 block w-full px-3 py-2 rounded-l-md border border-gray-300 text-gray-500 text-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                <option value="" disabled selected>Select server...</option>
                                @foreach($sourceServerTypes as $type)
                                    <option value="{{ $type->name }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" id="openSourceServerModalBtn" 
                                    class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Target IP --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 flex justify-between">
                        <span>Target IP</span>
                        <span class="text-xs text-gray-400">Required</span>
                    </label>
                    <input type="text" name="ip_target" id="ip_target" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="e.g. 192.168.1.1" required>
                </div>
                
                {{-- Target Details --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Target Port</label>
                        <input type="number" name="port" id="port" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500" 
                               placeholder="e.g. 80" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Duration (s)</label>
                        <input type="number" name="durasi" id="durasi" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500" 
                               placeholder="e.g. 60" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data Size (MB)</label>
                        <input type="number" name="data_size" id="data_size" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500" 
                               placeholder="e.g. 100" required>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Save Attack
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

{{-- DOS Type Management Modal --}}
<div id="manageDosTypeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Manage DOS Types</h3>
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
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <button type="submit" class="px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Save
                        </button>
                        <button type="button" id="cancelDosEditBtn" class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hidden">
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
            <h3 class="text-lg font-semibold text-gray-800">Manage Source Servers</h3>
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
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <button type="submit" class="px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Save
                        </button>
                        <button type="button" id="cancelSourceEditBtn" class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hidden">
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
    // --- DOS Type Management ---
    const dosModal = document.getElementById('manageDosTypeModal');
    const dosOpenBtn = document.getElementById('openDosTypeModalBtn');
    const dosCloseBtn = document.getElementById('closeDosTypeModalBtn');
    const dosTableBody = document.getElementById('dosTypeTableBody');
    const dosMainSelect = document.getElementById('dos_type');
    const dosForm = document.getElementById('dosTypeForm');
    const dosIdField = document.getElementById('dosTypeId');
    const dosNameField = document.getElementById('dosTypeName');
    const dosCancelBtn = document.getElementById('cancelDosEditBtn');
    const csrfToken = '{{ csrf_token() }}';

    // Fetch and render DOS types
    async function fetchDosTypes() {
        try {
            const response = await fetch('{{ route('dos-types.index') }}');
            const types = await response.json();
            
            // Update table
            dosTableBody.innerHTML = '';
            types.forEach(type => {
                const row = `
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">${type.name}</td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full ${type.is_custom ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
                                ${type.is_custom ? 'Custom' : 'Default'}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                            ${type.is_custom ? `
                                <button onclick="prepareEditDos(${type.id}, '${type.name}')" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                <button onclick="deleteDos(${type.id})" class="text-red-600 hover:text-red-900">Delete</button>
                            ` : '<span class="text-gray-400">N/A</span>'}
                        </td>
                    </tr>
                `;
                dosTableBody.innerHTML += row;
            });

            // Update select dropdown
            const selectedValue = dosMainSelect.value;
            dosMainSelect.innerHTML = '<option value="" disabled selected>Select DOS type...</option>';
            types.forEach(type => {
                const option = new Option(type.name, type.name);
                if (type.name === selectedValue) option.selected = true;
                dosMainSelect.add(option);
            });

        } catch (error) {
            console.error('Fetch error:', error);
            dosTableBody.innerHTML = `<tr><td colspan="3" class="px-4 py-2 text-sm text-red-600">Failed to load data</td></tr>`;
        }
    }

    // Reset DOS form
    function resetDosForm() {
        dosForm.reset();
        dosIdField.value = '';
        dosCancelBtn.classList.add('hidden');
    }

    // DOS form submit
    dosForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = dosIdField.value;
        const url = id ? `/dos-types/${id}` : '{{ route('dos-types.store') }}';
        const method = id ? 'PUT' : 'POST';
        
        try {
            const response = await fetch(url, {
                method,
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name: dosNameField.value })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to save data');
            }

            resetDosForm();
            await fetchDosTypes();
        } catch (error) {
            console.error('Submit error:', error);
            alert(`Error: ${error.message}`);
        }
    });

    // Prepare DOS edit
    window.prepareEditDos = (id, name) => {
        dosIdField.value = id;
        dosNameField.value = name;
        dosCancelBtn.classList.remove('hidden');
        dosNameField.focus();
    };

    // Delete DOS type
    window.deleteDos = async (id) => {
        if (!confirm('Are you sure you want to delete this DOS type?')) return;
        
        try {
            const response = await fetch(`/dos-types/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to delete data');
            }

            await fetchDosTypes();
        } catch (error) {
            console.error('Delete error:', error);
            alert(`Error: ${error.message}`);
        }
    };

    // --- Source Server Management ---
    const sourceModal = document.getElementById('manageSourceServerModal');
    const sourceOpenBtn = document.getElementById('openSourceServerModalBtn');
    const sourceCloseBtn = document.getElementById('closeSourceServerModalBtn');
    const sourceTableBody = document.getElementById('sourceServerTableBody');
    const sourceMainSelect = document.getElementById('source_server_type');
    const sourceForm = document.getElementById('sourceServerForm');
    const sourceIdField = document.getElementById('sourceServerId');
    const sourceNameField = document.getElementById('sourceServerName');
    const sourceCancelBtn = document.getElementById('cancelSourceEditBtn');

    // Fetch and render source servers
    async function fetchSourceServers() {
        try {
            const response = await fetch('{{ route('source-types.index') }}');
            const types = await response.json();
            
            // Update table
            sourceTableBody.innerHTML = '';
            types.forEach(type => {
                const row = `
                    <tr class="hover:bg-gray-50">
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
                sourceTableBody.innerHTML += row;
            });

            // Update select dropdown
            const selectedValue = sourceMainSelect.value;
            sourceMainSelect.innerHTML = '<option value="" disabled selected>Select server...</option>';
            types.forEach(type => {
                const option = new Option(type.name, type.name);
                if (type.name === selectedValue) option.selected = true;
                sourceMainSelect.add(option);
            });

        } catch (error) {
            console.error('Fetch error:', error);
            sourceTableBody.innerHTML = `<tr><td colspan="3" class="px-4 py-2 text-sm text-red-600">Failed to load data</td></tr>`;
        }
    }

    // Reset source form
    function resetSourceForm() {
        sourceForm.reset();
        sourceIdField.value = '';
        sourceCancelBtn.classList.add('hidden');
    }

    // Source form submit
    sourceForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = sourceIdField.value;
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
                body: JSON.stringify({ name: sourceNameField.value })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to save data');
            }

            resetSourceForm();
            await fetchSourceServers();
        } catch (error) {
            console.error('Submit error:', error);
            alert(`Error: ${error.message}`);
        }
    });

    // Prepare source edit
    window.prepareEditSource = (id, name) => {
        sourceIdField.value = id;
        sourceNameField.value = name;
        sourceCancelBtn.classList.remove('hidden');
        sourceNameField.focus();
    };

    // Delete source server
    window.deleteSource = async (id) => {
        if (!confirm('Are you sure you want to delete this source server?')) return;
        
        try {
            const response = await fetch(`/source-server-types/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to delete data');
            }

            await fetchSourceServers();
        } catch (error) {
            console.error('Delete error:', error);
            alert(`Error: ${error.message}`);
        }
    };

    // Event listeners
    dosOpenBtn.addEventListener('click', () => {
        dosModal.classList.remove('hidden');
        fetchDosTypes();
    });

    dosCloseBtn.addEventListener('click', () => {
        dosModal.classList.add('hidden');
    });

    dosCancelBtn.addEventListener('click', resetDosForm);

    sourceOpenBtn.addEventListener('click', () => {
        sourceModal.classList.remove('hidden');
        fetchSourceServers();
    });

    sourceCloseBtn.addEventListener('click', () => {
        sourceModal.classList.add('hidden');
    });

    sourceCancelBtn.addEventListener('click', resetSourceForm);

    // Close modals when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === dosModal) {
            dosModal.classList.add('hidden');
        }
        if (event.target === sourceModal) {
            sourceModal.classList.add('hidden');
        }
    });
});
</script>
@endpush