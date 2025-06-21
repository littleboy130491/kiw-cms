// Social interaction features
export class SocialManager {
    constructor() {
        this.liked = false;
        this.likeCount = 1870;
        this.init();
    }

    init() {
        this.setupLikeButton();
        this.setupWhatsAppIntegration();
    }

    setupLikeButton() {
        // Make toggleLike function globally available
        window.toggleLike = () => {
            this.liked = !this.liked;
            const imgLike = document.getElementById("img-like");
            const imgLiked = document.getElementById("img-liked");
            const text = document.getElementById("like-text");

            if (!imgLike || !imgLiked || !text) return;

            if (this.liked) {
                imgLike.classList.add("hidden");
                imgLiked.classList.remove("hidden");
                this.likeCount++;
            } else {
                imgLiked.classList.add("hidden");
                imgLike.classList.remove("hidden");
                this.likeCount--;
            }

            text.textContent = `${this.likeCount} Likes`;
        };
    }

    setupWhatsAppIntegration() {
        // WhatsApp message functionality
        const whatsappButtons = document.querySelectorAll('[data-whatsapp]');
        
        whatsappButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const message = button.getAttribute('data-whatsapp') || 'Hello from website';
                const encodedMessage = encodeURIComponent(message);
                const whatsappUrl = `https://wa.me/?text=${encodedMessage}`;
                window.open(whatsappUrl, '_blank');
            });
        });
    }
}

// Auto-initialize when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
    new SocialManager();
});