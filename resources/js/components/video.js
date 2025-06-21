// Video management utilities
export class VideoManager {
    constructor() {
        this.init();
    }

    init() {
        this.convertYouTubeUrls();
        this.setupInlineVideo();
    }

    // Convert YouTube watch URLs to embed URLs
    convertYouTubeUrls() {
        const iframes = document.querySelectorAll('iframe');

        iframes.forEach(iframe => {
            const originalUrl = iframe.src;
            const match = originalUrl.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/);

            if (match && match[1]) {
                const videoId = match[1];
                const embedUrl = `https://www.youtube.com/embed/${videoId}`;
                iframe.src = embedUrl;
            }
        });
    }

    // Setup inline video functionality
    setupInlineVideo() {
        const thumbnail = document.querySelector('#video-home > div');
        
        if (!thumbnail) return;

        thumbnail.addEventListener('click', function () {
            const container = this.parentNode;
            const iframe = container.querySelector('iframe');
            
            if (iframe) {
                iframe.src = iframe.getAttribute('data-src');
                iframe.classList.remove('hidden');
                this.remove();
            }
        });
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    new VideoManager();
});