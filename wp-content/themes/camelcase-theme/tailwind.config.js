import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './**/*.php',
    './assets/**/*.js',
    './assets/**/*.jsx',
    '!./node_modules/**',
    '!./dist/**'
  ],
  theme: {
    extend: {
      colors: {
        yellow: {
          500: '#F7D684',
        },
        pink: {
          500: '#F3AFA8',
        },
        red: {
          500: '#FF6250',
        },
        green:{
          500: '#009379',
        },
        gray: {
          100: '#F3F3F3',
          700: '#2D2D2D',
        },
        primary: {
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
        }
      },
      fontFamily: {
        sans: ['Epilogue', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', '"Helvetica Neue"', 'Arial', 'sans-serif'],
        epilogue: ['Epilogue', 'sans-serif'],
      },
      container: {
        center: true,
        padding: '1rem',
        screens: {
          sm: '640px',
          md: '768px',
          lg: '1024px',
          xl: '1280px',
        }
      }
    },
  },
  plugins: [
    typography,
  ],
}