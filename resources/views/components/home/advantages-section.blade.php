@props([
    'subtitle' => 'Keunggulan',
    'title' => 'Alasan Memilih KIW?',
    'backgroundImage' => asset('storage/media/back-keunggulan.jpg'),
    'advantages' => [
        [
            'number' => '01.',
            'title' => 'Layanan Perizinan',
            'description' => 'KIW menawarkan kemudahan dalam menjalankan bisnis melalui sistem pelayanan satu atap yang terintegrasi.',
            'url' => '/keunggulan#perijinan'
        ],
        [
            'number' => '02.',
            'title' => 'Lokasi Strategis',
            'description' => 'Kawasan Industri Wijayakusuma terletak di jalur utama Semarang, pusat pertumbuhan ekonomi di Jawa Tengah.',
            'url' => '/keunggulan#lokasi'
        ],
        [
            'number' => '03.',
            'title' => 'Berbasis Ekosistem',
            'description' => 'KIW mengusung ekosistem industri terintegrasi yang mendorong kolaborasi antar pelaku usaha untuk tumbuh secara berkelanjutan.',
            'url' => '/keunggulan#ekosistem'
        ],
        [
            'number' => '04.',
            'title' => 'Infrastruktur & Fasilitas',
            'description' => 'KIW dibangun dengan infrastruktur kelas industri yang lengkap dan modern.',
            'url' => '/keunggulan#infrastruktur'
        ],
        [
            'number' => '05.',
            'title' => 'Upah Minimum Kompetitif',
            'description' => 'KIW memiliki Upah Minimum yang relatif lebih rendah dibandingkan kota-kota besar seperti Jakarta atau Surabaya.',
            'url' => '/keunggulan#upah'
        ],
        [
            'number' => '06.',
            'title' => 'Sumber Daya Manusia',
            'description' => 'KIW dikelilingi institusi pendidikan dan pelatihan yang mencetak lulusan siap kerja dan terampil.',
            'url' => '/keunggulan#sdm'
        ],
        [
            'number' => '07.',
            'title' => 'Ekosistem Klaster Bisnis',
            'description' => 'KIW mendukung ekosistem industri melalui fasilitas modern, tata kelola profesional, dan layanan satu pintu.',
            'url' => '/keunggulan#bisnis'
        ]
    ]
])

<section 
    id="keunggulan-home" 
    class="bg-no-repeat bg-cover relative"
    style="background-image: url('{{ $backgroundImage }}')"
>
    {{-- Gradient Overlay --}}
    <div class="gradient-overlay-keunggulan lg:pt-30 pt-18 flex flex-col gap-10">
        
        {{-- Section Header --}}
        <x-ui.container>
            <div class="flex flex-col gap-5">
                <h6 class="lg:text-center text-white bullet-2" data-aos="fade-down">{{ $subtitle }}</h6>
                <h2 class="lg:text-center text-white" data-aos="fade-up">{{ $title }}</h2>
            </div>
        </x-ui.container>
        
        {{-- Advantages Grid --}}
        <div class="lg:pb-0 pb-18">
            <x-ui.container>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($advantages as $index => $advantage)
                        <x-home.partials.advantage-card
                            :number="$advantage['number']"
                            :title="$advantage['title']"
                            :description="$advantage['description']"
                            :url="$advantage['url']"
                            :delay="$index * 100"
                        />
                    @endforeach
                </div>
            </x-ui.container>
        </div>
    </div>
</section>