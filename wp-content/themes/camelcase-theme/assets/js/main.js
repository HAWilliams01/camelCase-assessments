/**
 * Main JavaScript file for Camelcase Theme
 */

/* CSS */
import '../css/main.pcss';

import Alpine from 'alpinejs';

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

document.addEventListener('DOMContentLoaded', function() {
    console.log('Camelcase Theme loaded');

    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileNavigation = document.getElementById('mobile-navigation');

    if (mobileMenuButton && mobileNavigation) {
        mobileMenuButton.addEventListener('click', function() {
            const isOpen = !mobileNavigation.classList.contains('hidden');

            if (isOpen) {
                mobileNavigation.classList.add('hidden');
                this.setAttribute('aria-expanded', 'false');
            } else {
                mobileNavigation.classList.remove('hidden');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add fade-in animation to elements when they come into view
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements with fade-in class
    document.querySelectorAll('.feature-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(el);
    });
});