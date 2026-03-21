/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
        backgroundImage: {
            'login': "url('/assets/img/login-background.jpg')",
        },
        fontFamily: {
            bodoni: ['"Bodoni Moda"', 'serif'],
        }
    }
},
  plugins: [],
}
