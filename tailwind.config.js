/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php"],
    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: ["light", "dark", "cupcake"],
    },
};
