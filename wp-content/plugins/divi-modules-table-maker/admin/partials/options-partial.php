<?php

if (!defined('ABSPATH')) exit;

/**
 * Displays plugin options widget.
 *
 * Divi-Modules products purchased from the Elegant Themes Divi Marketplace…
 * do not include the Divi-Modules admin-menu. This partial will only ever…
 * be loaded if the customer is concurrently running a Divi-Modules product…
 * that has been purchased directly from https://divi-modules.com/.
 *
 * @since  3.0.0
 */

// Message.
$message = sprintf(
    esc_html__('This copy of Divi-Modules – %s was purchased from the Elegant Themes Divi Marketplace. For product licensing, updates and support, see your %sDivi Marketplace Customer Dashboard%s.', 'dvmd-table-maker'),
    /* 01 */  esc_html(DVMD_TM_PLUGIN_TITLE),
    /* 02 */ '<a href="https://www.elegantthemes.com/marketplace/customer-dashboard/" target="_blank">',
    /* 03 */ '</a>'
);

?>

<div id="<?php echo esc_attr(DVMD_TM_PLUGIN_CLASS); ?>_options" class="dvmd-plugin-options">

    <!-- Header -->
    <div class="header">
        <h2><?php echo esc_html(DVMD_TM_PLUGIN_TITLE); ?></h2>
    </div>

    <!-- Body -->
    <div class="body">
        <p class="et_marketplace_message"><?php echo et_core_esc_previously($message); ?></p>
    </div>
</div>
