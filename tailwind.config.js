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
            colors: {
                sentry: {
                    deep: '#1f1633',
                    darker: '#150f23',
                    border: '#362d59',
                    purple: '#6a5fc1',
                    muted: '#79628c',
                    violet: '#422082',
                    light: '#d0bfff',
                    coral: '#ffb287',
                    pink: '#fa7faa',
                },
            },
            fontFamily: {
                sans: ['Rubik', ...defaultTheme.fontFamily.sans],
                mono: ['Monaco', ...defaultTheme.fontFamily.mono],
                display: ['Dammit Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};