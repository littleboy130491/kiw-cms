 <ul class="mt-10 flex flex-col gap-4">
    @foreach ($menu->menuItems as $item)
        @if ($item->children && count($item->children))
            <!-- Parent menu with submenu -->
            <x-menu-mobile.parent-menu-have-sub :menu="$item->linkable?->title ?? $item->title"
                url="{{ $item->url ?? 'javascript:void(0)' }}">
                @foreach ($item->children as $child)
                    @if ($child->children && count($child->children))
                        <!-- Submenu that has sub-submenu -->
                        <x-menu-mobile.sub-parent-menu :menu="$child->linkable?->title ?? $child->title"
                            url="{{ $child->url ?? 'javascript:void(0)' }}">
                            @foreach ($child->children as $subchild)
                                <x-menu-mobile.menu :menu="$subchild->linkable?->title ?? $subchild->title" url="{{ $subchild->url }}" />
                            @endforeach
                        </x-menu-mobile.sub-parent-menu>
                    @else
                        <!-- Submenu item -->
                        <x-menu-mobile.menu :menu="$child->linkable?->title ?? $child->title" url="{{ $child->url }}" />
                    @endif
                @endforeach
            </x-menu-mobile.parent-menu-have-sub>
        @else
            <!-- Simple parent menu -->
            <x-menu-mobile.parent-menu :menu="$item->linkable?->title ?? $item->title" url="{{ $item->url }}" />
        @endif
    @endforeach
</ul>