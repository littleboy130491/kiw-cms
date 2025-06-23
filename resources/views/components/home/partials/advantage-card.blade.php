@props([
    'number' => '01.',
    'title' => '',
    'description' => '',
    'url' => '#',
    'delay' => 0
])

<x-ui.card 
    variant="elevated"
    padding="lg"
    rounded="lg"
    class="group hover:scale-105 transition-all duration-300 bg-white/10 backdrop-blur-sm border border-white/20 text-white h-full"
    data-aos="fade-up"
    data-aos-delay="{{ $delay }}"
>
    {{-- Number Badge --}}
    <div class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white font-bold text-lg rounded-full mb-4">
        {{ $number }}
    </div>
    
    {{-- Title --}}
    <h3 class="text-xl font-semibold mb-3 group-hover:text-blue-300 transition-colors">
        {{ $title }}
    </h3>
    
    {{-- Description --}}
    <p class="text-white/80 mb-6 line-clamp-4 flex-grow">
        {{ $description }}
    </p>
    
    {{-- Read More Link --}}
    <div class="mt-auto">
        <x-ui.button
            :href="$url"
            variant="ghost"
            size="sm"
            class="text-white hover:text-blue-300 hover:bg-white/10 p-0 font-medium group-hover:translate-x-2 transition-all duration-300"
        >
            Selengkapnya
            <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </x-ui.button>
    </div>
</x-ui.card>