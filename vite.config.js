import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        hmr: 'localhost'
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    includeAbsolute: false,
                },
                compilerOptions: {
                    isCustomElement: (tag) => ['multiselect'].includes(tag),
                }
            },
        }),
    ],
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources',
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
    },
});
