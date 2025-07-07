@props([
    'subtitle' => 'layanan kami',
    'title' => 'Solusi Komprehensif untuk Kebutuhan Industri',
    'backgroundImage' => Storage::url('media/bg-grad.jpg'),
    'services' => [
        [
            'number' => '01.',
            'title' => 'Lahan Industri Siap Bangun',
            'description' =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'url' => '/lahan-industri',
            'image' => Storage::url('media/aerial-view-warehouse-industrial-plant-logistics-center-from-view-from.jpg'),

            // 'image' => Storage::url('media/aerial-view-warehouse-industrial-plant-logistics-center-from-view-from.jpg',
        ],
        [
            'number' => '02.',
            'title' => 'Bangunan Pabrik Siap Pakai (BPSP)',
            'description' =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'url' => '/archive-bangunan-pabrik-siap-pakai',
            'image' => Storage::url('media/exterior-view-modern-industrial-building.jpg',
        ],
        [
            'number' => '03.',
            'title' => 'Kerja sama Komersial Kawasan Industri',
            'description' =>
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'url' => '/single-area-komersil-atm',
            'image' => Storage::url('media/exterior-view-modern-industrial-building.jpg',
        ],
    ],
])

<x-ui.section id="layanan-home" padding="lg" :background="$backgroundImage" class="bg-cover">
    <div class="flex flex-col gap-20">
        {{-- Section Header --}}
        <div class="flex flex-col justify-start items-center gap-5">
            <h6 class="bullet-2 text-white text-center" data-aos="fade-down">{{ $subtitle }}</h6>
            <h2 class="text-white text-center lg:w-[700px]" data-aos="fade-up">{{ $title }}</h2>
        </div>

        {{-- Services Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-7">
            @foreach ($services as $index => $service)
                <x-home.partials.service-card :number="$service['number']" :title="$service['title']" :description="$service['description']" :url="$service['url']"
                    :image="$service['image']" :delay="$index * 100" />
            @endforeach
        </div>
    </div>
</x-ui.section>
