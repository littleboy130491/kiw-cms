// Modal management utilities
export class ModalManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupGlobalFunctions();
        this.setupVideoModal();
    }

    setupGlobalFunctions() {
        // Global modal functions for profile/content modals
        window.openModal = (element) => {
            const name = element.querySelector('.name')?.textContent || '';
            const position = element.querySelector('.position')?.textContent || '';
            const photo = element.querySelector('.photo')?.src || '';
            const description = element.querySelector('.description')?.innerHTML || '';

            // Fill modal data
            const modalTitle = document.querySelector('.modal-title');
            if (modalTitle) modalTitle.textContent = name;

            const modalPosition = document.querySelector('.modal-position');
            if (modalPosition) modalPosition.textContent = position;

            const modalImage = document.querySelector('.modal-image img');
            if (modalImage && photo) modalImage.src = photo;

            const modalDescription = document.querySelector('.modal-description');
            if (modalDescription) modalDescription.innerHTML = description;

            // Show modal
            document.getElementById('modal')?.classList.remove('hidden');

            // Prevent body scrolling
            document.body.style.overflow = 'hidden';
        };

        window.closeModal = () => {
            // Hide modal
            document.getElementById('modal')?.classList.add('hidden');

            // Re-enable body scrolling
            document.body.style.overflow = 'auto';
        };
    }

    setupVideoModal() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('youtubeIframe');
        const openBtn = document.getElementById('openVideoBtn');
        const closeBtn = document.getElementById('closeVideoBtn');

        if (!modal || !iframe) return;

        const openVideoModal = () => {
            const videoURL = "https://www.youtube.com/embed/lZTS74rU6J8?autoplay=1";
            iframe.src = videoURL;
            modal.classList.remove('hidden');
        };

        const closeVideoModal = () => {
            iframe.src = ''; // Stop video playback
            modal.classList.add('hidden');
        };

        const closeVideoModalOnOverlay = (event) => {
            // Close modal only if clicking on overlay, not modal content
            if (event.target === modal) {
                closeVideoModal();
            }
        };

        // Attach event listeners
        if (openBtn) openBtn.addEventListener('click', openVideoModal);
        if (closeBtn) closeBtn.addEventListener('click', closeVideoModal);
        modal.addEventListener('click', closeVideoModalOnOverlay);
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    new ModalManager();
});