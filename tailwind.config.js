/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: false,
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {},
    },
    animation: {
        bounce: 'bounce 1s infinite',
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
