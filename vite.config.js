import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    css: {
        minify: true,
    },
    resolve: {
        alias: {

            'owl.carousel': 'owl.carousel/dist/owl.carousel.js',
        },
    },
});
