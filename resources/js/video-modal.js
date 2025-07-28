// Video Modal Management
const modals = document.querySelectorAll('#videoModal, .video-modal, [data-video-modal]');
const openButtons = document.querySelectorAll('#openVideoBtn, .open-video-btn, [data-open-video]');
const closeButtons = document.querySelectorAll('#closeVideoBtn, .close-video-btn, [data-close-video]');

if (modals.length > 0) {
  console.log(`VideoModal: Initialized ${modals.length} video modals`);
  
  modals.forEach(modal => {
    const iframe = modal.querySelector('#youtubeIframe, iframe, [data-video-iframe]');
    
    function openVideoModal() {
      const videoURL = "https://www.youtube.com/embed/lZTS74rU6J8?autoplay=1";
      if (iframe) {
        iframe.src = videoURL;
      }
      modal.classList.remove('hidden');
    }

    function closeVideoModal() {
      if (iframe) {
        iframe.src = ''; // Stop video playback
      }
      modal.classList.add('hidden');
    }

    function closeVideoModalOnOverlay(event) {
      // Tutup modal hanya jika klik di overlay, bukan di konten modal
      if (event.target === modal) {
        closeVideoModal();
      }
    }

    // Pasang event listener untuk modal overlay
    modal.addEventListener('click', closeVideoModalOnOverlay);
    
    // Setup open buttons for this modal
    openButtons.forEach(btn => {
      if (btn && btn.getAttribute('data-target') === modal.id || !btn.hasAttribute('data-target')) {
        btn.addEventListener('click', openVideoModal);
      }
    });
    
    // Setup close buttons for this modal
    const modalCloseButtons = modal.querySelectorAll('#closeVideoBtn, .close-video-btn, [data-close-video]');
    modalCloseButtons.forEach(btn => {
      btn.addEventListener('click', closeVideoModal);
    });
  });
} else {
  console.log('VideoModal: No video modal elements found');
}
