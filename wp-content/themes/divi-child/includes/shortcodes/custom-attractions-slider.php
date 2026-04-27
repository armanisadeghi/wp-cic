<?php
/**
 * Custom Attractions Slider with Swiper.js
 */
function custom_attractions_slider() {
    // ======================================
    // CONFIGURE YOUR ATTRACTIONS HERE
    // ======================================
    $attractions = array(
        array(
            'title_front'  => 'Ventura Boulevard Dining District',
            'title_back'   => 'Ventura Boulevard Dining District',
            'description'  => 'A vibrant commercial corridor in Sherman Oaks with diverse dining, cafés, and local shops, commonly enjoyed by patients before or after their visit to the medspa.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/ventura-boulevard-dining.jpg', // UPDATE PATH
            'link'         => 'https://en.wikipedia.org/wiki/Ventura_Boulevard',
        ),
        array(
            'title_front'  => 'Sherman Oaks Galleria',
            'title_back'   => 'Sherman Oaks Galleria',
            'description'  => 'A landmark lifestyle destination offering dining, boutiques, wellness spots, and entertainment options all in one place. Whether enjoying a casual meal, catching a movie, or exploring local shops, the Galleria is a favorite stop among patients before or after their visit.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/sherman-oaks-galleria.jpg', // UPDATE PATH
            'link'         => 'https://shermanoaksgalleria.com/',
        ),
        array(
            'title_front'  => 'Sherman Oaks Castle Park',
            'title_back'   => 'Sherman Oaks Castle Park',
            'description'  => 'A family entertainment and recreation destination with miniature golf, arcade games, and batting cages in Sherman Oaks.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/sherman-oaks-castle-park.jpg', // UPDATE PATH
            'link'         => 'https://recreation.parks.lacity.gov/castlepark/',
        ),
        array(
            'title_front'  => 'Van Nuys–Sherman Oaks Park',
            'title_back'   => 'Van Nuys–Sherman Oaks Park',
            'description'  => 'Community park with sports courts, playground, and pool facilities near Sherman Oaks.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/van-nuys-sherman-oaks-park.webp', // UPDATE PATH
            'link'         => 'https://locator.lacounty.gov/lac/Location/3178992/van-nuys---sherman-oaks-park',
        ),
        array(
            'title_front'  => 'Lake Balboa Park',
            'title_back'   => 'Lake Balboa / Anthony C. Beilenson Park',
            'description'  => 'A peaceful lakeside escape featuring walking paths, swan-paddle boats, cherry blossom trees, and open green space. It\'s a perfect spot to unwind, take a relaxing stroll, or enjoy the outdoors after an appointment.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/lake-balboa-park.jpg', // UPDATE PATH
            'link'         => 'https://recreation.parks.lacity.gov/aquatic/balboa',
        ),
        array(
            'title_front'  => 'Universal Studios Hollywood',
            'title_back'   => 'Universal Studios Hollywood',
            'description'  => 'A major regional attraction within a short drive of Sherman Oaks, offering entertainment and theme park experiences.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/universal-studios-hollywood-sherman-oaks.jpg', // UPDATE PATH
            'link'         => 'https://www.universalstudioshollywood.com/',
        ),
    );

    // Generate unique ID to prevent conflicts
    $slider_id = 'attractions-slider-' . uniqid();
    
    ob_start();
    ?>
    
    <div class="hover-cards-wrapper" id="<?php echo esc_attr($slider_id); ?>">
        <div class="swiper hover-cards-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($attractions as $attraction) : ?>
                <div class="swiper-slide">
                    <a href="<?php echo esc_url($attraction['link']); ?>" target="_blank" rel="noopener" class="hover-card">
                        <!-- Front: Image + Short Title -->
                        <div class="hover-card-front" style="background-image: url('<?php echo esc_url($attraction['image']); ?>');">
                            <div class="hover-card-overlay"></div>
                            <span class="hover-card-title"><?php echo esc_html($attraction['title_front']); ?></span>
                        </div>
                        <!-- Back: Full Title + Description -->
                        <div class="hover-card-back">
                            <h3 class="hover-card-title-hover"><?php echo esc_html($attraction['title_back']); ?></h3>
                            <p class="hover-card-desc"><?php echo esc_html( wp_trim_words( $attraction['description'], 35, '...' ) ); ?></p>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Navigation Arrows -->
        <div class="hover-nav-prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </div>
        <div class="hover-nav-next">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </div>

    <script>
    (function() {
        function initAttractionsSlider() {
            if (typeof Swiper === 'undefined') {
                setTimeout(initAttractionsSlider, 100);
                return;
            }
            
            var container = document.getElementById('<?php echo esc_js($slider_id); ?>');
            if (!container) return;
            
            var swiperEl = container.querySelector('.hover-cards-swiper');
            var prevBtn = container.querySelector('.hover-nav-prev');
            var nextBtn = container.querySelector('.hover-nav-next');
            
            new Swiper(swiperEl, {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                speed: 400,
                navigation: {
                    nextEl: nextBtn,
                    prevEl: prevBtn,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 25,
                    },
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    }
                }
            });
        }
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAttractionsSlider);
        } else {
            initAttractionsSlider();
        }
    })();
    </script>
    
    <?php
    return ob_get_clean();
}
add_shortcode('attractions_slider', 'custom_attractions_slider');