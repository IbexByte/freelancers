import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server:{
        'host' : 'localhost',
        'port' : 3000 
    },
    plugins: [
        laravel({
            input: ['resources/scss/tailwind.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
