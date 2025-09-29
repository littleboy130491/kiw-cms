@php
//Start Tab Sektor Industri Temporary Data
    $tabSektorIndustri = [
        'tabsTitle' => [
            ['tab' => 'Modern Textile & Garment'],
            ['tab' => 'Wood & Furniture'],
            ['tab' => 'Chemical & New Material'],
            ['tab' => 'Consumer Goods & Food Procesing'],
            ['tab' => 'Others'],
        ],

        'tabsContent' => [
            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Modern Textile and Garment Industry',
                    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/garmen.png'),
                ],
            ]], 

            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Wood & Furniture Industry',
                    'desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/furniture.png'),
                ],
            ]],

            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Chemical & New Material Industry',
                    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/chemical.png'),
                ],
            ]],

            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Consumer Goods & Food Procesing Industry',
                    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/consumer.png'),
                ],
            ]],

            [ 'tab' => [
                'tabContentLeft' => [
                    'title'=>'Others',
                    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a augue in erat fermentum imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed sodales semper tincidunt. Curabitur varius ultricies magna eleifend tincidunt. Suspendisse fringilla malesuada metus eu rutrum. Proin neque ante, fermentum sed hendrerit eget, scelerisque at risus. In posuere dui a neque dictum placerat.',
                ],
                'tabContentRight' => [
                    'image'=> Storage::url('media/others.png'),
                ],
            ]],
        ]
    ];
    //End Tab Sektor Industri Temporary Data
@endphp

<x-layouts.app>
    <x-partials.header />

    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/bdc43b57-5e80-418a-9a89-47cf20e59746.jpg')" h1="{{ strip_tags($item->content) ?? 'Mengapa KIW?' }}" />


    <!--Start Tab Sektor Industri-->
    <section id="tab" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto relative">
        <div x-data="{ tab: 'tab1' }" class="rounded-md">
            <!-- Tab Headers -->
            <div
                class="header-sektor-wrap lg:flex lg:flex-row lg:justify-start lg:gap-5 grid grid-cols-2 gap-2 justify-center z-1">
                @foreach ($tabSektorIndustri['tabsTitle'] as $index => $item)
                <x-tab.tab-headers-sektor 
                    :title="$item['tab']" 
                    :tab="'tab' . ($index + 1)" 
                />
            @endforeach
            </div>

            <!-- Tab Contents -->
            @foreach ($tabSektorIndustri['tabsContent'] as $index => $item)
            <x-tab.tab-contents-sektor id="tab{{ $index + 1 }}" :title="$item['tab']['tabContentLeft']['title']"
                :image="$item['tab']['tabContentRight']['image']" :desc="$item['tab']['tabContentLeft']['desc']" />
            @endforeach
        </div>
    </section>

    <!--End Sektor Industri-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
