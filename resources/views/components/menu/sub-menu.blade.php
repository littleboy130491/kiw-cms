@php
    $currentRouteName = Route::currentRouteName();
    $resolvedCurrentUrl = !empty($currentRouteName) && Route::has($currentRouteName)
        ? route($currentRouteName, request()->route()?->parameters() ?? [])
        : url()->current();
    $isActive = $url === $resolvedCurrentUrl;
@endphp
<li>
    <a href="{{ $url ?? '' }}" target="{{ $target ?? '_self' }}" class="block text-[.9em] px-4 py-2 text-[var(--color-heading)] hover:bg-[var(--color-lightblue)] hover:text-white
        {{ $isActive ? 'active hover:!text-white !text-[var(--color-lightblue)]' : '' }}">
        {{ $title ?? '' }}
    </a>
</li>
