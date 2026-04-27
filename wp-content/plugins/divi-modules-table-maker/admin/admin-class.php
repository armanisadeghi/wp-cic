<?php

if (!defined('ABSPATH')) exit;

/**
 * Manages plugin admin.
 *
 * @since  3.0.0
 *
 */
final class DVMD_Table_Maker_Admin {


    /**
     * Class constructor.
     *
     * @since   3.0.0
     * @access  public
     *
     * @return  void
     */
    public function __construct() {

        // Constants.
        define('DVMD_TM_PLUGIN_PREFIX', 'dvmd-table-maker');
        define('DVMD_TM_PLUGIN_CLASS',  'dvmd_table_maker');

        // Actions.
        add_action('admin_enqueue_scripts',    array(__CLASS__, 'load_plugin_options_styles'), 10, 1);
        add_action('dvmd_load_plugin_options', array(__CLASS__, 'load_plugin_options_partial'));
    }


    /**
     * Loads plugin options styles.
     *
     * @since   3.0.0
     * @access  public
     *
     * @param   string  $page  The current admin page.
     *
     * @action  admin_enqueue_scripts
     * @return  void
     */
    public static function load_plugin_options_styles($page) {
        if ($page !== 'divi-modules_page_divi-modules-menu-2') return;
        $url = DVMD_TM_PLUGIN_DIR_URL.'admin/styles/options-style.css';
        wp_register_style('dvmd-tm-options-style', $url, false, DVMD_TM_PLUGIN_VERSION);
        wp_enqueue_style ('dvmd-tm-options-style');
    }


    /**
     * Loads plugin options partial.
     *
     * Function is called by 'dvmd_load_plugin_options' action…
     * which is triggered in admin-submenu-partial.php.
     *
     * Divi-Modules products purchased from the Elegant Themes Divi Marketplace…
     * do not include the Divi-Modules admin-menu. This function will only ever…
     * be called if the customer is concurrently running a Divi-Modules product…
     * that has been purchased directly from https://divi-modules.com/.
     *
     * @since   3.0.0
     * @access  public
     *
     * @action  dvmd_load_plugin_options
     * @return  void
     */
    public static function load_plugin_options_partial() {
        include_once DVMD_TM_PLUGIN_DIR.'admin/partials/options-partial.php';
    }
}

// Init.
new DVMD_Table_Maker_Admin;
