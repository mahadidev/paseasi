import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                montserrat: [defaultTheme.montserrat],
                poppins: ['Poppins'],
                mono: ['DM Mono'],
            },
            container: {
				center: true,
				padding: '0.5rem',
				screens: {
					sm: '640px',
					md: '768px',
					lg: '1024px',
					xl: '1280px',
					'2xl': '1280px',
				},
			},
			colors: {
				primary: {
					primary: colors.green[600],
					...colors.green,
				},
				secondary: colors.gray,
			},
			screens: {
				sm: '640px',
				md: '768px',
				lg: '1024px',
				xl: '1280px',
				'2xl': '1540px',
			},
        },
    },

    plugins: [forms, typography,
        require('flowbite/plugin')],
};
