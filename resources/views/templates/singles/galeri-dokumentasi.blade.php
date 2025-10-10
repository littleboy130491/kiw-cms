@php

    $mediaSosial = [
        'mediaSosialTitle' => 'Media Sosial',
    ];

    $dokumentasiVideos = [
        'dokumentasiVideosTitle' => 'Dokumentasi Video',
        'youtubeVideos' => [
            'https://www.youtube.com/watch?v=-jK-qj3ZNLI&ab_channel=PTKIW',
            'https://www.youtube.com/watch?v=Gkd6nIngOY4&ab_channel=PTKIW',
            'https://www.youtube.com/watch?v=ZaFJi0aiWsg&ab_channel=PTKIW',
            'https://www.youtube.com/watch?v=YX5BzjiFFiw&ab_channel=PTKIW',
            'https://www.youtube.com/watch?v=cAYqlHFaS3M&ab_channel=PTKIW',
            'https://www.youtube.com/watch?v=dflIUeHhr-Y&ab_channel=PTKIW',
    ]
    ];
  
    $kegiatanPerusahaan = [
        'kegiatanPerusahaanTitle' => 'Kegiatan Perusahaan',
        'kegiatanPhotos'  => [
        Storage::url('media/meeting1.jpg'),
        Storage::url('media/meeting2.jpg'),
        Storage::url('media/meeting3.jpg'),
        Storage::url('media/68de453ddb354d391a8d5663da11ba12ddba1644.jpg'),
        Storage::url('media/f6cabd2de5943a8d8f58738613aac44d02f4a337.jpg'),
        Storage::url('media/0a241be596b369a0fd4b7da46c26f373c47c6812.jpg'),
        Storage::url('media/3b19c87fbab5e033d46d3595543c1b86ae4c39ef.jpg'),
    ],
    'kegiatanVideos' => [
        'https://www.youtube.com/watch?v=-jK-qj3ZNLI&ab_channel=PTKIW',
        'https://www.youtube.com/watch?v=Gkd6nIngOY4&ab_channel=PTKIW',
        'https://www.youtube.com/watch?v=ZaFJi0aiWsg&ab_channel=PTKIW',
        'https://www.youtube.com/watch?v=YX5BzjiFFiw&ab_channel=PTKIW',
        'https://www.youtube.com/watch?v=cAYqlHFaS3M&ab_channel=PTKIW',
        'https://www.youtube.com/watch?v=dflIUeHhr-Y&ab_channel=PTKIW',
        'https://www.youtube.com/watch?v=wjF-yr-_xAM&ab_channel=PTKIW',
        'https://www.youtube.com/watch?v=S4X7sZ1Yij0&ab_channel=PTKIW',
        'https://www.youtube.com/watch?v=O9n3YtBTip0&ab_channel=PTKIW',
    ]
    ];
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>
       <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/galeri-dokumentasi-hero.jpg')" h1="{{$item->title ?? 'Galeri Dokumentasi'}}" />

        <!--Start Foto-->

        <section id="photo-gallery"
            class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-7 lg:gap-10 lg:w-[1200px] lg:mx-auto">

            <!--Title-->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <h2 data-aos="fade-up">
                {{ $mediaSosial['mediaSosialTitle'] }}
                </h2>

                <!--button-->
                <a class="w-fit btn1" data-aos="fade-down"
                    href="{{ app('settings')->instagram ?? config('cms.site_social_media.instagram') }}" target="_blank"
                    rel="noopener noreferrer">kunjungi instagram
                    <x-icon.instagram-icon-white />
                </a>

            </div>

            <!--Content-->
            <x-instagram-feed type="image" :columns="4" />
            <x-instagram-behold/>


        </section>

        <!--End Foto -->

        <!--Start Video-->

        <section id="video-gallery" class="py-18 lg:py-30 bg-[var(--color-transit)]">
            <div x-data="{ tab: 'tab1' }" class="px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto gap-7">

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 ">

                    <h2 data-aos="fade-up">{{ $dokumentasiVideos['dokumentasiVideosTitle'] }}</h2>

                    <!-- Tab Headers -->
                    <div class="flex flex-row gap-2 sm:gap-2 z-1" data-aos="fade-down">
                        <x-tab.tab-headers-video title="youtube" tab="tab1" />
                        <x-tab.tab-headers-video title="Reels instagram" tab="tab2" />
                    </div>
                </div>


                <!-- Tab Contents -->
                <x-tab.tab-contents-video id="tab1">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4">
                        @foreach ($dokumentasiVideos['youtubeVideos'] as $video)
                            <x-loop.youtube :src="$video" />
                        @endforeach
                    </div>

                </x-tab.tab-contents-video>


                <x-tab.tab-contents-video id="tab2">
                    <x-instagram-feed type="video" :columns="4" limit="20" />
                </x-tab.tab-contents-video>

            </div>
        </section>

        <!--End Video-->

        <!--Start Kegiatan Perusahaan-->
        <section id="kegiatan-perusahaan-gallery"
            class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-7 lg:gap-10 lg:w-[1200px] lg:mx-auto">
            <livewire:gallery-list />
           



        </section>
        <!--End Kegiatan Perusahaan-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
