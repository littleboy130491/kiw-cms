<div class="w-full max-w-7xl mx-auto px-4 py-8">
    {{-- Tabs --}}
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <button 
                wire:click="$set('activeTab', 'images')"
                class="
                    {{ $activeTab === 'images' 
                        ? 'border-indigo-500 text-indigo-600' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' 
                    }}
                    whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors
                "
            >
                Images
            </button>
            <button 
                wire:click="$set('activeTab', 'videos')"
                class="
                    {{ $activeTab === 'videos' 
                        ? 'border-indigo-500 text-indigo-600' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' 
                    }}
                    whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors
                "
            >
                Videos
            </button>
        </nav>
    </div>

    {{-- Filters --}}
    <div class="flex flex-wrap gap-4 mb-8">
        <div class="w-full sm:w-auto sm:flex-1 max-w-xs">
            <label for="month-filter" class="block text-sm font-medium text-gray-700 mb-1">
                Month
            </label>
            <select 
                id="month-filter"
                wire:model.live="selectedMonth"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
                <option value="">All Months</option>
                @foreach($availableMonths as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full sm:w-auto sm:flex-1 max-w-xs">
            <label for="year-filter" class="block text-sm font-medium text-gray-700 mb-1">
                Year
            </label>
            <select 
                id="year-filter"
                wire:model.live="selectedYear"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
                <option value="">All Years</option>
                @foreach($availableYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        @if($selectedMonth || $selectedYear)
            <div class="flex items-end">
                <button 
                    wire:click="resetFilters"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Clear Filters
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
                                    Your browser does not support the video tag.
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
                <div class="text-center">
                    <button 
                        wire:click="loadMore"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
                    >
                        <span wire:loading.remove wire:target="loadMore">Load More</span>
                        <span wire:loading wire:target="loadMore">Loading...</span>
                    </button>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No media found</h3>
                <p class="mt-1 text-sm text-gray-500">Try adjusting your filters.</p>
            </div>
        @endif
    </div>

    {{-- Loading indicator --}}
    <div wire:loading wire:target="activeTab,selectedMonth,selectedYear" class="fixed top-4 right-4 bg-indigo-600 text-white px-4 py-2 rounded-md shadow-lg">
        Loading...
    </div>
</div>