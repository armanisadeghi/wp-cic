<?php
/**
 * Practitioners Grid - Using unified hover-cards CSS (No slider)
 */
function custom_practitioners_grid() {
    $practitioners = array(
        array(
            'title_front'  => 'CATHERINE (M.S.N, R.N, Certified Aesthetic Nurse Specialist)',
            'title_back'   => 'CATHERINE ROGERS (M.S.N, R.N, Certified Aesthetic Nurse Specialist)',
            'description'  => 'Catherine brings over 15 years of experience to our medical spa. Her variety of experience—including work with plastic surgeons, dermatologists, and surgical operating rooms—has shaped her comprehensive expertise as an Aesthetic Nurse. Catherine takes a natural and methodical approach, emphasizing precision and safety while delivering personalized care with a mindful, big-picture perspective. Catherine enjoys forming a relationship with all her patients, keeping the experience light and warm-hearted! One of her favorite things in aesthetics is skincare!',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2021/08/nurse-cathrine-r-cosmetic-injectables.png',
            'link'         => 'https://cosmeticinjectables.com/about/our-staff/',
        ),
        array(
            'title_front'  => 'ELLEN (R.N.)',
            'title_back'   => 'ELLEN DRABKIN (R.N.)',
            'description'  => 'Ellen has built a career spanning plastic surgery centers and post-operative care before dedicating herself exclusively to aesthetics in 2010. With 20+ years in the field, Ellen brings extensive expertise as both a Laser Specialist and Aesthetic Nurse. Her combined experience and passion for aesthetics result in a calm demeanor and artistic eye, offering patients thoughtful insight and personalized care without ever making someone feel pressured into a treatment. She remains committed to staying current with advancements in aesthetic nursing and providing individualized attention to each patient.',
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2021/08/nurse-ellen-d-cosmetic-injectables.png',
            'link'         => 'https://cosmeticinjectables.com/about/our-staff/',
        ),
        array(
            'title_front'  => 'MELODY (A.D.N., B.S.N., R.N.)',
            'title_back'   => 'MELODY KOHAGURA (A.D.N., B.S.N., R.N.)',
            'description'  => "Melody brings dedication and precision to her role as an aesthetic nurse with over 10 years of experience. She earned her Associate's Degree in Nursing with Honors and her Bachelor of Science in Nursing Summa Cum Laude. Deeply committed to continuing education, Melody stays current with the latest techniques in aesthetic artistry and clinical safety. She is known for taking the time to thoroughly explain procedures, ensuring patients feel informed, confident, and supported throughout their care. Her skills don't stop at injecting, Melody is also a champion pinball player having competed in different leagues!",
            'image'        => 'https://cosmeticinjectables.com/wp-content/uploads/2021/08/nurse-melody-k-cosmetic-injectables.png',
            'link'         => 'https://cosmeticinjectables.com/about/our-staff/',
        ),
    );
    
    ob_start();
    ?>
    
    <div class="hover-cards-wrapper hover-cards-grid practitioners-grid">
        <?php foreach ($practitioners as $item) : ?>
        <a href="<?php echo esc_url($item['link']); ?>" class="hover-card">
            <div class="hover-card-front" style="background-image: url('<?php echo esc_url($item['image']); ?>');">
                <div class="hover-card-overlay"></div>
                <span class="hover-card-title"><?php echo esc_html($item['title_front']); ?></span>
            </div>
            <div class="hover-card-back">
                <span class="hover-card-title-hover"><?php echo esc_html($item['title_back']); ?></span>
                <p class="hover-card-desc"><?php echo esc_html( wp_trim_words( $item['description'], 200, '...' ) ); ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    
    <?php
    return ob_get_clean();
}
add_shortcode('practitioners_grid', 'custom_practitioners_grid');