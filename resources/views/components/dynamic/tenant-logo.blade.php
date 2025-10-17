@php
    $block = collect($componentData->block)
                ->firstWhere('data.block_id', 'logo');
@endphp

@foreach ($block['data']['gallery_urls'] as $tenantLogo)
    <x-loop.tenant-logo :image="$tenantLogo['image']" />
@endforeach