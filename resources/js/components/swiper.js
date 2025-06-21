// Swiper carousel management
export class SwiperManager {
    constructor() {
        this.init();
    }

    init() {
        this.initializeSwipers();
        this.setupAutoHeight();
    }

    initializeSwipers() {
        // Main swiper configuration
        if (document.querySelector('.swiper-1')) {
            new Swiper('.swiper-1', {
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
                breakpoints: {
                    1024: {
                        slidesPerView: 3,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        // Secondary swiper
        if (document.querySelector('.swiper-3')) {
            new Swiper('.swiper-3', {
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
                breakpoints: {
                    1024: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        // Hero swiper
        if (document.querySelector('.swiper-hero')) {
            new Swiper('.swiper-hero', {
                loop: true,
                spaceBetween: 0,
                speed: 600,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                allowTouchMove: true,
                breakpoints: {
                    1024: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
                // autoplay: {
                //   delay: 5000,
                //   disableOnInteraction: true,
                // },
            });
        }
    }

    // Equalize swiper slide heights
    setupAutoHeight() {
        const equalizeSwiperSlideHeights = () => {
            const slides = document.querySelectorAll('.same-height');
            let maxHeight = 0;

            // Reset height for recalculation on resize
            slides.forEach(slide => {
                slide.style.height = 'auto';
            });

            // Get maximum height
            slides.forEach(slide => {
                const height = slide.offsetHeight;
                if (height > maxHeight) {
                    maxHeight = height;
                }
            });

            // Apply maximum height to all slides
            slides.forEach(slide => {
                slide.style.height = maxHeight + 'px';
            });
        };

        // Run after page loads
        window.addEventListener('load', equalizeSwiperSlideHeights);

        // Re-run when window is resized
        window.addEventListener('resize', equalizeSwiperSlideHeights);
    }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new SwiperManager();
});