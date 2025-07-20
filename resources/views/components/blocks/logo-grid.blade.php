@props(['data'])

@php
    $section_label = $data['section_label'] ?? '';
    $title = $data['title'] ?? '';
    $logos = $data['logos'] ?? [];
@endphp

@if(!empty($logos))
<!--Start Tenant-->
<section id="tenant-home" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 flex flex-col lg:gap-9 gap-7">
    <div class="flex flex-col gap-5 lg:max-w-[1200px] lg:mx-auto">
        @if(!empty($section_label))
        <h6 class="bullet-1 self-center">{{ $section_label }}</h6>
        @endif
        @if(!empty($title))
        <h2 class="text-center">{{ $title }}</h2>
        @endif
    </div>
    
    <!--carousel-->
    <div class="relative w-full lg:max-w-[100vw] overflow-hidden">
        <div class="swiper-logo">
            <div class="swiper-wrapper lg:!flex lg:gap-5">
                @foreach($logos as $logo)
                <x-loop.tenant-logo 
                    :image="$logo['logo'] ?? Storage::url('media/logoipsum-1.png')" />
                @endforeach
                {{-- Duplicate logos for infinite scroll effect --}}
                @foreach($logos as $logo)
                <x-loop.tenant-logo 
                    :image="$logo['logo'] ?? Storage::url('media/logoipsum-1.png')" />
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--End Tenant-->
@endif