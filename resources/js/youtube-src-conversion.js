// Function to convert YouTube URLs
function convertYoutubeUrls() {
    const iframes = document.querySelectorAll('iframe[src*="youtube"], [data-youtube]');

    if (iframes.length > 0) {
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
}

// Check if DOM is already loaded
if (document.readyState === 'loading') {
    // DOM is still loading, add event listener
    document.addEventListener("DOMContentLoaded", convertYoutubeUrls);
} else {
    // DOM is already loaded, execute immediately
    convertYoutubeUrls();
}

// Export the function in case it needs to be called manually
export { convertYoutubeUrls };

