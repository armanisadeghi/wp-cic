<?php
/**
 * Custom Service Cards GRID (converted from slider)
 * Uses same hover-cards CSS classes
 */
function custom_service_cards_slider() {
    // ======================================
    // CONFIGURE YOUR SERVICES HERE (unchanged)
    // ======================================
    $services = array(
        array(
            'title_front'  => 'Injectables & Wrinkle Relaxers',
            'title_back'   => 'Injectables & Wrinkle Relaxers in Sherman Oaks, CA',
            'description'  => 'Smooth fine lines, restore facial balance, and achieve natural-looking rejuvenation with physician-guided injectables, including Botox® and other neuromodulators, dermal fillers, biostimulators, and advanced injection techniques customized for individual anatomy and goals.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/injectables-wrinkle-relaxers-treatments.webp',
            'link'         => 'https://cosmeticinjectables.com/procedures/filler-by-type/',
        ),
        array(
            'title_front'  => 'Laser & Light-Based Skin Treatments',
            'title_back'   => 'Laser & Light-Based Skin Treatments in Sherman Oaks, CA',
            'description'  => 'Improve skin tone, texture, redness, pigmentation, unwanted hair, and surface irregularities with advanced laser and light-based treatments, including laser hair removal, laser skin resurfacing, IPL photorejuvenation, and targeted vascular and pigment lasers designed to promote clearer, smoother, and more even-looking skin.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/laser-skin-treatment-at-medical-spa.webp',
            'link'         => 'https://cosmeticinjectables.com/procedures/laser/',
        ),
        array(
            'title_front'  => 'Skin Rejuvenation & Regenerative Aesthetics',
            'title_back'   => 'Skin Rejuvenation & Regenerative Aesthetics in Sherman Oaks, CA',
            'description'  => 'Enhance skin quality, texture, and radiance with regenerative aesthetic treatments that support cellular renewal and collagen production. Services such as microneedling, PRP, PRF, PDGF, exosomes, EZGel, biostimulators, and advanced regenerative therapies are designed to improve skin health from within and promote long-term rejuvenation.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/microneedling-treatment-at-medical-spa.webp',
            'link'         => 'https://cosmeticinjectables.com/procedures/other-procedures/',
        ),
        array(
            'title_front'  => 'Skin Tightening & Tissue Remodeling',
            'title_back'   => 'Skin Tightening & Tissue Remodeling in Sherman Oaks, CA',
            'description'  => 'Improve skin firmness, elasticity, and overall support with energy-based skin tightening and tissue remodeling treatments. Technologies such as Morpheus8, RF microneedling, and other radiofrequency-based therapies are designed to contract tissue, remodel collagen, and address skin laxity for a more lifted, contoured appearance.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/radiofrequency-skin-tightening-procedure.webp',
            'link'         => 'https://cosmeticinjectables.com/procedures/other-procedures/',
        ),
        array(
            'title_front'  => 'Body Contouring & Muscle Sculpting',
            'title_back'   => 'Body Contouring & Muscle Sculpting in Sherman Oaks, CA',
            'description'  => 'Strengthen muscles, reshape body contours, and reduce unwanted fat with non-surgical body sculpting treatments, including Emsella® and Emsculpt Neo®, using advanced muscle-stimulating and fat-reduction technologies tailored to individual goals.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/emsculpt-neo-treatment-medical-spa.webp',
            'link'         => 'https://cosmeticinjectables.com/procedures/health-and-wellness/',
        ),
        array(
            'title_front'  => 'Health & Wellness',
            'title_back'   => 'Health & Wellness in Sherman Oaks, CA',
            'description'  => 'Support overall health, metabolism, and vitality with physician-guided wellness services, including medical weight management and weight loss programs, GLP-1–based therapies such as tirzepatide, vitamin injections, and IV therapy designed to complement aesthetic care.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/medical-health-wellness-consultation-medical-spa.webp',
            'link'         => 'https://cosmeticinjectables.com/procedures/health-and-wellness/',
        ),
        array(
            'title_front'  => 'Medical-Grade Facials & Chemical Peels',
            'title_back'   => 'Medical-Grade Facials & Chemical Peels in Sherman Oaks, CA',
            'description'  => 'Refresh and brighten the skin with professional facials and chemical peels, including medical-grade exfoliation and resurfacing treatments formulated to improve clarity, tone, and texture.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2026/01/medical-grade-facials-medical-spa.webp',
            'link'         => 'https://cosmeticinjectables.com/procedures/other-procedures/',
        ),
    );
    
    ob_start();
    ?>
    
    <!-- GRID LAYOUT - No Swiper needed -->
    <div class="hover-cards-wrapper hover-cards-grid">
        <?php foreach ($services as $service) : ?>
        <a href="<?php echo esc_url($service['link']); ?>" class="hover-card">
            <!-- Front: Image + Short Title -->
            <div class="hover-card-front" style="background-image: url('<?php echo esc_url($service['image']); ?>');">
                <div class="hover-card-overlay"></div>
                <span class="hover-card-title"><?php echo esc_html($service['title_front']); ?></span>
            </div>
            <!-- Back: Full Title + Description -->
            <div class="hover-card-back">
                <h3 class="hover-card-title-hover"><?php echo esc_html($service['title_back']); ?></h3>
                <p class="hover-card-desc"><?php echo esc_html($service['description']); ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <script>
    // Mobile touch support only (no Swiper needed)
    (function() {
        var wrapper = document.querySelector('.hover-cards-wrapper.hover-cards-grid');
        if (!wrapper) return;
        
        var cards = wrapper.querySelectorAll('.hover-card');
        cards.forEach(function(card) {
            card.addEventListener('click', function(e) {
                if (window.innerWidth <= 991) {
                    if (card.classList.contains('is-flipped')) {
                        return true;
                    }
                    e.preventDefault();
                    cards.forEach(function(c) { c.classList.remove('is-flipped'); });
                    card.classList.add('is-flipped');
                }
            });
        });
    })();
    </script>
    
    <?php
    return ob_get_clean();
}
add_shortcode('service_cards_slider', 'custom_service_cards_slider');