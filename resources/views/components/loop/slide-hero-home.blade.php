@props(['slide', 'height', 'scale'])

@if (!empty($slide['backgroundVideo']))


<style>
    @media (min-width: 921px) {
        .slide-height {
            height: {{ $height['heightDesktop']['value'] }}{{ $height['heightDesktop']['unit'] }};
        }

        .video-bg {
            transform: scale({{ $scale['scaleDesktop'] }});
        }
    }  
    @media (min-width: 545px) and (max-width: 920px) {
        .slide-height {
            height: {{ $height['heightTablet']['value'] }}{{ $height['heightTablet']['unit'] }};
        }

         .video-bg {
            transform: scale({{ $scale['scaleTablet'] }});
        }
    }
    @media (max-width: 544px) {
        .slide-height {
            height: {{ $height['heightMobile']['value'] }}{{ $height['heightMobile']['unit'] }};
        }

        .video-bg {
        transform: scale({{ $scale['scaleMobile'] }});
        }
    
    }
</style>

    <div class="swiper-slide relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $slide['background'] }}" alt="Banner Image"
                class="w-full h-full object-cover absolute inset-0 z-0" />
            <iframe
                class="video-bgabsolute inset-0 w-full h-full object-cover video-bg"
                src="{{ $slide['backgroundVideo'] }}"
                title="YouTube video background"
                frameborder="0"
                allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>
        </div>
        <!-- overlay -->
        <div class="bg-[var(--color-overlayblack)] z-10 bg-opacity-60 relative">
            <div class="gradient-black-hero">
                <div class="flex flex-col justify-between items-start lg:pt-13 sm:pb-2 lg:pb-7 pb-6 slide-height">


                    <!-- content -->
                    <div class="flex flex-col items-start gap-5 sm:p-6 p-4 lg:w-[1200px] lg:mx-auto lg:px-0 sm:pt-8 px-4 lg:mt-40 mt-28 mb-10 z-20">
                        <div class="flex lg:flex-row flex-col items-start gap-5 ">
                        @if (!empty($slide['image']))
                        @if($slide['filterImageWhite'])
                            <img class="max-h-[80px] lg:max-h-[150px] filter invert brightness-0" src="{{ $slide['image'] }}">
                        @else
                            <img class="max-h-[80px] lg:max-h-[150px]" src="{{ $slide['image'] }}">
                        @endif
                        @endif
                            <div class="flex flex-col gap-5">
                                <h1 class="text-left text-white lg:max-w-[600px] sm:max-w-[500px] lg:!text-[2.8rem] sm:!text-[2.2rem] !text-[1.6rem]"
                                    data-aos="fade-up">
                                    {{ $slide['title'] }}
                                </h1>
                                <p class="text-white lg:max-w-[700px] sm:max-w-[400px] text-left">
                                    {{ $slide['desc'] }}
                                </p>
                                <a class="w-fit btn2 mt-5" data-aos="fade-down" href="{{ $slide['btnLink'] }}">
                                    <span class="gradient-text">{{ $slide['btnText'] }}</span>
                                    <img src="{{ Storage::url('media/arrow-right-solid.png') }}" alt="icon">
                                </a>
                            </div>
                        </div>    
                    </div>

                    @if (!empty($slide['counter']['items']))
                        <div class="counter-hero-home flex flex-row flex-wrap sm:flex-nowrap justify-start lg:w-[1200px] lg:mx-auto sm:gap-0 gap-y-5 mt-5 lg:px-0 sm:px-6 px-4">

                            @if (!empty($slide['counter']['title']))
                                <div class="lg:w-1/5 sm:w-1/5 w-full self-center lg:mr-5">
                                    <h5 class="text-white">{{ $slide['counter']['title'] }}</h5>
                                </div>
                            @endif
                            
                            <div class="flex flex-row flex-wrap sm:flex-nowrap justify-between w-full lg:gap-2 sm:gap-1 gap-y-5">
                            @foreach ($slide['counter']['items'] as $counter)
                                <x-loop.counter-hero-home 
                                    :counter="$counter['counter']" 
                                    :unit="$counter['suffix']" 
                                    :label="$counter['label']" />
                            @endforeach
                            </div>

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@else
    <div class="swiper-slide relative bg-cover bg-no-repeat overflow-hidden"
        style="background-image:url('{{ $slide['background'] }}')">
        <div class="bg-[var(--color-overlayblack)] z-10 bg-opacity-60 relative">
            <div class="gradient-black-hero">
                <div class="flex flex-col justify-between items-start lg:pt-13 sm:pb-2 lg:pb-7 pb-6 slide-height">


                    <!-- content -->
                    <div class="flex flex-col items-start gap-5 sm:p-6 p-4 lg:w-[1200px] lg:mx-auto lg:px-0 sm:pt-8 px-4 lg:mt-40 mt-28 mb-10 z-20">
                        <div class="flex lg:flex-row flex-col items-start gap-5 ">
                        @if (!empty($slide['image']))
                        @if($slide['filterImageWhite'])
                            <img class="max-h-[80px] lg:max-h-[150px] filter invert brightness-0" src="{{ $slide['image'] }}">
                        @else
                            <img class="max-h-[80px] lg:max-h-[150px]" src="{{ $slide['image'] }}">
                        @endif
                        @endif
                            <div class="flex flex-col gap-5">
                                <h1 class="text-left text-white lg:max-w-[600px] sm:max-w-[500px] lg:!text-[2.8rem] sm:!text-[2.2rem] !text-[1.6rem]"
                                    data-aos="fade-up">
                                    {{ $slide['title'] }}
                                </h1>
                                <p class="text-white lg:max-w-[700px] sm:max-w-[400px] text-left">
                                    {{ $slide['desc'] }}
                                </p>
                                <a class="w-fit btn2 mt-5" data-aos="fade-down" href="{{ $slide['btnLink'] }}">
                                    <span class="gradient-text">{{ $slide['btnText'] }}</span>
                                    <img src="{{ Storage::url('media/arrow-right-solid.png') }}" alt="icon">
                                </a>
                            </div>
                        </div>    
                    </div>

                    @if (!empty($slide['counter']['items']))
                    <div class="counter-hero-home flex flex-row flex-wrap sm:flex-nowrap justify-start lg:w-[1200px] lg:mx-auto sm:gap-0 gap-y-5 mt-5 lg:px-0 sm:px-6 px-4">

                            @if (!empty($slide['counter']['title']))
                                <div class="lg:w-1/5 sm:w-1/5 w-full self-center lg:mr-5">
                                    <h5 class="text-white">{{ $slide['counter']['title'] }}</h5>
                                </div>
                            @endif
                            
                            <div class="flex flex-row flex-wrap sm:flex-nowrap justify-between w-full lg:gap-2 sm:gap-1 gap-y-5">
                            @foreach ($slide['counter']['items'] as $counter)
                                <x-loop.counter-hero-home 
                                    :counter="$counter['counter']" 
                                    :unit="$counter['suffix']" 
                                    :label="$counter['label']" />
                            @endforeach
                            </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endif
