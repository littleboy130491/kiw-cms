// Popup Modal Event Initialization
const modalOverlays = document.querySelectorAll('.modal-overlay, [data-modal-overlay]');
const popupItems = document.querySelectorAll('.item-for-popup, [data-popup-item]');

// Initialize modal overlay click handlers
if (modalOverlays.length > 0) {
    console.log(`PopupModalEvents: Initialized ${modalOverlays.length} modal overlays`);
    
    modalOverlays.forEach(overlay => {
        overlay.addEventListener('click', closeModal);
    });
} else {
    console.log('PopupModalEvents: No modal overlay elements found');
}

// Initialize popup item click handlers
if (popupItems.length > 0) {
    console.log(`PopupModalEvents: Initialized ${popupItems.length} popup items`);
    
    popupItems.forEach(card => {
        card.addEventListener('click', function() {
            if (typeof openModal === 'function') {
                openModal(this);
            }
        });
    });
} else {
    console.log('PopupModalEvents: No popup item elements found');
}

// Global ESC key handler for modal closing
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (typeof closeModal === 'function') {
            closeModal();
        }
    }
});