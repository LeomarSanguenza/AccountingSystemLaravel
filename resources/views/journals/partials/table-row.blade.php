{{-- Journal Table Row Partial --}}
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
    {{ $journal->journal_entry_no }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ $journal->voucher_no ?? '-' }}
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ \Carbon\Carbon::parse($journal->entrydate)->format('M d, Y') }}
</td>
<td class="px-6 py-4 text-sm text-gray-900">
    <div class="max-w-xs">
        <p class="truncate" title="{{ $journal->particulars }}">
            {{ Str::limit($journal->particulars, 50) }}
        </p>
    </div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
        {{ $journal->details_count ?? 0 }} entries
    </span>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
    <x-action-buttons 
        :view-route="route('journals.show', $journal->hdr_id)"
        :edit-route="route('journals.edit', $journal->hdr_id)"
        :delete-route="route('journals.destroy', $journal->hdr_id)"
        delete-confirm="Are you sure you want to delete this journal entry?" />
</td>