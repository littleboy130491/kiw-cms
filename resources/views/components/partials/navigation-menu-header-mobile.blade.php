<ul class="mt-10 flex flex-col gap-4">
    @foreach ($menu->menuItems as $item)
        <x-partials.menu-mobile-tree-item :item="$item" :level="0" />
    @endforeach
</ul>
