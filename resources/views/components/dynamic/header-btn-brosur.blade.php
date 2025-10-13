@php
    $blocksCollection = collect($componentData->block);
    $headerBlock = $blocksCollection->firstWhere('data.block_id', 'header-btn-brosur');
    $btnUrl = $prefooterBlock['data']['url'] ?? '#';
    $btnLabel = $prefooterBlock['data']['button_label'] ?? 'Unduh Brosur';
@endphp

<a class=" btn5 group w-fit" href="{{ $btnUrl }}" target="_blank" rel="noopener">
    {{ $btnLabel }}
    <span class="gradient-icon">
        <x-icon.download-icon-current />
    </span>
</a>