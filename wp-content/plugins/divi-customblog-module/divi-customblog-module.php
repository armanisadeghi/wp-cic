<?php
/*
Plugin Name: Divi Custom Blog Module
Plugin URI:  https://www.peeayecreative.com/
Description: A FREE modified Divi Blog module by Pee-Aye Creative which allows you to select and show posts based on taxonomies of custom post types!
Version:     2.0.3
Author:      Pee-Aye Creative
Author URI:  https://www.peeayecreative.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dicbm-divi-customblog-module
Domain Path: /languages

Divi Customblog Module is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Divi Customblog Module is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Divi Customblog Module. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/
if (!function_exists('dicbm_initialize_extension')):
    /**
     * Creates the extension's main class instance.
     *
     * @since 1.0.0
     */
    function dicbm_initialize_extension()
    {
        require_once plugin_dir_path(__FILE__).'includes/DiviCustomblogModule.php';
    }

    add_action('divi_extensions_init', 'dicbm_initialize_extension');
endif;
/**
 * @param $data
 * @param $exit
 *
 * @return void
 */
if (!function_exists('pac_dicbm_dd')):
    function pac_dicbm_dd($data = '', $exit = true)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        echo $exit ? exit : null;
    }
endif;
/**
 * @param $output
 * @param $render_slug
 * @param $module
 *
 * @return mixed|string
 */
if (!function_exists('pac_dicbm_hide_empty_offset_slides')):
    function pac_dicbm_hide_empty_offset_slides($output, $render_slug, $module)
    {
        // Return If Frontend Builder
        if (function_exists('et_fb_is_enabled') && et_fb_is_enabled()) {
            return $output;
        }
        // Return If Backend Builder
        if (function_exists('et_builder_bfb_enabled') && et_builder_bfb_enabled()) {
            return $output;
        }
        // Return If Admin/Ajax and Output Array/Empty
        if (is_admin() || wp_doing_ajax() || is_array($output) || empty($output)) {
            return $output;
        }
        // Return If Not Slug Match
        if ('et_pb_custblog' !== $render_slug) {
            return $output;
        }
        //pac_dicbm_dd($output);
        if (preg_match("~\bnot-found-title\b~", $output)) {
            return '';
        }

        return $output;
    }
    if (!function_exists('is_plugin_active')) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    if (is_plugin_active('divi-carousel-maker/divi_carousel_maker.php')) {
        add_filter('et_module_shortcode_output', 'pac_dicbm_hide_empty_offset_slides', 10, 3);
    }
endif;
