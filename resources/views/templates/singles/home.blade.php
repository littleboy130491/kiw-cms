@php
    $archive_post_url = route('cms.page', [app()->getLocale(), 'posts']);

    //Start Hero Slide Temporary Data
    $sliderHeight = [
        'heightDesktop' => [
            'unit' => 'vh', // add radio or select px or vh
            'value' => '120',
        ],
        'heightTablet' => [
            'unit' => 'vh', // add radio or select px or vh
            'value' => '120',
        ],
        'heightMobile' => [
            'unit' => 'vh', // add radio or select px or vh
            'value' => '100',
        ],
    ];
    $sliderHome = [
                [
                    'slide' => [
                        'background' => Storage::url('media/hero-home-2.jpg'),
                        'backgroundVideo' => 'https://www.youtube.com/embed/1t_z7FMcsOw?autoplay=1&loop=1&mute=1&controls=0&playlist=1t_z7FMcsOw&modestbranding=1&showinfo=0',
                        'title' => 'Kawasan Industri Strategis untuk Pertumbuhan Bisnis',
                        'desc' => 'Fasilitas lengkap, aksesibilitas tinggi, dan dukungan profesional bagi investor.',
                        'image' => Storage::url('media/6b715ed8-8aa4-40e2-bdb6-0bb765219536.png'),
                        'filterImageWhite' => true,
                        'btnText' => 'Lihat Layanan',
                        'btnLink' => '#layanan-home',
                        'counter' => [
                            'title' => 'Luas Area Tersedia',
                            'items' => [
                                [
                                    'counter' => 36,
                                    'suffix' => 'Ha',
                                    'label' => 'Lahan Industri',
                                ],
                                [
                                    'counter' => 100,
                                    'suffix' => 'Unit',
                                    'label' => 'BPSP',
                                ],
                                [
                                    'counter' => 50,
                                    'suffix' => 'Persegi',
                                    'label' => 'Commercial Area',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'slide' => [
                        'background' => Storage::url('media/hero-home-2.jpg'),
                        'backgroundVideo' => '',
                        'title' => 'Dukungan Infrastruktur Lengkap untuk Kesuksesan Bisnis Anda',
                        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod',
                        'image' => '',
                        'filterImageWhite' => true,
                        'btnText' => 'Lihat Layanan',
                        'btnLink' => '#layanan-home',
                        'counter' => [
                            'title' => '',
                            'items' => [
                            
                               
                            ],
                        ],
                    ],
                ],
                [
                    'slide' => [
                        'background' => Storage::url('media/hero-home-2.jpg'),
                        'backgroundVideo' => '',
                        'title' => 'Dukungan Infrastruktur Lengkap untuk Kesuksesan Bisnis Anda',
                        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod',
                        'image' => Storage::url('media/6b715ed8-8aa4-40e2-bdb6-0bb765219536.png'),
                        'filterImageWhite' => false,
                        'btnText' => 'Lihat Layanan',
                        'btnLink' => '#layanan-home',
                        'counter' => [
                            'title' => 'Luas Area Tersedia',
                            'items' => [
                                [
                                    'counter' => 36,
                                    'suffix' => 'Ha',
                                    'label' => 'Lahan Industri',
                                ],
                                [
                                    'counter' => 100,
                                    'suffix' => 'Unit',
                                    'label' => 'BPSP',
                                ],
                                [
                                    'counter' => 50,
                                    'suffix' => 'Persegi',
                                    'label' => 'Commercial Area',
                                ],
                            ],
                        ],
                    ],
                ],
            ];
        //End Hero Slide Temporary Data
        
        //Start About Home Temporary Data
        $aboutHome = [
                'contentTop' => [
                    'subTitle' => 'tentang kiw',
                    'title' => 'Pilar Industri Jawa Tengah',
                    'desc' => 'PT Kawasan Industri Wijayakusuma (KIW) merupakan perusahaan yang bergerak di bidang pengembangan dan pengelolaan kawasan industri. Pemegang saham KIW antara lain; Kementerian BUMN, PT Danareksa (Persero), Pemerintah Provinsi Jawa Tengah, dan Pemerintah Kabupaten Cilacap.',
                    'iso' => [
                        'images' => [
                            Storage::url('media/iso-1.png'),
                            Storage::url('media/iso-2.png'),
                            Storage::url('media/iso-3.png'),
                        ],
                        'label' => 'ISO Certificate',
                    ],
                    'btnText' => 'Selengkapnya',
                    'btnLink' => '/profil-perusahaan',
                ],
                'contentBottom' => [
                    'image' => Storage::url('media/about-home-bottom.jpg'),
                    'counter' => [
                [
                    'counter' => 36,
                    'label' => 'Tahun Pengalaman',
                    'suffix' => '+',
                ],
                [
                    'counter' => 100,
                    'label' => 'Tenant Bekerjasama',
                    'suffix' => '+',
                ],
                [
                    'counter' => 5,
                    'label' => 'Penghargaan',
                    'suffix' => '+',
                ],
                [
                    'counter' => 4,
                    'label' => 'Sertifikasi',
                    'suffix' => '+',
                ],
            ],
                ],    
            ];
        //End About Home Temporary Data

        //Start Layanan Home Temporary Data
        $layananHome = [
                'layananTitle' => [
                    'subTitle' => 'layanan kami',
                    'title' => 'Solusi Komprehensif untuk Kebutuhan Industri',
                ],
                'layananContent' => [
                    [
                        'label' => 'Lahan Industri Siap Bangun',
                        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'image' => Storage::url('media/aerial-view-warehouse-industrial-plant-logistics-center-from-view-from.jpg'),
                        'btnText' => 'Selengkapnya',
                        'btnLink' => '/lahan-industri',
                    ],
                    [
                        'label' => 'Bangunan Pabrik Siap Pakai (BPSP)',
                        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'image' => Storage::url('media/exterior-view-modern-industrial-building.jpg'),
                        'btnText' => 'Selengkapnya',
                        'btnLink' => '/bpsp',
                    ],
                    [
                        'label' => 'Kawasan Industri Terpadu',
                        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'image' => Storage::url('media/exterior-view-modern-industrial-building.jpg'),
                        'btnText' => 'Selengkapnya',
                        'btnLink' => '/kawasan-industri',
                    ],
                ],    
            ];
            //End Layanan Home Temporary Data

            //Start Keunggulan Home Temporary Data
            $keunggulanHome = [
            'keunggulanTitle' => [
                'subTitle' => 'keunggulan',
                'title' => 'Alasan Memilih KIW?',
            ],
            'keunggulanItem' => [
                            [
                                'number' => '01.',
                                'label' => 'Layanan Perizinan',
                                'desc' => 'KIW menawarkan kemudahan dalam menjalankan bisnis melalui sistem pelayanan satu atap yang terintegrasi.',
                                'url' => '/keunggulan#perijinan',
                            ],
                            [
                                'number' => '02.',
                                'label' => 'Lokasi Strategis',
                                'desc' => 'Kawasan Industri Wijayakusuma terletak di jalur utama Semarang, pusat pertumbuhan ekonomi di Jawa Tengah.',
                                'url' => '/keunggulan#lokasi',
                            ],
                            [
                                'number' => '03.',
                                'label' => 'Area Bebas Banjir',
                                'desc' => 'KIW terletak di area bebas banjir yang terjamin ketersediaan air.',
                                'url' => '/keunggulan#area-bebas-banjir',
                            ],
                            [
                                'number' => '04.',
                                'label' => 'Kelengkapan Infrastruktur & Fasilitas',
                                'desc' => 'KIW dibangun dengan infrastruktur kelas industri yang lengkap dan modern.',
                                'url' => '/keunggulan#infrastruktur',
                            ],
                            [
                                'number' => '05.',
                                'label' => 'Upah Minimum Kompetitif',
                                'desc' => 'KIW memiliki Upah Minimum yang relatif lebih rendah dibandingkan kota-kota besar seperti Jakarta atau Surabaya.',
                                'url' => '/keunggulan#upah',
                            ],
                            [
                                'number' => '06.',
                                'label' => 'Sumber Daya Manusia Unggul',
                                'desc' => 'KIW dikelilingi institusi pendidikan dan pelatihan yang mencetak lulusan siap kerja dan terampil.',
                                'url' => '/keunggulan#sdm',
                            ],
                            [
                                'number' => '07.',
                                'label' => 'Ekosistem Klaster Bisnis',
                                'desc' => 'KIW mendukung ekosistem industri melalui fasilitas modern, tata kelola profesional, dan layanan satu pintu.',
                                'url' => '/keunggulan#bisnis',
                            ],
                        ],
            ];
            //End Keunggulan Home Temporary Data

            //Start Video Home Temporary Data
            $videoHome = [
                [
                    'videoLink' => 'https://www.youtube.com/embed/-jK-qj3ZNLI?autoplay=1&rel=0',
                    'image' => Storage::url('media/back-video.jpg'),
                ],
            ];
            //End Video Home Temporary Data

            //Start Tenant Logo Temporary Data

            $tenantHome = [
            'tenantTitle' => [
                'subTitle' => 'Tenant Kami',
                'title' => 'Tenant dari Berbagai Sektor Industri',
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

            //Start Fasilitas Temporary Data
            $fasilitasHome = [
                'subTitle' => 'Fasilitas',
                'title' => 'Fasilitas Industri yang Lengkap',
                ];
            //End Fasilitas Logo Temporary Data

            //Start Berita Temporary Data
            $beritaHome = [
                [
                    'subTitle' => 'Artikel & Berita',
                    'title' => 'Dapatkan Informasi Terbaru',
                    'btnText' => 'Berita Lainnya',
                    'btnLink' => '/berita',
                ],
            ];
            //End Berita Logo Temporary Data

            //Start Laporan Temporary Data
            $laporanHome = [
                [
                    'subTitle' => 'Anual Report',
                    'title' => 'Laporan Tahunan & Audit Perusahaan',
                    'btnText' => 'Laporan Tahunan',
                    'btnLink' => '/laporan-tahunan',
                ],
            ];
            //End Laporan Logo Temporary Data
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>

        <x-splash-screen :setOnce="false" />
        <x-popup-home :setOnce="false" />

        <!--Start Hero Banner-->
        <section id="hero-banner" class="relative bg-cover bg-center overflow-hidden">
            <div class="swiper swiper-hero">
                <div class="swiper-wrapper relative">

                    @foreach ($sliderHome as $item)
                        <x-loop.slide-hero-home :slide="$item['slide']" :height="$sliderHeight" />
                    @endforeach

                </div>

                <!-- Custom icon.arrow Left -->
                <div
                    class="swiper-button-prev bg-[var(--white-transparent)] hover:bg-[var(--color-blue)] rounded-[100%] sm:!h-[30px] sm:!w-[30px] !h-[20px] !w-[20px] p-1 cursor-pointer">
                    <x-icon.arrow-left-white />
                </div>

                <!-- Custom icon.arrow Right -->
                <div
                    class="swiper-button-next bg-[var(--white-transparent)] hover:bg-[var(--color-blue)] rounded-[100%] sm:!h-[30px] sm:!w-[30px] !h-[20px] !w-[20px] p-1 cursor-pointer">
                    <x-icon.arrow-right-white />
                </div>
            </div>
        </section>

        <!--End Hero Banner-->

        <!-- Start About Home -->
        <section id="about-home" class="bg-[var(--color-transit)] lg:py-30 py-18">
            <div
                class="flex flex-col overflow-hidden relative lg:gap-0 sm:gap-10 gap-10  lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">
                <!--top content-->
                <div class="flex lg:flex-row flex-col justify-between !gap-15 items-start lg:-mb-10">
                    <!--content left-->
                    <div class="flex flex-col justify-start gap-5 lg:!w-[55%]">
                        <h6 data-aos="fade-down" class="bullet-1">{{ $aboutHome['contentTop']['subTitle'] }}</h6>
                        <h2 data-aos="fade-up" class="text-[var(--color-heading)]">{{ $aboutHome['contentTop']['title'] }}</h2>

                        <p class="body-text text-[var(--color-text)]">
                            {{ $aboutHome['contentTop']['desc'] }}
                        </p>
                        <!--ISO-->
                        <div class="flex flex-row items-center gap-5 mt-4">
                            @foreach ($aboutHome['contentTop']['iso']['images'] as $image)
                                <img src="{{ $image }}" alt="iso">
                            @endforeach
                            <p class="!text-[var(--color-heading)] !text-[1.3em] w-[60px]">{{ $aboutHome['contentTop']['iso']['label'] }}</p>
                        </div>
                        <!--button-->
                        <a class="w-fit btn1 mt-5" data-aos="fade-down" href="{{ $aboutHome['contentTop']['btnLink'] }}">{{ $aboutHome['contentTop']['btnText'] }}
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
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
                        <x-loop.counter-about-home :counter="$counter['counter']" :suffix="$counter['suffix']" :label="$counter['label']" />
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
                    <h6 class="bullet-2 text-white text-center" data-aos="fade-down">{{ $layananHome['layananTitle']['subTitle'] }}</h6>
                    <h2 class="text-white text-center lg:w-[700px]" data-aos="fade-up">{{ $layananHome['layananTitle']['title'] }}</h2>
                </div>

                <!--Content-->
                <div class="flex lg:flex-row flex-col gap-7">
                    @foreach($layananHome['layananContent'] as $layananContent)
                    <x-loop.layanan-home label="{{ $layananContent['label'] }}"
                        desc="{{ $layananContent['desc'] }}"
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
                    <h6 class="lg:text-center !text-white bullet-2" data-aos="fade-down">{{ $keunggulanHome['keunggulanTitle']['subTitle'] }}</h6>
                    <h2 class="lg:text-center !text-white" data-aos="fade-up">{{ $keunggulanHome['keunggulanTitle']['title'] }}</h2>
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
                    <a class="w-fit btn1 mt-5" data-aos="fade-down" href="/fasilitas">semua fasilitas
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
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

            <!-- Custom Thumbnail -->
            <div class="absolute inset-0 bg-cover bg-center cursor-pointer rounded-2xl lg:mx-0 sm:mx-6 mx-4"
                style="background-image: url('{{ $videoHome[0]['image'] }} ') ;"
                onclick="loadVideo(this)">
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
            <iframe class="w-full h-full hidden rounded-2xl"
                data-src="{{ $videoHome[0]['videoLink'] }}" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>

        </section>
        <!--End Video Home-->

        <!--Start Tenant-->
        <section id="tenant-home" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 flex flex-col lg:gap-9 gap-7">
            <div class="flex flex-col gap-5 lg:max-w-[1200px] lg:mx-auto">
                <h6 class="bullet-1 self-center">
                    {{ $tenantHome['tenantTitle']['subTitle'] }}
                </h6>
                <h2 class="text-center" data-aos="fade-up">{{ $tenantHome['tenantTitle']['title'] }}</h2>
            </div>
            <!--carousel-->
            <div class="relative w-full lg:max-w-[100vw] overflow-hidden">
                <div class="swiper-logo ">
                    <div class="swiper-wrapper lg:!flex lg:gap-5">
                        @foreach ($tenantHome['tenantLogo'] as $tenantLogo)
                            <x-loop.tenant-logo :image="$tenantLogo['image']" />
                        @endforeach
                    </div>

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
                    <h6 class="bullet-1" data-aos="fade-down">{{ $beritaHome[0]['subTitle'] }}</h6>
                    <h2 data-aos="fade-up">{{ $beritaHome[0]['title'] }}</h2>
                </div>
                <!--button desktop tablet-->
                <a class="sm:!flex !hidden w-fit btn1 mt-5" data-aos="fade-down"
                    href="{{ $archive_post_url }}">{{ $beritaHome[0]['btnText'] }}
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

            <!--Content-->
            <x-loop.artikel-berita-grid />

            <!--button mobile-->
            <a class="!flex sm:!hidden w-fit btn1 mt-5" data-aos="fade-down" href="{{ $archive_post_url }}">{{ $beritaHome[0]['btnText'] }}
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
        </section>
        <!--End Artikel Berita-->

        <!-- Start Hubungan Investor Home -->
        <section id="hubungan-investor-home" class="lg:py-30 py-18 bg-cover bg-[var(--color-transit)]">
            <div class="flex flex-col overflow-hidden relative lg:gap-9 sm:gap-7 gap-7  lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">

                <!--Heading-->
                <div class="flex flex-col justify-start gap-5">
                    <h6 class="bullet-1 sm:text-center text-left sm:self-center" data-aos="fade-down">{{ $laporanHome[0]['subTitle'] }}</h6>
                    <h2 class="sm:text-center text-left" data-aos="fade-up">{{ $laporanHome[0]['title'] }}</h2>
                </div>


                <!--Content-->
                <x-loop.laporan-tahunan-grid />
                <div class="flex sm:justify-center justify-start">
                <!--button desktop tablet-->
                <a class="w-fit btn1 mt-5" data-aos="fade-down"
                    href="{{ $laporanHome[0]['btnLink'] }}">{{ $laporanHome[0]['btnText'] }}
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a></div>
            </div>
        </section>
        <!-- End Hubungan Investor Home -->



    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
