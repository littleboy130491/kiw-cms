// Inline Video Thumbnail Click Handler
const thumbnails = document.querySelectorAll('#video-home > div, .video-thumbnail, [data-video-thumbnail]');

if (thumbnails.length > 0) {
  console.log(`VideoInline: Initialized ${thumbnails.length} video thumbnails`);
  
  thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', function () {
      const container = this.parentNode;
      const iframe = container.querySelector('iframe, [data-video-iframe]');
      
      if (iframe) {
        const dataSrc = iframe.getAttribute('data-src');
        if (dataSrc) {
          iframe.src = dataSrc;
          iframe.classList.remove('hidden');
          this.remove();
        }
      }
    });
  });
} else {
  console.log('VideoInline: No video thumbnail elements found');
}