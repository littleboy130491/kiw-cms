@props(['data'])

@php
    $section_label = $data['section_label'] ?? '';
    $title = $data['title'] ?? '';
@endphp

<!-- Start Hubungan Investor Home -->
<section id="hubungan-investor-home" class="lg:py-30 py-18 bg-cover bg-[var(--color-transit)]">
    <div class="flex flex-col overflow-hidden relative lg:gap-9 sm:gap-7 gap-7 lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">
        <!--Heading-->
        <div class="flex flex-col justify-start gap-5">
            @if(!empty($section_label))
            <h6 class="bullet-1 sm:text-center text-left sm:self-center" data-aos="fade-down">{{ $section_label }}</h6>
            @endif
            @if(!empty($title))
            <h2 class="sm:text-center text-left" data-aos="fade-up">{{ $title }}</h2>
            @endif
        </div>

        <!--Content-->
        <x-loop.laporan-tahunan-grid />
    </div>
</section>
<!-- End Hubungan Investor Home -->