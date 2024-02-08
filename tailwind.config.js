/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    mode: "jit",
    darkMode: false,
    purge: {
        content: [
            "./resources/**/*.blade.php",
            "./resources/**/*.js",
        ],
    },
    theme: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
};
