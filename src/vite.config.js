import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'vite-plugin-laravel';
import { resolve } from 'path';

export default defineConfig({
  plugins: [
    vue(),
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '@': resolve(__dirname, 'resources/js'),
    },
  },
  build: {
    outDir: 'public/vendor/quotes',
    emptyOutDir: true,
    assetsDir: '',
  },
});