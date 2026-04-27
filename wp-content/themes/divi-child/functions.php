<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

//Shortcode to show the module
function showmodule_shortcode($atts) {
    $atts = shortcode_atts(array('id' => ''), $atts, 'showmodule');
    if ( empty($atts['id']) ) return '';
    return do_shortcode('[et_pb_section global_module="'. esc_attr($atts['id']) .'"][/et_pb_section]');
}
add_shortcode('showmodule', 'showmodule_shortcode');

add_action( 'pre_get_posts', function ( $q ) {
  if (!is_admin() && $q->is_category()) {
    $q->set( 'post_type', ['post', 'treatment-areas','procedures', 'press'] );
  }
});

add_filter( 'rank_math/frontend/canonical', function( $canonical ) {
if (  (is_category()||is_tax('blog_news')) && is_paged() ) {
		$object = get_queried_object();
		return get_term_link( $object->term_id );
	}
	return $canonical;
});

function dipi_mobile_body_class( $classes ) {
    if ( wp_is_mobile() ) {
        $classes[] = 'dipi-collapse-submenu-mobile dipi-menu-custom-breakpoint';
    }
    return $classes;
}
add_filter( 'body_class', 'dipi_mobile_body_class' );

add_action( 'wp_enqueue_scripts', function () {
    if ( wp_is_mobile() ) {
        wp_enqueue_script( 'menu-js', get_stylesheet_directory_uri().'/menu.js', [], '1.2', true ); // load in footer
    }
}, 20);


/* Shortcode files include */
// require_once (get_stylesheet_directory_uri().'/includes/shortcodes/custom-procedure-slider.php');
/**
 * Enqueue Swiper.js for service slider
 */
function enqueue_swiper_assets() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');
require_once (get_stylesheet_directory() . '/includes/shortcodes/custom-procedure-slider.php');
require_once (get_stylesheet_directory() . '/includes/shortcodes/custom-attractions-slider.php');
require_once (get_stylesheet_directory() . '/includes/shortcodes/practitioners-grid.php');
// Define the function to flush permalinks
//function flush_permalinks_hourly() {
  //  flush_rewrite_rules();
//}

// Schedule the event to flush permalinks hourly
//function schedule_permalink_flush() {
   // if ( ! wp_next_scheduled( 'hourly_permalink_flush' ) ) {
     //   wp_schedule_event( time(), 'hourly', 'hourly_permalink_flush' );
    //}
//}
//add_action( 'wp', 'schedule_permalink_flush' );

// Hook the function to the scheduled event
//function run_hourly_permalink_flush() {
   // flush_permalinks_hourly();
//}
//add_action( 'hourly_permalink_flush', 'run_hourly_permalink_flush' );

add_filter( 'rank_math/snippet/rich_snippet_videoobject_entity', function( $entity ) {
    // Set the uploadDate using get_the_modified_date in ISO 8601 format
    $entity['uploadDate'] = get_the_modified_date('c');

    // Ensure the format includes time (T separator)
    if ( ! empty( $entity['uploadDate'] ) ) {
        $parts = explode( 'T', $entity['uploadDate'] );
        if ( empty( $parts[1] ) ) {
            $entity['uploadDate'] = wp_date( 'Y-m-d\TH:i:sP', strtotime( $entity['uploadDate'] ) );
        }
    }

    return $entity;
});

add_filter( 'rank_math/opengraph/facebook/ya_ovs_upload_date', '__return_false');
add_filter( 'rank_math/sitemap/enable_caching', '__return_false');

/* Divi posts list sort order by title */
// add_filter('init', 'db_acf_sort_initialize_blog_module_sorting');
function db_acf_sort_initialize_blog_module_sorting() {    
    add_filter('et_pb_module_shortcode_attributes', 'db_acf_sort_add_sorting_filter', 10, 3);
}

function db_acf_sort_add_sorting_filter($attrs, $content, $module_slug) {
    global $post;
    // echo'<pre>';print_r($post);echo'</pre>';exit;
    if (is_singular('procedures')) {
        $id = get_the_ID(); // Get the post ID
        if($id == 10293) {
            
            add_filter('pre_get_posts', 'db_acf_sort_sort_blog_module_posts_by_acf', 10, 1);
            add_filter('et_pb_blog_shortcode_output', 'db_acf_sort_remove_sorting_filter', 10, 2);
            return $attrs;
        }
    }
    // add_filter('pre_get_posts', 'db_acf_sort_sort_blog_module_posts_by_acf', 10, 1);
	// add_filter('et_pb_blog_shortcode_output', 'db_acf_sort_remove_sorting_filter', 10, 2);
	return $attrs;
}

function db_acf_sort_remove_sorting_filter($output, $attrs) {
    global $post;
    // echo'<pre>';print_r($post);echo'</pre>';exit;
    if (is_singular('procedures')) {
        $id = get_the_ID(); // Get the post ID
        if($id == 10293) {
            
            remove_filter('pre_get_posts', 'db_acf_sort_sort_blog_module_posts_by_acf', 10);
            return $output;
        }
    }
	// remove_filter('pre_get_posts', 'db_acf_sort_sort_blog_module_posts_by_acf', 10);
	return $output;
}
function db_acf_sort_sort_blog_module_posts_by_acf($query) { 
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    return $query;
}

/**
 * Force custom template for all CPT posts (parent and child)
 * Prevents Divi from double-loading header/footer on child posts
 */
add_filter( 'template_include', function( $template ) {
    // Replace 'results' with your actual CPT slug
    if ( is_singular( 'results' ) ) {
        $custom_template = get_stylesheet_directory() . '/single-results.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }
    return $template;
}, 99 );






