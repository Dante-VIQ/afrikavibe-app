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
                    vendor: ['vue', 'axios', 'lodash'], // Add your main dependencies
                }
            }
        }
    },

    resolve: {
        alias: {
            '~': path.resolve(__dirname, 'node_modules'),
            // Add common aliases for better imports
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },

    // Optional: Server configuration for development
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost',
        },
    },
});
