/**
 * Simplified Module Loader
 * Loads modules based on general feature detection, letting each module handle its own initialization
 */

class ModuleLoader {
    constructor() {
        this.loadedModules = new Set();
        this.init();
    }

    async init() {
        await this.waitForDOM();
        await this.loadCoreModules();
        await this.loadPageModules();
    }

    waitForDOM() {
        return new Promise(resolve => {
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', resolve);
            } else {
                resolve();
            }
        });
    }

    async loadModule(modulePath, moduleName) {
        if (this.loadedModules.has(moduleName)) return;
        
        try {
            await import(/* @vite-ignore */ modulePath);
            this.loadedModules.add(moduleName);
            console.log(`✓ Loaded: ${moduleName}`);
        } catch (error) {
            console.warn(`Failed to load ${moduleName}:`, error);
        }
    }

    // Always load core modules
    async loadCoreModules() {
        const coreModules = [
            { path: './alpine.js', name: 'alpine' },
            { path: './aos-animate.js', name: 'aos-animate' },
            { path: './lightbox.js', name: 'lightbox' },
            { path: './phone-separator.js', name: 'phone-separator' },
            { path: './bg-switcher.js', name: 'bg-switcher' },
        ];

        await Promise.all(coreModules.map(({ path, name }) => this.loadModule(path, name)));
    }

    // Load page-specific modules based on body classes
    async loadPageModules() {
        const bodyClasses = document.body.classList;
        const pageModules = [
            { 
                condition: () => [...bodyClasses].some(cls => cls.includes('home')) || [...bodyClasses].some(cls => cls.includes('beranda')), 
                path: './pages/home.js', 
                name: 'page-home' 
            },
            { 
                condition: () => [...bodyClasses].some(cls => cls.includes('profil')) || [...bodyClasses].some(cls => cls.includes('profile')), 
                path: './pages/profil-perusahaan.js', 
                name: 'page-profil' 
            },
            { 
                condition: () => [...bodyClasses].some(cls => cls.includes('karier')) || [...bodyClasses].some(cls => cls.includes('career')), 
                path: './pages/karier.js', 
                name: 'page-karier' 
            },
            { 
                condition: () => [...bodyClasses].some(cls => cls.includes('industri')) || [...bodyClasses].some(cls => cls.includes('industrial')), 
                path: './pages/lahan-industri.js', 
                name: 'page-lahan-industri' 
            },
            { 
                condition: () => [...bodyClasses].some(cls => cls.includes('manajemen')) || [...bodyClasses].some(cls => cls.includes('management')), 
                path: './pages/manajemen-perusahaan.js', 
                name: 'page-manajemen-perusahaan' 
            },
            { 
                condition: () => [...bodyClasses].some(cls => cls.includes('fasilitas')) || [...bodyClasses].some(cls => cls.includes('facilities')) || [...bodyClasses].some(cls => cls.includes('facility')), 
                path: './pages/fasilitas.js', 
                name: 'page-fasilitas' 
            },
            { 
                condition: () => bodyClasses.contains('type-bpsp') || bodyClasses.contains('type-buildings'), 
                path: './pages/single-building.js', 
                name: 'page-single-building' 
            }
        ];

        const modulesToLoad = pageModules.filter(({ condition }) => condition());
        await Promise.all(modulesToLoad.map(({ path, name }) => this.loadModule(path, name)));
    }
}

// Initialize the module loading system
new ModuleLoader();