import AOS from 'aos';
import 'aos/dist/aos.css';

// Fallback function to show AOS elements if AOS fails to load
function showAOSElements() {
  const aosElements = document.querySelectorAll('[data-aos]');
  aosElements.forEach(element => {
    element.style.opacity = '1';
    element.style.transform = 'none';
    element.style.transition = 'none';
  });
}

function initAOS() {
  try {
    AOS.init({
      duration: 1000,
      once: true,
      // Add offset to ensure elements are visible
      offset: 50,
      // Disable on mobile if needed
      disable: false
    });
    
    // Refresh AOS after a short delay to catch any dynamic content
    setTimeout(() => {
      AOS.refresh();
    }, 100);
    
    console.log('✓ AOS initialized successfully');
  } catch (error) {
    console.warn('AOS initialization failed, showing elements:', error);
    showAOSElements();
  }
}

// Initialize immediately since lazy loader ensures DOM is ready
initAOS();

// Refresh after window load as fallback
window.addEventListener('load', () => {
  setTimeout(() => {
    if (typeof AOS !== 'undefined') {
      AOS.refresh();
    } else {
      showAOSElements();
    }
  }, 500);
});