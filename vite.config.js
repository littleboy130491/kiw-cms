import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

import { glob } from 'glob';

const jsFiles = glob.sync('resources/js/*.js');
const cssFiles = glob.sync('resources/css/*.css');

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...cssFiles,
                ...jsFiles,
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
