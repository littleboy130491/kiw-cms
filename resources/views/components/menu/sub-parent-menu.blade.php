@php
    $currentRouteName = Route::current()?->getName();
    $currentRouteParams = request()->route()?->parameters();
    $isActive = $currentRouteName && $url === route($currentRouteName, $currentRouteParams);
@endphp
<a href="{{ $url ?? '' }}"
    class="flex text-[.9em] items-center justify-between px-4 py-2 text-[var(--color-heading)] hover:bg-[var(--color-lightblue)] hover:text-white {{ $isActive ? 'active hover:!text-white !text-[var(--color-lightblue)]'  : '' }}">
    {{ $title ?? '' }}
    <svg class="ml-2 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
            d="M7.21 5.23a.75.75 0 011.06 0l4.65 4.25a.75.75 0 010 1.08l-4.65 4.25a.75.75 0 11-1.06-1.06L10.293 10 7.21 6.97a.75.75 0 010-1.06z"
            clip-rule="evenodd" />
    </svg>
</a>
