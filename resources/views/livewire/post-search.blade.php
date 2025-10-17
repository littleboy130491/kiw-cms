<section id="post-archive"
    class="flex flex-col gap-9 lg:gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">
    <!--Top Bar-->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 z-10">
        <!--Title-->
        <h2 class="text-center sm:text-left">{{ strip_tags($content) ?: 'Temukan Berita Terbaru' }}</h2>


        <!--Search Field-->
        <div class="flex flex-col sm:flex-row-reverse gap-2 sm:w-1/2 lg:w-1/3">
            <!--Search-->
            <div class="relative max-w-md w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <img src="{{ Storage::url('media/search.png') }}" alt="Search">
                </div>
                <input type="search" placeholder="{{ __('search.placeholder') }}" wire:model.live.debounce.500ms="searchQuery"
                    wire:loading.attr="disabled"
                    class="w-full pl-10 pr-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--color-blue)]" />
            </div>
            <!--Category Select (Non-AJAX) -->
            <x-partials.category-dropdown />
        </div>
    </div>



    <!--Loading State-->
    <div wire:loading wire:target="searchQuery,gotoPage,previousPage,nextPage"
        class="flex justify-center items-center py-20">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[var(--color-blue)]"></div>
    </div>

    <!--Content-->
    <div wire:loading.remove wire:target="searchQuery,gotoPage,previousPage,nextPage">
        @if ($posts->total() > 0)
            <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-7">
                @foreach ($posts as $post)
                    <x-loop.artikel-berita :item="$post" />
                @endforeach
            </div>

            <!--Pagination - Only show if there are results AND multiple pages-->
            @if ($posts->hasPages())
                <div class="mt-8">
                    {{ $posts->links('vendor.livewire.tailwind', ['wire:navigate' => true]) }}
                </div>
            @endif
        @else
            <div class="text-center py-20">
                <x-partials.post-not-found />
            </div>
        @endif
    </div>
</section>
