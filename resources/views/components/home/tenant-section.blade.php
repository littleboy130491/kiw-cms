@props([
    'subtitle' => 'Tenant Kami',
    'title' => 'Dipercaya oleh Perusahaan Terkemuka',
    'description' => 'Berbagai perusahaan terkemuka telah mempercayakan operasional bisnis mereka di Kawasan Industri Wijayakusuma.',
    'tenants' => [
        ['name' => 'PT ABC Industries', 'logo' => 'storage/media/tenant-1.png'],
        ['name' => 'PT XYZ Manufacturing', 'logo' => 'storage/media/tenant-2.png'],
        ['name' => 'PT DEF Textiles', 'logo' => 'storage/media/tenant-3.png'],
        ['name' => 'PT GHI Chemical', 'logo' => 'storage/media/tenant-4.png'],
        ['name' => 'PT JKL Foods', 'logo' => 'storage/media/tenant-5.png'],
        ['name' => 'PT MNO Furniture', 'logo' => 'storage/media/tenant-6.png'],
    ],
    'buttonText' => 'Lihat Semua Tenant',
    'buttonHref' => '/tenant'
])

<x-ui.section 
    id="tenant-home" 
    padding="lg"
    variant="light"
>
    <div class="text-center space-y-12">
        {{-- Section Header --}}
        <div class="max-w-3xl mx-auto">
            <h6 class="bullet-2" data-aos="fade-down">{{ $subtitle }}</h6>
            <h2 class="text-[var(--color-heading)] mt-4" data-aos="fade-up">{{ $title }}</h2>
            <p class="body-text text-[var(--color-text)] mt-6" data-aos="fade-up" data-aos-delay="100">
                {{ $description }}
            </p>
        </div>
        
        {{-- Tenant Logos Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center">
            @foreach($tenants as $index => $tenant)
                <div 
                    class="group flex items-center justify-center p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 100 }}"
                >
                    <img 
                        src="{{ asset($tenant['logo']) }}" 
                        alt="{{ $tenant['name'] }}"
                        class="max-h-12 w-auto object-contain grayscale group-hover:grayscale-0 transition-all duration-300"
                    >
                </div>
            @endforeach
        </div>
        
        {{-- Stats Row --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto">
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <x-ui.counter
                    number="100"
                    suffix="+"
                    title="Perusahaan Tenant"
                    variant="minimal"
                    size="lg"
                />
            </div>
            
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <x-ui.counter
                    number="5000"
                    suffix="+"
                    title="Tenaga Kerja"
                    variant="minimal"
                    size="lg"
                />
            </div>
            
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <x-ui.counter
                    number="15"
                    suffix="+"
                    title="Sektor Industri"
                    variant="minimal"
                    size="lg"
                />
            </div>
        </div>
        
        {{-- CTA Button --}}
        @if($buttonText && $buttonHref)
            <div data-aos="fade-up" data-aos-delay="500">
                <x-ui.button
                    :href="$buttonHref"
                    variant="primary"
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