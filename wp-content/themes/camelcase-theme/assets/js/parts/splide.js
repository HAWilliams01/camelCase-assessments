import { Splide } from "@splidejs/splide";
import { AutoScroll } from "@splidejs/splide-extension-auto-scroll";

let logoSlider = document.querySelectorAll(".block-image-slider.splide");
logoSlider.forEach(function (element) {
    new Splide(element, {
        arrows: false,
        type: "loop",
        pagination: false,
        padding: "0",
        perPage: 2,
        gap: "3.5rem",
        mediaQuery: "min",
        autoScroll: {
            speed: 1,
            pauseOnHover: false,
            pauseOnFocus: false,
        },
        breakpoints: {
            500: {
                perPage: 3,
            },
            640: {
                gap: "5rem",
                perPage: 4,
            },
            1280: {
                perPage: 5,
            },
        },
    }).mount({ AutoScroll });
}); 