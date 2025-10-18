@props(['item', 'level'])

@php
    $title = $item->linkable?->title ?? $item->title;
    $url = $item->url ?? 'javascript:void(0)';
    $hasChildren = $item->children?->isNotEmpty();
@endphp

@if ($level === 0 && $hasChildren)
    {{-- root accordion --}}
    <x-menu-mobile.parent-menu-have-sub :menu="$title" :url="$url" :target="$item->target ?? '_self'">
        @foreach ($item->children as $child)
            <x-partials.menu-mobile-tree-item :item="$child" :level="1" />
        @endforeach
    </x-menu-mobile.parent-menu-have-sub>
@elseif ($level === 1 && $hasChildren)
    {{-- second-level accordion --}}
    <x-menu-mobile.sub-parent-menu :menu="$title" :url="$url" :target="$item->target ?? '_self'">
        @foreach ($item->children as $subchild)
            <x-menu-mobile.menu :menu="$subchild->linkable?->title ?? $subchild->title" :url="$subchild->url" />
        @endforeach
    </x-menu-mobile.sub-parent-menu>
@else
    {{-- leaf --}}
    <x-menu-mobile.menu :menu="$title" :url="$url" :target="$item->target ?? '_self'" />
@endif