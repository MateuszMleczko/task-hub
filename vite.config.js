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
