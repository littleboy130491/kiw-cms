@props(['data'])

@php
    $slides = $data['slides'] ?? [];
@endphp

@if(!empty($slides))
<!--Start Hero Banner-->
<section id="hero-banner" class="relative bg-cover bg-center overflow-hidden">
    <div class="swiper swiper-hero">
        <div class="swiper-wrapper relative">
            @foreach($slides as $slide)
            <div class="swiper-slide relative overflow-hidden">
                <div class="absolute inset-0 z-0">
                    @if($slide['type'] === 'video' && !empty($slide['video_url']))
                        {{-- Video slide --}}
                        @if(!empty($slide['fallback_image']))
                            <img id="video-fallback" src="{{ $slide['fallback_image'] }}"
                                alt="Banner Image" class="w-full h-full object-cover absolute inset-0 z-0" />
                        @else
                            <img id="video-fallback" src="{{ Storage::url('media/background-home.jpg') }}"
                                alt="Banner Image" class="w-full h-full object-cover absolute inset-0 z-0" />
                        @endif
                        <iframe id="video-frame"
                            class="absolute inset-0 w-full h-full object-cover scale-[3] sm:scale-[1.5] lg:scale-[1.5]"
                            src="{{ $slide['video_url'] }}"
                            title="YouTube video background" frameborder="0" allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    @else
                        {{-- Image slide --}}
                        @if(!empty($slide['background_image']))
                            <div class="swiper-slide relative bg-cover bg-no-repeat overflow-hidden"
                                style="background-image:url('{{ $slide['background_image'] }}')">
                        @else
                            <div class="swiper-slide relative bg-cover bg-no-repeat overflow-hidden"
                                style="background-image:url('{{ Storage::url('media/hero-home-2.jpg') }}')">
                        @endif
                    @endif
                </div>
                
                <!-- overlay -->
                <div class="bg-[var(--color-overlayblack)] z-10 bg-opacity-60 relative">
                    <div class="gradient-black-hero">
                        <div class="flex flex-col justify-between items-start lg:pt-13 sm:pb-2 lg:pb-7 pb-6 lg:h-[110vh] sm:h-[600px] h-[654px]">
                            <!-- content -->
                            <div class="flex flex-col items-start gap-5 sm:p-6 p-4 lg:w-[1200px] lg:mx-auto lg:px-0 sm:pt-8 px-4 mt-40 z-20">
                                @if(!empty($slide['title']))
                                <h1 data-aos="fade-up"
                                    class="text-left text-white lg:max-w-[600px] sm:max-w-[500px] lg:!text-[2.8rem] sm:!text-[2.2rem] !text-[1.6rem]">
                                    {{ $slide['title'] }}
                                </h1>
                                @endif
                                
                                @if(!empty($slide['description']))
                                <p class="text-white lg:max-w-[700px] sm:max-w-[400px] text-left">
                                    {{ $slide['description'] }}
                                </p>
                                @endif
                                
                                @if(!empty($slide['button_text']) && !empty($slide['button_url']))
                                <!--Button-->
                                <a class="w-fit btn2 mt-5" data-aos="fade-down" href="{{ $slide['button_url'] }}">
                                    <span class="gradient-text">{{ $slide['button_text'] }}</span>
                                    <img src="{{ Storage::url('media/arrow-right-solid.png') }}" alt="icon">
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if(count($slides) > 1)
        <!-- Custom arrow Left -->
        <div class="swiper-button-prev bg-[var(--white-transparent)] hover:bg-[var(--color-blue)] rounded-[100%] sm:!h-[30px] sm:!w-[30px] !h-[20px] !w-[20px] p-1 cursor-pointer">
            <x-icon.arrow-left-white />
        </div>

        <!-- Custom arrow Right -->
        <div class="swiper-button-next bg-[var(--white-transparent)] hover:bg-[var(--color-blue)] rounded-[100%] sm:!h-[30px] sm:!w-[30px] !h-[20px] !w-[20px] p-1 cursor-pointer">
            <x-icon.arrow-right-white />
        </div>
        @endif
    </div>
</section>
<!--End Hero Banner-->
@endif