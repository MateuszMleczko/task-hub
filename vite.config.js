import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    build: {
        outDir: 'webroot',
        emptyOutDir: false,
        rollupOptions: {
            input: {
                app: 'webroot/scss/app.scss',
                bootstrap: 'webroot/js/app.js',
                mainStyle: 'resources/css/main.scss',
                tasksStyle: 'resources/css/tasks.scss',
                usersStyle: 'resources/css/users.scss',
            },
            output: {
                assetFileNames: 'css/[name][extname]',
                entryFileNames: 'js/[name].js',
            },
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: ['color-functions', 'import', 'global-builtin', 'if-function'],
            },
        },
    },
});
