import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/commentBroadcast.js', // Add commentBroadcast.js
                'resources/js/replyBroadcast.js'    // Add replyBroadcast.js
            ],
            refresh: true,
        }),
    ],
});
