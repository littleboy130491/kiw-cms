function equalizeSwiperSlideHeights() {
  const slides = document.querySelectorAll('.same-height');
  if (slides.length === 0) {
    return;
  }

  // Reset heights to 'auto' to allow the browser to calculate the natural height.
  slides.forEach(slide => {
    slide.style.height = 'auto';
  });

  // Use requestAnimationFrame to ensure we read the height after the browser has
  // painted the changes, preventing layout thrashing.
  requestAnimationFrame(() => {
    // Find the maximum height in a single pass
    const maxHeight = Array.from(slides).reduce((max, slide) => {
      return Math.max(max, slide.offsetHeight);
    }, 0);

    // Apply the max height to all slides
    if (maxHeight > 0) {
      slides.forEach(slide => {
        slide.style.height = `${maxHeight}px`;
      });
    }
  });
}

// A simple debounce function to limit how often the resize handler is called.
function debounce(func, wait = 100) {
  let timeout;
  return function(...args) {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      func.apply(this, args);
    }, wait);
  };
}

const debouncedEqualize = debounce(equalizeSwiperSlideHeights, 150);

// Run immediately since lazy loader ensures DOM is ready
equalizeSwiperSlideHeights();

// Run after a short delay to ensure swipers are initialized
setTimeout(equalizeSwiperSlideHeights, 100);

// Run when window is resized
window.addEventListener('resize', debouncedEqualize);

// Also run on window load as fallback
window.addEventListener('load', equalizeSwiperSlideHeights);

// Listen for swiper slide changes to re-equalize heights
document.addEventListener('swiperSlideChange', debouncedEqualize);

// Re-run when new content is added dynamically
const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    if (mutation.addedNodes.length > 0) {
      mutation.addedNodes.forEach((node) => {
        if (node.nodeType === Node.ELEMENT_NODE && 
            (node.classList?.contains('same-height') || node.querySelector?.('.same-height'))) {
          setTimeout(equalizeSwiperSlideHeights, 50);
        }
      });
    }
  });
});

// Observe the document for dynamic content changes
observer.observe(document.body, {
  childList: true,
  subtree: true
});

console.log('✓ Swiper auto-height initialized');
