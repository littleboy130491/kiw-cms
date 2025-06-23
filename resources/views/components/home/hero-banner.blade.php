@props([
    'slides' => [],
    'class' => '',
])

<section id="hero-banner" class="relative bg-cover bg-center overflow-hidden {{ $class }}">
    <div class="swiper swiper-hero">
        <div class="swiper-wrapper relative">
            @if(!empty($slides))
                @foreach($slides as $slide)
                    <div class="swiper-slide relative overflow-hidden">
                        {{-- Background Media --}}
                        <div class="absolute inset-0 z-0">
                            @if(isset($slide['video']))
                                {{-- Video Background --}}
                                <img 
                                    id="video-fallback" 
                                    src="{{ $slide['fallback_image'] ?? asset('storage/media/background-home.jpg') }}" 
                                    alt="Banner Image" 
                                    class="w-full h-full object-cover absolute inset-0 z-0"
                                />
                                <iframe 
                                    id="video-frame"
                                    class="absolute inset-0 w-full h-full object-cover scale-[3] sm:scale-[1.5] lg:scale-[1.5]"
                                    src="{{ $slide['video'] }}"
                                    title="Background video"
                                    frameborder="0" 
                                    allow="autoplay; encrypted-media"
                                    allowfullscreen
                                ></iframe>
                            @else
                                {{-- Image Background --}}
                                <x-ui.responsive-image
                                    :src="$slide['image']"
                                    :alt="$slide['alt'] ?? 'Hero background'"
                                    class="w-full h-full object-cover"
                                    loading="eager"
                                />
                            @endif
                        </div>
                        
                        {{-- Overlay --}}
                        <div class="bg-[var(--color-overlayblack)] z-10 bg-opacity-60 relative">
                            <div class="gradient-black-hero">
                                <div class="flex flex-col justify-between items-start lg:pt-13 sm:pb-2 lg:pb-7 pb-6 lg:h-[110vh] sm:h-[600px] h-[654px]">
                                    {{-- Content --}}
                                    <x-ui.container size="xl" class="flex flex-col items-start gap-5 mt-40 z-20">
                                        <h1 
                                            data-aos="fade-up"
                                            class="text-left text-white lg:max-w-[600px] sm:max-w-[500px] lg:!text-[2.8rem] sm:!text-[2.2rem] !text-[1.6rem] font-bold leading-tight"
                                        >
                                            {{ $slide['title'] ?? 'Kawasan Industri Strategis untuk Pertumbuhan Bisnis' }}
                                        </h1>
                                        
                                        <p class="text-white lg:max-w-[700px] sm:max-w-[400px] text-left text-lg">
                                            {{ $slide['description'] ?? 'Fasilitas lengkap, aksesibilitas tinggi, dan dukungan profesional bagi investor.' }}
                                        </p>
                                        
                                        {{-- Action Buttons --}}
                                        @if(isset($slide['buttons']))
                                            <div class="flex flex-wrap gap-4 mt-6">
                                                @foreach($slide['buttons'] as $button)
                                                    <x-ui.button
                                                        :href="$button['href'] ?? '#'"
                                                        :variant="$button['variant'] ?? 'primary'"
                                                        :size="$button['size'] ?? 'lg'"
                                                        :target="$button['target'] ?? null"
                                                        class="min-w-[150px]"
                                                    >
                                                        {{ $button['text'] }}
                                                    </x-ui.button>
                                                @endforeach
                                            </div>
                                        @endif
                                    </x-ui.container>
                                    
                                    {{-- Bottom Content --}}
                                    @if(isset($slide['bottom_content']))
                                        <x-ui.container size="xl" class="z-20">
                                            {!! $slide['bottom_content'] !!}
                                        </x-ui.container>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Default Single Slide --}}
                <div class="swiper-slide relative overflow-hidden">
                    <div class="absolute inset-0 z-0">
                        <img 
                            id="video-fallback" 
                            src="{{ asset('storage/media/background-home.jpg') }}" 
                            alt="Banner Image" 
                            class="w-full h-full object-cover absolute inset-0 z-0"
                        />
                        <iframe 
                            id="video-frame"
                            class="absolute inset-0 w-full h-full object-cover scale-[3] sm:scale-[1.5] lg:scale-[1.5]"
                            src="https://www.youtube.com/embed/1t_z7FMcsOw?autoplay=1&loop=1&mute=1&controls=0&playlist=1t_z7FMcsOw&modestbranding=1&showinfo=0"
                            title="YouTube video background"
                            frameborder="0" 
                            allow="autoplay; encrypted-media"
                            allowfullscreen
                        ></iframe>
                    </div>
                    
                    <div class="bg-[var(--color-overlayblack)] z-10 bg-opacity-60 relative">
                        <div class="gradient-black-hero">
                            <div class="flex flex-col justify-between items-start lg:pt-13 sm:pb-2 lg:pb-7 pb-6 lg:h-[110vh] sm:h-[600px] h-[654px]">
                                <x-ui.container size="xl" class="flex flex-col items-start gap-5 mt-40 z-20">
                                    <h1 
                                        data-aos="fade-up"
                                        class="text-left text-white lg:max-w-[600px] sm:max-w-[500px] lg:!text-[2.8rem] sm:!text-[2.2rem] !text-[1.6rem] font-bold leading-tight"
                                    >
                                        Kawasan Industri Strategis untuk Pertumbuhan Bisnis
                                    </h1>
                                    
                                    <p class="text-white lg:max-w-[700px] sm:max-w-[400px] text-left text-lg">
                                        Fasilitas lengkap, aksesibilitas tinggi, dan dukungan profesional bagi investor.
                                    </p>
                                </x-ui.container>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        {{-- Navigation --}}
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>