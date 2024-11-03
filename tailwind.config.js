/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#F5DEB3",
                secondary: "#89643D",
                tertiary: "#5C4328",
            },
        },
    },
    plugins: [],
};
