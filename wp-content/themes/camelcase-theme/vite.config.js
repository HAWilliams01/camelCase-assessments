import { defineConfig } from 'vite';
import { resolve } from 'path';
import ViteRestart from 'vite-plugin-restart';
import viteCompression from 'vite-plugin-compression';

export default defineConfig({
  base: process.env.NODE_ENV === 'production' ? '/wp-content/themes/camelcase-theme/dist/' : '/',

  build: {
    outDir: 'dist',
    manifest: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'assets/js/main.js'),
        style: resolve(__dirname, 'assets/css/main.pcss')
      },
      output: {
        entryFileNames: 'js/[name].[hash].js',
        chunkFileNames: 'js/[name].[hash].js',
        assetFileNames: ({ name }) => {
          if (/\.(css)$/.test(name ?? '')) {
            return 'css/[name].[hash][extname]';
          }
          if (/\.(woff|woff2|eot|ttf|otf)$/.test(name ?? '')) {
            return 'fonts/[name][extname]';
          }
          if (/\.(png|jpe?g|gif|svg|webp|avif)$/.test(name ?? '')) {
            return 'images/[name].[hash][extname]';
          }
          return 'assets/[name].[hash][extname]';
        }
      }
    }
  },

  plugins: [
    ViteRestart({
      reload: [
        '**/*.php',
        'template-parts/**/*',
      ],
    }),
    viteCompression({
      algorithm: 'gzip'
    }),
  ],

  server: {
    host: '0.0.0.0',
    port: 3000,
    strictPort: true,
    cors: true,
    headers: {
      'Access-Control-Allow-Origin': '*',
    },
    hmr: {
      host: 'localhost'
    }
  }
});