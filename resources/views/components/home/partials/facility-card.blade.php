@props([
    'title' => '',
    'image' => '',
    'description' => ''
])

<x-ui.card
    variant="elevated"
    padding="none"
    rounded="lg"
    class="overflow-hidden h-full"
>
    {{-- Facility Image --}}
    <div class="relative">
        <x-ui.responsive-image
            :src="asset($image)"
            :alt="$title"
            aspect-ratio="16/9"
            class="w-full"
        />
        
        {{-- Overlay with Title --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
            <h3 class="text-white font-bold text-xl p-6">{{ $title }}</h3>
        </div>
    </div>
    
    {{-- Description --}}
    <div class="p-6">
        <p class="text-gray-600 line-clamp-4">
            {{ $description }}
        </p>
    </div>
</x-ui.card>