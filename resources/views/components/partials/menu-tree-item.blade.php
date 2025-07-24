@props(['item', 'level'])

<li @class(['relative group', 'group/submenu' => $level > 0])>

    {{-- link / label --}}
    @if ($level === 0 && $item->children?->isNotEmpty())
        <x-menu.parent-menu-have-sub :title="$item->linkable?->title ?? $item->title" :url="$item->url" />
    @elseif ($level === 0)
        <x-menu.parent-menu :title="$item->linkable?->title ?? $item->title" :url="$item->url" />
    @elseif ($level > 0 && $item->children?->isNotEmpty())
        <x-menu.sub-parent-menu :title="$item->linkable?->title ?? $item->title" :url="$item->url" />
    @else
        <x-menu.sub-menu :title="$item->linkable?->title ?? $item->title" :url="$item->url" />
    @endif

    {{-- recursive children --}}
    @if ($item->children?->isNotEmpty())
        <ul @class([
            'absolute bg-white shadow-lg opacity-0 invisible transition-all z-50',
            'left-0 top-full mt-1 w-60 group-hover:opacity-100 group-hover:visible' =>
                $level === 0,
            'left-full top-0 w-40 group-hover/submenu:opacity-100 group-hover/submenu:visible' =>
                $level > 0,
        ])>
            @foreach ($item->children as $child)
                <x-partials.menu-tree-item :item="$child" :level="$level + 1" />
            @endforeach
        </ul>
    @endif
</li>
