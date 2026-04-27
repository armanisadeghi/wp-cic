// jQuery: open external links in a new tab
jQuery(document).ready(function ($) {
    $('a').each(function () {
        var link = $(this).attr('href');

        // External link (http/https and different domain)
        if (link && link.match(/^http(s)?:\/\//) && !link.match(document.domain)) {
            $(this).attr('target', '_blank');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {

    /* ================================
     * 1) NEW PROCEDURES SLIDER
     *    Targets: .cic-procedures-slider (from shortcode)
     * ================================ */
    var procSliders = document.querySelectorAll('.cic-procedures-slider');

    procSliders.forEach(function (sliderEl) {
        var nextBtn = sliderEl.querySelector('.cic-proc-next');
        var prevBtn = sliderEl.querySelector('.cic-proc-prev');

        new Swiper(sliderEl, {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: false,
            navigation: {
                nextEl: nextBtn,
                prevEl: prevBtn
            },
            breakpoints: {
                600: { slidesPerView: 2 },
                900: { slidesPerView: 3 },
                1200: { slidesPerView: 4 }
            }
        });
    });


    /* ================================
     * 2) DIVI GALLERY → SWIPER
     *    Only affects .swiper-gallery.et_pb_gallery_grid
     * ================================ */
    (function () {
        const galleryGrid = document.querySelector(".swiper-gallery.et_pb_gallery_grid");
        if (!galleryGrid) return;

        const originalItems = galleryGrid.querySelectorAll(".et_pb_gallery_item");
        if (originalItems.length === 0) return;

        // Create Swiper structure
        const swiperContainer = document.createElement("div");
        swiperContainer.classList.add("swiper");

        const swiperWrapper = document.createElement("div");
        swiperWrapper.classList.add("swiper-wrapper");

        originalItems.forEach(item => {
            item.classList.add("swiper-slide");

            // Ensure image link supports Divi lightbox
            const anchor = item.querySelector("a");
            if (anchor && anchor.href.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
                anchor.setAttribute("data-lightbox", "et_pb_gallery");
                anchor.setAttribute("rel", "lightbox");
                anchor.classList.add("et_pb_lightbox_image");
            }

            swiperWrapper.appendChild(item);
        });

        swiperContainer.appendChild(swiperWrapper);
        galleryGrid.innerHTML = '';
        galleryGrid.appendChild(swiperContainer);

        // Add pagination and navigation (local to this gallery)
        const pagination = document.createElement("div");
        pagination.className = "swiper-pagination";

        const leftArrowSVG = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path>
            </svg>`;
        const rightArrowSVG = `
            <svg xmlns="http://www.w3.org/2000/svg" id="icon-arrow-right2" viewBox="0 0 32 32">
              <path d="M19.414 27.414l10-10c0.781-0.781 0.781-2.047 0-2.828l-10-10c-0.781-0.781-2.047-0.781-2.828 0s-0.781 2.047 0 2.828l6.586 6.586h-19.172c-1.105 0-2 0.895-2 2s0.895 2 2 2h19.172l-6.586 6.586c-0.39 0.39-0.586 0.902-0.586 1.414s0.195 1.024 0.586 1.414c0.781 0.781 2.047 0.781 2.828 0z"></path>
            </svg>`;

        const prev = document.createElement("div");
        prev.className = "swiper-button-prev";
        prev.innerHTML = leftArrowSVG;

        const next = document.createElement("div");
        next.className = "swiper-button-next";
        next.innerHTML = rightArrowSVG;

        galleryGrid.appendChild(pagination);
        galleryGrid.appendChild(prev);
        galleryGrid.appendChild(next);

        // Initialize Swiper only for this gallery
        const gallerySwiper = new Swiper(galleryGrid.querySelector('.swiper'), {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: pagination,
                clickable: true
            },
            navigation: {
                nextEl: next,
                prevEl: prev
            },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 }
            }
        });

        // Retry lightbox init up to 10 times
        let attempts = 0;
        const maxAttempts = 10;

        function tryInitLightbox() {
            if (typeof et_pb_lightbox_items === "function") {
                et_pb_lightbox_items();
            } else if (attempts < maxAttempts) {
                attempts++;
                setTimeout(tryInitLightbox, 500);
            }
        }

        tryInitLightbox();
    })();


    /* ================================
     * 3) CUSTOM DIVI SWIPER SLIDER
     *    Targets: .custom-swiper-slider
     * ================================ */
    (function () {
        const customSlider = document.querySelector(".custom-swiper-slider");
        if (!customSlider) return;

        const slidesContainer = customSlider.querySelector(".et_pb_slides");
        if (!slidesContainer) return;

        const slides = slidesContainer.querySelectorAll(".et_pb_slide");
        if (slides.length === 0) return;

        // Create Swiper wrapper structure
        const swiperWrapper = document.createElement("div");
        swiperWrapper.className = "swiper-wrapper";

        slides.forEach(slide => {
            slide.classList.add("swiper-slide");
            swiperWrapper.appendChild(slide);
        });

        // Create outer Swiper container
        const swiperContainer = document.createElement("div");
        swiperContainer.className = "swiper";
        swiperContainer.appendChild(swiperWrapper);

        // Replace slides with Swiper
        slidesContainer.innerHTML = "";
        slidesContainer.appendChild(swiperContainer);

        // Navigation wrapper
        const navWrapper = document.createElement("div");
        navWrapper.className = "custom-swiper-nav-wrapper";

        const prev = document.createElement("div");
        prev.className = "swiper-button-prev";
        prev.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path>
            </svg>`;

        const next = document.createElement("div");
        next.className = "swiper-button-next";
        next.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" id="icon-arrow-right2" viewBox="0 0 32 32">
              <path d="M19.414 27.414l10-10c0.781-0.781 0.781-2.047 0-2.828l-10-10c-0.781-0.781-2.047-0.781-2.828 0s-0.781 2.047 0 2.828l6.586 6.586h-19.172c-1.105 0-2 0.895-2 2s0.895 2 2 2h19.172l-6.586 6.586c-0.39 0.39-0.586 0.902-0.586 1.414s0.195 1.024 0.586 1.414c0.781 0.781 2.047 0.781 2.828 0z"></path>
            </svg>`;

        navWrapper.appendChild(prev);
        navWrapper.appendChild(next);
        customSlider.appendChild(navWrapper);

        // Swiper Init scoped to this block
        new Swiper(".custom-swiper-slider .swiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: ".custom-swiper-slider .swiper-button-next",
                prevEl: ".custom-swiper-slider .swiper-button-prev"
            },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 }
            }
        });
    })();

});
