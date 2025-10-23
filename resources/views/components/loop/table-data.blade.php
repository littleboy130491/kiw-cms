@php
    $file = $item->fileMedia;
     /*Revisi penambahan cover image*/
    $fallbackThumbnail = Storage::url('media/dadc9265-8fd2-4f59-92af-7869b39f6272.png');
@endphp

<tr class="even:bg-[var(--color-darktransit)] ">
    <td class="px-6 py-4">
        <img class="w-full h-[80px] object-contain object-left" src="{{ $item->featuredImage?->url ?? $fallbackThumbnail }}" loading="lazy"/>
    </td>
    <td class="px-6 py-4">{{ $item->title ?? '' }}</td>
    <td class="px-6 py-4">{{ $file?->getSizeForHumans() ?? '' }}</td>
    <td class="px-6 py-4">{{ $file?->ext ?? '' }}</td>
    <td class="px-6 py-4">{{ $item->published_at->format('d-m-Y') ?? '' }}</td>
    <td class="px-6 py-4">
        <a href="{{ $file?->getSignedUrl() ?? '#' }}" target="_blank" class="flex flex-row justify-center">
            <x-icon.download-icon />
        </a>
    </td>
</tr>
