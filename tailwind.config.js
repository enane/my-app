/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/js/Pages/*.vue",
        "./resources/js/Pages/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('tailwind-scrollbar')({ nocompatible: true }),
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ],
}
