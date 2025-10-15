@props(['componentData', 'class' => null, 'iconColor' => 'white'])
@php
    $blocksCollection = collect($componentData->block);
    $headerBlock = $blocksCollection->firstWhere('data.block_id', 'header-btn-hubungi');
    $btnUrl = $headerBlock['data']['url'] ?? '#';
    $btnLabel = $headerBlock['data']['button_label'] ?? 'Hubungi Kami';

    // Use custom class if provided, otherwise use default
    $buttonClass = $class ?? 'btn5 group w-fit';
    $iconColorClass = "fill-[{$iconColor}]";
@endphp

<a class="{{ $buttonClass }}" 
   {{ $attributes->except('class') }}
    href="{{ $btnUrl }}" target="_blank" rel="noopener">
    {{ $btnLabel }}
    <span class="gradient-icon {{ $iconColorClass }}">
        <x-icon.pencil />
    </span>
</a>