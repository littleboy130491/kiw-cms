@props(['item'])

@php
    $title = $item->linkable?->title ?? $item->title;
    $url = $item->url ?? 'javascript:void(0)';
    $hasChildren = $item->children?->isNotEmpty();
@endphp

@if ($hasChildren)
    {{-- parent that opens / closes accordion-style --}}
    <x-menu-mobile.parent-menu-have-sub :menu="$title" :url="$url">
        @foreach ($item->children as $child)
            <x-partials.menu-mobile-tree-item :item="$child" />
        @endforeach
    </x-menu-mobile.parent-menu-have-sub>
@else
    {{-- simple leaf --}}
    <x-menu-mobile.menu :menu="$title" :url="$url" />
@endif
