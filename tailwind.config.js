const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'bg-sea': '#325288',
                'bg-deepsea': '#114e60',
                'bg-autumn': '#f4eee8',
                'bg-sand': '#f5cebe',
            },
        },
        container: {
            center: true,
        },
    },

    variants: {
        extend: {
            ringWidth: ['focus'],
            backgroundColor:['active', 'hover'],
        },
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        underline: ['hover'],
    },

    plugins: [require('@tailwindcss/ui')],
};
