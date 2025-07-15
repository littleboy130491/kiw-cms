import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/popup-modal-main.js',
                'resources/js/pages/home.js',
                'resources/js/pages/profil-perusahaan.js',
                'resources/js/pages/single-building.js',
                'resources/js/pages/karier.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor': ['axios']
                }
            }
        }
    }
});
