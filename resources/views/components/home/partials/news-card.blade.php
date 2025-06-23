@props([
    'title' => '',
    'excerpt' => '',
    'image' => '',
    'date' => '',
    'url' => '#',
    'category' => ''
])

<x-ui.card
    :href="$url"
    variant="elevated"
    padding="none"
    rounded="lg"
    class="overflow-hidden h-full hover:scale-105 transition-all duration-300"
>
    {{-- Featured Image --}}
    <div class="relative">
        <x-ui.responsive-image
            :src="asset($image)"
            :alt="$title"
            aspect-ratio="16/9"
            class="w-full group-hover:scale-110 transition-transform duration-500"
        />
        
        {{-- Category Badge --}}
        @if($category)
            <div class="absolute top-4 left-4 bg-blue-600 text-white text-sm font-medium px-3 py-1 rounded-full">
                {{ $category }}
            </div>
        @endif
    </div>
    
    {{-- Content --}}
    <div class="p-6 space-y-4">
        {{-- Date --}}
        @if($date)
            <time class="text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
            </time>
        @endif
        
        {{-- Title --}}
        <h3 class="text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
            {{ $title }}
        </h3>
        
        {{-- Excerpt --}}
        @if($excerpt)
            <p class="text-gray-600 line-clamp-3">
                {{ $excerpt }}
            </p>
        @endif
        
        {{-- Read More Link --}}
        <div class="pt-2">
            <span class="text-blue-600 font-medium text-sm group-hover:text-blue-800 transition-colors">
                Baca selengkapnya →
            </span>
        </div>
    </div>
</x-ui.card>