@props([
    'label' => '',
    'image' => '',
    'description' => ''
])

<x-ui.card
    variant="bordered"
    padding="lg"
    rounded="lg"
    class="bg-white shadow-lg"
>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        {{-- Content Left --}}
        <div class="space-y-6">
            <h3 class="text-2xl font-bold text-gray-900">
                {{ $label }}
            </h3>
            
            <div class="prose prose-gray max-w-none text-gray-600">
                {!! $description !!}
            </div>
            
            {{-- Optional CTA Button --}}
            <div class="pt-4">
                <x-ui.button
                    href="#"
                    variant="primary"
                    size="lg"
                >
                    Learn More
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </x-ui.button>
            </div>
        </div>
        
        {{-- Image Right --}}
        <div class="lg:order-2">
            <x-ui.responsive-image
                :src="asset($image)"
                :alt="$label"
                aspect-ratio="4/3"
                class="rounded-lg shadow-md"
                loading="lazy"
            />
        </div>
    </div>
</x-ui.card>