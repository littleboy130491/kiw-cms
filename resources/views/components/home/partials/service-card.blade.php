@props([
    'number' => '01.',
    'title' => '',
    'description' => '',
    'url' => '#',
    'image' => '',
    'delay' => 0
])

<x-ui.card 
    variant="elevated"
    padding="none"
    rounded="lg"
    class="group hover:scale-105 transition-all duration-300 bg-white/10 backdrop-blur-sm border border-white/20"
    data-aos="fade-up"
    data-aos-delay="{{ $delay }}"
>
    {{-- Service Image --}}
    <div class="relative overflow-hidden rounded-t-lg">
        <x-ui.responsive-image
            :src="$image"
            :alt="$title"
            aspect-ratio="16/9"
            class="group-hover:scale-110 transition-transform duration-500"
        />
        
        {{-- Number Badge --}}
        <div class="absolute top-4 left-4 bg-blue-600 text-white font-bold text-lg px-3 py-1 rounded-full">
            {{ $number }}
        </div>
    </div>
    
    {{-- Service Content --}}
    <div class="p-6 text-white">
        <h3 class="text-xl font-semibold mb-3 group-hover:text-blue-300 transition-colors">
            {{ $title }}
        </h3>
        
        <p class="text-white/80 mb-4 line-clamp-3">
            {{ $description }}
        </p>
        
        {{-- Read More Link --}}
        <x-ui.button
            :href="$url"
            variant="outline"
            size="sm"
            class="border-white text-white hover:bg-white hover:text-gray-900 transition-all duration-300"
        >
            Selengkapnya
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </x-ui.button>
    </div>
</x-ui.card>