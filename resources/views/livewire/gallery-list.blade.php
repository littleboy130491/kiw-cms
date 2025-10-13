@php
$galleryPerusahaan = [
    [
        'title' => 'Kegiatan Perusahaan',
    ],
    [
        'filter' => [
            'photo' => 'Foto',
            'videos' => 'Video',
            'allMonth' => 'Semua Bulan',
            'allYear' => 'Semua Tahun',
            'reset' => 'Hapus Filter',
            'loadMore' => 'Lihat Selengkapnya',
            'noData' => 'Tidak ada data ditemukan',
            'loading' => 'Loading...',
            'resetFilters' => 'Coba ubah filter Pencarian.',
            'doesntSupport' => 'Browser Anda tidak mendukung fitur video tag.',
            ]
    ],
];
@endphp

<div class="w-full max-w-7xl mx-auto px-4 py-8">

    <div class="flex sm:flex-row flex-wrap flex-col justify-start sm:justify-between items-start sm:items-center mb-6">
        <h2 class="sm:w-[45%] w-full sm:order-2">{{$galleryPerusahaan[0]['title']}}</h2>

        {{-- Tabs --}}
        <div class="sm:order-3 sm:w-[55%] w-full flex sm:flex-row flex-col justify-end sm:items-center items-start sm:gap-5 mb-4 sm:mb-0">
            <div class="mb-6">
                <nav class="-mb-px flex justify-start flex-nowrap gap-3">
                    <!--button-->
                        <a 
                            wire:click="$set('activeTab', 'images')"
                            class="w-fit btn11 mt-5 {{ $activeTab === 'images' ? 'active' : '' }}"
                        >
                            {{$galleryPerusahaan[1]['filter']['photo']}}
                        </a>

                        <a 
                            wire:click="$set('activeTab', 'videos')"
                            class="w-fit btn11 mt-5 {{ $activeTab === 'videos' ? 'active' : '' }}"
                        >
                            {{$galleryPerusahaan[1]['filter']['videos']}}
                        </a>


                {{-- Tabs --}}
                   
                </nav>
            </div>

            {{-- Filters --}} 
            <div class="flex lg:flex-wrap flex-nowrap gap-4 sm:justify-center justify-start">
                <div class="flex flex-row flex-nowrap justify-start items-start sm:items-center">
                    <select 
                        id="month-filter"
                        wire:model.live="selectedMonth"
                        wire:key="month-{{ $activeTab }}"
                        class="block w-full h-[45px] pl-3 pr-2 rounded-md border-gray-300 shadow-sm focus:border-[var(--color-blue)] focus:ring-[var(--color-blue)] sm:text-sm"
                    >
                        <option value="">{{$galleryPerusahaan[1]['filter']['allMonth']}}</option>
                        @foreach($availableMonths as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-row flex-nowrap items-center">
                    <select 
                        id="year-filter"
                        wire:model.live="selectedYear"
                        wire:key="year-{{ $activeTab }}"
                        class="block w-full h-[45px] pl-3 pr-2 rounded-md border-gray-300 shadow-sm focus:border-[var(--color-blue)] focus:ring-[var(--color-blue)] sm:text-sm"
                    >
                        <option value="">{{$galleryPerusahaan[1]['filter']['allYear']}}</option>
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @if($selectedMonth || $selectedYear)
            <div class="flex w-full sm:order-1 sm:justify-end justify-start sm:-mb-3 -mt-4 items-end text-[1em] text-[var(--color-blue)]">
                <button 
                    wire:click="resetFilters"
                    class="block h-[45px] cursor-pointer"
                >
                    {{$galleryPerusahaan[1]['filter']['reset']}}
                </button>
            </div>
        @endif
    </div>

    {{-- Media Grid --}}
    <div wire:loading.class="opacity-50" class="transition-opacity">
        @if($mediaItems->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($mediaItems as $media)
                    <div class="group relative bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow overflow-hidden">
                        @if($activeTab === 'images')
                            {{-- Image with Lightbox --}}
                            <a href="{{ $media->url }}" data-lightbox="gallery-{{ $activeTab }}" data-title="{{ $media->alt ?? $media->name }}">
                                <div class="aspect-square bg-gray-200 overflow-hidden">
                                    <img 
                                        src="{{ $media->url }}" 
                                        alt="{{ $media->alt ?? $media->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    >
                                </div>
                            </a>
                        @else
                            {{-- Video Player --}}
                            <div class="aspect-video bg-gray-900">
                                <video 
                                    controls 
                                    class="w-full h-full"
                                    preload="metadata"
                                >
                                    <source src="{{ $media->url }}" type="{{ $media->mime_type }}">
                                    {{$galleryPerusahaan[1]['filter']['doesntSupport']}},
                                </video>
                            </div>
                        @endif

                        {{-- Optional: Media Info --}}
                        @if($media->name || $media->alt)
                            <div class="p-3 bg-gray-50">
                                <p class="text-sm text-gray-600 truncate">
                                    {{ $media->alt ?? $media->name }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Load More Button --}}
            @if($hasMore)
                <div class="text-center w-full flex flex-row justify-center">
                    <button 
                        wire:click="loadMore"
                        class="btn1 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
                    >
                        <span wire:loading.remove wire:target="loadMore">{{$galleryPerusahaan[1]['filter']['loadMore']}}</span>
                        <span wire:loading wire:target="loadMore">{{$galleryPerusahaan[1]['filter']['loading']}}</span>
                        <span>
                            <x-icon.arrow-down-white/>        
                        </span>
                    </button>

                </div>
            @endif
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">{{$galleryPerusahaan[1]['filter']['noData']}}</h3>
                <p class="mt-1 text-sm text-gray-500">{{$galleryPerusahaan[1]['filter']['resetFilters']}}</p>
            </div>
        @endif
    </div>

    {{-- Loading indicator --}}
    <div wire:loading wire:target="activeTab,selectedMonth,selectedYear" class="fixed top-4 right-4 bg-indigo-600 text-white px-4 py-2 rounded-md shadow-lg">
        Loading...
    </div>
   
</div>