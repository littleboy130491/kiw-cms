@props(['data'])

@php
    $section_label = $data['section_label'] ?? '';
    $title = $data['title'] ?? '';
    $button_text = $data['button_text'] ?? '';
    $button_url = $data['button_url'] ?? '';
@endphp

<!--Start Fasilitas Home-->
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
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
<!--End Fasilitas Home-->