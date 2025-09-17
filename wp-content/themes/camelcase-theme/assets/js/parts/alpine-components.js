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

    Alpine.data("tvShowsForm", (initialCountry = "US", initialDate = null) => ({
        // Country dropdown state
        countryOpen: false,
        selectedCountry: initialCountry,

        // Date picker state
        dateOpen: false,
        selectedDate: initialDate || dayjs().format('YYYY-MM-DD'),
        currentMonth: initialDate ? dayjs(initialDate).month() : dayjs().month(),
        currentYear: initialDate ? dayjs(initialDate).year() : dayjs().year(),
        days: [],
        monthNames: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ],

        init() {
            // Initialize date picker calendar
            this.generateCalendar();

            // Check if we just submitted the form (URL has parameters)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has("date") || urlParams.has("country")) {
                // Scroll to form after page load
                this.$nextTick(() => {
                    setTimeout(() => {
                        this.scrollToForm();
                    }, 100);
                });
            }
        },

        // Country dropdown methods
        countries: [
            { code: "US", name: "USA" },
            { code: "CA", name: "Canada" },
            { code: "GB", name: "United Kingdom" },
            { code: "AU", name: "Australia" },
            { code: "DE", name: "Germany" },
            { code: "FR", name: "France" },
            { code: "JP", name: "Japan" },
            { code: "KR", name: "South Korea" },
        ],

        get selectedCountryName() {
            return (
                this.countries.find((c) => c.code === this.selectedCountry)
                    ?.name || "Select Country"
            );
        },

        selectCountry(countryCode) {
            this.selectedCountry = countryCode;
            this.countryOpen = false;
            // Update hidden input and submit form
            document.getElementById("country").value = countryCode;
            document.getElementById("tv-shows-form").submit();
        },

        toggle() {
            if (this.countryOpen) {
                return this.close();
            }
            this.$refs.button.focus();
            this.countryOpen = true;
        },

        close(focusAfter) {
            if (!this.countryOpen) return;
            this.countryOpen = false;
            focusAfter && focusAfter.focus();
        },

        // Date picker methods
        generateCalendar() {
            const firstDay = dayjs().year(this.currentYear).month(this.currentMonth).date(1);
            const startDate = firstDay.subtract(firstDay.day(), 'day');

            this.days = [];
            // 5 rows of 7 days
            for (let i = 0; i < 35; i++) {
                const date = startDate.add(i, 'day');
                const dateString = date.format('YYYY-MM-DD');

                this.days.push({
                    date: dateString,
                    day: date.date(),
                    isCurrentMonth: date.month() === this.currentMonth,
                    isToday: date.isSame(dayjs(), 'day'),
                    isSelected: dateString === this.selectedDate,
                    isWeekend: date.day() === 0 || date.day() === 6, // Sunday = 0, Saturday = 6
                });
            }
        },

        selectDate(date) {
            this.selectedDate = date;
            this.dateOpen = false;
            // Update hidden input and submit form
            document.getElementById("date").value = date;
            document.getElementById("tv-shows-form").submit();
        },

        previousMonth() {
            const currentDate = dayjs().year(this.currentYear).month(this.currentMonth);
            const prevDate = currentDate.subtract(1, 'month');
            this.currentMonth = prevDate.month();
            this.currentYear = prevDate.year();
            this.generateCalendar();
        },

        nextMonth() {
            const currentDate = dayjs().year(this.currentYear).month(this.currentMonth);
            const nextDate = currentDate.add(1, 'month');
            this.currentMonth = nextDate.month();
            this.currentYear = nextDate.year();
            this.generateCalendar();
        },

        toggleDate() {
            this.dateOpen = !this.dateOpen;
        },

        closeDate() {
            this.dateOpen = false;
        },

        get formattedDate() {
            if (!this.selectedDate) return "Select Date";
            return dayjs(this.selectedDate).format('MMM D, YYYY');
        },

        scrollToForm() {
            this.$el.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        },
    }));

    console.log('Camelcase Theme loaded');
}