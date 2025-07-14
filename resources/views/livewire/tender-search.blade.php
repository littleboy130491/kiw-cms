<section id="tender-archive"
    class="flex flex-col gap-9 lg:gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

    <!--Top Bar-->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 z-50">

        <!--Title-->
        <h2 class="text-center sm:text-left">Temukan Tender Terbaru</h2>

        <!--Field-->
        <div class="flex flex-col sm:flex-row-reverse gap-2 sm:w-1/2 lg:w-1/3">

            <!--Search-->
            <div class="relative max-w-md w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <img src="{{ Storage::url('media/search.png') }}">
                </div>
                <input type="search" placeholder="Cari disini..." wire:model.live.debounce.500ms="searchQuery"
                    wire:loading.attr="disabled"
                    class="w-full pl-10 pr-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--color-blue)]" />
            </div>

            <!--Year Dropdown-->
            <div class="relative max-w-md w-full">
                <select wire:model.live="tenderYear"
                    class="w-full pl-3 pr-10 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:var(--color-blue) appearance-none bg-white">
                    <option value="">Pilih Tahun</option>
                    @foreach($tenderYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <img src="{{ Storage::url('media/chevron-down-solid.png') }}" alt="">
                </div>
            </div>

        </div>

    </div>

    <!--Clear Filters-->
    @if($searchQuery || $tenderYear)
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-600">Filter aktif:</span>
            @if($searchQuery)
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                    Pencarian: "{{ $searchQuery }}"
                </span>
            @endif
            @if($tenderYear)
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                    Tahun: {{ $tenderYear }}
                </span>
            @endif
            <button wire:click="clearFilters" class="text-sm text-red-600 hover:text-red-800 underline cursor-pointer">
                Hapus Semua Filter
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
                    {{ $tenders->links('vendor.pagination.tailwind', ['wire:navigate' => true]) }}
                </div>
            @endif
        @else
            <div class="text-center py-20">
                <x-partials.post-not-found />
            </div>
        @endif
    </div>

</section>

