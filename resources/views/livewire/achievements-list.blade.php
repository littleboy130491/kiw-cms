<!--Penghargaan & Sertifikat-->
<section id="penghargaan-sertifikat"
    class="flex flex-col gap-9 lg:gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

    <!--Top Bar-->
    <div class="flex flex-col-reverse sm:flex-row sm:items-start sm:justify-between gap-5 z-10">

        <!--Category-->
        <div class="flex flex-row flex-wrap gap-2 justify-center sm:justify-start sm:w-1/2 lg:w-2/3">
            <button wire:click="$set('selectedType', '')"
                class="btn6 group w-fit {{ $selectedType == '' ? 'active' : '' }}">
                Semua
            </button>

            @foreach ($achievementTypes as $type)
                <button wire:click="selectType({{ $type->id }})"
                    class="btn6 group w-fit {{ $selectedType == $type->id ? 'active' : '' }}">
                    {{ $type->title }}
                </button>
            @endforeach
        </div>

        <!--Field-->
        <div class="flex flex-col gap-2 sm:w-1/2 lg:w-1/3">
            <div class="flex flex-col sm:flex-row-reverse gap-2">
                <!--Search-->
                <div class="relative max-w-md w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <img src="{{ Storage::url('media/search.png') }}">
                    </div>
                    <input type="search" placeholder="Cari disini..." wire:model.live.debounce.300ms="search"
                        x-on:forceClear.window="$el.value = ''"
                        class="w-full pl-10 pr-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:var(--color-blue)"
                        wire:key="search-input" />
                </div>

                <!--Year Dropdown-->
                <div class="relative max-w-md w-full">
                    <select wire:model.live="selectedYear"
                        class="w-full pl-3 pr-10 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:var(--color-blue) appearance-none">
                        <option value="">Pilih Tahun</option>
                        @foreach ($achievementYears as $year)
                            <option value="{{ $year->id }}">{{ $year->title }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <img src="{{ Storage::url('media/chevron-down-solid.png') }}" alt="">
                    </div>
                </div>
            </div>

            <!--Reset Filter-->
            <div class="flex justify-center sm:justify-end min-h-[1.5rem]">
                @if ($search || $selectedType || $selectedYear)
                    <button wire:click="resetFilters"
                        class="text-[var(--color-blue)] hover:text-[var(--color-blue-dark)] text-sm underline cursor-pointer">
                        Reset Filter
                    </button>
                @endif
            </div>
        </div>

    </div>

    <!--Loading indicator-->
    <div wire:loading class="flex justify-center items-center py-8">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[var(--color-blue)]"></div>
    </div>

    <!--Content-->
    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-12 z-10" wire:loading.remove>
        @forelse($achievements as $achievement)
            <div class="flex flex-col items-center group">
                <div class="flex flex-col justify-between items-center">
                    @if ($achievement->featuredImage)
                        <img class="h-[250px] object-contain -mb-[20px] z-10 group-hover:scale-110 transition-all duration-300"
                            src="{{ $achievement->featuredImage->url }}" alt="{{ $achievement->title }}">
                    @else
                        <img class="h-[250px] object-contain -mb-[20px] z-10 group-hover:scale-110 transition-all duration-300"
                            src="{{ Storage::url('media/default-achievement.png') }}" alt="{{ $achievement->title }}">
                    @endif
                    <img class="z-1" src="{{ Storage::url('media/frame-awards.png') }}" alt="frame-awards">
                </div>
                <div class="flex flex-col gap-2 items-center">
                    <p class="text-sm text-[var(--color-heading)] -mb-2">{{ $achievement->achievementYear->first()->title ?? '' }}</p>
                    <h5 class="text-[var(--color-heading)] text-center font-bold text-[1em]">{{ $achievement->title }}</h5>
                    <p class="text-sm text-[var(--color-text)] text-[.8em] italic">{{ $achievement->giver ?? 'Yayasan ABC' }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-[var(--color-text)] text-lg">Tidak ada penghargaan atau sertifikasi yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <!--Pagination-->
    @if ($achievements->hasPages())
        <div class="flex justify-center mt-8">
            {{ $achievements->links() }}
        </div>
    @endif
    @pushOnce('before_body_close')
        <script>
            window.addEventListener('reset-filters', () => {
                document.querySelector('input[type="search"]').value = '';
                document.querySelector('select').value = '';
            });
        </script>
    @endPushOnce
</section>
