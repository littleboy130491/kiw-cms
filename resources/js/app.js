import './alpine.js';
import './aos-animate.js';
import './lightbox.js';
import './phone-separator.js';
import './bg-switcher.js';

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
        } catch (error) {
            // Failed to load page-home
        }
    }
    
    // Profile page modules
    if ([...bodyClasses].some(cls => cls.includes('profil')) || [...bodyClasses].some(cls => cls.includes('profile'))) {
        try {
            await import('./pages/profil-perusahaan.js');
        } catch (error) {
            // Failed to load page-profil
        }
    }
    
    // Career page modules
    if ([...bodyClasses].some(cls => cls.includes('karier')) || [...bodyClasses].some(cls => cls.includes('career'))) {
        try {
            await import('./pages/karier.js');
        } catch (error) {
            // Failed to load page-karier
        }
    }
    
    // Industrial page modules
    if ([...bodyClasses].some(cls => cls.includes('industri')) || [...bodyClasses].some(cls => cls.includes('industrial'))) {
        try {
            await import('./pages/lahan-industri.js');
        } catch (error) {
            // Failed to load page-lahan-industri
        }
    }
    
    // Management page modules
    if ([...bodyClasses].some(cls => cls.includes('manajemen')) || [...bodyClasses].some(cls => cls.includes('management'))) {
        try {
            await import('./pages/manajemen-perusahaan.js');
        } catch (error) {
            // Failed to load page-manajemen-perusahaan
        }
    }
    
    // Facilities page modules
    if ([...bodyClasses].some(cls => cls.includes('fasilitas')) || [...bodyClasses].some(cls => cls.includes('facilities')) || [...bodyClasses].some(cls => cls.includes('facility'))) {
        try {
            await import('./pages/fasilitas.js');
        } catch (error) {
            // Failed to load page-fasilitas
        }
    }
    
    // Single building page modules
    if (bodyClasses.contains('type-bpsp') || bodyClasses.contains('type-buildings')) {
        try {
            await import('./pages/single-building.js');
        } catch (error) {
            // Failed to load page-single-building
        }
    }
}

// Initialize page module loading
loadPageModules();