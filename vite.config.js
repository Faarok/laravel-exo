import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0', // Permet à Vite d'être accessible de l'extérieur du conteneur Docker
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost', // Ou l'IP de votre machine hôte si nécessaire
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js'
            ],
            refresh: true
        }),
    ]
});
