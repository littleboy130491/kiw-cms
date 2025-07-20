@props(['data'])

@php
    $section_label = $data['section_label'] ?? '';
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $primary_image = $data['primary_image'] ?? '';
    $secondary_image = $data['secondary_image'] ?? '';
    $additional_media = $data['additional_media'] ?? [];
    $button_text = $data['button_text'] ?? '';
    $button_url = $data['button_url'] ?? '';
@endphp

<!-- Start About Home -->
<section id="about-home" class="bg-[var(--color-transit)] lg:py-30 py-18">
    <div class="flex flex-col overflow-hidden relative lg:gap-0 sm:gap-10 gap-10 lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">
        <!--top content-->
        <div class="flex lg:flex-row flex-col justify-between !gap-15 items-start lg:-mb-10">
            <!--content left-->
            <div class="flex flex-col justify-start gap-5 lg:!w-[55%]">
                @if(!empty($section_label))
                <h6 data-aos="fade-down" class="bullet-1">{{ $section_label }}</h6>
                @endif
                
                @if(!empty($title))
                <h2 data-aos="fade-up" class="text-[var(--color-heading)]">{{ $title }}</h2>
                @endif

                @if(!empty($description))
                <div class="body-text text-[var(--color-text)]">
                    {!! $description !!}
                </div>
                @endif
                
                {{-- ISO Certificates --}}
                @if(!empty($additional_media))
                <div class="flex flex-row items-center gap-5 mt-4">
                    @foreach($additional_media as $media)
                        @if(!empty($media['image']))
                            <img src="{{ $media['image'] }}" alt="{{ $media['alt_text'] ?? 'Certificate' }}">
                        @else
                            {{-- Fallback to original ISO images --}}
                            @if($loop->index == 0)
                                <img src="{{ Storage::url('media/iso-1.png') }}" alt="{{ $media['alt_text'] ?? 'ISO Certificate' }}">
                            @elseif($loop->index == 1)
                                <img src="{{ Storage::url('media/iso-2.png') }}" alt="{{ $media['alt_text'] ?? 'ISO Certificate' }}">
                            @elseif($loop->index == 2)
                                <img src="{{ Storage::url('media/iso-3.png') }}" alt="{{ $media['alt_text'] ?? 'ISO Certificate' }}">
                            @endif
                        @endif
                    @endforeach
                    <p class="!text-[var(--color-heading)] !text-[1.3em] w-[60px]">ISO Certificate</p>
                </div>
                @endif
                
                {{-- Button --}}
                @if(!empty($button_text) && !empty($button_url))
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

            <!--image top right-->
            <div class="lg;!w-[45%]">
                @if(!empty($primary_image))
                    <img class="rounded-2xl lg:!h-[550px] sm:!h-[450px] lg:!w-[unset] sm:!w-[100vw] object-cover"
                        src="{{ $primary_image }}" alt="about">
                @else
                    <img class="rounded-2xl lg:!h-[550px] sm:!h-[450px] lg:!w-[unset] sm:!w-[100vw] object-cover"
                        src="{{ Storage::url('media/construction-site-with-cranes-construction-worker.jpg') }}" alt="about">
                @endif
            </div>
        </div>

        <!--bottom content-->
        <div class="flex sm:flex-row flex-col-reverse justify-start items-center gap-10">
            <!--content left-->
            <div class="sm:w-[48%] w-[100%]">
                @if(!empty($secondary_image))
                    <img class="rounded-2xl h-[340px] object-cover" src="{{ $secondary_image }}">
                @else
                    <img class="rounded-2xl h-[340px] object-cover" src="{{ Storage::url('media/pointing-sketch.jpg') }}">
                @endif
            </div>

            <!--content right - This will be rendered by the next counters block-->
            <div class="sm:w-[48%] w-[100%]" id="about-counters-placeholder">
                {{-- About counters will be rendered here by the next block --}}
            </div>
        </div>
    </div>
</section>
<!-- End About Home -->