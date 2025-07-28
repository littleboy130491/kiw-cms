// Background Switcher Management
const switchers = document.querySelectorAll('#bg-switcher, .bg-switcher, [data-bg-switcher]');
const items = document.querySelectorAll('[data-bg]');

if (switchers.length > 0 && items.length > 0) {
    console.log(`BgSwitcher: Initialized ${switchers.length} switchers with ${items.length} background items`);
    
    const primarySwitcher = switchers[0]; // Use first switcher as primary
    
    function activateItem(item) {
        const newBg = item.getAttribute("data-bg");
        
        // Apply to all switchers
        switchers.forEach(switcher => {
            switcher.style.backgroundImage = `url('${newBg}')`;
        });

        // Hapus .active dari semua items
        items.forEach(i => i.classList.remove("active"));

        // Tambahkan .active ke elemen saat ini
        item.classList.add("active");
    }

    // Hover effect untuk semua items
    items.forEach(item => {
        item.addEventListener("mouseenter", () => {
            activateItem(item);
        });
    });

    // Trigger otomatis pada item pertama saat script dijalankan
    if (items.length > 0) {
        activateItem(items[0]);
    }
} else {
    console.log('BgSwitcher: No background switcher elements found');
}


