// Tippy.js tooltip initialization
export function initTooltips() {
    // Check if tippy is available
    if (typeof tippy === 'undefined') {
        console.warn('Tippy.js is not loaded. Tooltips will not work.');
        return;
    }

    const tooltipElements = document.querySelectorAll('[data-tippy-content]');
    
    if (tooltipElements.length === 0) return;

    tippy('[data-tippy-content]', {
        allowHTML: true,
        theme: 'custom-red',
        interactive: true,
        placement: 'top',
    });
}

// Auto-initialize when DOM is ready
document.addEventListener("DOMContentLoaded", initTooltips);