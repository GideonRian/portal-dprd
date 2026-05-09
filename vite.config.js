import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/Non-Users/app.css', 'resources/js/Non-Users/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
