const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    default: '#22B574',
                    50: '#BBEBD4',
                    100: '#ABE6CA',
                    200: '#8CDCB5',
                    300: '#6DD3A1',
                    400: '#4DCA8D',
                    500: '#37B779',
                    600: '#2A8C5C',
                    700: '#1D6140',
                    800: '#103623',
                    900: '#030A07'
                }
            },
            fontFamily: {
                'body': [
                    'Montserrat', 
                    'ui-sans-serif', 
                    'system-ui', 
                    '-apple-system', 
                    'system-ui', 
                    'Segoe UI', 
                    'Roboto', 
                    'Helvetica Neue', 
                    'Arial', 
                    'Noto Sans', 
                    'sans-serif', 
                    'Apple Color Emoji', 
                    'Segoe UI Emoji', 
                    'Segoe UI Symbol', 
                    'Noto Color Emoji'
                ],
                'sans': [
                    'Montserrat', 
                    'ui-sans-serif', 
                    'system-ui', 
                    '-apple-system', 
                    'system-ui', 
                    'Segoe UI', 
                    'Roboto', 
                    'Helvetica Neue', 
                    'Arial', 
                    'Noto Sans', 
                    'sans-serif', 
                    'Apple Color Emoji', 
                    'Segoe UI Emoji', 
                    'Segoe UI Symbol', 
                    'Noto Color Emoji'
                ]
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        // probs not needed
        require('flowbite/plugin'),
        require('flowbite-typography')
    ],
};
