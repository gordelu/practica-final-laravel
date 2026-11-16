import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Color principal de Proyecta (verde azulado)
                brand: {
                    50: '#effefa',
                    100: '#c8fff1',
                    200: '#91fee4',
                    300: '#52f5d4',
                    400: '#1ee1bf',
                    500: '#05c5a6',
                    600: '#009f88',
                    700: '#057e6e',
                    800: '#0a6459',
                    900: '#0d534a',
                    950: '#00332e',
                },
                // Azul muy oscuro de la barra lateral
                ink: {
                    600: '#2b3a5c',
                    700: '#1e2a45',
                    800: '#151e33',
                    900: '#0e1526',
                    950: '#090e1a',
                },
            },
        },
    },

    plugins: [forms],
};
