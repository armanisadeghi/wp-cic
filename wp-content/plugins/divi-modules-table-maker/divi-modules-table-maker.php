<?php

/**
 * Plugin Name:     Divi-Modules – Table Maker
 * Plugin URI:      https://divi-modules.com/products/table-maker/
 * Description:     Brings beautiful responsive tables to the Divi Builder.
 * Version:         2.0.4
 * Author:          Divi-Modules
 * Author URI:      https://divi-modules.com/
 * License:         GPLv2
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     dvmd-table-maker
 * Domain Path:     /languages
 *
 * Divi-Modules – Table Maker is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 2 of the License, or any later version.
 *
 * Divi-Modules – Table Maker is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License.
 * If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

// Exit.
if (!defined('ABSPATH')) exit;

// Init.
if (!class_exists('DVMD_Table_Maker')) {

    // Constants.
    define('DVMD_TM_PLUGIN_TITLE',    'Table Maker');
    define('DVMD_TM_PLUGIN_VERSION',  '2.0.4');
    define('DVMD_TM_PLUGIN_FILE',      __FILE__);
    define('DVMD_TM_PLUGIN_DIR',       plugin_dir_path(__FILE__));
    define('DVMD_TM_PLUGIN_DIR_URL',   plugin_dir_url(__FILE__));

    // Activate plugin.
    register_activation_hook(__FILE__, 'dvmd_table_maker_activate');
    function dvmd_table_maker_activate() {
        require_once DVMD_TM_PLUGIN_DIR.'activate.php';
    }

    // Deactivate plugin.
    if (get_transient('dvmd-tm-activate-error')) add_action('admin_notices', 'dvmd_table_maker_deactivate');
    function dvmd_table_maker_deactivate() {
        echo et_core_esc_previously(get_transient('dvmd-tm-activate-error'));
        deactivate_plugins(plugin_basename(DVMD_TM_PLUGIN_FILE), true);
        if (isset($_GET['activate'])) unset($_GET['activate']); // phpcs:ignore
        delete_transient('dvmd-tm-activation-error');
    }

    // Init admin.
    if (is_admin()) require_once DVMD_TM_PLUGIN_DIR.'admin/admin-class.php';

    // Init extension.
    add_action('divi_extensions_init', 'dvmd_table_maker_init');
    function dvmd_table_maker_init() {
        require_once DVMD_TM_PLUGIN_DIR.'includes/main-class.php';
    }
}
