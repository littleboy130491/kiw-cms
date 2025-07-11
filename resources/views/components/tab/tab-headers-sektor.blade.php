@props(['title', 'tab', 'activeTab' => 'tab'])

<button 
    @click="{{ $activeTab }} = '{{ $tab }}'" 
    :class="{{ $activeTab }} === '{{ $tab }}' 
        ? ' text-white gradient-blue' 
        : 'text-[var(--color-heading)]'"
    class="tab-header-sektor px-1 sm:px-3 lg:pt-4 lg:pb-7 py-1 lg:py-0 lg:px-3 focus:outline-none cursor-pointer rounded-md lg:rounded-t-2xl rounded-bl-none rounded-br-none text-[.8em] sm:text-[1em] manrope font-bold bg-[var(--color-darktransit)] z-1 hover:bg-[var(--color-blue)] hover:text-white">
    {{ $title }}
</button>
