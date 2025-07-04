import Swiper from 'swiper';
import 'swiper/css';

// Default configuration shared across some swipers
const defaultConfig = {
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
const swipers = swiperConfigs
  .map(({ selector, config }) => {
    const element = document.querySelector(selector);
    if (element) {
      return new Swiper(selector, config);
    }
    return null;
  })
  .filter((swiper) => swiper !== null);

// Export swipers if needed elsewhere
export { swipers };