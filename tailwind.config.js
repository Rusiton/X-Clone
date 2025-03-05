import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                sm: '0.8rem',
                base: '1rem',
                xl: '1.25rem',
                '2xl': '1.563rem',
                '3xl': '1.953rem',
                '4xl': '2.441rem',
                '5xl': '3.052rem',
            },
            colors: {
                'color-1': 'var(--color-1)',
                'color-2': 'var(--color-2)',
                'color-3': 'var(--color-3)',
                'color-4': 'var(--color-4)',
                'color-5': 'var(--color-5)',
            },
        },
    },

    plugins: [forms, typography],
};
