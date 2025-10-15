@php
    $blocksCollection = collect($componentData->block);
    $headerBlock = $blocksCollection->firstWhere('data.block_id', 'header-btn-hubungi');
    $btnUrl = $prefooterBlock['data']['url'] ?? '#';
    $btnLabel = $prefooterBlock['data']['button_label'] ?? 'Hubungi Kami';
@endphp

 <a {{ $attributes->merge(['class' => 'btn5 group w-fit']) }} 
   href="{{ route('cms.page', [app()->getLocale(), 'kontak']) }}"
   rel="noopener">
    {{ $btnLabel }}
    <span class="gradient-icon">
        <x-icon.pencil />
    </span>
</a>