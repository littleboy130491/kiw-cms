<a href="{{ route('cms.single.content', ['lang' => app()->getLocale(), 'content_type_key' => 'bpsp', 'content_slug' => $item->slug]) }}"
    class="group relative flex flex-col h-auto justify-between bg-[var(--color-transit)] overflow-hidden rounded-md px-6 pt-13 pb-0 block">
    @if ($item->buildingCategories->first())
        <div
            class="gradient-blue top-0 left-0 w-fit absolute px-3 py-2 rounded-tl-md rounded-br-md {{ $item->buildingCategories->first()?->slug === 'tersedia' ? 'blinking' : '' }}">
            <p class="text-white uppercase text-[.8em]">{{ $item->buildingCategories->first()?->title }}</p>
        </div>
    @endif

    <div
        class="mb-6 flex flex-row justify-between flex-nowrap items-center gap-3 group-hover:text-[var(--color-lightblue)]">
        <h4 class="group-hover:text-[var(--color-lightblue)]">{{ $item->title }}</h4>
        <x-icon.arrow-right-color-current />
    </div>
    <x-curator-glider :media="$item->featured_image" class="rounded-2xl rounded-b-none h-[180px] object-cover self-end w-full" />
</a>
