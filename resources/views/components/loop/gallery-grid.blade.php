 @if ($gallery)
     @php
         $images = \Awcodes\Curator\Models\Media::whereIn('id', $gallery)->get()->keyBy('id');
         $orderedImages = collect($gallery)->map(fn($id) => $images[$id])->filter();
     @endphp

     <!--Start Gallery-->
     <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 lg:gap-4">
         @foreach ($orderedImages as $media)
             <a href="{{ $media->url }}" data-lightbox="gallery">
                 <x-curator-glider :media="$media" class="rounded-md" />
             </a>
         @endforeach
     </div>
     <!--End Gallery -->

 @endif
