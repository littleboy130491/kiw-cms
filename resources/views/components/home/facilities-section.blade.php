@props([
    'subtitle' => 'Fasilitas',
    'title' => 'Fasilitas Pendukung Terlengkap',
    'description' => 'KIW menyediakan berbagai fasilitas pendukung yang lengkap untuk memenuhi kebutuhan operasional dan kenyamanan tenant.',
    'facilities' => [
        [
            'title' => 'Masjid',
            'image' => 'storage/media/masjid.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis mi ac mattis vehicula.'
        ],
        [
            'title' => 'Pengelola Air Bersih',
            'image' => 'storage/media/pengelolaan-air.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis mi ac mattis vehicula.'
        ],
        [
            'title' => 'Pemadam Kebakaran',
            'image' => 'storage/media/pemadam.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis mi ac mattis vehicula.'
        ],
        [
            'title' => 'Jalan Lingkungan',
            'image' => 'storage/media/jalan.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus facilisis mi ac mattis vehicula.'
        ]
    ]
])

<x-ui.section id="fasilitas-home" padding="lg">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        {{-- Content Left --}}
        <div class="space-y-6">
            <div>
                <h6 class="bullet-1" data-aos="fade-down">{{ $subtitle }}</h6>
                <h2 class="text-[var(--color-heading)] mt-4" data-aos="fade-up">{{ $title }}</h2>
            </div>
            
            <p class="body-text text-[var(--color-text)]" data-aos="fade-up" data-aos-delay="100">
                {{ $description }}
            </p>
            
            {{-- Counters --}}
            <div class="grid grid-cols-2 gap-6 mt-8">
                <x-ui.counter
                    number="15"
                    suffix="+"
                    title="Fasilitas Utama"
                    variant="minimal"
                    size="sm"
                    text-align="left"
                    data-aos="fade-up"
                    data-aos-delay="200"
                />
                
                <x-ui.counter
                    number="24"
                    suffix="/7"
                    title="Operasional"
                    variant="minimal"
                    size="sm"
                    text-align="left"
                    data-aos="fade-up"
                    data-aos-delay="300"
                />
            </div>
        </div>
        
        {{-- Facilities Carousel --}}
        <div class="relative" data-aos="fade-left">
            <div class="swiper facilities-swiper">
                <div class="swiper-wrapper">
                    @foreach($facilities as $facility)
                        <div class="swiper-slide">
                            <x-home.partials.facility-card
                                :title="$facility['title']"
                                :image="$facility['image']"
                                :description="$facility['description']"
                            />
                        </div>
                    @endforeach
                </div>
                
                {{-- Navigation --}}
                <div class="swiper-button-prev gradient-blue rounded-full !h-[40px] !w-[40px] !mt-0 !top-1/2 !left-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </div>
                
                <div class="swiper-button-next gradient-blue rounded-full !h-[40px] !w-[40px] !mt-0 !top-1/2 !right-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
                
                {{-- Pagination --}}
                <div class="swiper-pagination !bottom-4"></div>
            </div>
        </div>
    </div>
</x-ui.section>