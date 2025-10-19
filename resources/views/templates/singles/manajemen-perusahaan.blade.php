@php
    use App\Models\Management;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;

    $items = Management::with('featuredImage')
        ->where('status', ContentStatus::Published)
        ->orderBy('menu_order', 'asc')
        ->get();
    $commissioners = $items->where('level', 'commissioner');
    $directors = $items->where('level', 'bod');
    $heads = $items->where('level', 'heads');

@endphp

<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/manajemen-hero.jpg')"
            h1="{{ $item->title ?? 'Manajemen Perusahaan' }}" imageSize="bg-contain" />

        <!--Start Manajemen-->
        <section id="manajemen">
            <!--Section per Position-->
            @if($commissioners?->isNotEmpty())
                <x-loop.manajemen-grid :items="$commissioners" level="{{ __('management.commissioners') }}" />
            @endif

            @if($directors?->isNotEmpty())
                <x-loop.manajemen-grid :items="$directors" level="{{ __('management.directors') }}" />
            @endif

            @if($heads?->isNotEmpty())
                <x-loop.manajemen-grid :items="$heads" level="{{ __('management.division_heads') }}" />
            @endif
        </section>


        <!--Popup Content-->
        <div id="modal" class="fixed inset-0 flex items-center justify-center z-999 hidden">
            <div class="modal-overlay absolute inset-0 bg-black opacity-75"></div>

            <div
                class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-lg shadow-lg z-9999 overflow-y-auto">
                <!-- Modal Header -->
                <div class="modal-header flex flex-row justify-end pr-2 pt-2">

                    <button class="modal-close cursor-pointer" onclick="closeModal()">
                        <svg class="fill-current text-black h-6 w-6" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="modal-content pb-6 px-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="modal-image w-full md:w-1/3">
                            <img class="w-full rounded-md" src="" alt="Foto Manajemen">
                        </div>
                        <div class="modal-info w-full md:w-2/3 flex flex-col gap-3">
                            <h6
                                class="modal-position position w-fit text-transparent bg-clip-text bg-gradient-to-r from-[#1F77D3] to-[#321B71]">
                            </h6>
                            <h3 class="modal-title sm:mb-5 mb-1"></h3>
                            <div
                                class="modal-description flex flex-col gap-5 text-[var(--color-text)] pr-2 overflow-y-auto sm:max-h-[300px] max-h-[150px]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--End Manajemen-->



    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>