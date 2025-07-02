import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/inicio-sesion.css', 'resources/css/mis-citas.css', 'resources/css/mi-historial.css', 'resources/css/mi-salud.css', 'resources/css/mi-agenda.css', 'resources/css/abm.css'],
            refresh: true,
        }),
    ],
});
