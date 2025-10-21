@php
    $tender_archive_url = route('cms.page', [
        'lang' => app()->getLocale(),
        'slug' => 'tenders',
    ]);

    $blocksCollection = collect($item->block);
    $welcomeBlock = $blocksCollection->firstWhere('data.block_id', 'welcome');
    $backgroundBlock = $blocksCollection->firstWhere('data.block_id', 'background');
    $peringatanBlock = $blocksCollection->firstWhere('data.block_id', 'peringatan');
    $panduanPengadaanBlock = $blocksCollection->firstWhere('data.block_id', 'panduan-pengadaan');
    $pengadaanTerbaruBlock = $blocksCollection->firstWhere('data.block_id', 'pengadaan-terbaru');
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/pengadaan-hero.jpg')"
            h1="{!! $item->title ?? 'Pengadaan Barang & Jasa' !!}" />

        <!--Start About Pengadaan-->
        <section id="about-pengadaan" class="relative bg-contain bg-no-repeat bg-bottom z-10"
            style="background-image:url({{ $backgroundBlock['data']['image_url'] ?? Storage::url('media/pengadaan-content.jpg') }})">
            <div class="flex flex-col grow gradient-pengadaan-top">
                <div
                    class="gradient-white-visi-misi-bottom pb-70 sm:pb-80 lg:pb-200 pt-18 px-4 sm:px-6 lg:px-0 lg:pt-30">
                    @if ($welcomeBlock)
                        <div class="lg:w-[1200px] lg:mx-auto flex flex-col lg:flex-row gap-5 sm:justify-between">
                            <div class="lg:w-[37%] flex flex-col gap-5">
                                <h2 data-aos="fade-up">
                                    {{ $welcomeBlock['data']['title'] ?? 'Selamat Datang di E-Procurement KIW' }}
                                </h2>
                            </div>

                            <!--Wrap Items-->
                            <div class="flex flex-col gap-5 lg:w-[58%] sm:grid-cols-2">

                                <p>
                                    {!! $welcomeBlock['data']['description'] !!}
                                </p>
                                <a class="w-fit btn1 mt-5" data-aos="fade-down" href="{{ $welcomeBlock['data']['url'] }}"
                                    target="_blank" rel="noopener noreferrer">{{ $welcomeBlock['data']['button_label'] }}
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </a>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!--End About Pengadaan-->

        <!--Start Section Peringatan-->
        @if ($peringatanBlock)
            <section data-aos="fade-up" id="{{ $peringatanBlock['data']['block_id'] }}"
                class="relative sm:px-6 lg:px-0 sm:-mt-20 lg:-mt-25 lg:w-[1200px] lg:mx-auto z-20">
                <div class="bg-cover px-4 sm:px-6 pt-18 sm:pt-0 lg:px-10 flex flex-col sm:rounded-lg justify-between sm:flex-row gap-8"
                    style="background-image:url('{{ Storage::url('media/gradient-pengadaan.jpg') }}')">
                    <div class="flex flex-col gap-5 sm:w-2/3 lg:w-1/2 sm:py-9 lg:self-center">
                        <h3 class="text-white">{{ $peringatanBlock['data']['title'] }}</h3>
                        <p class="text-white">
                            {!! $peringatanBlock['data']['description'] !!}
                        </p>
                    </div>
                    <x-curator-glider :media="$peringatanBlock['data']['image']"
                        class="object-contain sm:w-1/3 lg:w-1/2 sm:self-end sm:-ml-5 lg:-ml-0 lg:-mt-20" />
                </div>
            </section>
        @endif
        <!--End Section Peringatan-->

        <!-- Start Panduan Pengadaan -->
        @if ($panduanPengadaanBlock)
            <section id="{{ $panduanPengadaanBlock['data']['block_id'] }}"
                class="lg:my-30 my-18 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:gap-9 lg:w-[1200px] lg:mx-auto">

                <!--Heading-->
                <div class="flex flex-col justify-start gap-5">
                    <h6 data-aos="fade-down" class="bullet-1 sm:text-center text-left sm:self-center">
                        {{ $panduanPengadaanBlock['data']['subtitle'] }}
                    </h6>
                    <h2 data-aos="fade-up" class="sm:text-center text-left">
                        {{ $panduanPengadaanBlock['data']['title'] }}
                    </h2>
                </div>
                <x-loop.panduan-pengadaan-grid />


            </section>
        @endif
        <!-- End Panduan Pengadaan -->

        <!--Start Pengadaan-->
        @if ($pengadaanTerbaruBlock)
            <section id="{{ $pengadaanTerbaruBlock['data']['block_id'] }}"
                class="lg:py-30 py-18 bg-cover bg-[var(--color-transit)]">
                <div
                    class="flex flex-col overflow-hidden relative lg:gap-11 sm:gap-7 gap-7  lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">

                    <!--Heading-->
                    <div class="flex flex-row justify-between">
                        <div class="flex flex-col justify-start gap-5">
                            <h6 data-aos="fade-down" class="bullet-1 sm:text-left text-left">
                                {{ $pengadaanTerbaruBlock['data']['subtitle'] }}
                            </h6>
                            <h2 data-aos="fade-up" class="sm:text-center text-left">
                                {{ $pengadaanTerbaruBlock['data']['title'] }}
                            </h2>
                        </div>
                        <!--button Desktop Tablet-->
                        <a class="w-fit btn1 self-end mt-5 sm:!flex !hidden" data-aos="fade-down"
                            href="{{ $tender_archive_url }}">{{ __('common.view_all') }}
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
                    <x-loop.tender-grid qty="4" />
                    <!--button mobile only-->
                    <a class="w-fit btn1 mobile-only mt-7 lg:hidden" data-aos="fade-down"
                        href="{{ $tender_archive_url }}">{{ __('common.view_all') }}
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
            </section>
        @endif
        <!--End Pengadaan-->



    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>