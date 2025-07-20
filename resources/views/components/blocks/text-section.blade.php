@props(['data'])

@php
    $section_label = $data['section_label'] ?? '';
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $button_text = $data['button_text'] ?? '';
    $button_url = $data['button_url'] ?? '';
    $background_image = $data['background_image'] ?? '';
@endphp

{{-- Detect section type based on labels --}}
@if(str_contains(strtolower($section_label), 'fasilitas') || str_contains(strtolower($section_label), 'facilities'))
    {{-- Facilities Section --}}
    <section id="fasilitas-home" class="overflow-hidden lg:my-30 my-18 lg:px-0 sm:px-6 px-4">
        <div class="flex sm:flex-row flex-col lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto gap-10">
            <!--title-->
            <div class="flex flex-col justify-between gap-5 sm:!w-[40%]">
                <div class="flex flex-col justify-between gap-5">
                    @if(!empty($section_label))
                    <h6 class="bullet-1" data-aos="fade-down">{{ $section_label }}</h6>
                    @endif
                    @if(!empty($title))
                    <h2 data-aos="fade-up">{{ $title }}</h2>
                    @endif
                </div>

                @if(!empty($button_text) && !empty($button_url))
                <!--button-->
                <a class="w-fit btn1 mt-5" data-aos="fade-down" href="{{ $button_url }}">{{ $button_text }}
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
                @endif
            </div>

            <!--carousel-->
            <x-loop.fasilitas-home-carousel />
        </div>
        <x-popup-content.fasilitas-popup />
    </section>

@elseif(str_contains(strtolower($section_label), 'artikel') || str_contains(strtolower($section_label), 'berita') || str_contains(strtolower($section_label), 'news'))
    {{-- News/Articles Section --}}
    <section id="artikel-berita-home" class="lg:max-w-[1200px] lg:mx-auto flex flex-col lg:my-30 my-18 lg:px-0 sm:px-6 px-4 gap-8">
        <!--Title-->
        <div class="flex sm:flex-row flex-col justify-between items-end">
            <div class="flex flex-col gap-5">
                @if(!empty($section_label))
                <h6 class="bullet-1" data-aos="fade-down">{{ $section_label }}</h6>
                @endif
                @if(!empty($title))
                <h2 data-aos="fade-up">{{ $title }}</h2>
                @endif
            </div>
            @if(!empty($button_text))
            <!--button desktop tablet-->
            <a class="sm:!flex !hidden w-fit btn1 mt-5" data-aos="fade-down" href="{{ route('cms.archive.content', [app()->getLocale(), 'posts']) }}">{{ $button_text }}
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </a>
            @endif
        </div>

        <!--Content-->
        <x-loop.artikel-berita-grid />

        @if(!empty($button_text))
        <!--button mobile-->
        <a class="!flex sm:!hidden w-fit btn1 mt-5" data-aos="fade-down" href="{{ route('cms.archive.content', [app()->getLocale(), 'posts']) }}">{{ $button_text }}
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </a>
        @endif
    </section>

@elseif(str_contains(strtolower($section_label), 'investor') || str_contains(strtolower($section_label), 'hubungan'))
    {{-- Investor Relations Section --}}
    <section id="hubungan-investor-home" class="lg:py-30 py-18 bg-cover bg-[var(--color-transit)]">
        <div class="flex flex-col overflow-hidden relative lg:gap-9 sm:gap-7 gap-7 lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">
            <!--Heading-->
            <div class="flex flex-col justify-start gap-5">
                @if(!empty($section_label))
                <h6 class="bullet-1 sm:text-center text-left sm:self-center" data-aos="fade-down">{{ $section_label }}</h6>
                @endif
                @if(!empty($title))
                <h2 class="sm:text-center text-left" data-aos="fade-up">{{ $title }}</h2>
                @endif
            </div>

            <!--Content-->
            <x-loop.laporan-tahunan-grid />
        </div>
    </section>
@endif