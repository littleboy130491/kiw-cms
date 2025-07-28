// Modal Controller Module - Handles all modal-related functionality
class ModalController {
  constructor() {
    this.modal = null;
    this.init();
  }

  init() {
    // Find modal container and triggers
    this.modal = document.getElementById('modal') || document.querySelector('.modal');
    const triggers = this.findModalTriggers();

    if (!this.modal && triggers.length === 0) {
      console.log('Modal: No modal or triggers found');
      return;
    }

    this.setupGlobalFunctions();
    console.log(`Modal: Initialized with ${triggers.length} triggers`);
  }

  findModalTriggers() {
    const selectors = [
      '[onclick*="openModal"]',
      '[data-modal]',
      '.modal-trigger',
      '.open-modal'
    ];

    const triggers = [];
    selectors.forEach(selector => {
      const elements = document.querySelectorAll(selector);
      elements.forEach(el => {
        if (!triggers.includes(el)) {
          triggers.push(el);
        }
      });
    });

    return triggers;
  }

  setupGlobalFunctions() {
    // Create global functions for backward compatibility
    window.openModal = (element) => this.openModal(element);
    window.closeModal = () => this.closeModal();
  }

  openModal(element) {
    if (!this.modal) return;

    // Extract data from clicked element
    const data = this.extractModalData(element);
    
    // Populate modal with data
    this.populateModal(data);
    
    // Show modal
    this.showModal();
  }

  extractModalData(element) {
    return {
      name: element.querySelector('.name')?.textContent || '',
      position: element.querySelector('.position')?.textContent || '',
      photo: element.querySelector('.photo')?.src || '',
      description: element.querySelector('.description')?.innerHTML || ''
    };
  }

  populateModal(data) {
    const modalTitle = this.modal.querySelector('.modal-title');
    if (modalTitle) modalTitle.textContent = data.name;

    const modalPosition = this.modal.querySelector('.modal-position');
    if (modalPosition) modalPosition.textContent = data.position;

    const modalImage = this.modal.querySelector('.modal-image img');
    if (modalImage && data.photo) modalImage.src = data.photo;

    const modalDescription = this.modal.querySelector('.modal-description');
    if (modalDescription) modalDescription.innerHTML = data.description;
  }

  showModal() {
    this.modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Add click outside to close functionality
    setTimeout(() => {
      this.modal.addEventListener('click', this.handleModalClick.bind(this));
    }, 10);
  }

  closeModal() {
    if (!this.modal) return;
    
    this.modal.classList.add('hidden');
    this.modal.removeEventListener('click', this.handleModalClick.bind(this));
    document.body.style.overflow = 'auto';
  }

  handleModalClick(event) {
    // Close if clicking on the modal overlay (not the content)
    if (event.target === this.modal || event.target.classList.contains('modal-overlay')) {
      this.closeModal();
    }
  }
}

// Initialize the modal controller
new ModalController();
