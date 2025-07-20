@props(['data'])

@php
    $section_title = $data['section_title'] ?? '';
    $tabs = $data['tabs'] ?? [];
@endphp

@if(!empty($tabs))
<!--Start Tab Sektor Industri-->
<section id="tab" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto relative">
    <div x-data="{ tab: 'tab1' }" class="rounded-md">
        <!-- Tab Headers -->
        <div class="header-sektor-wrap lg:flex lg:flex-row lg:justify-start lg:gap-5 grid grid-cols-2 gap-2 justify-center z-1">
            @foreach($tabs as $index => $tab)
            <x-tab.tab-headers-sektor 
                title="{{ $tab['tab_title'] ?? '' }}" 
                tab="tab{{ $index + 1 }}" />
            @endforeach
        </div>

        <!-- Tab Contents -->
        @foreach($tabs as $index => $tab)
        <x-tab.tab-contents-sektor 
            id="tab{{ $index + 1 }}" 
            label="{{ $tab['content_title'] ?? $tab['tab_title'] ?? '' }}"
            :image="$tab['image'] ?? Storage::url('media/garmen.png')"
            desc="{{ $tab['content'] ?? '' }}" />
        @endforeach
    </div>
</section>
<!--End Sektor Industri-->
@endif