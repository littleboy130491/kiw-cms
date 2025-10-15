@php
    $currentRouteName = Route::current()?->getName();
    $currentRouteParams = request()->route()?->parameters();
    $isActive = $currentRouteName && $url === route($currentRouteName, $currentRouteParams);
@endphp
<a href="{{ $url ?? '' }}"
   class="inline-flex items-center px-1 pt-1 uppercase text-white hover:text-[var(--color-lightblue)] focus:outline-none
           {{ $isActive ? 'active !text-[var(--color-lightblue)]' : '' }}">
    {{ $title ?? '' }}
</a>
