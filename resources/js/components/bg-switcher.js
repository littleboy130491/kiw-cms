// Background switcher functionality
export function initBackgroundSwitcher() {
    const switcher = document.getElementById("bg-switcher");
    const items = document.querySelectorAll("[data-bg]");

    if (!switcher || items.length === 0) return;

    function activateItem(item) {
        const newBg = item.getAttribute("data-bg");
        switcher.style.backgroundImage = `url('${newBg}')`;

        // Remove .active from all
        items.forEach(i => i.classList.remove("active"));

        // Add .active to current element
        item.classList.add("active");
    }

    // Hover effect
    items.forEach(item => {
        item.addEventListener("mouseenter", () => {
            activateItem(item);
        });
    });

    // Auto-trigger on first item when page opens
    window.addEventListener("DOMContentLoaded", () => {
        if (items.length > 0) {
            activateItem(items[0]);
        }
    });
}

// Auto-initialize
initBackgroundSwitcher();