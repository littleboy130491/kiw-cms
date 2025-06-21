// Home page specific functionality
export function initHomePage() {
    // Only run on home page
    if (!document.body.classList.contains('home-page') && !document.getElementById('popup-home')) {
        return;
    }

    initHomePopup();
}

function initHomePopup() {
    const popup = document.getElementById("popup-home");
    
    if (!popup) return;

    // Show popup when page loads
    popup.classList.remove("hidden");

    // Global function to close popup
    window.closePopup = () => {
        popup.classList.add("hidden");
    };

    // Add event listener to overlay (not its content)
    popup.addEventListener("click", (event) => {
        if (event.target === popup) {
            window.closePopup();
        }
    });
}

// Auto-initialize when DOM is ready
document.addEventListener("DOMContentLoaded", initHomePage);