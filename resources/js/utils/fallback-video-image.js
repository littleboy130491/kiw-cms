// Video fallback utility - handles video loading errors
export function initVideoFallback() {
    const videos = document.querySelectorAll('video[data-fallback]');
    
    videos.forEach(video => {
        video.addEventListener('error', function() {
            const fallbackSrc = this.getAttribute('data-fallback');
            if (fallbackSrc) {
                const img = document.createElement('img');
                img.src = fallbackSrc;
                img.alt = this.getAttribute('alt') || 'Video fallback image';
                img.className = this.className;
                
                this.parentNode.replaceChild(img, this);
            }
        });
    });
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', initVideoFallback);