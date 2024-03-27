import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // 'resources/js/kanban.js',
                // 'resources/js/task-board.js',
                // 'resources/js/task-utility.js',
                // 'resources/js/task-modal.js',
            ],
            refresh: true,
        }),
    ],
});
