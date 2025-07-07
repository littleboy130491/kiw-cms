@props([
    'defaultTab' => 'tab1',
    'tabs' => [
        [
            'id' => 'tab1',
            'title' => 'Modern Textile & Garment',
            'label' => 'Modern Textile and Garment Industry',
            'image' => Storage::url('media/garmen.png',
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.<ul class="list-disc pl-6 mt-5"><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li></ul></p>'
        ],
        [
            'id' => 'tab2',
            'title' => 'Wood & Furniture',
            'label' => 'Wood & Furniture',
            'image' => Storage::url('media/furniture.png',
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.<ul class="list-disc pl-6 mt-5"><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li></ul></p>'
        ],
        [
            'id' => 'tab3',
            'title' => 'Chemical & New Material',
            'label' => 'Chemical & New Material',
            'image' => Storage::url('media/chemical.png',
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.<ul class="list-disc pl-6 mt-5"><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li></ul></p>'
        ],
        [
            'id' => 'tab4',
            'title' => 'Consumer Goods & Food Processing',
            'label' => 'Consumer Goods & Food Processing',
            'image' => Storage::url('media/food.png',
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.<ul class="list-disc pl-6 mt-5"><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li></ul></p>'
        ],
        [
            'id' => 'tab5',
            'title' => 'Others',
            'label' => 'Others',
            'image' => Storage::url('media/others.png',
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.<ul class="list-disc pl-6 mt-5"><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li><li>Lorem ipsum dolor sit amet</li></ul></p>'
        ]
    ]
])

<x-ui.section 
    id="tab" 
    padding="lg"
    class="relative"
>
    <div x-data="{ tab: '{{ $defaultTab }}' }" class="rounded-md">
        {{-- Tab Headers --}}
        <div class="header-sektor-wrap lg:flex lg:flex-row lg:justify-start lg:gap-5 grid grid-cols-2 gap-2 justify-center z-1 mb-8">
            @foreach($tabs as $tabData)
                <button
                    @click="tab = '{{ $tabData['id'] }}'"
                    :class="tab === '{{ $tabData['id'] }}' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'"
                    class="px-4 py-3 rounded-lg font-medium transition-all duration-300 text-sm lg:text-base"
                >
                    {{ $tabData['title'] }}
                </button>
            @endforeach
        </div>
        
        {{-- Tab Contents --}}
        @foreach($tabs as $tabData)
            <div 
                x-show="tab === '{{ $tabData['id'] }}'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="tab-content"
            >
                <x-home.partials.industry-tab-content
                    :label="$tabData['label']"
                    :image="$tabData['image']"
                    :description="$tabData['description']"
                />
            </div>
        @endforeach
    </div>
</x-ui.section>