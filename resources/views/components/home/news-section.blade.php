@props([
    'subtitle' => 'Berita & Artikel',
    'title' => 'Informasi Terkini dari KIW',
    'description' => 'Ikuti perkembangan terbaru dan berita penting seputar Kawasan Industri Wijayakusuma.',
    'posts' => [],
    'buttonText' => 'Lihat Semua Berita',
    'buttonHref' => '/berita'
])

<x-ui.section 
    id="berita-home" 
    padding="lg"
    variant="secondary"
>
    <div class="space-y-12">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto">
            <h6 class="bullet-2" data-aos="fade-down">{{ $subtitle }}</h6>
            <h2 class="text-[var(--color-heading)] mt-4" data-aos="fade-up">{{ $title }}</h2>
            <p class="body-text text-[var(--color-text)] mt-6" data-aos="fade-up" data-aos-delay="100">
                {{ $description }}
            </p>
        </div>
        
        {{-- News Grid --}}
        @if(!empty($posts))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts->take(3) as $index => $post)
                    <article 
                        class="group"
                        data-aos="fade-up"
                        data-aos-delay="{{ $index * 100 }}"
                    >
                        <x-home.partials.news-card
                            :title="$post->title"
                            :excerpt="$post->excerpt"
                            :image="$post->featured_image"
                            :date="$post->published_at"
                            :url="$post->url"
                            :category="$post->category"
                        />
                    </article>
                @endforeach
            </div>
        @else
            {{-- Placeholder News Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for($i = 0; $i < 3; $i++)
                    <article 
                        class="group"
                        data-aos="fade-up"
                        data-aos-delay="{{ $i * 100 }}"
                    >
                        <x-home.partials.news-card
                            title="Berita Terbaru {{ $i + 1 }}"
                            excerpt="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
                            :image="Storage::url('media/news-placeholder-{{ $i + 1 }}.jpg')"
                            date="2024-01-{{ 15 + $i }}"
                            url="/berita/artikel-{{ $i + 1 }}"
                            category="Industri"
                        />
                    </article>
                @endfor
            </div>
        @endif
        
        {{-- CTA Button --}}
        @if($buttonText && $buttonHref)
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <x-ui.button
                    :href="$buttonHref"
                    variant="outline"
                    size="lg"
                >
                    {{ $buttonText }}
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </x-ui.button>
            </div>
        @endif
    </div>
</x-ui.section>