import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";


export default ({ mode }) => {
    process.env = Object.assign(process.env, loadEnv(mode, process.cwd(), ''));

    return defineConfig({
        plugins: [
            laravel({
                input: ['resources/js/app.js'],
                refresh: true,
            }),
            vue({
                template: {
                 transformAssetUrls: {
                   base: null,
                   includeAbsolute: false,
                   },
                 },
             }),
        ],
        server: {
            host: '0.0.0.0',
            hmr: {
                host: 'localhost'
            }
        },
    });
}
