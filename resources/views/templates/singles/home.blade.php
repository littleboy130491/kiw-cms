@php
    $archive_post_url = route('cms.page', [app()->getLocale(), 'posts']);

    $blocks = collect($item->block);

    // About Home contentTop (main section)
    $aboutHomeTop = $blocks
        ->where('data.block_id', 'about-home')
        ->first();

    $aboutHomeIso = $blocks
        ->where('data.block_id', 'about-home-iso-images')
        ->first();

    $aboutHomeCounters = $blocks
        ->where('data.block_id', 'about-home-counter')
        ->pluck('data');

    // Build the dynamic $aboutHome array
    $aboutHome = [
        'contentTop' => [
            'subTitle' => $aboutHomeTop['data']['subtitle'] ?? null,
            'title'    => $aboutHomeTop['data']['title'] ?? null,
            'desc'     => $aboutHomeTop['data']['description'] ?? null,
            'iso'      => [
                'images' => $aboutHomeIso['data']['gallery_urls'] ?? [],
                'label'  => $aboutHomeIso['data']['title'] ?? null,
            ],
           
            'btnText' => $aboutHomeTop['data']['url'] ?? null,
            'btnLink' => $aboutHomeTop['data']['button_label'] ?? null,
        ],
        'contentBottom' => [
            'image'   => $aboutHomeTop['data']['media_url'] ?? null,
            'counter' => $aboutHomeCounters->map(fn($c) => [
                'counter' => (int) ($c['title'] ?? 0),
                'label'   => $c['description'] ?? '',
                'suffix'  => $c['suffix'] ?? '',
            ])->values()->all(),
        ],
    ];
   

    // Get main layanan-home section (title & subtitle)
    $layananHomeSection = $blocks
        ->where('data.block_id', 'layanan-home')
        ->first();

    // Get layanan-home-item blocks (each service card)
    $layananItems = $blocks
        ->where('data.block_id', 'layanan-home-item')
        ->pluck('data');

    // Build the final array dynamically
    $layananHome = [
        'layananTitle' => [
            'subTitle' => $layananHomeSection['data']['subtitle'] ?? null,
            'title'    => $layananHomeSection['data']['title'] ?? null,
        ],
        'layananContent' => $layananItems->map(fn($item) => [
            'label'   => $item['title'] ?? null,
            'desc'    => $item['description'] ?? null,
            'image'   => $item['media_url'] ?? null,
            // note: CMS field mapping — adjust if reversed
            'btnText' => $item['button_label'] ?? null,
            'btnLink' => $item['url'] ?? null,
        ])->values()->all(),
    ];

    // Get the main Keunggulan section (title, subtitle, background)
    $keunggulanSection = $blocks
        ->where('data.block_id', 'keunggulan-home')
        ->first();

    // Get all the individual Keunggulan items
    $keunggulanItems = $blocks
        ->where('data.block_id', 'keunggulan-home-item')
        ->pluck('data');

    // Build the dynamic structure
    $keunggulanHome = [
        'keunggulanTitle' => [
            'subTitle' => $keunggulanSection['data']['subtitle'] ?? null,
            'title'    => $keunggulanSection['data']['title'] ?? null,
            'image'    => $keunggulanSection['data']['media_url'] ?? null,
        ],
        'keunggulanItem' => $keunggulanItems->map(fn($item) => [
            'number' => $item['subtitle'] ?? null,
            'label'  => $item['title'] ?? null,
            'desc'   => $item['description'] ?? null,
            'url'    => $item['url'] ?? null,
            'btnText'=> $item['button_label'] ?? null,
        ])->values()->all(),
    ];

    //Start Fasilitas Data
    $fasilitasHomeBlocks = $blocks
        ->where('data.block_id', 'fasilitas-home')
        ->first();
    $fasilitasHome = [
        'subTitle' => $fasilitasHomeBlocks['data']['subtitle'] ?? null,
        'title' => $fasilitasHomeBlocks['data']['title'] ?? null,
        'url'   => $fasilitasHomeBlocks['data']['url'] ?? null,
        'label' => $fasilitasHomeBlocks['data']['button_label'] ?? null,
    ];
    //End Fasilitas Data

    //Start Video Home Data
    $videoBlocks = $blocks
        ->where('data.block_id', 'video-home')
        ->first();

    $videoHome = [
        'subTitle' => $videoBlocks['data']['subtitle'] ?? null,
        'title' => $videoBlocks['data']['title'] ?? null,
        'description' => $videoBlocks['data']['description'] ?? null,
        'videoLink' => $videoBlocks['data']['video_url'] ?? null,
        'image' => $videoBlocks['data']['media_url'] ?? null,
    ];
    //End Video Home Data

    //Start Tenant Logo Data
    $tenantBlocks = $blocks
        ->where('data.block_id', 'tenant-home')
        ->first();

    $tenantHome = [
        'tenantTitle' => [
            'subTitle' => $tenantBlocks['data']['subtitle'] ?? null,
            'title' => $tenantBlocks['data']['title'] ?? null,
            'description' => $tenantBlocks['data']['description'] ?? null,
        ],
        'tenantLogo' => [
            [
                'image' => Storage::url('media/logoipsum-1.png'),
            ],
            [
                'image' => Storage::url('media/logoipsum-2.png'),
            ],
            [
                'image' => Storage::url('media/logoipsum-3.png'),
            ],
            [
                'image' => Storage::url('media/logoipsum-4.png'),
            ],
            [
                'image' => Storage::url('media/logoipsum-7.png'),
            ],
            [
                'image' => Storage::url('media/logoipsum-8.png'),
            ],
            [
                'image' => Storage::url('media/logoipsum-8.png'),
            ],
            [
                'image' => Storage::url('media/logoipsum-8.png'),
            ],
        ],
    ];
    //End Tenant Logo Temporary Data

    //Start Berita Data
    $beritaBlocks = $blocks
        ->where('data.block_id', 'artikel-berita-home')
        ->first();

    $beritaHome = [
            'subTitle' => $beritaBlocks['data']['subtitle'] ?? null,
            'title' => $beritaBlocks['data']['title'] ?? null,
            'description' => $beritaBlocks['data']['description'] ?? null,
            'btnText' => $beritaBlocks['data']['button_label'] ?? null,
            'btnLink' => $beritaBlocks['data']['url'] ?? null,
    ];
    //End Berita Data

    //Start Laporan Data
    $laporanBlocks = $blocks
        ->where('data.block_id', 'hubungan-investor-home')
        ->first();

    $laporanHome = [
            'subTitle' => $laporanBlocks['data']['subtitle'] ?? null,
            'title' => $laporanBlocks['data']['title'] ?? null,
            'description' => $laporanBlocks['data']['description'] ?? null,
            'btnText' => $laporanBlocks['data']['button_label'] ?? null,
            'btnLink' => $laporanBlocks['data']['url'] ?? null,
    ];
    //End Laporan Data
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>

        <x-splash-screen :setOnce="false" />
        <x-popup-home :setOnce="false" />

        <x-sumimasen-cms::component-loader name="slider" />

        <!-- Start About Home -->
        <section id="about-home" class="bg-[var(--color-transit)] lg:py-30 py-18">
            <div
                class="flex flex-col overflow-hidden relative lg:gap-0 sm:gap-10 gap-10  lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">
                <!--top content-->
                <div class="flex lg:flex-row flex-col justify-between !gap-15 items-start lg:-mb-10">
                    <!--content left-->
                    <div class="flex flex-col justify-start gap-5 lg:!w-[55%]">
                        <h6 data-aos="fade-down" class="bullet-1">{{ $aboutHome['contentTop']['subTitle'] }}</h6>
                        <h2 data-aos="fade-up" class="text-[var(--color-heading)]">
                            {{ $aboutHome['contentTop']['title'] }}</h2>

                        <p class="body-text text-[var(--color-text)]">
                            {!! $aboutHome['contentTop']['desc'] !!}
                        </p>
                        <!--ISO-->
                        <div class="flex flex-row items-center gap-5 mt-4">
                            @foreach ($aboutHome['contentTop']['iso']['images'] as $image)
                                <img src="{{ $image }}" alt="iso">
                            @endforeach
                            <p class="!text-[var(--color-heading)] !text-[1.3em] w-[60px]">
                                {{ $aboutHome['contentTop']['iso']['label'] }}</p>
                        </div>
                        <!--button-->
                        <a class="w-fit btn1 mt-5" data-aos="fade-down"
                            href="{{ $aboutHome['contentTop']['btnLink'] }}">{{ $aboutHome['contentTop']['btnText'] }}
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!--image top right-->
                    <div class="lg:!w-[45%]">
                        <img class="rounded-2xl lg:!h-[550px] sm:!h-[450px] lg:!w-[unset] sm:!w-[100vw] object-cover"
                            src="{{ Storage::url('media/construction-site-with-cranes-construction-worker.jpg') }}"
                            alt="about">
                    </div>
                </div>


                <!--bottom content-->
                <div class="flex sm:flex-row flex-col-reverse justify-start items-center gap-10">
                    <!--content left-->
                    <div class="sm:w-[48%] w-[100%]">
                        <img class="rounded-2xl h-[340px] object-cover"
                            src="{{ Storage::url('media/pointing-sketch.jpg') }}">
                    </div>

                    <!--content right-->
                    <div class="grid grid-cols-2 gap-8">
                        @foreach ($aboutHome['contentBottom']['counter'] as $counter)
                            <x-loop.counter-about-home :counter="$counter['counter']" :suffix="$counter['suffix']"
                                :label="$counter['label']" />
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Home -->

        <!-- Start Layanan Home -->
        <section id="layanan-home" class="lg:py-30 py-18 bg-cover "
            style="background-image: url('{{ Storage::url('media/bg-grad.jpg') }}');">
            <div
                class="flex flex-col overflow-hidden relative lg:gap-20 sm:gap-10 gap-10 lg:px-0 lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">

                <!--Heading-->
                <div class="flex flex-col justify-start items-center gap-5">
                    <h6 class="bullet-2 text-white text-center" data-aos="fade-down">
                        {{ $layananHome['layananTitle']['subTitle'] }}</h6>
                    <h2 class="text-white text-center lg:w-[700px]" data-aos="fade-up">
                        {{ $layananHome['layananTitle']['title'] }}</h2>
                </div>

                <!--Content-->
                <div class="flex lg:flex-row flex-col gap-7">
                    @foreach($layananHome['layananContent'] as $layananContent)
                        <x-loop.layanan-home label="{{ $layananContent['label'] }}" desc="{{ $layananContent['desc'] }}"
                            url="{{ $layananContent['btnLink'] }}" :image="
                                    $layananContent['image']
                                " />
                    @endforeach
                </div>


            </div>
        </section>
        <!-- End Layanan Home -->

        <!--Start Keunggulan-->
        <section id="keunggulan-home" class="bg-no-repeat bg-cover"
            style="background-image: url('{{ Storage::url('media/back-keunggulan.jpg') }}')">
            <!--Overlay-->
            <div class="gradient-overlay-keunggulan lg:pt-30 pt-18 flex flex-col gap-10">

                <!--Title-->
                <div class="flex flex-col gap-5 lg:px-0 sm:px-6 px-4">
                    <h6 class="lg:text-center !text-white bullet-2" data-aos="fade-down">
                        {{ $keunggulanHome['keunggulanTitle']['subTitle'] }}</h6>
                    <h2 class="lg:text-center !text-white" data-aos="fade-up">
                        {{ $keunggulanHome['keunggulanTitle']['title'] }}</h2>
                </div>

                <!--Content-->
                <div class="flex lg:flex-row flex-col lg:px-0 lg:pb-0 pb-18 sm:px-6 px-4">
                    @foreach ($keunggulanHome['keunggulanItem'] as $item)
                        <x-loop.keunggulan-home :number="$item['number']" :label="$item['label']"
                           :desc="$item['desc']" :url="$item['url']" />
                    @endforeach

                </div>
            </div>
        </section>
        <!--End Keunggulan-->

        <!--Start Fasilitas Home-->
        <section id="fasilitas-home" class="overflow-hidden lg:my-30 my-18 lg:px-0 sm:px-6 px-4">
            <div class="flex sm:flex-row flex-col lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto gap-10 ">
                <!--title-->
                <div class="flex flex-col justify-between gap-5 sm:!w-[40%]">
                    <div class="flex flex-col justify-between gap-5">
                        <h6 class="bullet-1" data-aos="fade-down">{{ $fasilitasHome['subTitle'] }}</h6>
                        <h2 data-aos="fade-up">{{ $fasilitasHome['title'] }}</h2>
                    </div>

                    <!--button-->
                    <a class="w-fit btn1 mt-5" data-aos="fade-down" href="{{ $fasilitasHome['url'] }}">{{ $fasilitasHome['label'] }}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </a>
                </div>

                <!--carousel-->
                <x-loop.fasilitas-home-carousel />

            </div>
            <x-popup-content.fasilitas-popup />
        </section>

        <!--End Fasilitas Home-->


        <!--Start Video Home-->
        <section id="video-home"
            class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden lg:max-w-[1200px] lg:mx-auto lg:my-30 my-18 lg:px-0 sm:px-6 px-4">
            <div class="flex flex-col justify-between gap-5">
                <h6 class="bullet-1" data-aos="fade-down">{{ $videoHome['subTitle'] }}</h6>
                <h2 data-aos="fade-up">{{ $videoHome['title'] }}</h2>
                @if ( $videoHome['description'] )
                    <p class="body-text text-[var(--color-text)]">
                        {{ $videoHome['description'] }}
                    </p>
                @endif
                
            </div>
            <!-- Custom Thumbnail -->
            <div class="absolute inset-0 bg-cover bg-center cursor-pointer rounded-2xl lg:mx-0 sm:mx-6 mx-4"
                style="background-image: url('{{ $videoHome['image'] }} ') ;" onclick="loadVideo(this)">
                <!-- Custom Play Button -->
                <div class="flex items-center justify-center w-full h-full bg-black/10 rounded-2xl">
                    <svg class="max-w-30 hover:max-w-40 transition duration-1000" xmlns="http://www.w3.org/2000/svg"
                        version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 124.9 124.9">
                        <defs>
                            <style>
                                .cls-1,
                                .cls-2 {
                                    fill: #fff;
                                }

                                .cls-3 {
                                    fill: none;
                                }

                                .cls-2 {
                                    opacity: .2;
                                }
                            </style>
                            <clipPath id="clippath">
                                <circle class="cls-3" cx="62.4" cy="62.4" r="62.4" />
                            </clipPath>
                            <clipPath id="clippath-3">
                                <circle class="cls-3" cx="62.4" cy="62.4" r="48.8" />
                            </clipPath>
                            <clipPath id="clippath-6">
                                <circle class="cls-3" cx="62.4" cy="62.4" r="35.6" />
                            </clipPath>
                        </defs>
                        <!-- Generator: Adobe Illustrator 28.6.0, SVG Export Plug-In . SVG Version: 1.2.0 Build 709)  -->
                        <g>
                            <g id="Layer_1">
                                <g>
                                    <circle class="cls-2" cx="62.4" cy="62.4" r="62.4" />
                                    <circle class="cls-2" cx="62.4" cy="62.4" r="48.8" />
                                    <circle class="cls-2" cx="62.4" cy="62.4" r="35.6" />
                                    <path class="cls-1"
                                        d="M81.2,61.6l-27.8-16.8c-.7-.4-1.5,0-1.5.9v33.6c0,.8.9,1.3,1.5.9l27.8-16.8c.6-.4.6-1.3,0-1.7Z" />
                                </g>
                            </g>
                        </g>
                    </svg>

                </div>
            </div>

            <!-- Hidden iframe initially -->
            <iframe class="w-full h-full hidden rounded-2xl" data-src="{{ $videoHome['videoLink'] }}"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>

        </section>
        <!--End Video Home-->

        <!--Start Tenant-->
        <section id="tenant-home"
            class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 flex flex-col lg:gap-9 gap-7 lg:w-[1200px] lg:mx-auto">
            <div class="flex flex-col gap-5">
                <h6 class="bullet-1 self-center">
                    {{ $tenantHome['tenantTitle']['subTitle'] }}
                </h6>
                <h2 class="text-center" data-aos="fade-up">{{ $tenantHome['tenantTitle']['title'] }}</h2>
                @if ( $tenantHome['tenantTitle']['description'] )
                    <p class="text-center body-text text-[var(--color-text)]">
                        {{ $tenantHome['tenantTitle']['description'] }}
                    </p>
                @endif
            </div>

            <!--carousel-->
            <div class="relative lg:w-[1200px] mx-auto w-full">
                <div class="swiper-logo overflow-hidden !flex !flex-row !justify-center">
                    <div class="swiper-wrapper">
                      <x-sumimasen-cms::component-loader name="tenant-logo" />
                    </div>
                </div>

                <!-- Custom Arrow Left -->
                <div
                    class="swiper-button-prev gradient-blue rounded-full !h-[30px] !w-[30px] p-1 cursor-pointer lg:-ml-8">
                    <x-icon.arrow-left-white />
                </div>

                <!-- Custom Arrow Right -->
                <div
                    class="swiper-button-next gradient-blue rounded-full !h-[30px] !w-[30px] p-1 cursor-pointer lg:-mr-8">
                    <x-icon.arrow-right-white />
                </div>
            </div>
        </section>
        <!--End Tenant-->


        <!--Start Artikel Berita-->
        <section id="artikel-berita-home"
            class="lg:max-w-[1200px] lg:mx-auto flex flex-col lg:my-30 my-18 lg:px-0 sm:px-6 px-4 gap-8">
            <!--Title-->
            <div class="flex sm:flex-row flex-col justify-between items-end">
                <div class="flex flex-col gap-5">
                    <h6 class="bullet-1" data-aos="fade-down">{{ $beritaHome['subTitle'] }}</h6>
                    <h2 data-aos="fade-up">{{ $beritaHome['title'] }}</h2>
                    @if ( $beritaHome['description'] )
                        <p class="body-text text-[var(--color-text)]">
                            {{ $beritaHome['description'] }}
                        </p>
                    @endif
                </div>
                <!--button desktop tablet-->
                <a class="sm:!flex !hidden w-fit btn1 mt-5" data-aos="fade-down"
                    href="{{ $archive_post_url }}">{{ $beritaHome['btnText'] }}
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
            </div>

            <!--Content-->
            <x-loop.artikel-berita-grid />

            <!--button mobile-->
            <a class="!flex sm:!hidden w-fit btn1 mt-5" data-aos="fade-down"
                href="{{ $archive_post_url }}">{{ $beritaHome['btnText'] }}
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            </a>
        </section>
        <!--End Artikel Berita-->

        <!-- Start Hubungan Investor Home -->
        <section id="hubungan-investor-home" class="lg:py-30 py-18 bg-cover bg-[var(--color-transit)]">
            <div
                class="flex flex-col overflow-hidden relative lg:gap-9 sm:gap-7 gap-7  lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">

                <!--Heading-->
                <div class="flex flex-col justify-start gap-5">
                    <h6 class="bullet-1 sm:text-center text-left sm:self-center" data-aos="fade-down">
                        {{ $laporanHome['subTitle'] }}</h6>
                    <h2 class="sm:text-center text-left" data-aos="fade-up">{{ $laporanHome['title'] }}</h2>
                      @if ( $laporanHome['description'] )
                        <p class="sm:text-center text-left body-text text-[var(--color-text)]">
                            {{ $laporanHome['description'] }}
                        </p>
                    @endif
                </div>


                <!--Content-->
                <x-loop.laporan-tahunan-grid />
                <div class="flex sm:justify-center justify-start">
                    <!--button desktop tablet-->
                    <a class="w-fit btn1 mt-5" data-aos="fade-down"
                        href="{{ $laporanHome['btnLink'] }}">{{ $laporanHome['btnText'] }}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </section>
        <!-- End Hubungan Investor Home -->



    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>