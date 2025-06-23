@props([
    'videoId' => 'dQw4w9WgXcQ', // Default YouTube video ID
    'thumbnailImage' => asset('storage/media/back-video.jpg'),
    'title' => 'Kawasan Industri Wijayakusuma',
    'description' => 'Tonton video profil lengkap tentang fasilitas dan layanan yang kami tawarkan'
])

<x-ui.section id="video-home" padding="lg">
    <div class="relative w-full aspect-video rounded-2xl overflow-hidden max-w-6xl mx-auto">
        {{-- Video Thumbnail --}}
        <div 
            class="absolute inset-0 bg-cover bg-center cursor-pointer group"
            style="background-image: url('{{ $thumbnailImage }}')"
            onclick="loadVideo(this)"
            data-video-id="{{ $videoId }}"
        >
            {{-- Dark Overlay --}}
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/20 transition-all duration-300"></div>
            
            {{-- Content Overlay --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-8">
                
                {{-- Play Button --}}
                <div class="mb-6 group-hover:scale-110 transition-transform duration-300">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30">
                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
                
                {{-- Title & Description --}}
                <h3 class="text-2xl lg:text-3xl font-bold mb-4">{{ $title }}</h3>
                <p class="text-lg opacity-90 max-w-md">{{ $description }}</p>
            </div>
        </div>
        
        {{-- Video Container (Initially Hidden) --}}
        <div class="video-container absolute inset-0 hidden">
            <!-- Video will be loaded here -->
        </div>
    </div>
</x-ui.section>

@push('scripts')
<script>
function loadVideo(element) {
    const videoId = element.getAttribute('data-video-id');
    const container = element.nextElementSibling;
    
    // Create iframe
    const iframe = document.createElement('iframe');
    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
    iframe.frameBorder = '0';
    iframe.allowFullscreen = true;
    iframe.allow = 'autoplay; encrypted-media';
    iframe.className = 'w-full h-full';
    
    // Replace thumbnail with video
    container.appendChild(iframe);
    container.classList.remove('hidden');
    element.style.display = 'none';
}
</script>
@endpush