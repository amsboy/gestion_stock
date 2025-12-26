module.exports = {
  content: [
    "./*.html",       // toutes tes pages HTML à la racine
    "./*.php",        // si tu as des pages PHP
    "./src/**/*.{html,js,php}" // si tu as des fichiers dans src
  ],
  darkMode: 'class', // tu pourras activer le mode sombre avec la classe "dark"
  theme: {
    extend: {
      colors: {
        primary: '#1E40AF',   // bleu personnalisé
        secondary: '#F59E0B', // orange personnalisé
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [],
}