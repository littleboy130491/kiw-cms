@php
    $fallbackThumbnail = Storage::url('media/dadc9265-8fd2-4f59-92af-7869b39f6272.png');
@endphp
<!--Item-->
<a class="flex flex-col justify-between gap-4 bg-white p-6 pb-0 mini-radius" href="{{ $item->fileMedia?->url }}" target="_blank">
   <img src="{{ $item->featuredImage?->url ?? $fallbackThumbnail }}" class="w-full h-[320px] object-cover rounded-sm object-top">
    <div class="mt-0 z-5 flex flex-col gap-5">
    <h5>{{ $item->title ?? 'Laporan Tahunan' }}</h5>
        <div class="w-full btn10">
            <span class="gradient-text">Lihat Dokumen</span>
            <span>
                <x-icon.download-icon/>
            </span>
        </div>
    </div>
</a>