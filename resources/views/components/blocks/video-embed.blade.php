@props(['data'])

@php
    $title = $data['title'] ?? '';
    $video_url = $data['video_url'] ?? '';
    $thumbnail_image = $data['thumbnail_image'] ?? '';
    $description = $data['description'] ?? '';
@endphp

@if(!empty($video_url))
<!--Start Video Home-->
<section id="video-home" class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden lg:max-w-[1200px] lg:mx-auto lg:my-30 my-18 lg:px-0 sm:px-6 px-4">
    <!-- Custom Thumbnail -->
    <div class="absolute inset-0 bg-cover bg-center cursor-pointer rounded-2xl lg:mx-0 sm:mx-6 mx-4"
        @if(!empty($thumbnail_image))
            style="background-image: url('{{ $thumbnail_image }}');"
        @else
            style="background-image: url('{{ Storage::url('media/back-video.jpg') }}');"
        @endif
        onclick="loadVideo(this)">
        <!-- Custom Play Button -->
        <div class="flex items-center justify-center w-full h-full bg-black/10 rounded-2xl">
            <svg class="max-w-30 hover:max-w-40 transition duration-1000" xmlns="http://www.w3.org/2000/svg"
                version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 124.9 124.9">
                <defs>
                    <style>
                        .cls-1,
                        .cls-2 {
                            fill: #fff;
                        }

                        .cls-3 {
                            fill: none;
                        }

                        .cls-2 {
                            opacity: .2;
                        }
                    </style>
                    <clipPath id="clippath">
                        <circle class="cls-3" cx="62.4" cy="62.4" r="62.4" />
                    </clipPath>
                    <clipPath id="clippath-3">
                        <circle class="cls-3" cx="62.4" cy="62.4" r="48.8" />
                    </clipPath>
                    <clipPath id="clippath-6">
                        <circle class="cls-3" cx="62.4" cy="62.4" r="35.6" />
                    </clipPath>
                </defs>
                <!-- Generator: Adobe Illustrator 28.6.0, SVG Export Plug-In . SVG Version: 1.2.0 Build 709)  -->
                <g>
                    <g id="Layer_1">
                        <g>
                            <circle class="cls-2" cx="62.4" cy="62.4" r="62.4" />
                            <circle class="cls-2" cx="62.4" cy="62.4" r="48.8" />
                            <circle class="cls-2" cx="62.4" cy="62.4" r="35.6" />
                            <path class="cls-1"
                                d="M81.2,61.6l-27.8-16.8c-.7-.4-1.5,0-1.5.9v33.6c0,.8.9,1.3,1.5.9l27.8-16.8c.6-.4.6-1.3,0-1.7Z" />
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </div>

    <!-- Hidden iframe initially -->
    <iframe class="w-full h-full hidden rounded-2xl"
        data-src="{{ $video_url }}" 
        title="{{ $title ?: 'YouTube video player' }}"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen></iframe>
</section>
<!--End Video Home-->
@endif