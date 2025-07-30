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
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5A5252]">{{ $attack->ip_target }}</td>
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
                            @if($attack->status == 'Blocked') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $attack->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                        <button class="text-[#BF5A4B] hover:text-[#a84a3b] mr-3"><i class="fas fa-eye"></i></button>
                        <button class="text-[#5A5252] hover:text-[#3d3636]"><i class="fas fa-ellipsis-v"></i></button>
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