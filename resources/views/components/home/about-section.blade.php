@props([
    'subtitle' => 'tentang kiw',
    'title' => 'Pilar Industri Jawa Tengah',
    'description' =>
        'PT Kawasan Industri Wijayakusuma (KIW) merupakan perusahaan yang bergerak di bidang pengembangan dan pengelolaan kawasan industri. Pemegang saham KIW antara lain; Kementerian BUMN, PT Danareksa (Persero), Pemerintah Provinsi Jawa Tengah, dan Pemerintah Kabupaten Cilacap.',
    'isoImages' => [Storage::url('media/iso-1.png'), Storage::url('media/iso-2.png'), Storage::url('media/iso-3.png')],
    'counters' => [
        ['number' => '36', 'title' => 'Tahun Pengalaman'],
        ['number' => '100', 'title' => 'Perusahaan Tenant'],
        ['number' => '5000', 'title' => 'Tenaga Kerja'],
    ],
    'buttonText' => 'Baca Selengkapnya',
    'buttonHref' => '#',
    'images' => [
        ['src' => Storage::url('media/about-home-1.jpg'), 'alt' => 'About KIW 1'],
        ['src' => Storage::url('media/about-home-2.jpg'), 'alt' => 'About KIW 2'],
    ],
])

<x-ui.section id="about-home" variant="secondary" padding="lg" class="bg-[var(--color-transit)]">
    <div class="flex flex-col lg:gap-0 sm:gap-10 gap-10">
        {{-- Top Content --}}
        <div class="flex lg:flex-row flex-col justify-between gap-15 items-start lg:-mb-10">
            {{-- Content Left --}}
            <div class="flex flex-col justify-start gap-5 lg:w-[55%]">
                <h6 data-aos="fade-down" class="bullet-1">{{ $subtitle }}</h6>
                <h2 data-aos="fade-up" class="text-[var(--color-heading)]">{{ $title }}</h2>

                <p class="body-text text-[var(--color-text)]">
                    {{ $description }}
                </p>

                {{-- ISO Certificates --}}
                @if (!empty($isoImages))
                    <div class="flex flex-row items-center gap-5 mt-4">
                        @foreach ($isoImages as $iso)
                            <img src="{{ $iso }}" alt="ISO Certificate" class="h-12 object-contain">
                        @endforeach
                        <p class="text-[var(--color-heading)] text-[1.3em] w-[60px]">ISO Certificate</p>
                    </div>
                @endif

                {{-- Action Button --}}
                @if ($buttonText && $buttonHref)
                    <div class="mt-6">
                        <x-ui.button :href="$buttonHref" variant="outline" size="lg" class="btn2">
                            {{ $buttonText }}
                        </x-ui.button>
                    </div>
                @endif
            </div>

            {{-- Content Right - Images --}}
            @if (!empty($images))
                <div class="flex flex-col gap-5 lg:w-[40%]">
                    @foreach ($images as $index => $image)
                        <div class="{{ $index === 0 ? 'lg:ml-20' : 'lg:mr-20' }}">
                            <x-ui.responsive-image :src="$image['src']" :alt="$image['alt']" class="rounded-lg shadow-lg"
                                data-aos="fade-{{ $index === 0 ? 'right' : 'left' }}" />
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Counters Section --}}
        @if (!empty($counters))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                @foreach ($counters as $counter)
                    <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <x-ui.counter :number="$counter['number']" :title="$counter['title']" :suffix="$counter['suffix'] ?? ''" variant="default"
                            size="lg" />
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-ui.section>
