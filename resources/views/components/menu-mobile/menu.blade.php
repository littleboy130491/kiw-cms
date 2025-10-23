@php
    $currentRouteName = Route::currentRouteName();
    $resolvedCurrentUrl = !empty($currentRouteName) && Route::has($currentRouteName)
        ? route($currentRouteName, request()->route()?->parameters() ?? [])
        : url()->current();
    $isActive = $url === $resolvedCurrentUrl;
@endphp
<li><a href="{{ $url }}" target="{{ $target ?? '_self' }}"
        class="block hover:text-[var(--color-lightblue)] {{ $isActive ? 'active !text-[var(--color-lightblue)]' : '' }}">{{ $menu }}</a>
</li>
