import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                admin: {
                    primary: '#F43F5E', // розовый (основной)
                    background: '#F8FAFC', // фон
                    text: '#334155', // основной текст
                    muted: '#1E293B', // тёмный серый
                },
            },
        },
    },

    plugins: [forms],
}
