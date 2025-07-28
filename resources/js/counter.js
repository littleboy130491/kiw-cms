// Counter Module - Handles all counter-related functionality
class CounterModule {
  constructor() {
    this.init();
  }

  init() {
    // Find all possible counter elements using multiple selectors
    const selectors = [
      '.counter',
      '[data-counter]',
      '[data-target]',
      '.animate-counter'
    ];
    
    const allCounters = [];
    selectors.forEach(selector => {
      const elements = document.querySelectorAll(selector);
      elements.forEach(el => {
        if (!allCounters.includes(el)) {
          allCounters.push(el);
        }
      });
    });

    if (allCounters.length === 0) {
      return;
    }

    this.setupCounters(allCounters);
  }

  setupCounters(counters) {
    const options = { threshold: 0.5 };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const target = this.getTargetValue(el);
          
          if (target !== null) {
            this.animateCounter(el, target);
            observer.unobserve(el);
          }
        }
      });
    }, options);

    counters.forEach(counter => {
      observer.observe(counter);
    });
  }

  // Extract target value from various possible attributes/content
  getTargetValue(element) {
    // Try data-target attribute first
    if (element.hasAttribute('data-target')) {
      return parseInt(element.getAttribute('data-target'));
    }
    
    // Try to parse from current text content (remove formatting)
    const textContent = element.textContent.replace(/[^\d]/g, '');
    const numericValue = parseInt(textContent);
    
    return isNaN(numericValue) ? null : numericValue;
  }

  // Format numbers with Indonesian locale
  formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
  }

  animateCounter(el, target) {
    const duration = 2000;
    const startTime = performance.now();

    const update = (currentTime) => {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const value = Math.floor(progress * target);
      el.textContent = this.formatNumber(value);

      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        el.textContent = this.formatNumber(target);
      }
    };

    requestAnimationFrame(update);
  }
}

// Initialize the counter module
new CounterModule();
