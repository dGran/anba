const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require("tailwindcss/plugin");
const selectorParser = require("postcss-selector-parser");

module.exports = {
    darkMode: 'class',

    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        screens: {
            xs : '320px',
            sm : '640px',
            md : '768px',
            lg : '1024px',
            xl : '1280px'
        },
        extend: {
            fontFamily: {
                sans: ['Source Sans Pro', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                light: { raw: "(prefers-color-scheme: light)" },
                dark: { raw: "(prefers-color-scheme: dark)" }
            },
            colors: {
                gray: {
                    '50' : '#F9F9F9',
                    '100': '#F4F4F4',
                    '150': '#E9E6EB',
                    '200': '#E0E0E0',
                    '300': '#C8C8C8',
                    '350': '#BAB8BB',
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
                    '925': '#171617',
                    '950': '#121112',
                },
                "header-bg": '#2e3a46',
                "header-bg-light": '#334150',
                "header-bg-lighter": '#3A4C5E',
                "header-bg-dark": '#27313C',
                // "sub-header-bg": '#202831',
                "dark-link": '#8ab4f8',
                "pretty-red": '#f4645f',
            }
        },
    },

    variants: {
        textColor: ['dark', 'responsive', 'hover', 'focus', 'group-hover'],
        backgroundColor: ['dark', 'responsive', 'hover', 'focus', 'group-hover'],
        borderColor: ['dark', 'responsive', 'hover', 'focus', 'group-hover'],
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
        },
        plugin(function ({ addVariant, prefix }) {
            addVariant('dark', ({ modifySelectors, separator}) => {
                modifySelectors(({ selector }) => {
                    return selectorParser((selectors) => {
                        selectors.walkClasses((sel) => {
                            sel.value = `dark${separator}${sel.value}`
                            sel.parent.insertBefore(sel, selectorParser().astSync(prefix('.scheme-dark ')))
                        })
                    }).processSync(selector)
                })
            })
        })
    ]
};