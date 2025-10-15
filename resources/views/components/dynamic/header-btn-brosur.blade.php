@php
    $blocksCollection = collect($componentData->block);
    $headerBlock = $blocksCollection->firstWhere('data.block_id', 'header-btn-brosur');
    $btnUrl = $prefooterBlock['data']['url'] ?? '#';
    $btnLabel = $prefooterBlock['data']['button_label'] ?? 'Unduh Brosur';
@endphp

<a {{ $attributes->class(['group', 'w-fit'])->merge(['class' => 'btn5']) }} 
    href="{{ $btnUrl }}" target="_blank" rel="noopener">
    {{ $btnLabel }}
    <span class="gradient-icon fill-[white]">
        <x-icon.download-icon-current />
    </span>
</a>