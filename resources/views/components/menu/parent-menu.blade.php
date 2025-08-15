<a href="{{ $url ?? '' }}"
   class="inline-flex items-center px-1 pt-1 uppercase text-white hover:text-[var(--color-lightblue)] focus:outline-none
          {{ $url === route(Route::current()->getName(), request()->route()->parameters()) ? 'active !text-[var(--color-lightblue)]' : '' }}">
    {{ $title ?? '' }}
</a>
