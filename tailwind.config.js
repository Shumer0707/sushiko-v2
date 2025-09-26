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
                first_color: '#34302f',
                second_color: '#b5836b',
                third_color: '#fe2b2b',
                black: '#110d0e',
                sushi: {
                    // dark: '#2D2D2D',
                    dark: '#110d0e',

                    gold: '#D4AF37', // золотистый акцент
                    white: '#FFFFFF',
                },
            },
        },
    },

    plugins: [forms],
}
