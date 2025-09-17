/**
 * Main JavaScript file for Camelcase Theme
 */

/* CSS */
import '../css/main.pcss';

import Alpine from 'alpinejs';
import dayjs from 'dayjs';
import { registerComponents } from './parts/alpine-components';
import './parts/splide.js';

// Register custom Alpine components
registerComponents(Alpine);

// Make Alpine and dayjs available globally (useful for debugging)
window.Alpine = Alpine;
window.dayjs = dayjs;

// Start Alpine.js
Alpine.start();

/**
 * Accept HMR as per: https://vitejs.dev/guide/api-hmr.html
 */
if (import.meta.hot) {
  import.meta.hot.accept(() => {
    console.log("HMR active");
  });
}

// All interactive functionality is now handled via Alpine.js components
// See assets/js/parts/alpine-components.js for component definitions