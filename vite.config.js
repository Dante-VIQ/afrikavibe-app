import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/content-tracking.js'
            ],
            refresh: true,
        }),
    ],

    build: {
        chunkSizeWarningLimit: 1500, // ✅ Moved here — correct location
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: [
                        'lodash'
                        // add more vendor libraries here if needed
                    ],
                },
            },
        },
    },

    resolve: {
        alias: {
            '~': path.resolve(__dirname, 'node_modules'),
        },
    },
});
