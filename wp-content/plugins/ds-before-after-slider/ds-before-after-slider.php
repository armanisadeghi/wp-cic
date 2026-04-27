<?php
/*
Plugin Name: Divi Sensei Before After Slider
Plugin URI:  https://divi-sensei.com/before-after-slider-for-divi
Description: A Before After Slider for Divi
Version:     2.2.2
Author:      Divi Sensei
Author URI:  https://divi-sensei.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dss-ds-before-after-slider
Domain Path: /languages

Before After Slider for Divi is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Before After Slider for Divi is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Before After Slider for Divi. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

function ds_before_after_slider_divi_builder_active()
{
    return (function_exists('et_builder_bfb_enabled') && et_builder_bfb_enabled())
        || (function_exists('et_builder_is_tb_admin_screen') && et_builder_is_tb_admin_screen())
        || (function_exists('et_fb_enabled') && et_fb_enabled());
}

add_action('divi_extensions_init', function () {
    require_once plugin_dir_path(__FILE__) . 'includes/DsBeforeAfterSlider.php';
});

add_action('admin_enqueue_scripts', function () {
    if (ds_before_after_slider_divi_builder_active()) {
        wp_enqueue_style('ds_before_after_slider_admin_css', plugin_dir_url(__FILE__) . '/admin/css/admin.css', array(), '2.2.0');
    }
});

add_action('init', function () {
    wp_register_script('ds_before_after_slider', plugin_dir_url(__FILE__) . 'scripts/frontend-bundle.min.js', array('jquery'), true);
    wp_register_style('ds_before_after_slider', plugin_dir_url(__FILE__) . 'styles/style.min.css', [], '2.2.0');
});

function ds_before_after_slider_enqueue_scripts()
{
    wp_dequeue_script('ds-before-after-slider-frontend-bundle');
    wp_dequeue_style('ds-before-after-slider-styles');

    if (ds_before_after_slider_divi_builder_active()) {
        wp_enqueue_style('ds_before_after_slider');
    }
}
add_action('wp_enqueue_scripts', 'ds_before_after_slider_enqueue_scripts', 20, 0);
add_action('admin_enqueue_scripts', 'ds_before_after_slider_enqueue_scripts', 20, 0);
