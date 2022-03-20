module.exports = {
    darkMode: 'class',

    content: [
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
                sans: ['Source Sans Pro'],
            },
            colors: {
                gray: {
                    '50' : '#F9F9F9',
                    '100': '#F4F4F4',
                    '150': '#e7e7e7',
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
            },
        },
    },

    plugins: [
        require('tailwind-scrollbar'),
    ],

    variants: {
        backgroundColor: ['dark', 'responsive', 'hover', 'focus', 'group-hover'],
        borderColor: ['dark', 'responsive', 'hover', 'focus', 'group-hover'],
        display: ['dark'],
        opacity: ['responsive', 'hover', 'focus', 'disabled', 'group-hover'],
        scale: ['group-hover', 'group-focus'],
        scrollbar: ['dark', 'rounded'],
        textColor: ['dark', 'responsive', 'hover', 'focus', 'group-hover'],
        extend: {
          backgroundColor: ['even'],
        }
    }
  }