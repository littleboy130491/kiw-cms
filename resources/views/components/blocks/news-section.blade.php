@props(['data'])

@php
    $section_label = $data['section_label'] ?? '';
    $title = $data['title'] ?? '';
    $button_text = $data['button_text'] ?? '';
    $button_url = $data['button_url'] ?? '';
@endphp

<!--Start Artikel Berita-->
<section id="artikel-berita-home"
    class="lg:max-w-[1200px] lg:mx-auto flex flex-col lg:my-30 my-18 lg:px-0 sm:px-6 px-4 gap-8">
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
        @if(!empty($button_text) && !empty($button_url))
        <!--button desktop tablet-->
        <a class="sm:!flex !hidden w-fit btn1 mt-5" data-aos="fade-down" href="{{ $button_url }}">{{ $button_text }}
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
        </a>
        @endif
    </div>

    <!--Content-->
    <x-loop.artikel-berita-grid />

    @if(!empty($button_text) && !empty($button_url))
    <!--button mobile-->
    <a class="!flex sm:!hidden w-fit btn1 mt-5" data-aos="fade-down" href="{{ $button_url }}">{{ $button_text }}
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </span>
    </a>
    @endif
</section>
<!--End Artikel Berita-->