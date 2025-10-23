<section id="tender-archive"
    class="flex flex-col gap-9 lg:gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

    <!--Top Bar-->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 z-10">

        <!--Title-->
        <h2 class="text-center sm:text-left">{{ strip_tags($content) ?? __('tender.find_latest_tenders') }}</h2>

        <!--Field-->
        <div class="flex flex-col sm:flex-row-reverse gap-2 sm:w-1/2 lg:w-1/3">

            <!--Search-->
            <div class="relative max-w-md w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <img src="{{ Storage::url('media/search.png') }}" loading="lazy"/>
                </div>
                <input type="search" placeholder="{{ __('tender.search_here') }}"
                    wire:model.live.debounce.500ms="searchQuery" wire:loading.attr="disabled"
                    class="w-full pl-10 pr-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--color-blue)]" />
            </div>

            <!--Year Dropdown-->
            <div class="relative max-w-md w-full">
                <select wire:model.live="tenderYear"
                    class="w-full pl-3 pr-10 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:var(--color-blue) appearance-none bg-white">
                    <option value="">{{ __('tender.select_year') }}</option>
                    @foreach ($tenderYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <img src="{{ Storage::url('media/chevron-down-solid.png') }}" alt="" loading="lazy"/>
                </div>
            </div>

        </div>

    </div>

    <!--Clear Filters-->
    @if ($searchQuery || $tenderYear)
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-600">{{ __('tender.active_filters') }}</span>
            @if ($searchQuery)
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                    {{ __('tender.search') }}: "{{ $searchQuery }}"
                </span>
            @endif
            @if ($tenderYear)
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                    {{ __('tender.year') }}: {{ $tenderYear }}
                </span>
            @endif
            <button wire:click="clearFilters" class="text-sm text-red-600 hover:text-red-800 underline cursor-pointer">
                {{ __('tender.clear_all_filters') }}
            </button>
        </div>
    @endif

    <!--Loading State-->
    <div wire:loading wire:target="searchQuery,tenderYear,gotoPage,previousPage,nextPage"
        class="flex justify-center items-center py-20">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[var(--color-blue)]"></div>
    </div>

    <!--Content-->
    <div wire:loading.remove wire:target="searchQuery,tenderYear,gotoPage,previousPage,nextPage">
        @if ($tenders->total() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-7 lg:gap-5">
                @foreach ($tenders as $tender)
                    <x-loop.tender :item="$tender" />
                @endforeach
            </div>

            <!--Pagination - Only show if there are results AND multiple pages-->
            @if ($tenders->hasPages())
                <div class="mt-8">
                    {{ $tenders->links('vendor.livewire.tailwind', ['wire:navigate' => true]) }}
                </div>
            @endif
        @else
            <div class="text-center py-20">
                <x-partials.post-not-found />
            </div>
        @endif
    </div>
    @pushOnce('before_body_close')
        <script>
            window.addEventListener('reset-filters', () => {
                document.querySelector('input[type="search"]').value = '';
                document.querySelector('select').value = '';
            });
        </script>
    @endPushOnce
</section>