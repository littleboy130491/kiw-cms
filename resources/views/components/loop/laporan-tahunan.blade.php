<!--Item-->
<a class="overlay-laporan-tahunan-grid flex flex-col justify-between gap-5 bg-white p-6 pb-0 mini-radius bg-cover bg-top" href="{{ $item->fileMedia?->url }}" target="_blank" style="background-image:url('{{ $backgroundHome }}')">
    <div class="flex flex-col gap-2 mt-15 z-5">
        <span class="w-[24px] h-full fill-white"><x-icon.document-icon-current /></span>
        <h5 class="text-white">{{ $item->title ?? 'Laporan Tahunan' }}</h5>
</div>
    <div class="mt-0 z-5">
        <div class="w-full btn10">
            <span class="text-white">Lihat Dokumen</span>
            <span>
                <x-icon.download-icon-white/>
            </span>
        </div>
    </div>
</a>