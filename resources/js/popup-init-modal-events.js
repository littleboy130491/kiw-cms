// Popup Modal Event Initialization
const modalOverlays = document.querySelectorAll('.modal-overlay, [data-modal-overlay]');
const popupItems = document.querySelectorAll('.item-for-popup, [data-popup-item]');

// Initialize modal overlay click handlers
if (modalOverlays.length > 0) {
    modalOverlays.forEach(overlay => {
        overlay.addEventListener('click', closeModal);
    });
}

// Initialize popup item click handlers
if (popupItems.length > 0) {
    popupItems.forEach(card => {
        card.addEventListener('click', function() {
            if (typeof openModal === 'function') {
                openModal(this);
            }
        });
    });
}

// Global ESC key handler for modal closing
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (typeof closeModal === 'function') {
            closeModal();
        }
    }
});