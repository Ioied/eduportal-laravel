import defaultTheme from 'tailwindcss/defaultTheme'
import forms      from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',  // все Blade-шаблоны
    './resources/js/**/*.js',            // твой JS (Alpine, Vite)
    './resources/**/*.vue',              // если будут Vue-компоненты
  ],

  theme: {
    container: {
      center: true,
      padding: '1rem',
    },
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [
    forms,
    typography,
  ],
}
