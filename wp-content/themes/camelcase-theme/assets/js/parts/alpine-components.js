/**
 * Alpine.js Components
 *
 * Converts the existing vanilla JavaScript functionality to Alpine components
 */

export function registerComponents(Alpine) {

    // Mobile menu component
    Alpine.data('mobileMenu', () => ({
        open: false,
        toggle() {
            this.open = !this.open;
        }
    }));

    // Smooth scroll handler for anchor links
    Alpine.data('smoothScroll', () => ({
        init() {
            // Handle all anchor links within this component
            this.$el.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(anchor.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }
    }));

    // Fade-in animation component for feature cards
    Alpine.data('fadeIn', () => ({
        show: false,
        init() {
            // Set initial styles
            this.$el.style.opacity = '0';
            this.$el.style.transform = 'translateY(20px)';
            this.$el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';

            const observer = new IntersectionObserver(
                ([entry]) => {
                    if (entry.isIntersecting) {
                        this.$el.style.opacity = '1';
                        this.$el.style.transform = 'translateY(0)';
                        observer.disconnect();
                    }
                },
                {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                }
            );
            observer.observe(this.$el);
        }
    }));

    Alpine.data('tvShowsForm', (initialCountry = 'US') => ({
        open: false,
        selectedCountry: initialCountry,

        init() {
            // Check if we just submitted the form (URL has parameters)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('date') || urlParams.has('country')) {
                // Scroll to form after page load
                this.$nextTick(() => {
                    setTimeout(() => {
                        this.scrollToForm();
                    }, 100);
                });
            }
        },

        countries: [
            { code: 'US', name: 'USA' },
            { code: 'CA', name: 'Canada' },
            { code: 'GB', name: 'United Kingdom' },
            { code: 'AU', name: 'Australia' },
            { code: 'DE', name: 'Germany' },
            { code: 'FR', name: 'France' },
            { code: 'JP', name: 'Japan' },
            { code: 'KR', name: 'South Korea' }
        ],

        get selectedCountryName() {
            return this.countries.find(c => c.code === this.selectedCountry)?.name || 'Select Country';
        },

        selectCountry(countryCode) {
            this.selectedCountry = countryCode;
            this.open = false;
            // Update hidden input and submit form
            document.getElementById('country').value = countryCode;
            document.getElementById('tv-shows-form').submit();
        },

        toggle() {
            if (this.open) {
                return this.close();
            }
            this.$refs.button.focus();
            this.open = true;
        },

        close(focusAfter) {
            if (!this.open) return;
            this.open = false;
            focusAfter && focusAfter.focus();
        },

        scrollToForm() {
            this.$el.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }));

    console.log('Camelcase Theme loaded');
}