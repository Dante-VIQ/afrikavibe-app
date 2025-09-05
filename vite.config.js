import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/comment.js',
            ],
            refresh: true,
        }),
    ],

    build: {
        chunkSizeWarningLimit: 1500,
        // Optional: Add these for better build optimization
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['axios'], // Add your main dependencies
                }
            }
        }
    },

    resolve: {
        alias: {
            '~': path.resolve(__dirname, 'node_modules'),
        },
    },

});
