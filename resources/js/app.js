// Static imports for Vite build compatibility
import './alpine.js';
import './accessibility.js';
import './aos-animate.js';
import './lightbox.js';
import './phone-separator.js';
import './bg-switcher.js';
import './accordion.js';
import './tippy.js';
import './popup-modal-controller.js';
import './popup-init-modal-events.js';
import './single-get-message-whatsapp.js';

// Wait for DOM to be ready
function waitForDOM() {
    return new Promise(resolve => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', resolve);
        } else {
            resolve();
        }
    });
}

// Page-specific module loading
async function loadPageModules() {
    await waitForDOM();
    
    const bodyClasses = document.body.classList;
    
    // Home page modules
    if ([...bodyClasses].some(cls => cls.includes('home')) || [...bodyClasses].some(cls => cls.includes('beranda'))) {
        try {
            await import('./pages/home.js');
            console.log('✓ Loaded: page-home');
        } catch (error) {
            console.warn('Failed to load page-home:', error);
        }
    }
    
    // Profile page modules
    if ([...bodyClasses].some(cls => cls.includes('profil')) || [...bodyClasses].some(cls => cls.includes('profile'))) {
        try {
            await import('./pages/profil-perusahaan.js');
            console.log('✓ Loaded: page-profil');
        } catch (error) {
            console.warn('Failed to load page-profil:', error);
        }
    }
    
    // Career page modules
    if ([...bodyClasses].some(cls => cls.includes('karier')) || [...bodyClasses].some(cls => cls.includes('career'))) {
        try {
            await import('./pages/karier.js');
            console.log('✓ Loaded: page-karier');
        } catch (error) {
            console.warn('Failed to load page-karier:', error);
        }
    }
    
    // Industrial page modules
    if ([...bodyClasses].some(cls => cls.includes('industri')) || [...bodyClasses].some(cls => cls.includes('industrial'))) {
        try {
            await import('./pages/lahan-industri.js');
            console.log('✓ Loaded: page-lahan-industri');
        } catch (error) {
            console.warn('Failed to load page-lahan-industri:', error);
        }
    }
    
    // Management page modules
    if ([...bodyClasses].some(cls => cls.includes('manajemen')) || [...bodyClasses].some(cls => cls.includes('management'))) {
        try {
            await import('./pages/manajemen-perusahaan.js');
            console.log('✓ Loaded: page-manajemen-perusahaan');
        } catch (error) {
            console.warn('Failed to load page-manajemen-perusahaan:', error);
        }
    }
    
    // Facilities page modules
    if ([...bodyClasses].some(cls => cls.includes('fasilitas')) || [...bodyClasses].some(cls => cls.includes('facilities')) || [...bodyClasses].some(cls => cls.includes('facility'))) {
        try {
            await import('./pages/fasilitas.js');
            console.log('✓ Loaded: page-fasilitas');
        } catch (error) {
            console.warn('Failed to load page-fasilitas:', error);
        }
    }
    
    // Single building page modules
    if (bodyClasses.contains('type-bpsp') || bodyClasses.contains('type-buildings')) {
        try {
            await import('./pages/single-building.js');
            console.log('✓ Loaded: page-single-building');
        } catch (error) {
            console.warn('Failed to load page-single-building:', error);
        }
    }
}

// Initialize page module loading
loadPageModules();