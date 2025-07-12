@props([
    'menu',
])
<nav class="hidden lg:flex lg:flex-row lg:justify-end">
    <ul class="flex flex-row justify-between gap-2 items-end grow">
        @foreach ($menu->menuItems as $item)
            <li class="relative group">
                @if ($item->children && count($item->children))
                
                    <!-- Main Menu with Submenu -->
                    <x-menu.parent-menu-have-sub :menu="$item->linkable?->title ?? $item->title" url="{{ $item->url }}" />

                    <!-- Submenu -->
                    <ul
                        class="absolute left-0 top-full mt-1 w-60 bg-white shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                        @foreach ($item->children as $child)
                            @if ($child->children && count($child->children))
                                <!-- Submenu with Sub-submenu -->
                                <li class="relative group/submenu">
                                    <x-menu.sub-parent-menu :menu="$child->linkable?->title ?? $child->title" url="{{ $child->url }}" />

                                    <!-- Sub-submenu -->
                                    <ul
                                        class="absolute left-full top-0 mt-0 w-40 bg-white shadow-lg opacity-0 invisible group-hover/submenu:opacity-100 group-hover/submenu:visible transition-all">
                                        @foreach ($child->children as $subchild)
                                            <x-menu.sub-sub-menu :menu="$subchild->linkable?->title ?? $subchild->title"  url="{{ $subchild->url }}" />
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <!-- Submenu tanpa Sub-submenu -->
                                <x-menu.sub-menu :menu="$child->linkable?->title ?? $child->title" url="{{ $child->url }}" />
                            @endif
                        @endforeach
                    </ul>
                @else
                    <!-- Main Menu tanpa Submenu -->
                    <x-menu.parent-menu :menu="$item->linkable?->title ?? $item->title" url="{{ $item->url }}" />
                @endif
            </li>
        @endforeach
    </ul>
</nav>