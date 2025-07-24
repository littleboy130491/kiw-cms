@props(['menu'])

<nav class="hidden lg:flex lg:flex-row lg:justify-end">
    <ul class="flex flex-row justify-between gap-2 items-end grow">
        @foreach ($menu->menuItems as $item)
            <x-partials.menu-tree-item :item="$item" :level="0" />
        @endforeach
    </ul>
</nav>
