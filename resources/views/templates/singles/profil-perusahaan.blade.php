@php
    //Start About Temporary Data
    $about = [
        'title' => 'Pilar Industri Jawa Tengah',
        'paragraphs-bold' => [
            'PT Kawasan Industri Wijayakusuma (KIW) adalah perusahaan pengembang dan pengelola kawasan industri yang berlokasi strategis di Semarang, Jawa Tengah. Sebagai anggota Holding BUMN Danareksa sejak 2022, KIW dimiliki oleh Kementerian BUMN, PT Danareksa (Persero), Pemerintah Provinsi Jawa Tengah, dan Pemerintah Kabupaten Cilacap.',
        ],
        'paragraphs' => [
            'Dengan infrastruktur lengkap, akses mudah ke tol, pelabuhan, bandara, dan pusat kota, KIW menawarkan kawasan industri seluas 250 Ha yang bebas banjir, dilengkapi Bangunan Pabrik Siap Pakai (BPSP), layanan terpadu (WTP, WWTP, keamanan 24 jam, pemadam kebakaran), serta fasilitas KLIK dan berbagai kemudahan bisnis.',
        ],
        'iso' => [
            'images' => [
                Storage::url('media/iso-1.png'),
                Storage::url('media/iso-2.png'),
                Storage::url('media/iso-3.png'),
            ],
            'label' => 'ISO Certificate'
        ]
    ];
    //End About Temporary Data

    //Start About Perjalanan Temporary Data
    $aboutPerjalanan = [
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
        'perjalananKami' => [
            'titlePerjalanan' => [
                'title' => 'Perjalanan Kami',
                'subtitle' => 'Sejarah & Pencapaian Kami',
            ],
            'imagePerjalanan' => Storage::url('media/perjalanan-image.jpg'),
            'perjalananSlide' => [
                [
                    'year' => '1988',
                    'desc' => 'PT KIW (Persero) sebelumnya bernama PT Kawasan Industri Cilacap (KIC), berdiri di Cilacap, Jawa Tengah.',
                ],
                [
                    'year' => '1998',
                    'desc' => 'Pindah ke kawasan industri baru di Semarang, Jawa Tengah dengan nama baru, yaitu: PT Kawasan Industri Wijayakusuma (Persero).',
                ],
                [
                    'year' => '2018',
                    'desc' => 'PT Putra Wijayakusuma Sakti (PWS) lahir sebagai anak perusahaan PT Kawasan Industri Wijayakusuma (Persero).',
                ],
                [
                    'year' => '2020',
                    'desc' => 'PT Kawasan Industri Terpadu Batang (KITB) adalah perusahaan joint venture antara PT KIW (Persero), PT PP (Persero), PTPN IX, dan Perusda Batang. Perusahaan ini membangun dan mengelola Kawasan Industri Terpadu Batang sebagai salah satu Proyek Strategis Nasional (PSN).',
                ],
                [
                    'year' => '2021',
                    'desc' => 'PT KIW (Persero) mendapatkan Penyertaan Modal Negara (PMN) guna pembangunan dan pengembangan KIT Batang.',
                ],
                [
                    'year' => '2022',
                    'desc' => 'PT KIW resmi menjadi anggota Holding Danareksa.',
                ],
                [
                    'year' => '2022',
                    'desc' => 'Peresmian Holding Danareksa oleh Menteri BUMN.',
                ],
                
            ],
        ],
    ];
    //End About Perjalanan Temporary Data

    //Start Tab Afiliasi Perusahaan Temporary Data
    $tabAfiliasiPerusahaan = [
        'tabsTitle' => [
            ['tab' => 'Pemegang Saham'],
            ['tab' => 'PT PWS'],
            ['tab' => 'PT KITB'],
        ],

        'tabsContent' => [
            [ 'tab' => [
                'tabContentLeft' => [
                    'logo'=> '',
                    'subtitle'=>'',
                    'title'=>'',
                    'desc'=>'',
                    'btnText'=>'',
                    'btnLink'=>'',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/pemegang-saham.png'),
                ],
            ]], 

            [ 'tab' => [
                'tabContentLeft' => [
                    'logo'=> Storage::url('media/gbc-logo.png'),
                    'subtitle'=>'Anak Perusahaan',
                    'title'=>'Grand Batang City',
                    'desc'=>'Perusahaan pengelola kawasan industri seluas 4.300 hektar di Kabupaten Batang yang didukung penuh oleh Pemerintah Indonesia.',
                    'btnText'=>'Kunjungi Website',
                    'btnLink'=>'https://grandbatangcity.co.id/',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/anak-perusahaan-1.png'),
                ],
            ]],

            [ 'tab' => [
                'tabContentLeft' => [
                    'logo'=> Storage::url('media/pws-logo.png'),
                    'subtitle'=>'Anak Perusahaan',
                    'title'=>'PT. Putra Wijaya Kusuma Sakti',
                    'desc'=>'PT PWS bergerak pada empat bidang bisnis utama, yaitu Construction & Property, Fiber Optic Infrastructure, Facility Management Services, dan Business Support.',
                    'btnText'=>'Kunjungi Website',
                    'btnLink'=>'https://putrawijayakusumasakti.co.id/',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/anak-perusahaan-2.png'),
                ],
            ]],
        ]
    ];
    //End Tab Afiliasi Perusahaan Temporary Data

    //Start Hotspot Koneksi Global Temporary Data
    $hotspotKoneksiGlobal = [
        'subTitle' => 'Koneksi Global',
        'title' => 'Dipercaya oleh Lebih dari 100 Perusahaan Global',
        'mapKoneksiGlobal' => [
            'map' => Storage::url('media/map-koneksi.png'),
        ],
        'pinKoneksiGlobal' => [
            [
                'top' => '44',   
                'left' => '91',
                'country' => 'Jepang',
                'company' => '8',
                'flag' => Storage::url('media/9b375a17-a0b6-4a43-b3c2-fc6648537d7c.png'),
            ],
            [
                'top' => '70',   
                'left' => '83',
                'country' => 'Indonesia',
                'company' => '5',
                'flag' => Storage::url('media/b37cc863-17ac-43c6-bfe7-27e5a46c82fa.png'),
            ],
            [
                'top' => '51',   
                'left' => '60',
                'country' => 'Arab Saudi',
                'company' => '2',
                'flag' => Storage::url('media/9564aeac-dca6-4d07-b7d2-bb70f9c49a8d.png'),
            ],
            [
                'top' => '72',  
                'left' => '34',
                'country' => 'Brazil',
                'company' => '10',
                'flag' => Storage::url('media/1c4fcec5-dde0-41d4-8d50-1a76b5b69902.png'),
            ],
            [
                'top' => '41', 
                'left' => '18',
                'country' => 'Amerika Serikat',
                'company' => '10',
                'flag' => Storage::url('media/e899bfab-5ae3-4da6-9d55-5eaf0af75229.png'),
            ],
            [
                'top' => '37', 
                'left' => '49',
                'country' => 'Jerman',
                'company' => '10',
                'flag' => Storage::url('media/71b04c87-493e-4d33-ba7f-e6d8da86c8ef.png'),
            ],
            [
                'top' => '43', 
                'left' => '79',
                'country' => 'China',
                'company' => '10',
                'flag' => Storage::url('media/3f7250c5-e316-4f42-a6ee-43d7109e6beb.png'),
            ],
        ]
    ];
    //End Hotspot Koneksi Global Temporary Data

    //Start Tab Sektor Industri Temporary Data
    $tabSektorIndustri = [
        'tabsTitle' => [
            ['tab' => 'Modern Textile & Garment'],
            ['tab' => 'Wood & Furniture'],
            ['tab' => 'Chemical & New Material'],
            ['tab' => 'Consumer Goods & Food Procesing'],
            ['tab' => 'Others'],
        ],

        'tabsContent' => [
            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Modern Textile and Garment Industry',
                    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/garmen.png'),
                ],
            ]], 

            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Wood & Furniture Industry',
                    'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/furniture.png'),
                ],
            ]],

            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Chemical & New Material Industry',
                    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/chemical.png'),
                ],
            ]],

            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Consumer Goods & Food Procesing Industry',
                    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/consumer.png'),
                ],
            ]],

            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Others',
                    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/others.png'),
                ],
            ]],
        ]
    ];
    //End Tab Sektor Industri Temporary Data

    
@endphp


<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/hero-profil-perusahaan.jpg')" h1="{!! strip_tags($item->content) ?? 'Tentang Perusahaan' !!}" />

        <!--Start About-->
        
        <section id="about" class="bg-contain bg-no-repeat bg-bottom sm:bg-cover"
            style="background-image:url('{{ Storage::url('media/about-image.jpg') }}')">
            <div
                class="flex flex-col grow pt-18 pb-42 sm:pb-70 lg:pb-130 px-4 sm:px-6 lg:px-0 lg:pt-30  gradient-white-about">
                <div class="lg:w-[1200px] lg:mx-auto flex flex-col gap-5 sm:flex-row sm:justify-between">
                    <h2 data-aos="fade-up" class="sm:w-1/3 lg:w-[35%]"> {{ $aboutPerjalanan['perjalananKami']['titlePerjalanan']['title'] }}</h2>
                    <div class="flex flex-col gap-5 sm:w-2/3 lg:w-[60%]">
                        <p data-aos="fade-down" class="sub-p">
                            {{ $about['paragraphs-bold'][0] }}
                        </p>
                        <p>
                            {{ $about['paragraphs'][0] }}
                        </p>
                        <!--ISO-->
                        <div class="flex flex-row items-center gap-5 mt-4">
                            @foreach ($about['iso']['images'] as $image)
                                <img src="{{ $image }}" alt="iso">
                            @endforeach
                            <p class="!text-[var(--color-heading)] !text-[1.3em] w-[60px]">{{ $about['iso']['label'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--End About-->

        <!--Start Perjalanan-->
        <section id="perjalanan"
            class="relative flex flex-col gap-18 px-4 sm:px-6 sm:pt-0 lg:pt-0 lg:pb-0 bg-cover bg-no-repeat"
            style="background-image:url('{{ Storage::url('media/bg-perjalanan.jpg') }}')">

            <!--Counter-->
            <div
                class="sm:max-w-full sm:-top-12 lg:left-1/2 grid grid-cols-2 -mt-14 sm:grid-cols-4 gap-5 lg:w-[1200px] lg:mx-auto">
                @foreach ($aboutPerjalanan['counter'] as $counter)
                    <x-loop.counter-profil :counter="$counter['counter']" :label="$counter['label']" :suffix="$counter['suffix']" />
                @endforeach
            </div>

            <!--Content-->
            <div
                class="flex flex-col sm:flex-row-reverse justify-between sm:items-center gap-9 lg:w-[1200px] lg:mx-auto">

                <!--Main Content-->
                <div class="flex flex-col sm:w-1/2 lg:w-[60%] gap-10">

                    <!--Title-->
                    <div class="flex flex-col gap-5">
                        <h6 data-aos="fade-down" class="bullet-2 text-white ">{{ $aboutPerjalanan['perjalananKami']['titlePerjalanan']['title'] }}</h6>
                        <h2 data-aos="fade-up" class="text-white">{{ $aboutPerjalanan['perjalananKami']['titlePerjalanan']['subtitle'] }}</h2>
                    </div>

                    <!--carousel-->
                    <div class="relative">
                        <div class="swiper swiper-3">
                            <div class="swiper-wrapper !flex">
                                @foreach ($aboutPerjalanan['perjalananKami']['perjalananSlide'] as $perjalanan)
                                <x-loop.perjalanan :year="$perjalanan['year']" :desc="$perjalanan['desc']" />
                                @endforeach
                            </div>

                            <!-- Custom icon.arrow Right -->
                            <div
                                class="absolute !top-10 lg:!top-15 swiper-button-next bg-white rounded-[100%] !h-[30px] !w-[30px] p-1 cursor-pointer z-10">
                                <img class="w-2/3" src="{{Storage::url('media/arrow-right-solid.png')}}" alt="arrow">
                            </div>

                        </div>

                    </div>

                </div>

                <!--Image-->
                <img class="rounded-2xl lg:rounded-b-none sm:w-[45%] lg:w-[35%] sm:h-[450px] lg:h-[460px] sm:object-cover"
                    src="{{ $aboutPerjalanan['perjalananKami']['imagePerjalanan'] }}" alt="perjalanan">
            </div>


        </section>
        <!--End Perjalanan-->

        <!--Start Tab-->
        <section id="tab" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto relative">
            <div x-data="{ tab: 'tab1' }" class="rounded-md">
                <!-- Tab Headers -->
                <div class="flex gap-1 sm:gap-2 z-1">
                @foreach ($tabAfiliasiPerusahaan['tabsTitle'] as $index => $item)
                <x-tab.tab-headers-saham 
                    :title="$item['tab']" 
                    :tab="'tab' . ($index + 1)" 
                />
            @endforeach
                </div>

                <!-- Tab Contents -->
                @foreach ($tabAfiliasiPerusahaan['tabsContent'] as $index => $item)
                    @php
                        $left = $item['tab']['tabContentLeft'];
                        $right = $item['tab']['tabContentRight'];
                        $isLeftEmpty = empty($left['logo']) && empty($left['subtitle']) && empty($left['title']) && empty($left['desc']) && empty($left['btnText']) && empty($left['btnLink']);
                    @endphp

                    <x-tab.tab-contents-saham id="tab{{ $index + 1 }}">
                        @if ($isLeftEmpty)
                            <!-- Hanya menampilkan gambar kanan -->
                            <div class="relative">
                                <a href="{{ $right['image'] }}" data-lightbox="gallery">
                                    <img class="w-full" src="{{ $right['image'] }}">
                                </a>
                            </div>
                        @else
                            <!-- Menampilkan konten kiri + kanan -->
                            <div class="flex flex-col lg:flex-row lg:justify-between gap-12">
                                <div class="flex flex-col justify-between gap-10 lg:gap-20 lg:w-1/2">
                                    <img class="w-1/4 sm:w-1/5 lg:w-1/3" src="{{ $left['logo'] }}" alt="Logo">
                                    <div class="flex flex-col gap-5">
                                        <h6 class="bullet-1">{{ $left['subtitle'] }}</h6>
                                        <h2>{{ $left['title'] }}</h2>
                                        <p>{!! $left['desc'] !!}</p>

                                        @if(!empty($left['btnText']))
                                        <a class="w-fit btn1 lg:mt-5" data-aos="fade-down" href="{{ $left['btnLink'] }}"
                                            target="_blank" rel="noopener noreferrer">{{ $left['btnText'] }}
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="relative lg:w-1/2">
                                    <a href="{{ Storage::url($right['image']) }}" data-lightbox="gallery">
                                        <img class="w-full object-contain" src="{{ $right['image'] }}">
                                    </a>
                                </div>
                            </div>
                        @endif
                    </x-tab.tab-contents-saham>
                @endforeach

            </div>
        </section>

        <!--End Tab-->

        <!--Start Koneksi Global-->
        <section id="koneksi-global" class="lg:w-[1200px] lg:mx-auto my-18 lg:my-30">

            <div class="flex flex-col gap-5 px-4 sm:px-6 lg:px-0 text-center items-center">
                <h6 data-aos="fade-down" class="bullet-1">{{$hotspotKoneksiGlobal['subTitle']}}</h6>
                <h2 data-aos="fade-up" class="sm:w-[500px] lg:w-[600px]">{{$hotspotKoneksiGlobal['title']}}</h2>
            </div>


            <div class="map-container relative overflow-x-auto whitespace-nowrap max-w-full">
                <div class="relative inline-block min-w-full">
                    <img src="{{$hotspotKoneksiGlobal['mapKoneksiGlobal']['map']}}">
                  

                    <!-- Hotspot Items -->
                    @foreach ($hotspotKoneksiGlobal['pinKoneksiGlobal'] as $item)
                    <x-loop.hotspot-item-koneksi-global :top="$item['top']" :left="$item['left']" :country="$item['country']" :company="$item['company']" :flag="$item['flag']" />
                    @endforeach
                </div>
            </div>
        </section>
        <!--End Koneksi Global-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>