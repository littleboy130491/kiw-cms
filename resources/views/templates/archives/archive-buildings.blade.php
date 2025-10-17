<!-- @php
    $titleBPSPContent = [
        'title' => 'Bangunan Pabrik Siap Pakai',
        'desc' => 'KIW menghadirkan berbagai pilihan bangunan pabrik siap pakai berkualitas tinggi yang tersedia untuk disewa, dirancang untuk mendukung operasional industri secara langsung.
        <br><br>
        Setiap unit dilengkapi dengan utilitas lengkap dan ruang kantor terintegrasi, menawarkan solusi praktis untuk kegiatan manufaktur, logistik, dan industri lainnya.
        <br><br>
        Tersedia dalam berbagai ukuran untuk memenuhi kebutuhan operasional yang berbeda, bangunan-bangunan ini dibangun menggunakan material terbaik dan dirancang dengan efisiensi tinggi.',
        'image'=> [
            Storage::url('media/water-treatment-plant-2025-03-09-21-55-03-utc.jpg'),
            Storage::url('media/water-treatment-plant-2025-03-09-21-55-03-utc.jpg'),
            Storage::url('media/water-treatment-plant-2025-03-09-21-55-03-utc.jpg'),
            Storage::url('media/water-treatment-plant-2025-03-09-21-55-03-utc.jpg'),
        ],
        'titleSpec' => 'Spesifikasi :',
        'specItem' => [
            'Rangka Struktur: Konstruksi baja',
            'Mutu Beton: K-350',
            'Tinggi Bangunan Maksimum: 13 meter',
            'Kapasitas Beban Lantai: 2–4 ton/m²',
            'Ketinggian Lantai: 0,4 meter di atas permukaan jalan',
            'Ketebalan Lantai Beton: 25 cm',
            'Sistem Sirkulasi Udara: Louvre',
            'Ketinggian Halaman: 14 meter di atas permukaan jalan²',
        ]
    ];
@endphp -->
<x-layouts.app>
    <x-partials.header />
    <main>


        <x-partials.hero-page :image="isset($record->featuredImage) ? $record->featuredImage->url : Storage::url('media/bpsp.jpg')" h1="{{ $record->title ?? ($title ?? 'Bangunan Pabrik Siap Pakai') }}" />
        <!--Start Bangunan Pabrik-->

        <!-- <section id="bangunan-pabrik"
            class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-10 lg:gap-20 lg:w-[1200px] lg:mx-auto">

            
            <div class="flex flex-col mb-18">
                <div class="flex flex-col lg:flex-row gap-5 ">
                    <div class="flex flex-col gap-5 lg:w-3/4">
                        <h2 data-aos="fade-up">
                            {{$titleBPSPContent['title']}}
                        </h2>
                        <p>{!! $titleBPSPContent['desc'] !!}</p>
                    </div>
                    <div class="hidden lg:block lg:w-[440px]">
                        <img class="rounded-sm w-full" src="{{ $titleBPSPContent['image'][0] }}">
                    </div>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5 mt-9 lg:mt-5">
                   @foreach ($titleBPSPContent['image'] as $image)
                        @if ($loop->first)
                            <img class="rounded-sm lg:hidden w-[400px] object-cover" src="{{ $image }}">
                        @else
                            <img class="rounded-sm w-[400px] object-cover" src="{{ $image }}">
                        @endif
                    @endforeach

                </div>
            
                <div class="flex flex-col gap-5 mt-12">
                    <h3>{{ $titleBPSPContent['titleSpec'] }}</h3>
                    <ul class="sm:grid sm:grid-rows-4 sm:grid-flow-col sm:gap-x-3 !text-[var(--color-text)]">
                        @foreach ($titleBPSPContent['specItem'] as $specItem)
                            <li>{{ $specItem }}</li>
                        @endforeach
                    </ul>
                </div>

            </div> -->

            <section id="bangunan-pabrik"
            class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-10 lg:gap-20 lg:w-[1200px] lg:mx-auto">

            <!--Title-->
            <div class="flex flex-col lg:flex-row lg:items-center gap-5 lg:gap-10">
                <h2 data-aos="fade-up">
                    BPSP Modern & Fungsional
                </h2>
                <div class="flex flex-col gap-5">
                    <p class="sub-p" data-aos="fade-down">
                        {!! $record->content !!}
                    </p>
                    <p>
                        KIW juga siap mendirikan BPSP baru untuk memenuhi kebutuhan para investor dalam menjalankan
                        bisnis. Available BPSP 12 saat ini tersedia disewa dengan spesifikasi berikut.
                    </p>
                </div>
            </div>


            <!--Content-->
            @if ($items->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($items as $item)
                        <x-loop.bpsp :item="$item" />
                    @endforeach
                </div>
            @else
                <x-partials.post-not-found />
            @endif

            {{ $items->links() }}


        </section>

        <!--End Bangunan Pabrik-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
