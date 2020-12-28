const defaultTheme = require('tailwindcss/defaultTheme');
// const colors = require('tailwindcss/colors');

module.exports = {
    darkMode: 'class',

    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Source Sans Pro', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                light: { raw: "(prefers-color-scheme: light)" },
                dark: { raw: "(prefers-color-scheme: dark)" }
            },
            colors: {
                "dark-link": '#8ab4f8',
                "dark-link-light": '#8DB9FF',
                gray: {
                    '50' : '#F9F9F9',
                    '100': '#F4F4F4',
                    '150': '#EEF4F8',
                    '200': '#E0E0E0',
                    '300': '#C8C8C8',
                    '350': '#B2B22B',
                    '400': '#888888',
                    '450': '#797979',
                    '500': '#707070',
                    '550': '#606060',
                    '600': '#505050',
                    '650': '#454545',
                    '700': '#333333',
                    '750': '#292a2d',
                    '800': '#282828',
                    '850': '#202124',
                    '900': '#1d1d1f',
                    '950': '#101010',
                },

            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [
        require('@tailwindcss/ui'),
        function({ addBase, config }) {
            addBase({
                body: {
                    color: config("theme.colors.black"),
                    backgroundColor: config("theme.colors.white")
                },
                "@screen dark": {
                    body: {
                        color: config("theme.colors.white"),
                        backgroundColor: config("theme.colors.black")
                    }
                }
            });
        }
    ]
};