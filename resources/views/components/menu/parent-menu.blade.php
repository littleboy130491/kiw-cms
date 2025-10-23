@php
    $currentRouteName = Route::currentRouteName();
    $resolvedCurrentUrl = !empty($currentRouteName) && Route::has($currentRouteName)
        ? route($currentRouteName, request()->route()?->parameters() ?? [])
        : url()->current();
    $isActive = $url === $resolvedCurrentUrl;
@endphp
<a href="{{ $url ?? '' }}" target="{{ $target ?? '_self' }}" class="inline-flex items-center px-1 pt-1 uppercase text-white hover:text-[var(--color-lightblue)] focus:outline-none
           {{ $isActive ? 'active !text-[var(--color-lightblue)]' : '' }}">
    {{ $title ?? '' }}
</a>
