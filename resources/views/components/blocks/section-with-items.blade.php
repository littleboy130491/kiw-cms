@props(['data'])

@php
    $section_label = $data['section_label'] ?? '';
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $background_image = $data['background_image'] ?? '';
    $items = $data['items'] ?? [];
@endphp

@if(!empty($items))
{{-- Detect if this is services or advantages based on section label --}}
@if(str_contains(strtolower($section_label), 'layanan') || str_contains(strtolower($section_label), 'service'))
    {{-- Services Section --}}
    <section id="layanan-home" class="lg:py-30 py-18 bg-cover" 
        @if(!empty($background_image))
            style="background-image: url('{{ $background_image }}');"
        @else
            style="background-image: url('{{ Storage::url('media/bg-grad.jpg') }}');"
        @endif>
        <div class="flex flex-col overflow-hidden relative lg:gap-20 sm:gap-10 gap-10 lg:px-0 lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">
            <!--Heading-->
            <div class="flex flex-col justify-start items-center gap-5">
                @if(!empty($section_label))
                <h6 class="bullet-2 text-white text-center" data-aos="fade-down">{{ $section_label }}</h6>
                @endif
                @if(!empty($title))
                <h2 class="text-white text-center lg:w-[700px]" data-aos="fade-up">{{ $title }}</h2>
                @endif
            </div>

            <!--Content-->
            <div class="flex lg:flex-row flex-col gap-7">
                @foreach($items as $item)
                <x-loop.layanan-home 
                    number="{{ $item['number'] ?? '' }}" 
                    label="{{ $item['title'] ?? '' }}"
                    desc="{{ $item['description'] ?? '' }}"
                    url="{{ $item['url'] ?? '' }}" 
                    :image="$item['image'] ?? Storage::url('media/aerial-view-warehouse-industrial-plant-logistics-center-from-view-from.jpg')" />
                @endforeach
            </div>
        </div>
    </section>

@elseif(str_contains(strtolower($section_label), 'keunggulan') || str_contains(strtolower($section_label), 'advantage'))
    {{-- Advantages Section --}}
    <section id="keunggulan-home" class="bg-no-repeat bg-cover"
        @if(!empty($background_image))
            style="background-image: url('{{ $background_image }}');"
        @else
            style="background-image: url('{{ Storage::url('media/back-keunggulan.jpg') }}');"
        @endif>
        <!--Overlay-->
        <div class="gradient-overlay-keunggulan lg:pt-30 pt-18 flex flex-col gap-10">
            <!--Title-->
            <div class="flex flex-col gap-5 lg:px-0 sm:px-6 px-4">
                @if(!empty($section_label))
                <h6 class="lg:text-center !text-white bullet-2" data-aos="fade-down">{{ $section_label }}</h6>
                @endif
                @if(!empty($title))
                <h2 class="lg:text-center !text-white" data-aos="fade-up">{{ $title }}</h2>
                @endif
            </div>

            <!--Content-->
            <div class="flex lg:flex-row flex-col lg:px-0 lg:pb-0 pb-18 sm:px-6 px-4">
                @foreach($items as $item)
                <x-loop.keunggulan-home 
                    number="{{ $item['number'] ?? '' }}" 
                    label="{{ $item['title'] ?? '' }}"
                    desc="{{ $item['description'] ?? '' }}"
                    url="{{ $item['url'] ?? '' }}" />
                @endforeach
            </div>
        </div>
    </section>
@endif
@endif