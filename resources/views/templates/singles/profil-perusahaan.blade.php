@php
    // Process CMS blocks into organized data structure
    $blocks = collect($item->block);
    dd($blocks);
    // About Section
    $aboutSection = $blocks->where('data.block_id', 'section-1')->first();
    $about = [
        'title' => $aboutSection['data']['title'] ?? '',
        'paragraphs-bold' => [
            $aboutSection['data']['subtitle'] ?? '',
        ],
        'paragraphs' => [
            $aboutSection['data']['description'] ?? '',
        ],
        'backgroundImage' => $aboutSection['data']['image_url'] ?? Storage::url('media/about-image.jpg'),
    ];

    // ISO Gallery
    $isoGallery = $blocks->where('data.block_id', 'iso-images')->first();
    $about['iso'] = [
        'images' => $isoGallery['data']['gallery_urls'] ?? [],
        'label' => $isoGallery['data']['title'] ?? 'ISO Certificate'
    ];

    // Counter Section
    $counters = $blocks->where('data.block_id', 'counter');
    $aboutPerjalanan = [
        'counter' => $counters->map(function ($counter) {
            return [
                'counter' => $counter['data']['title'] ?? 0,
                'label' => $counter['data']['subtitle'] ?? '',
                'suffix' => $counter['data']['suffix'] ?? '',
                'prefix' => $counter['data']['prefix'] ?? '',
            ];
        })->values()->toArray(),
    ];

    // Perjalanan Section
    $perjalananSection = $blocks->where('data.block_id', 'section-2')->first();
    $perjalananSlides = $blocks->where('data.block_id', 'perjalanan-slide');

    $aboutPerjalanan['perjalananKami'] = [
        'titlePerjalanan' => [
            'title' => $perjalananSection['data']['title'] ?? 'Perjalanan Kami',
            'subtitle' => $perjalananSection['data']['subtitle'] ?? 'Sejarah & Pencapaian Kami',
        ],
        'imagePerjalanan' => $perjalananSection['data']['image_url'] ?? Storage::url('media/perjalanan-image.jpg'),
        'perjalananSlide' => $perjalananSlides->map(function ($slide) {
            return [
                'year' => $slide['data']['title'] ?? '',
                'desc' => $slide['data']['description'] ?? '',
            ];
        })->values()->toArray(),
    ];

    // Tab Afiliasi Perusahaan
    $tabBlocks = $blocks->where('data.block_id', 'tab');

    $tabAfiliasiPerusahaan = [
        'tabsTitle' => $tabBlocks->map(function ($tab) {
            return ['tab' => $tab['data']['tab_title'] ?? ''];
        })->values()->toArray(),

        'tabsContent' => $tabBlocks->map(function ($tab) {
            $hasContent = !empty($tab['data']['content_title']) ||
                !empty($tab['data']['content_subtitle']) ||
                !empty($tab['data']['description']);

            return [
                'tab' => [
                    'tabContentLeft' => [
                        'logo' => $tab['data']['logo'] ?? '',
                        'subtitle' => $tab['data']['content_subtitle'] ?? '',
                        'title' => $tab['data']['content_title'] ?? '',
                        'desc' => $tab['data']['description'] ?? '',
                        'btnText' => $tab['data']['cta_label'] ?? '',
                        'btnLink' => $tab['data']['cta'] ?? '',
                    ],
                    'tabContentRight' => [
                        'image' => $tab['data']['image_url'] ?? '',
                    ],
                ]
            ];
        })->values()->toArray(),
    ];

    // Hotspot Koneksi Global
    $koneksiSection = $blocks->where('data.block_id', 'section-3')->first();
    $hotspots = $blocks->where('data.block_id', 'hotspot');

    $hotspotKoneksiGlobal = [
        'subTitle' => $koneksiSection['data']['title'] ?? 'Koneksi Global',
        'title' => $koneksiSection['data']['subtitle'] ?? 'Dipercaya oleh Lebih dari 100 Perusahaan Global',
        'mapKoneksiGlobal' => [
            'map' => $koneksiSection['data']['image_url'] ?? Storage::url('media/map-koneksi.png'),
        ],
        'pinKoneksiGlobal' => $hotspots->map(function ($hotspot) {
            // Extract number from company string (e.g., "8 Perusahaan" -> "8")

            return [
                'top' => $hotspot['data']['top'] ?? '0',
                'left' => $hotspot['data']['left'] ?? '0',
                'country' => $hotspot['data']['country'] ?? '',
                'company' => $hotspot['data']['company'] ?? '',
                'flag' => $hotspot['data']['image_url'] ?? '',
            ];
        })->values()->toArray(),
    ];
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/hero-profil-perusahaan.jpg')"
            h1="{!! strip_tags($item->content) ?? 'Tentang Perusahaan' !!}" />

        <!--Start About-->
        <section id="about" class="bg-contain bg-no-repeat bg-bottom sm:bg-cover"
            style="background-image:url('{{ $about['backgroundImage'] }}')">
            <div
                class="flex flex-col grow pt-18 pb-42 sm:pb-70 lg:pb-130 px-4 sm:px-6 lg:px-0 lg:pt-30 gradient-white-about">
                <div class="lg:w-[1200px] lg:mx-auto flex flex-col gap-5 sm:flex-row sm:justify-between">
                    <h2 data-aos="fade-up" class="sm:w-1/3 lg:w-[35%]">{{ $about['title'] }}</h2>
                    <div class="flex flex-col gap-5 sm:w-2/3 lg:w-[60%]">
                        <p data-aos="fade-down" class="sub-p">
                            {{ $about['paragraphs-bold'][0] }}
                        </p>
                        <p>
                            {{ $about['paragraphs'][0] }}
                        </p>
                        <!--ISO-->
                        @if(!empty($about['iso']['images']))
                            <div class="flex flex-row items-center gap-5 mt-4">
                                @foreach ($about['iso']['images'] as $image)
                                    <img src="{{ $image }}" alt="iso">
                                @endforeach
                                <p class="!text-[var(--color-heading)] !text-[1.3em] w-[60px]">{{ $about['iso']['label'] }}
                                </p>
                            </div>
                        @endif
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
            @if(!empty($aboutPerjalanan['counter']))
                <div
                    class="sm:max-w-full sm:-top-12 lg:left-1/2 grid grid-cols-2 -mt-14 sm:grid-cols-4 gap-5 lg:w-[1200px] lg:mx-auto">
                    @foreach ($aboutPerjalanan['counter'] as $counter)
                        <x-loop.counter-profil :counter="$counter['counter']" :label="$counter['label']"
                            :suffix="$counter['suffix']" />
                    @endforeach
                </div>
            @endif

            <!--Content-->
            <div
                class="flex flex-col sm:flex-row-reverse justify-between sm:items-center gap-9 lg:w-[1200px] lg:mx-auto">
                <!--Main Content-->
                <div class="flex flex-col sm:w-1/2 lg:w-[60%] gap-10">
                    <!--Title-->
                    <div class="flex flex-col gap-5">
                        <h6 data-aos="fade-down" class="bullet-2 text-white">
                            {{ $aboutPerjalanan['perjalananKami']['titlePerjalanan']['title'] }}
                        </h6>
                        <h2 data-aos="fade-up" class="text-white">
                            {{ $aboutPerjalanan['perjalananKami']['titlePerjalanan']['subtitle'] }}
                        </h2>
                    </div>

                    <!--carousel-->
                    @if(!empty($aboutPerjalanan['perjalananKami']['perjalananSlide']))
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
                    @endif
                </div>

                <!--Image-->
                <img class="rounded-2xl lg:rounded-b-none sm:w-[45%] lg:w-[35%] sm:h-[450px] lg:h-[460px] sm:object-cover"
                    src="{{ $aboutPerjalanan['perjalananKami']['imagePerjalanan'] }}" alt="perjalanan">
            </div>
        </section>
        <!--End Perjalanan-->

        <!--Start Tab-->
        @if(!empty($tabAfiliasiPerusahaan['tabsTitle']))
            <section id="tab" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto relative">
                <div x-data="{ tab: 'tab1' }" class="rounded-md">
                    <!-- Tab Headers -->
                    <div class="flex gap-1 sm:gap-2 z-1">
                        @foreach ($tabAfiliasiPerusahaan['tabsTitle'] as $index => $item)
                            <x-tab.tab-headers-saham :title="$item['tab']" :tab="'tab' . ($index + 1)" />
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
                                <!-- Only display right image -->
                                <div class="relative">
                                    <a href="{{ $right['image'] }}" data-lightbox="gallery">
                                        <img class="w-full" src="{{ $right['image'] }}" alt="Tab Image">
                                    </a>
                                </div>
                            @else
                                <!-- Display both left content + right image -->
                                <div class="flex flex-col lg:flex-row lg:justify-between gap-12">
                                    <div class="flex flex-col justify-between gap-10 lg:gap-20 lg:w-1/2">
                                        @if(!empty($left['logo']))
                                            <x-curator-glider :media="$left['logo']" class="w-1/4 sm:w-1/5 lg:w-1/3" />
                                        @endif
                                        <div class="flex flex-col gap-5">
                                            @if(!empty($left['subtitle']))
                                                <h6 class="bullet-1">{{ $left['subtitle'] }}</h6>
                                            @endif
                                            @if(!empty($left['title']))
                                                <h2>{{ $left['title'] }}</h2>
                                            @endif
                                            @if(!empty($left['desc']))
                                                <p>{!! $left['desc'] !!}</p>
                                            @endif

                                            @if(!empty($left['btnText']) && !empty($left['btnLink']))
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
                                    @if(!empty($right['image']))
                                        <div class="relative lg:w-1/2">
                                            <a href="{{ $right['image'] }}" data-lightbox="gallery">
                                                <img class="w-full object-contain" src="{{ $right['image'] }}" alt="Tab Content">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </x-tab.tab-contents-saham>
                    @endforeach
                </div>
            </section>
        @endif
        <!--End Tab-->

        <!--Start Koneksi Global-->
        @if(!empty($hotspotKoneksiGlobal['pinKoneksiGlobal']))
            <section id="koneksi-global" class="lg:w-[1200px] lg:mx-auto my-18 lg:my-30">
                <div class="flex flex-col gap-5 px-4 sm:px-6 lg:px-0 text-center items-center">
                    <h6 data-aos="fade-down" class="bullet-1">{{ $hotspotKoneksiGlobal['subTitle'] }}</h6>
                    <h2 data-aos="fade-up" class="sm:w-[500px] lg:w-[600px]">{{ $hotspotKoneksiGlobal['title'] }}</h2>
                </div>

                <div class="map-container relative overflow-x-auto whitespace-nowrap max-w-full">
                    <div class="relative inline-block min-w-full">
                        <img src="{{ $hotspotKoneksiGlobal['mapKoneksiGlobal']['map'] }}" alt="World Map">

                        <!-- Hotspot Items -->
                        @foreach ($hotspotKoneksiGlobal['pinKoneksiGlobal'] as $item)
                            <x-loop.hotspot-item-koneksi-global :top="$item['top']" :left="$item['left']"
                                :country="$item['country']" :company="$item['company']" :flag="$item['flag']" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <!--End Koneksi Global-->
    </main>

    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>