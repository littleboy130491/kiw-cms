<!--Item-->
<a class="flex flex-col justify-between gap-4 bg-white p-6 pb-0 mini-radius" href="{{ $item->fileMedia?->url }}" target="_blank">
   <img src="{{ $image ?? '' }}" class="w-full h-[320px] object-cover rounded-sm object-top">
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