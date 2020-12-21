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
