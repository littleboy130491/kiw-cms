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

// Run on initial load and when the window is resized.
window.addEventListener('load', equalizeSwiperSlideHeights);
window.addEventListener('resize', debouncedEqualize);
