@php
    // Maksimum kolom desktop
    $maxColumns = 6;
    $cols = min(max($columns, 1), $maxColumns);

    // Atur jumlah kolom mobile berdasarkan tipe konten
    $mobileCols = match ($type) {
        'video' => 1,
        default => 2, // image, carousel, dll.
    };

    // Komposisi kelas grid tailwind
    $gridClass = 'grid-cols-' . $mobileCols . ' md:grid-cols-' . $cols;

    // Format timestamp
    $formatTimestamp = function ($timestamp) {
        return \Carbon\Carbon::parse($timestamp)->diffForHumans();
    };
@endphp
<div class="instagram-feed">
    <div class="grid {{ $gridClass }} gap-2 lg:gap-4">
        @forelse($feeds as $feed)
            <div class="relative group">
                <a href="{{ $feed['permalink'] }}" target="_blank" rel="noopener noreferrer" class="block">
                    @if (in_array($feed['media_type'], ['IMAGE', 'CAROUSEL_ALBUM']))
                        @if($feed['media_type'] === 'CAROUSEL_ALBUM')
                            <div class="relative aspect-square bg-gray-100 rounded-md overflow-hidden">
                                <img src="{{ $feed['media_url'] }}" alt="{{ $feed['caption'] ?? 'Instagram Carousel' }}"
                                    class="w-full h-full" style="object-fit: cover;" loading="lazy" />
                                <div class="absolute top-2 right-2 bg-black bg-opacity-50 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM2 7a2 2 0 012-2h12a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V7z"/>
                                    </svg>
                                </div>
                            </div>
                        @else
                            <div class="relative aspect-square bg-gray-100 rounded-md overflow-hidden">
                                <img src="{{ $feed['media_url'] }}" alt="{{ $feed['caption'] ?? 'Instagram Image' }}"
                                    class="w-full h-full" style="object-fit: cover;" loading="lazy" />
                            </div>
                        @endif
                    @elseif($feed['media_type'] === 'VIDEO')
                        <div class="relative aspect-square bg-gray-100 rounded-md overflow-hidden">
                            <img src="{{ $feed['thumbnail_url'] ?? $feed['media_url'] }}"
                                alt="{{ $feed['caption'] ?? 'Instagram Video' }}"
                                class="w-full h-full" style="object-fit: cover;" loading="lazy" />
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white opacity-75" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M6.3 2.841A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z">
                                    </path>
                                </svg>
                            </div>
                            @if(isset($feed['isReel']) && $feed['isReel'])
                                <div class="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                    Reel
                                </div>
                            @endif
                        </div>
                    @endif
                </a>

                @if ($showCaption || $showLikes || $showTimestamp)
                    <!-- Overlay for metadata -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end rounded-md">
                        <div class="p-3 text-white">
                            @if ($showCaption && !empty($feed['caption']))
                                <p class="text-sm mb-2 line-clamp-2">
                                    {{ $feed['caption'] }}
                                </p>
                            @endif

                            <div class="flex items-center justify-between text-xs">
                                @if ($showLikes && isset($feed['like_count']))
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a1 1 0 00-.8.4z">
                                            </path>
                                        </svg>
                                        {{ number_format($feed['like_count']) }}
                                    </span>
                                @endif

                                @if ($showTimestamp && !empty($feed['timestamp']))
                                    <span class="text-xs opacity-75">
                                        {{ $formatTimestamp($feed['timestamp']) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 py-8">No Instagram posts found.</p>
        @endforelse
    </div>
</div>