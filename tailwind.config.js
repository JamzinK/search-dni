import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "./public/assets/custom/**/*.js",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                'puerto-rico': {
                    '50': '#f0fdfa',
                    '100': '#ccfbf0',
                    '200': '#9af5e2',
                    '300': '#5fe9d1',
                    '400': '#2cceb7',
                    '500': '#16b6a2',
                    '600': '#0e9385',
                    '700': '#10756b',
                    '800': '#125d57',
                    '900': '#144d49',
                    '950': '#042f2d',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('flowbite/plugin'),
    ],
};
