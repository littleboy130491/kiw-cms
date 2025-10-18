@php
    $isActive = false;
    if (Route::current()) {
        try {
            $routeName = Route::current()->getName();
            $routeParams = request()->route() ? request()->route()->parameters() : [];
            $isActive = $url === route($routeName, $routeParams);
        } catch (Exception $e) {
            $isActive = false;
        }
    }
@endphp
<li><a href="{{ $url }}" target="{{ $target ?? '_self' }}"
        class="block hover:text-[var(--color-lightblue)] {{ $isActive ? 'active !text-[var(--color-lightblue)]' : '' }}">{{ $menu }}</a>
</li>