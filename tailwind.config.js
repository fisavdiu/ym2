import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                brand:{
                    DEFAULT: '#4ABAD5',
                    50: '#E6F6F9',
                    100: '#CEECF4',
                    200: '#ADE0EC',
                    300: '#8CD3E4',
                    400: '#6BC7DD',
                    500: '#4ABAD5',
                    600: '#2B9FBB',
                    700: '#21798E',
                    800: '#165260',
                    900: '#0C2B33',
                    950: '#07181C'
                }
            }
        },
    },

    plugins: [forms],
};
