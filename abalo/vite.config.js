import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/js/app.js',

                'resources/js/homepage.js',
                'resources/js/cookiecheck.js',
                'resources/js/newarticle.js',
                'resources/js/cart.js',
                'resources/js/test.js',
                'resources/js/old/homepage_old.js',
                'resources/js/old/newarticle_old.js',
                'resources/js/vue/newarticle.js',
                'resources/js/app_v2.js',

                'resources/css/homepage.css',
                'resources/css/newarticle.css',
                'resources/css/cart.css',

                'resources/scss/app.scss',
                'resources/scss/navbar.scss',
                'resources/scss/variables.scss',
                'resources/scss/articlelist.scss',
                'resources/scss/footer.scss'],
            refresh: true,
        }),
        tailwindcss(),
    ], resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js"
        },
    }, build: {
        minify: false,
    }
});
