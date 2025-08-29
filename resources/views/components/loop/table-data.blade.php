@php
    $file = $item->fileMedia;
@endphp

<tr class="even:bg-[var(--color-darktransit)] ">
    <td class="px-6 py-4">
        <img class="w-full h-[80px] object-contain object-left" src="{{ $cover ?? '' }}">
    </td>
    <td class="px-6 py-4">{{ $item->title ?? '' }}</td>
    <td class="px-6 py-4">{{ $file->getSizeForHumans() ?? '' }}</td>
    <td class="px-6 py-4">{{ $file->ext ?? '' }}</td>
    <td class="px-6 py-4">{{ $item->created_at->format('d-m-Y') ?? '' }}</td>
    <td class="px-6 py-4">
        <a href="{{ $file->getSignedUrl() ?? '#' }}" target="_blank" class="flex flex-row justify-center">
            <x-icon.download-icon />
        </a>
    </td>
</tr>
