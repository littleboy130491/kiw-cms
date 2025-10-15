@props(['componentData', 'class' => null, 'iconColor' => 'white'])

@php

    $blocksCollection = collect($componentData->block);
    $headerBlock = $blocksCollection->firstWhere('data.block_id', 'header-btn-brosur');
    $btnUrl = $headerBlock['data']['url'] ?? '#';
    $btnLabel = $headerBlock['data']['button_label'] ?? 'Unduh Brosur';

    // Use custom class if provided, otherwise use default
    $buttonClass = $class ?? 'btn5 group w-fit';
@endphp

<a class="{{ $buttonClass }}" 
   {{ $attributes->except('class') }}
    href="{{ $btnUrl }}" target="_blank" rel="noopener">
    {{ $btnLabel }}
    <span class="gradient-icon">
        <x-icon.download-icon-current :color="$iconColor"/>
    </span>
</a>