import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

// Default configuration shared across some swipers
const defaultConfig = {
  modules: [Navigation, Pagination, Autoplay],
  loop: true,
  spaceBetween: 20,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay: {
    delay: 3000,
    disableOnInteraction: true,
  },
};

// Swiper configurations with their specific settings
const swiperConfigs = [
  {
    selector: '.swiper-1',
    config: {
      ...defaultConfig,
      navigation: {
        nextEl: '.fasilitas-home .swiper-button-next',
        prevEl: '.fasilitas-home .swiper-button-prev',
      },
      breakpoints: {
        1024: { slidesPerView: 3 },
        768: { slidesPerView: 2 },
        0: { slidesPerView: 1 },
      },
    },
  },
  {
    selector: '.swiper-3',
    config: {
      ...defaultConfig,
      spaceBetween: 30,
      centeredSlides: true,
      autoHeight: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      breakpoints: {
        1024: { slidesPerView: 1 },
        768: { slidesPerView: 1 },
        0: { slidesPerView: 1 },
      },
    },
  },
  {
    selector: '.swiper-hero',
    config: {
      ...defaultConfig,
      spaceBetween: 0,
      speed: 600,
      allowTouchMove: true,
      autoplay: false,
      breakpoints: {
        1024: { slidesPerView: 1 },
        768: { slidesPerView: 1 },
        0: { slidesPerView: 1 },
      },
    },
  },
  {
    selector: '.swiper-logo',
    config: {
      slidesPerView: 7,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-logo .swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        0: { slidesPerView: 2, spaceBetween: 10 },
        768: { slidesPerView: 3, spaceBetween: 20 },
        1024: { slidesPerView: 7, spaceBetween: 20 },
      },
    },
  },
];

// Initialize all swipers where the selector is found
function initializeSwipers() {
  const swipers = swiperConfigs
    .map(({ selector, config }) => {
      const element = document.querySelector(selector);
      if (element) {
        console.log(`Initializing swiper: ${selector}`);
        return new Swiper(selector, config);
      } else {
        console.log(`Element not found: ${selector}`);
      }
      return null;
    })
    .filter((swiper) => swiper !== null);
  
  console.log(`Initialized ${swipers.length} swipers`);
  return swipers;
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeSwipers);
} else {
  initializeSwipers();
}

// Export for external use
export { initializeSwipers };