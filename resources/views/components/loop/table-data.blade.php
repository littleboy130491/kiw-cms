@php
    $file = $item->fileMedia;
@endphp

<tr class="even:bg-[var(--color-darktransit)]">
    <td class="px-6 py-4">{{ $item->title ?? '' }}</td>
    <td class="px-6 py-4">{{ $file->getSizeForHumans() ?? '' }}</td>
    <td class="px-6 py-4">{{ $file->ext ?? '' }}</td>
    <td class="px-6 py-4">{{ $item->created_at->format('d-m-Y') ?? '' }}</td>
    <td class="px-6 py-4 flex flex-row justify-center">
        <a href="{{ $file->getSignedUrl() ?? '#' }}" target="_blank">
            <x-icon.download-icon />
        </a>
    </td>
</tr>
