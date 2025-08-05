<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-[#C9C9C9]">
        <thead class="bg-[#000]/50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Timestamp</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Attack IP</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">IP Target</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Type</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Target</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Severity</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-[#C9C9C9]">
            @forelse ($attacks as $attack)
                <tr class="hover:bg-[#f5f5f5]">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#5A5252]">{{ $attack->created_at->format('Y-m-d H:i:s') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5A5252]">{{ $attack->attack_ip }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5A5252]">{{ $attack->target_ip }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5A5252]">{{ $attack->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5A5252]">{{ $attack->target }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($attack->severity == 'Critical') bg-red-100 text-red-800
                            @elseif($attack->severity == 'High') bg-orange-100 text-orange-800
                            @elseif($attack->severity == 'Medium') bg-yellow-100 text-yellow-800
                            @else bg-blue-100 text-blue-800 @endif">
                            {{ $attack->severity }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($attack->status == 'Allowed') 
                                bg-green-100 text-green-800
                            @elseif($attack->status == 'Monitored')
                                bg-yellow-100 text-yellow-800
                            @else($attack->status == 'Blocked')
                                bg-red-100 text-red-800
                            @endif">
                            {{ $attack->status }}
                        </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        {{-- Tombol View Log --}}
                        <button class="text-[#1E40AF] hover:text-[#1D4ED8] mr-3" title="Lihat Log"
                            onclick="showLogModal('{{ $attack->details }}')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('attacks.destroy', $attack->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE') 
                            <button type="submit" class="text-[#BF5A4B] hover:text-[#a84a3b]" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1H9a1 1 0 00-1 1v3m1-3h6"></path>
                                </svg>
                            </button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-sm text-gray-500">No attacks found matching your criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="bg-white px-6 py-4 border-t border-[#C9C9C9]">
    {{ $attacks->links() }}
</div>