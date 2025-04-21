import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: ['class'],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{vue,js,ts,jsx,tsx}',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#1976D2',
                secondary: '#0D47A1',
                dark: '#121212',
                light: '#f5f5f5',
            },
            fontFamily: {
                sans: ['Vazirmatn', 'sans-serif', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [require('tailwindcss-animate')],
};
