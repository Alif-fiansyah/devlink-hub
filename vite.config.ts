import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  build: {
    outDir: 'public/dist',
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/ts/main.ts'),
        style: resolve(__dirname, 'src/scss/main.scss'),
      },
      output: {
        entryFileNames: '[name].bundle.js',
        assetFileNames: '[name].[ext]',
      },
    },
  },
});
