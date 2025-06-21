// AOS (Animate On Scroll) initialization
export function initAOS() {
    // Check if AOS is available
    if (typeof AOS === 'undefined') {
        console.warn('AOS library is not loaded. Animations will not work.');
        return;
    }

    AOS.init({
        duration: 1000, // set default duration here
        once: true,     // optional: animation runs only once
    });
}

// Auto-initialize when DOM is ready
document.addEventListener("DOMContentLoaded", initAOS);