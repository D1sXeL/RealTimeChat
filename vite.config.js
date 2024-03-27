import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    // Плагин Vue перепишет URL-адреса ресурсов, когда они 
                    // будут использоваться в однофайловых компонентах, 
                    // чтобы указывать на веб-сервер Laravel. Установка этого 
                    // значения в `null` позволяет вместо этого плагину Laravel 
                    // переписывать URL-адреса ресурсов, чтобы они указывали на сервер Vite.
                    base: null,

                    // Плагин Vue будет анализировать абсолютные URL-адреса и рассматривать 
                    // их как абсолютные пути к файлам на диске. Установка этого значения в 
                    // `false` оставит абсолютные URL-адреса нетронутыми, чтобы они могли 
                    // ссылаться на ресурсы в папке public, как ожидается.
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
});
