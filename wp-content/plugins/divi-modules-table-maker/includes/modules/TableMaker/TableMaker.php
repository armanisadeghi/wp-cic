<?php


if (!defined('ABSPATH')) exit;


/**
 * Divi-Modules – Table Maker.
 *
 * @since 2.0.4
 */
class DVMD_Table_Maker_Module extends ET_Builder_Module {


    /**
     * Module properties initialization.
     *
     * @since 2.0.3
     */
    function init() {


        // Configuration.
        $this->vb_support       = 'on'; // on|partial
        $this->icon             = 'W';
        $this->slug             = 'dvmd_table_maker';
        $this->child_slug       = 'dvmd_table_maker_item';
        $this->name             =  esc_html__('Table Maker', 'dvmd-table-maker');
        $this->plural           =  esc_html__('Table Makers', 'dvmd-table-maker');
        $this->child_item_text  =  esc_html__('Column', 'dvmd-table-maker');
        //$this->main_css_element = '%%order_class%%';


        // Credits.
        $this->module_credits   = array(
            'module_uri'        => 'https://divi-modules.com/products/table-maker',
            'author'            => 'Divi-Modules',
            'author_uri'        => 'https://divi-modules.com',
        );


        // Global assets.
        add_filter('et_global_assets_list', array(__CLASS__, 'dvmd_tm_global_assets_list'), 10);


        // Toggles.
        $this->settings_modal_toggles = array(

            // Content Tab. (general)
            'general'                   => array(
                'toggles'               => array(
                    'tbl_column'        => esc_html__('Table Columns',          'dvmd-table-maker'),
                    'tbl_row'           => esc_html__('Table Rows',             'dvmd-table-maker'),
                    'tbl_responsive'    => esc_html__('Table Responsive',       'dvmd-table-maker'),
                    'tbl_scrolling'     => esc_html__('Table Scrolling',        'dvmd-table-maker'),
                    'tbl_icon'          => esc_html__('Table Icons',            'dvmd-table-maker'),
                    'tbl_button'        => esc_html__('Table Buttons',          'dvmd-table-maker'),
                    'tbl_image'         => esc_html__('Table Images',           'dvmd-table-maker'),
                ),
            ),

            // Design Tab. (advanced)
            'advanced'                  => array(
                'toggles'               => array(
                    'tbl_frame'         => esc_html__('Table Frame',            'dvmd-table-maker'),
                    'tbl_stripes'       => esc_html__('Table Stripes',          'dvmd-table-maker'),
                    'tbl_tcell_cell'    => esc_html__('Table Cells',            'dvmd-table-maker'),
                    'tbl_tcell_text'    => esc_html__('Table Text',             'dvmd-table-maker'),
                    'tbl_chead_cell'    => esc_html__('Column Header Cells',    'dvmd-table-maker'),
                    'tbl_chead_text'    => esc_html__('Column Header Text',     'dvmd-table-maker'),
                    'tbl_rhead_cell'    => esc_html__('Row Header Cells',       'dvmd-table-maker'),
                    'tbl_rhead_text'    => esc_html__('Row Header Text',        'dvmd-table-maker'),
                    'tbl_cfoot_cell'    => esc_html__('Column Footer Cells',    'dvmd-table-maker'),
                    'tbl_cfoot_text'    => esc_html__('Column Footer Text',     'dvmd-table-maker'),
                    'tbl_rfoot_cell'    => esc_html__('Row Footer Cells',       'dvmd-table-maker'),
                    'tbl_rfoot_text'    => esc_html__('Row Footer Text',        'dvmd-table-maker'),
                    'tbl_toggle'        => esc_html__('Accordion Toggle',       'dvmd-table-maker'),
                ),
            ),

            // Advance Tab. (custom_css)
            /*
            'custom_css'                => array(
                'toggles'               => array(
                    // Toggles go here.
                ),
            ),
            */
        );


        // Custom CSS.
        $this->custom_css_fields = array(

            'tbl_tcell_cells'   => array(
                'label'         => esc_html__('Table Cells', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_tcell',
            ),
            'tbl_tcell_content' => array(
                'label'         => esc_html__('Table Content', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_tcell .dvmd_tm_cdata',
            ),
            'tbl_chead_cells'   => array(
                'label'         => esc_html__('Column Header Cells', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_chead',
            ),
            'tbl_chead_content' => array(
                'label'         => esc_html__('Column Header Content', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_chead .dvmd_tm_cdata',
            ),
            'tbl_rhead_cells'   => array(
                'label'         => esc_html__('Row Header Cells', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_rhead',
            ),
            'tbl_rhead_content' => array(
                'label'         => esc_html__('Row Header Content', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_rhead .dvmd_tm_cdata',
            ),
            'tbl_cfoot_cells'   => array(
                'label'         => esc_html__('Column Footer Cells', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_cfoot',
            ),
            'tbl_cfoot_content' => array(
                'label'         => esc_html__('Column Footer Content', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_cfoot .dvmd_tm_cdata',
            ),
            'tbl_rfoot_cells'   => array(
                'label'         => esc_html__('Row Footer Cells', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_rfoot',
            ),
            'tbl_rfoot_content' => array(
                'label'         => esc_html__('Row Footer Content', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_rfoot .dvmd_tm_cdata',
            ),
            'tbl_icons'         => array(
                'label'         => esc_html__('Table Icons', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_icon',
            ),
            'tbl_buttons'       => array(
                'label'         => esc_html__('Table Buttons', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_button',
            ),
            'tbl_images'        => array(
                'label'         => esc_html__('Table Images', 'dvmd-table-maker'),
                'selector'      => '.dvmd_tm_image',
            ),
        );

    }


    /**
     * Module's advanced fields configuration.
     *
     * If module has partial or full builder support, all…
     * advanced options (except button) are added by default.
     * The following advanced fields are automatically added…
     * regardless of builder support or explicit definition.
     *
     * Tabs     | Toggles          | Fields
     * --------- ------------------ -------------
     * Design   | Border           | Rounded Corners (multiple fields)
     * Design   | Border           | Border Styles (multiple fields)
     * Design   | Box Shadow       | Box Shadow (multiple fields)
     * Design   | Animation        | Animation (multiple fields)
     *
     * @since 2.0.0
     *
     * @return array
     */
    function get_advanced_fields_config() {


        // Fields.
        $fields = array();


        //---------------------- Defaults ----------------------//


        // All fields.
        //$fld['background']              = false;
        //$fld['link_options']            = false;
        $fields['text']                 = false;
        $fields['fonts']                = false;
        $fields['button']               = false;
        //$fld['max_width']               = false;
        //$fld['height']                  = false;
        //$fld['margin_padding']          = false;
        //$fld['borders']                 = false;
        //$fld['box_shadow']              = false;
        //$fld['filters']                 = false;
        //$fld['transform']               = false;
        //$fld['animation']               = false;


        // Background.
        $fields['background']           =   array(
            'css'                       =>  array(
                'main'                  => '%%order_class%%, %%order_class%% .dvmd_tm_tblock',
            ),
        );

        // Borders.
        $fields['borders']              =   array(
            'default'                   =>  array(
                'css'                   =>  array(
                    'main'              =>  array(
                        'border_radii'  => '%%order_class%%, %%order_class%% .dvmd_tm_tblock',
                        'border_styles' => '%%order_class%%, %%order_class%% .dvmd_tm_tblock',
                    ),
                ),
                'defaults'              =>  array(
                    'border_radii'      => 'on||||',
                    'border_styles'     =>  array(
                        'width'         => '1px',
                        'style'         => 'none',
                    ),
                ),
            ),
        );

        // Box Shadow.
        $fields['box_shadow']           =   array(
            'default'                   =>  array(
                'css'                   =>  array(
                    'main'              => '%%order_class%%, %%order_class%% .dvmd_tm_tblock',
                ),
            ),
        );

        // Height.
        $fields['height']               =   array(
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_table',
            ),
        );

        // Spacing.
        $fields['margin_padding']       =   array(
            'css'                       =>  array(
                'padding'               => '%%order_class%%, %%order_class%% .dvmd_tm_tblock',
                'margin'                => '%%order_class%%, %%order_class%% .dvmd_tm_tblock',
            ),
        );


        //---------------------- Button ----------------------//


        // Table.
        $fields['button']['button']     =   array(

            'label'                     =>  esc_html__('Buttons', 'dvmd-table-maker'),
            'option_category'           => 'layout',
            'tab_slug'                  => 'general',
            'toggle_slug'               => 'tbl_button',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_button',
                'limited_main'          => '%%order_class%% .dvmd_tm_button',
            ),
            'box_shadow'                =>  array(
                'css'                   =>  array(
                    'main'              => '%%order_class%% .dvmd_tm_button',
                ),
            ),
            'margin_padding'            =>  false,
            'use_alignment'             =>  false,
        );


        //---------------------- Fonts ----------------------//


        // Table.
        $fields['fonts']['tbl_tcell_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_tcell_text',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell .dvmd_tm_cdata',
            ),
            'hide_text_align'           =>  true,
            'font_size'                 =>  array(
              'default'                 => '',
            ),
            'text_color'                =>  array(
              'default'                 => '',
            ),
        );

        // Column Header.
        $fields['fonts']['tbl_chead_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_chead_text',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_chead .dvmd_tm_cdata',
            ),
            'hide_text_align'           =>  true,
            'font_size'                 =>  array(
              'default'                 => '',
            ),
            'text_color'                =>  array(
              'default'                 => '',
            ),
            'header_level'              =>  array(
                'default'               => 'h6',
            ),
        );

        // Row Header.
        $fields['fonts']['tbl_rhead_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_rhead_text',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_rhead .dvmd_tm_cdata',
            ),
            'hide_text_align'           =>  true,
            'font_size'                 =>  array(
              'default'                 => '',
            ),
            'text_color'                =>  array(
              'default'                 => '',
            ),
            'header_level'              =>  array(
                'default'               => 'h6',
            ),
        );

        // Column Footer.
        $fields['fonts']['tbl_cfoot_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_cfoot_text',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_cfoot .dvmd_tm_cdata',
            ),
            'hide_text_align'           =>  true,
            'font_size'                 =>  array(
              'default'                 => '',
            ),
            'text_color'                =>  array(
              'default'                 => '',
            ),
        );

        // Row Footer.
        $fields['fonts']['tbl_rfoot_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_rfoot_text',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_rfoot .dvmd_tm_cdata',
            ),
            'hide_text_align'           =>  true,
            'font_size'                 =>  array(
              'default'                 => '',
            ),
            'text_color'                =>  array(
              'default'                 => '',
            ),
        );


        //---------------------- Borders ----------------------//


        // Table.
        $fields['borders']['tbl_tcell_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_tcell_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => '%%order_class%% .dvmd_tm_tcell',
                    'border_styles'     => '%%order_class%% .dvmd_tm_tcell',
                )
            ),
            'defaults'                  =>  array(
                'border_radii'          => 'on||||',
                'border_styles'         =>  array(
                    'width'             => '1px',
                    'style'             => 'none',
                ),
            ),
        );

        // Column Header.
        $fields['borders']['tbl_chead_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_chead_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_chead',
                    'border_styles'     => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_chead',
                )
            ),
            'defaults'                  =>  array(
                'border_radii'          => 'on||||',
                'border_styles'         =>  array(
                    'width'             => '1px',
                    'style'             => 'none',
                ),
            ),
        );

        // Row Header.
        $fields['borders']['tbl_rhead_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_rhead_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_rhead',
                    'border_styles'     => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_rhead',
                )
            ),
            'defaults'                  =>  array(
                'border_radii'          => 'on||||',
                'border_styles'         =>  array(
                    'width'             => '1px',
                    'style'             => 'none',
                ),
            ),
        );

        // Column Footer.
        $fields['borders']['tbl_cfoot_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_cfoot_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_cfoot',
                    'border_styles'     => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_cfoot',
                )
            ),
            'defaults'                  =>  array(
                'border_radii'          => 'on||||',
                'border_styles'         =>  array(
                    'width'             => '1px',
                    'style'             => 'none',
                ),
            ),
        );

        // Row Footer.
        $fields['borders']['tbl_rfoot_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_rfoot_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_rfoot',
                    'border_styles'     => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_rfoot',
                )
            ),
            'defaults'                  =>  array(
                'border_radii'          => 'on||||',
                'border_styles'         =>  array(
                    'width'             => '1px',
                    'style'             => 'none',
                ),
            ),
        );


        //---------------------- Box Shadow ----------------------//


        // Table.
        $fields['box_shadow']['tbl_tcell_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_tcell_cell',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell',
            ),
        );

        // Column Header.
        $fields['box_shadow']['tbl_chead_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_chead_cell',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_chead',
            ),
        );

        // Row Header.
        $fields['box_shadow']['tbl_rhead_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_rhead_cell',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_rhead',
            ),
        );

        // Column Footer.
        $fields['box_shadow']['tbl_cfoot_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_cfoot_cell',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_cfoot',
            ),
        );

        // Row Footer.
        $fields['box_shadow']['tbl_rfoot_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'tbl_rfoot_cell',
            'css'                       =>  array(
                'main'                  => '%%order_class%% .dvmd_tm_tcell.dvmd_tm_rfoot',
            ),
        );


        // Return
        return $fields;
    }


    /**
     * Module's specific fields.
     *
     * The following modules are automatically…
     * added regardless being defined or not:
     *
     * Tabs     | Toggles          | Fields
     * --------- ------------------ -------------
     * Content  | Admin Label      | Admin Label
     * Advanced | CSS ID & Classes | CSS ID
     * Advanced | CSS ID & Classes | CSS Class
     * Advanced | Custom CSS       | Before
     * Advanced | Custom CSS       | Main Element
     * Advanced | Custom CSS       | After
     * Advanced | Visibility       | Disable On
     *
     * @since 2.0.4
     *
     * @return array
     */
    function get_fields() {


        // Columns/Rows Max-Min.
        $tbl_column_max_width = esc_html__(
            "Here you can set a maximum width for all table columns. For flexible-width columns, it’s recommended to use fraction (fr) units. This can also be set to 'auto'. For fixed-width columns, it’s recommended to use pixel (px) units. This setting can be overridden per column.", 'dvmd-table-maker');
        $tbl_column_min_width = esc_html__(
            'Here you can set a minimum width for all table columns. It’s recommended to use pixel (px) units. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_row_max_height = esc_html__(
            "Here you can set a maximum height for all table rows. For flexible-height rows, it’s recommended to set this to ‘auto’. For fixed-height rows, it’s recommended to use pixel (px) units.", 'dvmd-table-maker');
        $tbl_row_min_height = esc_html__(
            'Here you can set a minimum height for all table rows. It’s recommended to use pixel (px) units.', 'dvmd-table-maker');

        // Columns/Rows Count.
        $tbl_column_header_count = esc_html__(
            'Here you can set the number of column headers the table will have.', 'dvmd-table-maker');
        $tbl_column_footer_count = esc_html__(
            'Here you can set the number of column footers the table will have.', 'dvmd-table-maker');
        $tbl_row_header_count = esc_html__(
            'Here you can set the number of row headers the table will have.', 'dvmd-table-maker');
        $tbl_row_footer_count = esc_html__(
            'Here you can set the number of row footers the table will have.', 'dvmd-table-maker');

        // Table Responsive.
        $tbl_responsive_breakpoint = esc_html__(
            'Here you can set the table breakpoint – the point at which the table will display as blocks or accordion.', 'dvmd-table-maker');
        $tbl_responsive_break_by = esc_html__(
            'Here you can set whether the table will break by columns or rows. If set to Columns, each column will become a separate block or accordion section. If set to Rows, each row will become a separate block or accordion section.', 'dvmd-table-maker');
        $tbl_responsive_warning_1 = esc_html__(
            'Your table currently has no column headers and will break by rows regardless of the setting above. To break by columns, please add a column header.', 'dvmd-table-maker');
        $tbl_responsive_warning_2 = esc_html__(
            'Your table currently has no row headers and will break by columns regardless of the setting above. To break by rows, please add a row header.', 'dvmd-table-maker');
        $tbl_responsive_display_as = esc_html__(
            'Here you can choose whether the table will display as blocks or accordion.', 'dvmd-table-maker');
        $tbl_responsive_warning_3 = esc_html__(
            'Your table currently has no headers and will display as blocks regardless of the setting above. To display as accordion, please add a column or row header.', 'dvmd-table-maker');
        $tbl_responsive_block_margin = esc_html__(
            'Here you can set the space between each block or accordion section.', 'dvmd-table-maker');

        // Table Scrolling.
        $tbl_scrolling_active = esc_html__(
            'Here you can choose to enable table scrolling. If set to Off, the table may overflow its containing element. If set to On, any overflow will be hidden and scrollbars will appear.', 'dvmd-table-maker');
        $tbl_scrolling_col_sticky = esc_html__(
            'Here you can choose to make column headers sticky. If set to Off, column headers will scroll along with table contents. If set to On, column headers will stick to the top edge of the table, remaining visible.', 'dvmd-table-maker');
        $tbl_scrolling_row_sticky= esc_html__(
            'Here you can choose to make row headers sticky. If set to Off, row headers will scroll along with table contents. If set to On, row headers will stick to the left edge of the table, remaining visible.', 'dvmd-table-maker');

        // Table Icon.
        $tbl_icon_type = esc_html__(
            'Here you can select the table’s default icon. This setting can be overridden per column or individual icon element. See documentation for details.', 'dvmd-table-maker');
        $tbl_icon_size = esc_html__(
            'Here you can set the table’s default icon size. This setting can be overridden per column or individual icon element. See documentation for details.', 'dvmd-table-maker');
        $tbl_icon_color = esc_html__(
            'Here you can set the table’s default icon color. This setting can be overridden per column or individual icon element. See documentation for details.', 'dvmd-table-maker');

        // Table Button.
        $tbl_button_text = esc_html__(
            'Here you can set the table’s default button text. This setting can be overridden per column or individual button element. See documentation for details.', 'dvmd-table-maker');
        $tbl_button_url = esc_html__(
            'Here you can set the table’s default button url. This setting can be overridden per column or individual button element. See documentation for details.', 'dvmd-table-maker');
        $tbl_button_target = esc_html__(
            'Here you can set the table’s default button target. This setting can be overridden per column or individual button element. See documentation for details.', 'dvmd-table-maker');
        $tbl_button_width = esc_html__(
            'Here you can set the table’s default button width. If set to Text Width, buttons will be as wide as their text. If set to Cell Width, buttons will stretch to fill their containing cell. This setting can be overridden per column.', 'dvmd-table-maker');

        // Table Image.
        $tbl_image_ids = esc_html__(
            'Here you can select images to use within table cells. See documentation for details.', 'dvmd-table-maker');
        $tbl_image_quality = esc_html__(
            'Here you can set the table’s default image quality or resolution.', 'dvmd-table-maker');
        $tbl_image_proportion = esc_html__(
            'Here you can set the table’s default image proportion. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_image_scale = esc_html__(
            'Here you can choose how the table’s images are scaled. If set to Fit, images are scaled to fit their containing cell without cropping. If set to Fill, images are scaled to fill or cover their containing cell. This may result in some cropping. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_image_align_horz = esc_html__(
            'Here you can set the table’s default horizontal image alignment. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_image_align_vert = esc_html__(
            'Here you can set the table’s default vertical image alignment. This setting can be overridden per column.', 'dvmd-table-maker');

        // Table Frame.
        $tbl_frame_type = esc_html__(
            'Here you can set how the table frame or grid will display. If set to Gaps, table cells will be separated by a gap of your choice, allowing background colors and images to show through. If set to Lines, table cells will be separated by a line of your choice.', 'dvmd-table-maker');
        $tbl_frame_gap_col = esc_html__(
            'Here you can set the column gap.', 'dvmd-table-maker');
        $tbl_frame_gap_row = esc_html__(
            'Here you can set the row gap.', 'dvmd-table-maker');
        $tbl_frame_line_style = esc_html__(
            'Here you can set the line style.', 'dvmd-table-maker');
        $tbl_frame_line_color = esc_html__(
            'Here you can set the line color.', 'dvmd-table-maker');
        $tbl_frame_line_width = esc_html__(
            'Here you can set the line width.', 'dvmd-table-maker');

        // Table Stripes.
        $tbl_stripes = esc_html__(
            'Here you can choose to apply a stripe effect to table rows.', 'dvmd-table-maker');
        $tbl_stripes_apply = esc_html__(
            'Here you can choose where the stripe effect is applied.', 'dvmd-table-maker');
        $tbl_stripes_order = esc_html__(
            'Here you can choose whether the stripe effect is applied to odd or even rows.', 'dvmd-table-maker');
        $tbl_stripes_hue = esc_html__(
            'Here you can set the stripe hue level.', 'dvmd-table-maker');
        $tbl_stripes_saturation = esc_html__(
            'Here you can set the stripe saturation level.', 'dvmd-table-maker');
        $tbl_stripes_brightness = esc_html__(
            'Here you can set the stripe brightness level.', 'dvmd-table-maker');

        // Table Cell.
        $tbl_tcell_cell_color = esc_html__(
            'Here you can set the table cell background color. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_tcell_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of table cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_tcell_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of table cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_tcell_cell_padding = esc_html__(
            'Here you can set the table cell padding. This setting can be overridden per column.', 'dvmd-table-maker');

        // Column Header Cell.
        $tbl_chead_cell_color = esc_html__(
            'Here you can set the column header cell background color. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_chead_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of column header cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_chead_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of column header cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_chead_cell_padding = esc_html__(
            'Here you can set the column header cell padding. This setting can be overridden per column.', 'dvmd-table-maker');

        // Row Header Cell.
        $tbl_rhead_cell_color = esc_html__(
            'Here you can set the row header cell background color. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_rhead_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of row header cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_rhead_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of row header cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_rhead_cell_padding = esc_html__(
            'Here you can set the row header cell padding. This setting can be overridden per column.', 'dvmd-table-maker');

        // Column Footer Cell.
        $tbl_cfoot_cell_color = esc_html__(
            'Here you can set the column footer cell background color. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_cfoot_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of column footer cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_cfoot_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of column footer cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_cfoot_cell_padding = esc_html__(
            'Here you can set the column footer cell padding. This setting can be overridden per column.', 'dvmd-table-maker');

        // Row Footer Cell.
        $tbl_rfoot_cell_color = esc_html__(
            'Here you can set the row footer cell background color. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_rfoot_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of row footer cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_rfoot_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of row footer cell content. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_rfoot_cell_padding = esc_html__(
            'Here you can set the row footer cell padding. This setting can be overridden per column.', 'dvmd-table-maker');

        // Table Text.
        $tbl_tcell_text_wrap = esc_html__(
            'Here you can choose whether to allow table text to wrap to multiple lines. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_chead_text_wrap = esc_html__(
            'Here you can choose whether to allow column header text to wrap to multiple lines. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_rhead_text_wrap = esc_html__(
            'Here you can choose whether to allow row header text to wrap to multiple lines. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_cfoot_text_wrap = esc_html__(
            'Here you can choose whether to allow column footer text to wrap to multiple lines. This setting can be overridden per column.', 'dvmd-table-maker');
        $tbl_rfoot_text_wrap = esc_html__(
            'Here you can choose whether to allow row footer text to wrap to multiple lines. This setting can be overridden per column.', 'dvmd-table-maker');

        // Accordion Toggle.
        $tbl_toggle_align = esc_html__(
            'Here you can set the accordion toggle icon alignment.', 'dvmd-table-maker');
        $tbl_toggle_size = esc_html__(
            'Here you can set the accordion toggle icon size.', 'dvmd-table-maker');
        $tbl_toggle_color = esc_html__(
            'Here you can set the accordion toggle icon color.', 'dvmd-table-maker');
        $tbl_toggle_icon_open = esc_html__(
            'Here you can set the accordion open toggle icon.', 'dvmd-table-maker');
        $tbl_toggle_icon_close = esc_html__(
            'Here you can set the accordion close toggle icon.', 'dvmd-table-maker');


        // Defaults.
        if (function_exists('et_pb_get_extended_font_icon_value')) {
            $tbl_icon_type_default         = '&#x52;||divi||400';
            $tbl_toggle_icon_open_default  = '&#x4c;||divi||400';
            $tbl_toggle_icon_close_default = '&#x4b;||divi||400';
        } else {
            $tbl_icon_type_default         = '&#x52;';
            $tbl_toggle_icon_open_default  = '&#x4c;';
            $tbl_toggle_icon_close_default = '&#x4b;';
        }


        // Fields.
        $fields = array(


            //---------------------- Count ----------------------//


            // Columns.
            'tbl_column_header_count'       =>  array(
                'label'                     =>  esc_html__('Header Count', 'dvmd-table-maker'),
                'description'               =>  $tbl_column_header_count,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_column',
                'type'                      => 'range',
                'allow_empty'               =>  false,
                'validate_unit'             =>  false,
                'default'                   => '1',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '3',
                    'step'                  => '1',
                ),
            ),

            'tbl_column_footer_count'       =>  array(
                'label'                     =>  esc_html__('Footer Count', 'dvmd-table-maker'),
                'description'               =>  $tbl_column_footer_count,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_column',
                'type'                      => 'range',
                'allow_empty'               =>  false,
                'validate_unit'             =>  false,
                'default'                   => '0',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '3',
                    'step'                  => '1',
                ),
            ),

            // Rows.
            'tbl_row_header_count'          =>  array(
                'label'                     =>  esc_html__('Header Count', 'dvmd-table-maker'),
                'description'               =>  $tbl_row_header_count,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_row',
                'type'                      => 'range',
                'allow_empty'               =>  false,
                'validate_unit'             =>  false,
                'default'                   => '1',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '3',
                    'step'                  => '1',
                ),
            ),

            'tbl_row_footer_count'          =>  array(
                'label'                     =>  esc_html__('Footer Count', 'dvmd-table-maker'),
                'description'               =>  $tbl_row_footer_count,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_row',
                'type'                      => 'range',
                'allow_empty'               =>  false,
                'validate_unit'             =>  false,
                'default'                   => '0',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '3',
                    'step'                  => '1',
                ),
            ),


            //---------------------- Min Max ----------------------//


            // Columns.
            'tbl_column_max_width'          =>  array(
                'label'                     =>  esc_html__('Max Width', 'dvmd-table-maker'),
                'description'               =>  $tbl_column_max_width,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_column',
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('fr','%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'default_unit'              => 'fr',
                'default'                   => '1fr',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '5',
                    'step'                  => '.1',
                ),
            ),

            'tbl_column_min_width'          =>  array(
                'label'                     =>  esc_html__('Min Width', 'dvmd-table-maker'),
                'description'               =>  $tbl_column_min_width,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_column',
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'default_unit'              => 'px',
                'default'                   => '100px',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '300',
                    'step'                  => '1',
                ),
            ),

            // Rows.
            'tbl_row_max_height'            =>  array(
                'label'                     =>  esc_html__('Max Height', 'dvmd-table-maker'),
                'description'               =>  $tbl_row_max_height,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_row',
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allowed_values'            =>  array('auto'),
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'default_unit'              => 'px',
                'default'                   => 'auto',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '300',
                    'step'                  => '1',
                ),
            ),

            'tbl_row_min_height'            =>  array(
                'label'                     =>  esc_html__('Min Height', 'dvmd-table-maker'),
                'description'               =>  $tbl_row_min_height,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_row',
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'default_unit'              => 'px',
                'default'                   => '50px',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '300',
                    'step'                  => '1',
                ),
            ),


            //---------------------- Responsive ----------------------//


            'tbl_responsive_breakpoint'     =>  array(
                'label'                     =>  esc_html__('Breakpoint', 'dvmd-table-maker'),
                'description'               =>  $tbl_responsive_breakpoint,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_responsive',
                'type'                      => 'multiple_buttons',
                'default'                   => 'max_width_980',
                'options'                   =>  array(
                    'none'                  =>  array(
                        'title'             =>  esc_html__('None', 'dvmd-table-maker'),
                    ),
                    'max_width_980'         =>  array(
                        'title'             =>  esc_html__('Tablet', 'dvmd-table-maker'),
                    ),
                    'max_width_767'         =>  array(
                        'title'             =>  esc_html__('Phone', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  false,
                'multi_selection'           =>  false,
            ),

            'tbl_responsive_break_by'       =>  array(
                'label'                     =>  esc_html__('Break By', 'dvmd-table-maker'),
                'description'               =>  $tbl_responsive_break_by,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_responsive',
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
                'type'                      => 'multiple_buttons',
                'default'                   => 'column',
                'options'                   =>  array(
                    'column'                =>  array(
                        'title'             =>  esc_html__('Columns', 'dvmd-table-maker'),
                    ),
                    'row'                   =>  array(
                        'title'             =>  esc_html__('Rows', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  false,
                'multi_selection'           =>  false,
            ),

            'tbl_responsive_warning_1'      =>  array(
                'message'                   =>  $tbl_responsive_warning_1,
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_responsive',
                'type'                      => 'warning',
                'value'                     =>  true,
                'display_if'                =>  true,
                'show_if'                           =>  array(
                    'tbl_responsive_display_as'     => 'accordion',
                    'tbl_responsive_break_by'       => 'column',
                    'tbl_column_header_count'       => '0',
                ),
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                    'tbl_row_header_count'          => '0',
                ),
            ),

            'tbl_responsive_warning_2'      =>  array(
                'message'                   =>  $tbl_responsive_warning_2,
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_responsive',
                'type'                      => 'warning',
                'value'                     =>  true,
                'display_if'                =>  true,
                'show_if'                           =>  array(
                    'tbl_responsive_display_as'     => 'accordion',
                    'tbl_responsive_break_by'       => 'row',
                    'tbl_row_header_count'          => '0',
                ),
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                    'tbl_column_header_count'       => '0',
                ),
            ),

            'tbl_responsive_display_as'     =>  array(
                'label'                     =>  esc_html__('Display As', 'dvmd-table-maker'),
                'description'               =>  $tbl_responsive_display_as,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_responsive',
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
                'type'                      => 'multiple_buttons',
                'default'                   => 'blocks',
                'options'                   =>  array(
                    'blocks'                =>  array(
                        'title'             =>  esc_html__('Blocks', 'dvmd-table-maker'),
                    ),
                    'accordion'             =>  array(
                        'title'             =>  esc_html__('Accordion', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  false,
                'multi_selection'           =>  false,
            ),

            'tbl_responsive_warning_3'      =>  array(
                'message'                   =>  $tbl_responsive_warning_3,
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_responsive',
                'type'                      => 'warning',
                'value'                     =>  true,
                'display_if'                =>  true,
                'show_if'                           =>  array(
                    'tbl_responsive_display_as'     => 'accordion',
                    'tbl_column_header_count'       => '0',
                    'tbl_row_header_count'          => '0',
                ),
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
            ),

            'tbl_responsive_block_margin'   =>  array(
                'label'                     =>  esc_html__('Block/Acccordion Gap', 'dvmd-table-maker'),
                'description'               =>  $tbl_responsive_block_margin,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_responsive',
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'default_unit'              => 'px',
                'default'                   => '15px',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '100',
                    'step'                  => '1',
                ),
            ),


            //---------------------- Scrolling ----------------------//


            'tbl_scrolling_active'          =>  array(
                'label'                     =>  esc_html__('Scrolling', 'dvmd-table-maker'),
                'description'               =>  $tbl_scrolling_active,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_scrolling',
                'type'                      => 'yes_no_button',
                'default'                   => 'off',
                'options'                   =>  array(
                    'on'                    =>  esc_html__('On', 'dvmd-table-maker'),
                    'off'                   =>  esc_html__('Off', 'dvmd-table-maker'),
                ),
            ),

            'tbl_scrolling_col_sticky'      =>  array(
                'label'                     =>  esc_html__('Sticky Column Headers', 'dvmd-table-maker'),
                'description'               =>  $tbl_scrolling_col_sticky,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_scrolling',
                'show_if'                   =>  array(
                    'tbl_scrolling_active'  => 'on',
                ),
                'show_if_not'               =>  array(
                    'tbl_chead_count'       => '0',
                ),
                'type'                      => 'yes_no_button',
                'default'                   => 'off',
                'options'                   =>  array(
                    'on'                    =>  esc_html__('On', 'dvmd-table-maker'),
                    'off'                   =>  esc_html__('Off', 'dvmd-table-maker'),
                ),
            ),

            'tbl_scrolling_row_sticky'      =>  array(
                'label'                     =>  esc_html__('Sticky Row Headers', 'dvmd-table-maker'),
                'description'               =>  $tbl_scrolling_row_sticky,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_scrolling',
                'show_if'                   =>  array(
                    'tbl_scrolling_active'  => 'on',
                ),
                'show_if_not'               =>  array(
                    'tbl_rhead_count'       => '0',
                ),
                'type'                      => 'yes_no_button',
                'default'                   => 'off',
                'options'                   =>  array(
                    'on'                    =>  esc_html__('On', 'dvmd-table-maker'),
                    'off'                   =>  esc_html__('Off', 'dvmd-table-maker'),
                ),
            ),


            //---------------------- Icon ----------------------//


            'tbl_icon_type'                 =>  array(
                'label'                     =>  esc_html__('Default Icon', 'dvmd-table-maker'),
                'description'               =>  $tbl_icon_type,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_icon',
                'type'                      => 'select_icon',
                'default'                   =>  $tbl_icon_type_default,
            ),

            'tbl_icon_size'                 =>  array(
                'label'                     =>  esc_html__('Icon Size', 'dvmd-table-maker'),
                'description'               =>  $tbl_icon_size,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_icon',
                'type'                      => 'range',
                'default'                   => '1em',
                'range_settings'            =>  array(
                    'min'                   => '1',
                    'max'                   => '120',
                    'step'                  => '1',
                ),
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'default_unit'              => 'px',
                'mobile_options'            =>  true,
            ),

            'tbl_icon_color'                =>  array(
                'label'                     =>  esc_html__('Icon Color', 'dvmd-table-maker'),
                'description'               =>  $tbl_icon_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_icon',
                'type'                      => 'color-alpha',
                'mobile_options'            =>  true,
                'hover'                     => 'tabs',
            ),


            //---------------------- Button ----------------------//


            'tbl_button_text'               =>  array(
                'label'                     =>  esc_html__('Button Text', 'dvmd-table-maker'),
                'description'               =>  $tbl_button_text,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_button',
                'type'                      => 'text',
                'default'                   => 'Default',
            ),

            'tbl_button_url'                =>  array(
                'label'                     =>  esc_html__('Button URL', 'dvmd-table-maker'),
                'description'               =>  $tbl_button_url,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_button',
                'type'                      => 'text',
                'default'                   => '#',
                'dynamic_content'           => 'url',
            ),

            'tbl_button_target'             =>  array(
                'label'                     =>  esc_html__('Button Target', 'dvmd-table-maker'),
                'description'               =>  $tbl_button_target,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_button',
                'type'                      => 'select',
                'default'                   => 'default',
                'options'                   =>  array(
                    'default'               =>  esc_html__('Default', 'dvmd-table-maker'),
                    '_self'                 =>  esc_html__('In The Same Window', 'et_builder'),
                    '_blank'                =>  esc_html__('In The New Tab', 'et_builder'),
                ),
            ),

            'tbl_button_width'              =>  array(
                'label'                     =>  esc_html__('Button Width', 'dvmd-table-maker'),
                'description'               =>  $tbl_button_width,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_button',
                'type'                      => 'multiple_buttons',
                'default'                   => 'inline-block',
                'options'                   =>  array(
                    'inline-block'          =>  array(
                        'title'             =>  esc_html__('Text Width', 'dvmd-table-maker'),
                    ),
                    'block'                 =>  array(
                        'title'             =>  esc_html__('Cell Width', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),


            //---------------------- Image ----------------------//


            'tbl_image_ids'                 =>  array(
                'label'                     =>  esc_html__('Images', 'et_builder'),
                'description'               =>  $tbl_image_ids,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_image',
                'type'                      => 'upload-gallery',
                'computed_affects'          => array(
                    '__tbl_image_src',
                ),
            ),

            'tbl_image_quality'             =>  array(
                'label'                     =>  esc_html__('Image Quality', 'dvmd-table-maker'),
                'description'               =>  $tbl_image_quality,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_image',
                'type'                      => 'select',
                'default'                   => 'medium',
                'options'                   =>  array(
                    'thumbnail'             =>  esc_html__('Thumbnail', 'dvmd-table-maker'),
                    'medium'                =>  esc_html__('Small', 'dvmd-table-maker'),
                    'medium_large'          =>  esc_html__('Medium', 'dvmd-table-maker'),
                    'large'                 =>  esc_html__('Large', 'dvmd-table-maker'),
                    'full'                  =>  esc_html__('Full Size', 'dvmd-table-maker'),
                ),
                'computed_affects'          => array(
                    '__tbl_image_src',
                ),
            ),

            '__tbl_image_src'               =>  array(
                'type'                      => 'computed',
                'computed_callback'         =>  array('DVMD_Table_Maker_Module', 'dvmd_tm_get_image_src'),
                'computed_depends_on'       =>  array(
                    'tbl_image_ids',
                    'tbl_image_quality',
                ),
            ),

            'tbl_image_proportion'          =>  array(
                'label'                     =>  esc_html__('Image Proportion', 'dvmd-table-maker'),
                'description'               =>  $tbl_image_proportion,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_image',
                'type'                      => 'select',
                'mobile_options'            =>  true,
                'default'                   => '75%',
                'options'                   =>  array(
                    '300%'                  =>  esc_html__('1:3 – Portrait', 'dvmd-table-maker'),
                    '200%'                  =>  esc_html__('1:2 – Portrait', 'dvmd-table-maker'),
                    '150%'                  =>  esc_html__('2:3 – Portrait', 'dvmd-table-maker'),
                    '133.3%'                =>  esc_html__('3:4 – Portrait', 'dvmd-table-maker'),
                    '125%'                  =>  esc_html__('4:5 – Portrait', 'dvmd-table-maker'),
                    '100%'                  =>  esc_html__('1:1 – Square', 'dvmd-table-maker'),
                    '80%'                   =>  esc_html__('5:4 – Landscape', 'dvmd-table-maker'),
                    '75%'                   =>  esc_html__('4:3 – Landscape', 'dvmd-table-maker'),
                    '66.7%'                 =>  esc_html__('3:2 – Landscape', 'dvmd-table-maker'),
                    '50%'                   =>  esc_html__('2:1 – Landscape', 'dvmd-table-maker'),
                    '33.3%'                 =>  esc_html__('3:1 – Landscape', 'dvmd-table-maker'),
                ),
            ),

            'tbl_image_scale'               =>  array(
                'label'                     =>  esc_html__('Image Scale', 'dvmd-table-maker'),
                'description'               =>  $tbl_image_scale,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_image',
                'type'                      => 'multiple_buttons',
                'default'                   => 'cover',
                'options'                   =>  array(
                    'contain'               =>  array(
                        'title'             =>  esc_html__('Fit', 'dvmd-table-maker'),
                    ),
                    'cover'                 =>  array(
                        'title'             =>  esc_html__('Fill', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  false,
                'multi_selection'           =>  false,
            ),

            'tbl_image_align_horz'          =>  array(
                'label'                     =>  esc_html__('Image Alignment (Horizontal)', 'dvmd-table-maker'),
                'description'               =>  $tbl_image_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_image',
                'type'                      => 'multiple_buttons',
                'default'                   => 'center',
                'options'                   =>  array(
                    'left'                  =>  array(
                        'title'             =>  esc_html__('Left', 'dvmd-table-maker'),
                    ),
                    'center'                =>  array(
                        'title'             =>  esc_html__('Center', 'dvmd-table-maker'),
                    ),
                    'right'                 =>  array(
                        'title'             =>  esc_html__('Right', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  false,
                'multi_selection'           =>  false,
            ),

            'tbl_image_align_vert'          =>  array(
                'label'                     =>  esc_html__('Image Alignment (Vertical)', 'dvmd-table-maker'),
                'description'               =>  $tbl_image_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'tbl_image',
                'type'                      => 'multiple_buttons',
                'default'                   => 'center',
                'options'                   =>  array(
                    'top'                   =>  array(
                        'title'             =>  esc_html__('Top', 'dvmd-table-maker'),
                    ),
                    'center'                =>  array(
                        'title'             =>  esc_html__('Center', 'dvmd-table-maker'),
                    ),
                    'bottom'                =>  array(
                        'title'             =>  esc_html__('Bottom', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  false,
                'multi_selection'           =>  false,
            ),


            //---------------------- Frame ----------------------//


            'tbl_frame_type'                =>  array(
                'label'                     =>  esc_html__('Frame Type', 'dvmd-table-maker'),
                'description'               =>  $tbl_frame_type,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_frame',
                'type'                      => 'multiple_buttons',
                'default'                   => 'gaps',
                'options'                   =>  array(
                    'none'                  =>  array(
                        'title'             =>  esc_html__('None', 'dvmd-table-maker'),
                    ),
                    'gaps'                  =>  array(
                        'title'             =>  esc_html__('Gaps', 'dvmd-table-maker'),
                    ),
                    'lines'                 =>  array(
                        'title'             =>  esc_html__('Lines', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  false,
                'multi_selection'           =>  false,
            ),

            'tbl_frame_gap_col'             =>  array(
                'label'                     =>  esc_html__('Column Gap', 'dvmd-table-maker'),
                'description'               =>  $tbl_frame_gap_col,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_frame',
                'show_if'                   =>  array(
                    'tbl_frame_type'        => 'gaps',
                ),
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'default_unit'              => 'px',
                'default'                   => '2px',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '50',
                    'step'                  => '1',
                ),
            ),

            'tbl_frame_gap_row'             =>  array(
                'label'                     =>  esc_html__('Row Gap', 'dvmd-table-maker'),
                'description'               =>  $tbl_frame_gap_row,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_frame',
                'show_if'                   =>  array(
                    'tbl_frame_type'        => 'gaps',
                ),
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'default_unit'              => 'px',
                'default'                   => '2px',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '50',
                    'step'                  => '1',
                ),
            ),

            'tbl_frame_line_style'          =>  array(
                'label'                     =>  esc_html__('Line Style', 'dvmd-table-maker'),
                'description'               =>  $tbl_frame_line_style,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_frame',
                'show_if'                   =>  array(
                    'tbl_frame_type'        => 'lines',
                ),
                'type'                      => 'select',
                'default'                   => 'solid',
                'options'                   =>  array(
                    'solid'                 =>  esc_html__('Solid', 'et_builder'),
                    'dashed'                =>  esc_html__('Dashed', 'et_builder'),
                    'dotted'                =>  esc_html__('Dotted', 'et_builder'),
                    'double'                =>  esc_html__('Double', 'et_builder'),
                    'groove'                =>  esc_html__('Dark/Light', 'et_builder'),
                    'ridge'                 =>  esc_html__('Light/Dark', 'et_builder'),
                    'inset'                 =>  esc_html__('Inset', 'dvmd-table-maker'),
                    'outset'                =>  esc_html__('Outset', 'dvmd-table-maker'),
                ),
            ),

            'tbl_frame_line_color'          =>  array(
                'label'                     =>  esc_html__('Line Color', 'dvmd-table-maker'),
                'description'               =>  $tbl_frame_line_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_frame',
                'show_if'                   =>  array(
                    'tbl_frame_type'        => 'lines',
                ),
                'type'                      => 'color-alpha',
            ),

            'tbl_frame_line_width'          =>  array(
                'label'                     =>  esc_html__('Line Width', 'dvmd-table-maker'),
                'description'               =>  $tbl_frame_line_width,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_frame',
                'show_if'                   =>  array(
                    'tbl_frame_type'        => 'lines',
                ),
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'default_unit'              => 'px',
                'default'                   => '1px',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '50',
                    'step'                  => '1',
                ),
            ),


            //---------------------- Color Stripes ----------------------//


            'tbl_stripes_active'            =>  array(
                'label'                     =>  esc_html__('Stripes', 'dvmd-table-maker'),
                'description'               =>  $tbl_stripes,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_stripes',
                'type'                      => 'yes_no_button',
                'default'                   => 'off',
                'options'                   =>  array(
                    'on'                    =>  esc_html__('On', 'dvmd-table-maker'),
                    'off'                   =>  esc_html__('Off', 'dvmd-table-maker'),
                ),
            ),

            'tbl_stripes_apply'             =>  array(
                'label'                     =>  esc_html__('Apply Stripes To', 'dvmd-table-maker'),
                'description'               =>  $tbl_stripes_apply,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_stripes',
                'show_if'                   =>  array(
                    'tbl_stripes_active'    => 'on',
                ),
                'type'                      => 'multiple_checkboxes',
                'default'                   => 'on|off|off|on|on',
                'options'                   =>  array(
                    'content'               =>  esc_html__('Table Content', 'dvmd-table-maker'),
                    'col_header'            =>  esc_html__('Column Headers', 'dvmd-table-maker'),
                    'col_footer'            =>  esc_html__('Column Footers', 'dvmd-table-maker'),
                    'row_header'            =>  esc_html__('Row Headers', 'dvmd-table-maker'),
                    'row_footer'            =>  esc_html__('Row Footers', 'dvmd-table-maker'),
                ),
            ),

            'tbl_stripes_order'             =>  array(
                'label'                     =>  esc_html__('Stripe Order', 'dvmd-table-maker'),
                'description'               =>  $tbl_stripes_order,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_stripes',
                'show_if'                   =>  array(
                    'tbl_stripes_active'    => 'on',
                ),
                'type'                      => 'multiple_buttons',
                'default'                   => 'even',
                'options'                   =>  array(
                    'odd'                   =>  array(
                        'title'             =>  esc_html__('Odd Rows', 'dvmd-table-maker'),
                    ),
                    'even'                  =>  array(
                        'title'             =>  esc_html__('Even Rows', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  false,
                'multi_selection'           =>  false,
            ),

            'tbl_stripes_hue'               =>  array(
                'label'                     =>  esc_html__('Stripe Hue', 'dvmd-table-maker'),
                'description'               =>  $tbl_stripes_hue,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_stripes',
                'show_if'                   =>  array(
                    'tbl_stripes_active'    => 'on',
                ),
                'type'                      => 'range',
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'allowed_units'             =>  array('deg'),
                'default_unit'              => 'deg',
                'default'                   => '0deg',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '359',
                    'step'                  => '1',
                ),
            ),

            'tbl_stripes_saturation'        =>  array(
                'label'                     =>  esc_html__('Stripe Saturation', 'dvmd-table-maker'),
                'description'               =>  $tbl_stripes_saturation,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_stripes',
                'show_if'                   =>  array(
                    'tbl_stripes_active'    => 'on',
                ),
                'type'                      => 'range',
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'allowed_units'             =>  array('%'),
                'default_unit'              => '%',
                'default'                   => '110%',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '200',
                    'step'                  => '1',
                ),
            ),

            'tbl_stripes_brightness'        =>  array(
                'label'                     =>  esc_html__('Stripe Brightness', 'dvmd-table-maker'),
                'description'               =>  $tbl_stripes_brightness,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_stripes',
                'show_if'                   =>  array(
                    'tbl_stripes_active'    => 'on',
                ),
                'type'                      => 'range',
                'allow_empty'               =>  false,
                'validate_unit'             =>  true,
                'allowed_units'             =>  array('%'),
                'default_unit'              => '%',
                'default'                   => '90%',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '200',
                    'step'                  => '1',
                ),
            ),


            //---------------------- Cell ----------------------//


            // Table.
            'tbl_tcell_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $tbl_tcell_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_tcell_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          => '#f6f9fb',
            ),

            'tbl_tcell_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_tcell_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_tcell_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_tcell_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_tcell_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_tcell_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_tcell_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $tbl_tcell_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_tcell_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                'default'                   => '',
                'default_on_front'          => '10px|10px|10px|10px',
            ),

            // Column Header.
            'tbl_chead_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $tbl_chead_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_chead_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          =>  et_builder_accent_color(), // '#6b35b6'
            ),

            'tbl_chead_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_chead_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_chead_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_chead_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_chead_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_chead_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_chead_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $tbl_chead_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_chead_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),

            // Row Header.
            'tbl_rhead_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $tbl_rhead_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rhead_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          =>  et_builder_accent_color(), // '#1fc3ab'
            ),

            'tbl_rhead_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_rhead_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rhead_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_rhead_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_rhead_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rhead_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_rhead_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $tbl_rhead_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rhead_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),

            // Column Footer.
            'tbl_cfoot_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $tbl_cfoot_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_cfoot_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          => '#d7e2ed',
            ),

            'tbl_cfoot_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_cfoot_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_cfoot_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_cfoot_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_cfoot_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_cfoot_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_cfoot_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $tbl_cfoot_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_cfoot_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),

            // Row Footer.
            'tbl_rfoot_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $tbl_rfoot_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rfoot_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          => '#d7e2ed',
            ),

            'tbl_rfoot_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_rfoot_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rfoot_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_rfoot_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_rfoot_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rfoot_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'tbl_rfoot_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $tbl_rfoot_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rfoot_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),


            //---------------------- Text ----------------------//


            // Table.
            'tbl_tcell_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $tbl_tcell_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_tcell_text',
                'type'                      => 'multiple_buttons',
                'default'                   => 'normal',
                'options'                   =>  array(
                    'normal'                =>  array(
                        'title'             =>  esc_html__('Wrap', 'dvmd-table-maker'),
                    ),
                    'nowrap'                =>  array(
                        'title'             =>  esc_html__('No Wrap', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),

            // Column Header.
            'tbl_chead_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $tbl_chead_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_chead_text',
                'type'                      => 'multiple_buttons',
                'default'                   => '',
                'options'                   =>  array(
                    'normal'                =>  array(
                        'title'             =>  esc_html__('Wrap', 'dvmd-table-maker'),
                    ),
                    'nowrap'                =>  array(
                        'title'             =>  esc_html__('No Wrap', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),

            // Row Header.
            'tbl_rhead_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $tbl_rhead_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rhead_text',
                'type'                      => 'multiple_buttons',
                'default'                   => '',
                'options'                   =>  array(
                    'normal'                =>  array(
                        'title'             =>  esc_html__('Wrap', 'dvmd-table-maker'),
                    ),
                    'nowrap'                =>  array(
                        'title'             =>  esc_html__('No Wrap', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),

            // Column Footer.
            'tbl_cfoot_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $tbl_cfoot_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_cfoot_text',
                'type'                      => 'multiple_buttons',
                'default'                   => '',
                'options'                   =>  array(
                    'normal'                =>  array(
                        'title'             =>  esc_html__('Wrap', 'dvmd-table-maker'),
                    ),
                    'nowrap'                =>  array(
                        'title'             =>  esc_html__('No Wrap', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),

            // Row Footer.
            'tbl_rfoot_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $tbl_rfoot_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_rfoot_text',
                'type'                      => 'multiple_buttons',
                'default'                   => '',
                'options'                   =>  array(
                    'normal'                =>  array(
                        'title'             =>  esc_html__('Wrap', 'dvmd-table-maker'),
                    ),
                    'nowrap'                =>  array(
                        'title'             =>  esc_html__('No Wrap', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),


            //---------------------- Accordion Toggle ----------------------//


            'tbl_toggle_align'              =>  array(
                'label'                     =>  esc_html__('Toggle Alignment', 'dvmd-table-maker'),
                'description'               =>  $tbl_toggle_align,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_toggle',
                'type'                      => 'text_align',
                'default'                   => 'right',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified', 'center')),
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
                'show_if'                           =>  array(
                    'tbl_responsive_display_as'     => 'accordion',
                ),
            ),

            'tbl_toggle_size'               =>  array(
                'label'                     =>  esc_html__('Toggle Size', 'dvmd-table-maker'),
                'description'               =>  $tbl_toggle_size,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_toggle',
                'type'                      => 'range',
                'default'                   => '24px',
                'range_settings'            =>  array(
                    'min'                   => '1',
                    'max'                   => '120',
                    'step'                  => '1',
                ),
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'default_unit'              => 'px',
                'mobile_options'            =>  true,
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
                'show_if'                           =>  array(
                    'tbl_responsive_display_as'     => 'accordion',
                ),
            ),

            'tbl_toggle_color'              =>  array(
                'label'                     =>  esc_html__('Toggle Color', 'dvmd-table-maker'),
                'description'               =>  $tbl_toggle_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_toggle',
                'type'                      => 'color-alpha',
                'mobile_options'            =>  true,
                'default'                   => '#ffffff',
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
                'show_if'                           =>  array(
                    'tbl_responsive_display_as'     => 'accordion',
                ),
            ),

            'tbl_toggle_icon_open'          =>  array(
                'label'                     =>  esc_html__('Toggle Icon (Open)', 'dvmd-table-maker'),
                'description'               =>  $tbl_toggle_icon_open,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_toggle',
                'type'                      => 'select_icon',
                'default'                   =>  $tbl_toggle_icon_open_default,
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
                'show_if'                           =>  array(
                    'tbl_responsive_display_as'     => 'accordion',
                ),
            ),

            'tbl_toggle_icon_close'         =>  array(
                'label'                     =>  esc_html__('Toggle Icon (Close)', 'dvmd-table-maker'),
                'description'               =>  $tbl_toggle_icon_close,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'tbl_toggle',
                'type'                      => 'select_icon',
                'default'                   =>  $tbl_toggle_icon_close_default,
                'show_if_not'                       =>  array(
                    'tbl_responsive_breakpoint'     => 'none',
                ),
                'show_if'                           =>  array(
                    'tbl_responsive_display_as'     => 'accordion',
                ),
            ),

        );


        // Return
        return $fields;
    }


    /**
     * Transition fields
     *
     * @since 2.0.1
     *
     * @return   array   Fields to apply Transitions settings to.
     */
    public function get_transition_fields_css_props() {

        $fld = parent::get_transition_fields_css_props();

        $fld['tbl_icon_color'] = array(
            'color' => '%%order_class%% .dvmd_tm_icon',
        );

        return $fld;
    }


    /**
     * Render module output
     *
     * @since 2.0.3
     *
     * @param array  $attrs       List of unprocessed attributes
     * @param string $content     Content being processed
     * @param string $render_slug Slug of module that is used for rendering output
     *
     * @return string module's rendered output
     */
    function render($attrs, $content, $render_slug) {


        // Render Properties
        $rs             = $render_slug;
        $a['render']    = $render_slug;


        //---------------------- Min/Max Values ----------------------//


        // Table row.
        $trmins = $this->dvmd_tm_get_responsive($this->props, 'tbl_row_min_height');
        $trmaxs = $this->dvmd_tm_get_responsive($this->props, 'tbl_row_max_height');
        $this->dvmd_tm_fleshout_responsive($trmins);
        $this->dvmd_tm_fleshout_responsive($trmaxs);
        $rgrid = array('desktop' => '', 'tablet' => '', 'phone' => '');
        $empty = array('desktop' => '', 'tablet' => '', 'phone' => '');
        $rgrid['desktop'] .= $this->dvmd_tm_get_grid('desktop', $trmins, $trmaxs, $empty, $empty, '50px', 'auto');
        $rgrid['tablet']  .= $this->dvmd_tm_get_grid('tablet',  $trmins, $trmaxs, $empty, $empty, '50px', 'auto');
        $rgrid['phone']   .= $this->dvmd_tm_get_grid('phone',   $trmins, $trmaxs, $empty, $empty, '50px', 'auto');

        // Table column.
        $tcmins = $this->dvmd_tm_get_responsive($this->props, 'tbl_column_min_width');
        $tcmaxs = $this->dvmd_tm_get_responsive($this->props, 'tbl_column_max_width');
        $this->dvmd_tm_fleshout_responsive($tcmins);
        $this->dvmd_tm_fleshout_responsive($tcmaxs);


        //---------------------- Columns Content ----------------------//


        /**
         * Prepare column content for parsing.
         *
         * Each column content comes wrapped in outer and inner html.
         * We need to remove the wrapping and get an array of just the data.
         * The data we need is wrapped in [kabooom] tags, like this…
         * [kabooom]data[kabooom]junk[kabooom]data[kabooom]junk[kabooom] etc...
         * We explode the content, unset the junk, then reindex the array.
         */
        $cols = $this->content;
        $cols = explode('[kabooom]', $cols);
        $c = count($cols);
        for ($i = 0; $i < $c; $i++) if (($i % 2) == 0) unset ($cols[$i]);
        $cols = array_values($cols);


        /**
         * Parse the column data.
         * Get the table’s max row count.
         * Prepare the table’s grid-template-columns values.
         */

        $mrows = 0;
        $cgrid = array('desktop' => '', 'tablet' => '', 'phone' => '');

        foreach ($cols as $c => $col) {

            // Get column data.
            $cols[$c] = json_decode($col, true);

            // Get row count.
            $mrows = max($cols[$c]['count'], $mrows);

            // Get column min/max.
            $cmins = $cols[$c]['mins'];
            $cmaxs = $cols[$c]['maxs'];
            $this->dvmd_tm_fleshout_responsive($cmins);
            $this->dvmd_tm_fleshout_responsive($cmaxs);
            $cgrid['desktop'] .= $this->dvmd_tm_get_grid('desktop', $cmins, $cmaxs, $tcmins, $tcmaxs, '100px', '1fr');
            $cgrid['tablet']  .= $this->dvmd_tm_get_grid('tablet',  $cmins, $cmaxs, $tcmins, $tcmaxs, '100px', '1fr');
            $cgrid['phone']   .= $this->dvmd_tm_get_grid('phone',   $cmins, $cmaxs, $tcmins, $tcmaxs, '100px', '1fr');
        }


        //---------------------- Table Attributes ----------------------//


        // Attributes.
        $a['ccount']  = count($cols);
        $a['rcount']  = $mrows;
        $a['cheads']  = $this->props['tbl_column_header_count'];
        $a['rheads']  = $this->props['tbl_row_header_count'];
        $a['cfoots']  = $this->props['tbl_column_footer_count'];
        $a['rfoots']  = $this->props['tbl_row_footer_count'];
        $a['cheads']  = max(0, min($a['cheads'], $a['rcount']-1));
        $a['rheads']  = max(0, min($a['rheads'], $a['ccount']-1));
        $a['cfoots']  = max(0, $a['rcount']-$a['cfoots']-1);
        $a['rfoots']  = max(0, $a['ccount']-$a['rfoots']-1);
        $a['breakpt'] = $this->props['tbl_responsive_breakpoint'];
        $a['display'] = $this->props['tbl_responsive_display_as'];
        $a['breakby'] = $this->props['tbl_responsive_break_by'];

        // Responsive attributes.
        $a['responsive'] = ($a['breakpt'] != 'none');
        if ($a['responsive']) $a['mquery'] = ET_Builder_Element::get_media_query($a['breakpt']);
        if (($a['cheads'] == 0) && ($a['rheads'] == 0)) $a['display'] = 'blocks';
        if (($a['display'] == 'accordion') && ($a['cheads'] == 0)) $a['breakby'] = 'row';
        if (($a['display'] == 'accordion') && ($a['rheads'] == 0)) $a['breakby'] = 'column';


        //------------------------------------------------------------//
        //---------------------- Core Functions ----------------------//
        //------------------------------------------------------------//


        /**
         * Dimension the table array by column/row.
         */
        $table = array_fill(0, $a['rcount'], null);
        $table = array_fill(0, $a['ccount'], $table);


        /**
         * Build table cells from a column’s row data.
         * Populate the table array with the built cells.
         * Table array is passed byref.
         */
        for ($c = 0; $c < $a['ccount']; $c++) :

            // Column attributes.
            $a['cslug']             = $cols[$c]['slug'];
            $a['col_button']        = $cols[$c]['col_button'];
            $a['col_button_text']   = $cols[$c]['col_button_text'];
            $a['col_button_url']    = $cols[$c]['col_button_url'];
            $a['col_button_target'] = $cols[$c]['col_button_target'];

            for ($r = 0; $r < $a['rcount']; $r++) :

                // Get cell type.
                if (($c < $a['rheads']) && ($r < $a['cheads'])):
                    $ctype = 'crhead';
                elseif ($r < $a['cheads']):
                    $ctype = 'chead';
                elseif ($c < $a['rheads']):
                    $ctype = 'rhead';
                elseif (($r > $a['cfoots']) && ($c > $a['rfoots'])):
                    $ctype = 'cfoot dvmd_tm_rfoot';
                elseif ($r > $a['cfoots']):
                    $ctype = 'cfoot';
                elseif ($c > $a['rfoots']):
                    $ctype = 'rfoot';
                else:
                    $ctype = 'tdata';
                endif;

                // Skip cells if…
                if ($ctype == 'crhead') continue;
                if ($table[$c][$r] !== null) continue;

                // Cell attributes.
                $a['ctype'] = $ctype;
                $a['cdata'] = isset($cols[$c]['rows'][$r]) ? $cols[$c]['rows'][$r] : '';

                // Build the cell.
                $tcell = $this->dvmd_tm_get_tcell_html($a, $c, $r);
                $this->dvmd_tm_build_tcell_inner($a, $c, $r, $tcell);
                $this->dvmd_tm_build_tcell_outer($a, $c, $r, $tcell, $table);

            endfor;
        endfor;


        /**
         * Generalise table properties.
         *
         * Table properties are generalised so that, where possible,…
         * code can be used for both col-ordered and row-ordered tables.
         */
        if ($a['breakby'] == 'column') {
            $xorder = 'column';
            //$yorder = 'row';
            $xcount = $a['ccount'];
            $ycount = $a['rcount'];
            $offset = $a['rheads'];
            $bcount = $xcount-$offset;

        } else {
            $xorder = 'row';
            //$yorder = 'column';
            $xcount = $a['rcount'];
            $ycount = $a['ccount'];
            $offset = $a['cheads'];
            $bcount = $xcount-$offset;
        }


        /**
         * Build the table body from the table array.
         *
         * If table is not responsive, it is wrapped in a single block.
         * If table is responsive, it is seperate into discrete blocks.
         * If ordered by column, any row headers are duplicated per-block.
         * If ordered by row, any column headers are duplicated per-block.
         */

        $cells = '';
        $tbody = '';
        $block = "<div class='dvmd_tm_tblock dvmd_tm_{$xorder[0]}block'>%s</div>";

        if (!$a['responsive']):

            // Build table body.
            for ($x = 0; $x < $xcount; $x++) {
                for ($y = 0; $y < $ycount; $y++) {
                    $cells .= ($xorder == 'column') ? $table[$x][$y] : $table[$y][$x];
                }
            }

            // Print table body.
            $tbody = sprintf($block, $cells);

        else:

            // Build table body.
            for ($b = 0; $b < $bcount; $b++) {
                for ($y = 0; $y < $ycount; $y++) {
                    for ($o = 0; $o <= $offset; $o++) {
                        if ($o < $offset) {
                            $cells .= ($xorder == 'column') ? $table[$o][$y] : $table[$y][$o];
                        } else {
                            $cells .= ($xorder == 'column') ? $table[$offset+$b][$y] : $table[$y][$offset+$b];
                        }
                    }
                }

                // Print table body.
                $tbody .= sprintf($block, $cells);
                $cells  = '';
            }

        endif;


        //-----------------------------------------------------------//
        //---------------------- Styles Output ----------------------//
        //-----------------------------------------------------------//


        // Properties.
        $props = $this->props;
        $order_class = ET_Builder_Element::get_module_order_class($render_slug);


        //---------------------- Table Grid ------------------------//


        // Table Grid.
        $s = '%%order_class%% .dvmd_tm_table';
        $this->dvmd_tm_set_responsive($rs, $s, 'grid-template-columns', $cgrid, '', 'custom');
        $this->dvmd_tm_set_responsive($rs, $s, 'grid-auto-rows', $rgrid, '', 'custom');


        //-------------------- Table Grid (Responsive) --------------------//


        if ($a['responsive']) {

            // Disable grid on table element.
            $s = '%%order_class%% .dvmd_tm_table';
            $d = 'display: contents;';
            $this->dvmd_tm_set_style_declaration($rs, $s, $d, $a['mquery']);

            // Override cell’s inline grid-area style.
            $s = '%%order_class%% .dvmd_tm_tcell';
            $d = 'grid-area: auto !important;';
            $this->dvmd_tm_set_style_declaration($rs, $s, $d, $a['mquery']);

            // Enable grid on block elements.
            $s = "%%order_class%% .dvmd_tm_{$xorder[0]}block";
            $d = 'display: grid;';
            $this->dvmd_tm_set_style_declaration($rs, $s, $d, $a['mquery']);

            // Set block grid-template-columns.
            $r = $offset+1;
            $v = "repeat({$r}, minmax(50px, 1fr))";
            $this->dvmd_tm_set_style($rs, $s, 'grid-template-columns', esc_html($v), $a['mquery']);

            // Set block grid-auto-rows.
            $this->dvmd_tm_set_responsive($rs, $s, 'grid-auto-rows', $rgrid, '', 'custom');

            // Set header’s start/end column.
            $e = $offset+2;
            $s = "%%order_class%% .dvmd_tm_tblock .dvmd_tm_{$xorder[0]}head";
            $v = "1/{$e} !important";
            $this->dvmd_tm_set_style($rs, $s, 'grid-column', esc_html($v), $a['mquery']);

            // Block/Accordion margin.
            $s = '%%order_class%% .dvmd_tm_tblock:not(:first-child)';
            $v = $this->dvmd_tm_get_responsive($props, 'tbl_responsive_block_margin');
            $this->dvmd_tm_set_responsive($rs, $s, 'margin-top', $v, '', 'range');

            // Blocks.
            if ($a['display'] == 'blocks') {

                // Reset table element styles.
                $s = '%%order_class%%';
                $d = 'padding: 0; margin: 0; border: none; background: none; box-shadow: none;';
                $this->dvmd_tm_set_style_declaration($rs, $s, $d, $a['mquery']);

            } else {

                // Reset table element styles.
                $s = '%%order_class%% .dvmd_tm_tblock';
                $d = 'padding: 0; margin: 0; border: none; background: none; box-shadow: none;';
                $this->dvmd_tm_set_style_declaration($rs, $s, $d, $a['mquery']);
            }
        }


        //---------------------- Table Scrolling ------------------------//


        // Scrolling.
        if ('on' == $props['tbl_scrolling_active']) {
            $s = '%%order_class%% .dvmd_tm_table';
            $d = 'overflow: auto;';
            $this->dvmd_tm_set_style_declaration($rs, $s, $d);
        }

        // Sticky Column Headers.
        if ('on' == $props['tbl_scrolling_col_sticky']) {
            $s = '%%order_class%% .dvmd_tm_chead';
            $d = 'position: sticky; top: 0; z-index: 999;';
            $this->dvmd_tm_set_style_declaration($rs, $s, $d);
        }

        // Sticky Row Headers.
        if ('on' == $props['tbl_scrolling_row_sticky']) {
            $s = '%%order_class%% .dvmd_tm_rhead';
            $d = 'position: sticky; left: 0; z-index: 999;';
            $this->dvmd_tm_set_style_declaration($rs, $s, $d);
        }


        //---------------------- Table Frame ------------------------//


        // Gaps.
        if ('gaps' == $props['tbl_frame_type']) {

            // Gaps.
            $cg = $this->dvmd_tm_get_responsive($props, 'tbl_frame_gap_col');
            $rg = $this->dvmd_tm_get_responsive($props, 'tbl_frame_gap_row');

            // Apply to table element.
            $s = '%%order_class%% .dvmd_tm_table';
            $this->dvmd_tm_set_responsive($rs, $s, 'column-gap', $cg, '', 'range');
            $this->dvmd_tm_set_responsive($rs, $s, 'row-gap', $rg, '', 'range');

            // Apply to block elements.
            if ($a['responsive']) {
                $s = '%%order_class%% .dvmd_tm_tblock';
                $this->dvmd_tm_set_responsive($rs, $s, 'column-gap', $cg, '', 'range');
                $this->dvmd_tm_set_responsive($rs, $s, 'row-gap', $rg, '', 'range');
            }
        }

        // Lines.
        if ('lines' == $props['tbl_frame_type']) {

            // Set color.
            $s = '%%order_class%% .dvmd_tm_tcell';
            $v = $props['tbl_frame_line_color'];
            $this->dvmd_tm_set_style($rs, $s, 'outline-color', esc_html($v));

            // Set style.
            $v = $props['tbl_frame_line_style'];
            $this->dvmd_tm_set_style($rs, $s, 'outline-style', esc_html($v));

            // Set width.
            $v = $this->dvmd_tm_get_responsive($props, 'tbl_frame_line_width');
            $this->dvmd_tm_set_responsive($rs, $s, 'outline-width', $v, '', 'range');

            // Prepare offset and padding responsive values.
            foreach ($v as $i => $w) {
                if ($w) {
                    $unit  = preg_replace('/[0-9]+/', '', $w);
                    $value = preg_replace('/[^0-9.]/', '', $w);
                    $value = $value/2;
                    $offsets[$i] = "-{$value}{$unit}";
                    $padding[$i] = "{$value}{$unit}";
                }
            }

            // Set offset.
            $this->dvmd_tm_set_responsive($rs, $s, 'outline-offset', $offsets);

            // Set padding.
            $s = '%%order_class%% .dvmd_tm_table';
            $this->dvmd_tm_set_responsive($rs, $s, 'padding', $padding);
        }


        //---------------------- Table Text & Cell ------------------------//


        $types = array('tcell', 'rhead', 'chead', 'rfoot', 'cfoot');
        $order = array('', '21', '22', '23', '24');

        foreach ($types as $i => $type):

            // Classes.
            $classes = "%%order_class%% .dvmd_tm_{$type}";
            if ($type !== 'tcell') $classes = "%%order_class%% .dvmd_tm_tcell.dvmd_tm_{$type}";

            // Text wrap.
            $v = $props["tbl_{$type}_text_wrap"];
            if ($v) {
                $s = "{$classes} .dvmd_tm_cdata";
                $this->dvmd_tm_set_style($rs, $s, 'white-space', esc_html($v), null, $order[$i]);
            }

            // Cell Color.
            $s = $classes;
            $v = $props["tbl_{$type}_cell_color"];
            if ($v) $this->dvmd_tm_set_style($rs, $s, 'background', esc_html($v), null, $order[$i]);

            // Cell Horizontal alignment.
            $v = $props["tbl_{$type}_cell_align_horz"];
            if ($v) $this->dvmd_tm_set_style($rs, $s, 'text-align', esc_html($v), null, $order[$i]);

            // Cell Vertical alignment.
            $v = $props["tbl_{$type}_cell_align_vert"];
            if ($v) {
                if ($v == 'left')  $v = 'flex-start';
                if ($v == 'right') $v = 'flex-end';
                $this->dvmd_tm_set_style($rs, $s, 'justify-content', esc_html($v), null, $order[$i]);
            }

            // Cell Padding.
            $this->dvmd_tm_set_margin_padding($rs, "tbl_{$type}_cell_padding", $s, 'padding', false, $order[$i]);

        endforeach;


        //---------------------- Table Stripes ------------------------//


        if ('on' == $props['tbl_stripes_active']) {

            // Filter.
            $hue = $props['tbl_stripes_hue'];
            $sat = $props['tbl_stripes_saturation'];
            $brt = $props['tbl_stripes_brightness'];
            $hue = "hue-rotate({$hue})";
            $sat = "saturate({$sat})";
            $brt = "brightness({$brt})";
            $v   = "{$hue} {$sat} {$brt}";

            // Appply to…
            $order = esc_html($props['tbl_stripes_order']);
            $apply = $props['tbl_stripes_apply'];
            $s = array(
                "%%order_class%% .dvmd_tm_tdata.dvmd_tm_row_{$order}",
                "%%order_class%% .dvmd_tm_chead.dvmd_tm_row_{$order}",
                "%%order_class%% .dvmd_tm_cfoot.dvmd_tm_row_{$order}",
                "%%order_class%% .dvmd_tm_rhead.dvmd_tm_row_{$order}",
                "%%order_class%% .dvmd_tm_rfoot.dvmd_tm_row_{$order}"
            );
            $s = $this->process_multiple_checkboxes_field_value($s, $apply );
            $s = str_replace('|', ', ', $s);

            // Desktop
            $this->dvmd_tm_set_style($rs, $s, 'filter', esc_html($v));

            // Responsive break by row.
            if ($a['responsive'] && $a['breakby'] === 'row') {

                // Reset.
                $reset = 'hue-rotate(0deg) saturate(100%) brightness(100%)';
                $this->dvmd_tm_set_style($rs, $s, 'filter', $reset, $a['mquery']);

                // Tablet or Phone.
                $s = array(
                    "%%order_class%% .dvmd_tm_tdata.dvmd_tm_col_{$order}",
                    "%%order_class%% .dvmd_tm_rhead.dvmd_tm_col_{$order}",
                    "%%order_class%% .dvmd_tm_rfoot.dvmd_tm_col_{$order}",
                    "%%order_class%% .dvmd_tm_chead.dvmd_tm_col_{$order}",
                    "%%order_class%% .dvmd_tm_cfoot.dvmd_tm_col_{$order}"
                );
                $s = $this->process_multiple_checkboxes_field_value($s, $apply );
                $s = str_replace('|', ', ', $s);
                $this->dvmd_tm_set_style($rs, $s, 'filter', esc_html($v), $a['mquery']);
            }
        }


        //---------------------- Table Icon ----------------------//


        // Icon.
        if ($props['tbl_icon_type']) {

            $icon = $props['tbl_icon_type'];
            $s = '%%order_class%% .dvmd_tm_icon.ei-default:before';

            // Pre 4.13.
            if (false === strpos($icon, '||')) {

                // Icon value.
                $icon = html_entity_decode(esc_attr(et_pb_process_font_icon($icon)));
                $this->dvmd_tm_set_style($rs, $s, 'content', "'{$icon}'");
            }

            // Post 4.13.
            elseif (function_exists('et_pb_get_extended_font_icon_value')) {

                // Icon value.
                $icon = esc_attr(et_pb_get_extended_font_icon_value($icon, true));
                $this->dvmd_tm_set_style($rs, $s, 'content', "'{$icon}'");

                // Icon styles.
                $this->generate_styles(array(
                    'utility_arg'    => 'icon_font_family',
                    'render_slug'    =>  $rs,
                    'base_attr_name' => 'tbl_icon_type',
                    'selector'       =>  $s,
                    'important'      =>  true,
                    'processor'      =>  array(
                        'ET_Builder_Module_Helper_Style_Processor',
                        'process_extended_icon',
                    ),
                ));
            }
        }

        // Icon size.
        $s = '%%order_class%% .dvmd_tm_icon';
        $v = $this->dvmd_tm_get_responsive($props, 'tbl_icon_size');
        $this->dvmd_tm_set_responsive($rs, $s, 'font-size', $v, '', 'range');

        // Icon color.
        $v = $this->dvmd_tm_get_responsive($props, 'tbl_icon_color');
        $this->dvmd_tm_set_responsive($rs, $s, 'color', $v, '', 'color');

        // Icon color hover.
        if (et_builder_is_hover_enabled('tbl_icon_color', $props)) {
            $s = '%%order_class%% .dvmd_tm_icon:hover';
            $v = $this->get_hover_value('tbl_icon_color');
            $this->dvmd_tm_set_style($rs, $s, 'color', esc_html($v));
        }


        //---------------------- Table Button ----------------------//


        // Button width.
        if ('block' == $props['tbl_button_width']) {
            $s = '%%order_class%% .dvmd_tm_button';
            $d = 'display: block;';
            $this->dvmd_tm_set_style_declaration($rs, $s, $d);
        }


        //---------------------- Table Image ----------------------//


        if ($props['tbl_image_ids']) {

            // Image proportion.
            $s = '%%order_class%% .dvmd_tm_image';
            $v = $this->dvmd_tm_get_responsive($props, 'tbl_image_proportion');
            $this->dvmd_tm_set_responsive($rs, $s, 'padding-top', $v, '', 'custom');

            // Image size.
            $v = $props['tbl_image_scale'];
            if ($v) $this->dvmd_tm_set_style($rs, $s, 'background-size', esc_html($v));

            // Image alignment.
            $x = $props['tbl_image_align_horz'];
            $y = $props['tbl_image_align_vert'];
            $v = "{$x} {$y}";
            $this->dvmd_tm_set_style($rs, $s, 'background-position', esc_html($v));
        }


        //---------------------- Table Accordion ----------------------//


        if ('none' !== $a['breakpt'] && 'accordion' == $a['display']) {

            //------------ Close ------------//

            $icon = $props['tbl_toggle_icon_close'];
            $s = '%%order_class%% .dvmd_tm_accordion .dvmd_tm_active .dvmd_tm_tcell:first-child:after';

            // Pre 4.13.
            if (false === strpos($icon, '||')) {

                // Icon value.
                $icon = html_entity_decode(esc_attr(et_pb_process_font_icon($icon)));
                $this->dvmd_tm_set_style($rs, $s, 'content', "'{$icon}'", $a['mquery']);
            }

            // Post 4.13.
            elseif (function_exists('et_pb_get_extended_font_icon_value')) {

                // Icon value.
                $icon = esc_attr(et_pb_get_extended_font_icon_value($icon, true));
                $this->dvmd_tm_set_style($rs, $s, 'content', "'{$icon}'", $a['mquery']);

                // Icon styles.
                $this->generate_styles(array(
                    'utility_arg'    => 'icon_font_family',
                    'render_slug'    =>  $rs,
                    'base_attr_name' => 'tbl_toggle_icon_close',
                    'selector'       =>  $s,
                    'important'      =>  true,
                    'processor'      =>  array(
                        'ET_Builder_Module_Helper_Style_Processor',
                        'process_extended_icon',
                    ),
                ));
            }

            //------------ Open ------------//

            $icon = $props['tbl_toggle_icon_open'];
            $s = '%%order_class%% .dvmd_tm_accordion .dvmd_tm_tcell:first-child:after';

            // Pre 4.13.
            if (false === strpos($icon, '||')) {

                // Open.
                $icon = html_entity_decode(esc_attr(et_pb_process_font_icon($icon)));
                $this->dvmd_tm_set_style($rs, $s, 'content', "'{$icon}'", $a['mquery']);
            }

            // Post 4.13.
            elseif (function_exists('et_pb_get_extended_font_icon_value')) {

                // Icon value.
                $icon = esc_attr(et_pb_get_extended_font_icon_value($icon, true));
                $this->dvmd_tm_set_style($rs, $s, 'content', "'{$icon}'", $a['mquery']);

                // Icon styles.
                $this->generate_styles(array(
                    'utility_arg'    => 'icon_font_family',
                    'render_slug'    =>  $rs,
                    'base_attr_name' => 'tbl_toggle_icon_open',
                    'selector'       =>  $s,
                    'important'      =>  true,
                    'processor'      =>  array(
                        'ET_Builder_Module_Helper_Style_Processor',
                        'process_extended_icon',
                    ),
                ));
            }

            //------------ Style ------------//

            // Alignment.
            $v = $props['tbl_toggle_align'];
            $v = ('right' == $v) ? 'flex-end' : 'flex-start';
            $this->dvmd_tm_set_style($rs, $s, 'align-self', $v, $a['mquery']);

            // Size.
            $v = $this->dvmd_tm_get_responsive($props, 'tbl_toggle_size');
            $this->dvmd_tm_set_responsive($rs, $s, 'font-size', $v, '', 'range');

            // Color.
            $v = $this->dvmd_tm_get_responsive($props, 'tbl_toggle_color');
            $this->dvmd_tm_set_responsive($rs, $s, 'color', $v, '', 'color');
        }


        //-------------------------------------------------------------------//
        //---------------------- Main Element Output ------------------------//
        //-------------------------------------------------------------------//


        /**
         * Print the Table Maker html element.
         */
        $output = sprintf('
            <div role="table" class="dvmd_tm_table%1$s%2$s">
                %3$s
            </div>',
            /* 01 */ ($a['responsive']) ? esc_attr(" dvmd_tm_{$a['breakpt']}") : '',
            /* 01 */ esc_attr(" dvmd_tm_{$a['display']}"),
            /* 02 */ $tbody
        );

        // Return.
        return $output;
    }


    //------------------------------------------------------------------//
    //---------------------- Table-Grid Functions ----------------------//
    //------------------------------------------------------------------//


    /**
     * Returns a min/max value pair for a specific media query.
     * Checks three sets of mix/max properties to find the first…
     * with a 'defined' value.
     *
     * @since    2.0.0
     * @access   public
     *
     * @param    string   $media   The media query to check. (desktop/tablet/phone)
     * @param    array    $min1    1st user specified min value.
     * @param    array    $max1    1st user specified max value.
     * @param    array    $min2    2nd user specified min value.
     * @param    array    $max2    2nd user specified max value.
     * @param    string   $min3    Default min value.
     * @param    string   $max3    Default max value.
     *
     * @return   array    Responsive minmax() values.
     */
    private function dvmd_tm_get_grid($media, $min1, $max1, $min2, $max2, $min3, $max3) {
        $min = $this->dvmd_tm_get_grid_value($min1[$media], $min2[$media], $min3);
        $max = $this->dvmd_tm_get_grid_value($max1[$media], $max2[$media], $max3);
        return "minmax({$min}, {$max}) ";
    }


    /**
     * Finds the first 'defined' properties out of three.
     *
     * @since    2.0.0
     * @access   public
     *
     * @param    string     $p1    1st property to check.
     * @param    string     $p2    2nd property to check.
     * @param    string     $p3    3rd property to check.
     *
     * @return   string     The defined property.
     */
    private function dvmd_tm_get_grid_value($p1, $p2, $p3) {
        return ($p1) ? $p1 : (($p2) ? $p2 : $p3);
    }


    //------------------------------------------------------------------//
    //---------------------- Table-Cell Functions ----------------------//
    //------------------------------------------------------------------//


    /**
     * Safely loads html data as DOM document.
     *
     * @since   2.0.1
     * @access  private
     *
     * @param   var       $html   Unset variable for DOM document object. (byref)
     * @param   integer   $data   The raw html data.
     * @param   array     $c      The current column index.
     * @param   integer   $r      The current row index.
     *
     * @return  boolean   Whether data was succesfully loaded.
     */
    private function dvmd_tm_load_html(&$html, $data, $c, $r) {

        // Setup.
        $data = mb_convert_encoding($data, 'HTML-ENTITIES', 'UTF-8');
        $html = new DOMDocument('1.0', 'utf-8');
        libxml_use_internal_errors(true);

        // Try.
        if ($html->LoadHTML($data)) {
            $this->dvmd_tm_clean_html($html);
            return true;
        }

        // Error: Escape data.
        $data = esc_html($data);
        $data = "<div>$data</div>";

        // Try again.
        if ($html->LoadHTML($data)) {
            $this->dvmd_tm_clean_html($html);
            return false;
        }

        // Error: Prepare error.
        $error = sprintf(
            esc_html('%sError:%s Please check your data entry in Column %s / Row %s.%s', 'dvmd-table-maker'),
            /* 01 */ '<div><p><strong>',
            /* 02 */ '</strong>',
            /* 03 */  $c+1,
            /* 04 */  $r+1,
            /* 05 */ '</p></div>'
        );

        // Try again.
        if ($html->LoadHTML($error)) {
            $this->dvmd_tm_clean_html($html);
            return false;
        }

        // Error: Prepare error.
        $error = sprintf(
            esc_html__('%1$s%2$s%3$sSorry!%4$s%5$sFatal Error:%6$s Divi-Modules – Table Maker requires %7$sPHP Version 5.6 (or higher)%8$s and the %7$sPHP DOM Extension%8$s to be enabled. Please check with your hosting provider that your %7$sPHP%8$s is correctly configured for this product. If problems persist, please contact Divi-Modules for support: %9$shttps://divi-modules.com/contact/%10$s', 'dvmd-table-maker'),
            /* 01 */ '<div style="margin:1rem;padding:1rem;background:#FFFF99;border: solid 2px #333;">',
            /* 02 */ '<div style="max-width:780px;margin:auto;text-align:center;">',
            /* 03 */ '<h3 style="color:#333;"><i>',
            /* 04 */ '</i></h3>',
            /* 05 */ '<p style="color:#333;"><strong>',
            /* 06 */ '</strong>',
            /* 07 */ '<i>',
            /* 08 */ '</i>',
            /* 09 */ '<a style="color:#2ea3f2;" href="https://divi-modules.com/contact/" target="_blank">',
            /* 10 */ '</a>.</p></div></div>'
        );

        // Die.
        die(et_core_esc_previously($error));
    }


    /**
     * Manually removes the doctype, html and body elements from the html.
     * We could use LoadHTML($data, LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED).
     * However, this would add a dependency on libxml version 2.7.7.
     *
     * @since   2.0.1
     * @access  private
     *
     * @param   var    $html   DOM document object. (byref)
     *
     * @return  void
     */
    private function dvmd_tm_clean_html(&$html) {
        $html->removeChild($html->doctype);
        $html->replaceChild($html->firstChild->firstChild->firstChild, $html->firstChild);
    }


    /**
     * Converts a single row of table column data into a DOM document.
     *
     * The data is wrapped in either a <div> or <h#> element which…
     * is then wrapped in an outer <div> element. If the data comes…
     * pre-wrapped in a <cell> element, the <cell> attributes are…
     * copied to the outer <div> before the <cell> and any data…
     * outside of it is removed.
     *
     * @since    2.0.1
     * @access   private
     *
     * @param    array      $a   The table attributes array.
     * @param    integer    $c   The current column index.
     * @param    integer    $r   The current row index.
     *
     * @return   document   The table cell as a DOM document.
     */
    private function dvmd_tm_get_tcell_html($a, $c, $r) {

        // Get cell tag.
        switch ($a['ctype']) {
            case 'chead':
                $ctag = esc_html($this->props['tbl_chead_text_level']);
                break;
            case 'rhead':
                $ctag = esc_html($this->props['tbl_rhead_text_level']);;
                break;
            default:
                $ctag = 'div';
        }

        // Prepare table data.
        $cdata = trim($a['cdata']);
        $cdata = "<{$ctag}>{$cdata}</{$ctag}>";

        // Get DOM document.
        if ($this->dvmd_tm_load_html($tcell, $cdata, $c, $r)) {

            // Get cells, in any.
            $cell = $tcell->getElementsByTagName('cell');

            // Change cell tag type.
            if ($cell->length > 0) {
                $cdata = $tcell->saveHTML($cell[0]);
                $cdata = str_replace('<cell ', "<{$ctag} ", $cdata);
                $cdata = str_replace('<cell>', "<{$ctag}>", $cdata);
                $cdata = str_replace('</cell>', "</{$ctag}>", $cdata);
            }

            // Re-prepare table data.
            $cdata = "<div>{$cdata}</div>";

            // Re-get DOM document.
            if ($this->dvmd_tm_load_html($tcell, $cdata, $c, $r)) {

                // Get elements.
                $wrap = $tcell->documentElement;
                $cell = $wrap->childNodes[0];

                // Move cell’s attributes to wrap.
                $i = $cell->attributes->length-1;
                for ($i; $i >= 0 ; $i--) {
                    $att = $cell->attributes[$i];
                    $n   = $att->nodeName;
                    $v   = $att->nodeValue;
                    $wrap->setAttribute(esc_html($n), esc_attr($v));
                    $cell->removeAttribute($att->nodeName);
                }

                // Add class to cell.
                $cell->setAttribute('class', 'dvmd_tm_cdata');
            }
        }

        // Return.
        return $tcell;
    }


    /**
     * Processes a single table cell’s inner elements, including icons,…
     * images, and buttons – keeping any attributes set by the user.
     *
     * @since    2.0.3
     * @access   private
     *
     * @param    array      $a       The table attributes array.
     * @param    integer    $c       The current column index.
     * @param    integer    $r       The current row index.
     * @param    html       $tcell   The table cell as a DOM document. (byref)
     *
     * @return   void
     */
    private function dvmd_tm_build_tcell_inner($a, $c, $r, &$tcell) {


        //---------------------- Icons ----------------------//


        // Get icon elements.
        $icons = $tcell->getElementsByTagName('icon');

        // Process icons.
        $i = $icons->length-1;
        for ($i; $i >= 0 ; $i--):

            // Get old and new elements.
            $old = $icons[$i];
            $new = $tcell->createElement('span');

            // Copy old atts to new.
            foreach ($old->attributes as $att) {
                $n = $att->nodeName;
                $v = $att->nodeValue;
                $new->setAttribute(esc_html($n), esc_attr($v));
            }

            // Set nodeValue as icon class name.
            $icon  = $old->nodeValue;
            $icon  = ($icon) ? $icon : 'default';
            $class = $new->getAttribute('class');
            $new->setAttribute('class', trim(esc_attr("et-pb-icon dvmd_tm_icon ei ei-{$icon} {$class}")));

            // Replace old with new.
            $old->parentNode->replaceChild($new, $old);

        endfor;


        //---------------------- Buttons ----------------------//


        // Get button elements.
        $buttons = $tcell->getElementsByTagName('button');

        // Process buttons.
        $i = $buttons->length-1;
        for ($i; $i >= 0 ; $i--):

            // Get old button element.
            $old = $buttons[$i];

            // Get column button.
            $button = $a['col_button'];

            // Get table button.
            if (!$button) {

                // Get icons.
                $icons = $this->dvmd_tm_get_responsive($this->props, 'button_icon');

                // Render button.
                $button = $this->render_button(array(
                    'has_wrapper'         => false,
                    'button_classname'    => array('dvmd_tm_button'),
                    'button_custom'       => $this->props['custom_button'],
                    'button_rel'          => $this->props['button_rel'],
                    'button_text'         => 'Default',
                    'button_text_escaped' => true,
                    'button_url'          => '#',
                    'url_new_window'      => 'off',
                    'custom_icon'         => $icons['desktop'],
                    'custom_icon_tablet'  => $icons['tablet'],
                    'custom_icon_phone'   => $icons['phone'],
                ));
            }

            // Create new element.
            if ($this->dvmd_tm_load_html($new, $button, $c, $r)) :

                // Get new button element.
                $new = $new->documentElement;

                // Set text.
                $v = $old->nodeValue;
                $v = ($v) ? $v : $a['col_button_text'];
                $v = ('Default' != $v) ? $v : $this->props['tbl_button_text'];
                $new->nodeValue = esc_html($v);

                // Set class.
                $class1 = $new->getAttribute('class');
                $class2 = $old->getAttribute('class');
                $new->setAttribute('class', trim(esc_attr("{$class1} {$class2}")));
                $old->removeAttribute('class');

                // Set href.
                $v = $old->getAttribute('href');
                $v = ($v) ? $v : $a['col_button_url'];
                $v = ('#' != $v) ? $v : $this->props['tbl_button_url'];
                $new->setAttribute('href', esc_url_raw($v));
                $old->removeAttribute('href');

                // Set target.
                $v = $old->getAttribute('target');
                $v = ($v) ? $v : $a['col_button_target'];
                $v = ('default' != $v) ? $v : $this->props['tbl_button_target'];
                $v = ('default' != $v) ? $v : '_self';
                $new->setAttribute('target', esc_attr($v));
                $old->removeAttribute('target');

                // Copy old atts to new.
                foreach ($old->attributes as $att) {
                    $n = $att->nodeName;
                    $v = $att->nodeValue;
                    $new->setAttribute(esc_html($n), esc_attr($v));
                }

                // Replace old with new.
                $new = $tcell->importNode($new, true);
                $old->parentNode->replaceChild($new, $old);

            endif;
        endfor;


        //---------------------- Images ----------------------//


        // Get images and ids.
        $ids    = $this->props['tbl_image_ids'];
        $images = $tcell->getElementsByTagName('image');
        $i      = $images->length-1;

        // Process images.
        if (($i >= 0) && ($ids)):
            $ids = explode(',', $ids);

            for ($i; $i >= 0 ; $i--):

                // Get old and new elements.
                $old = $images[$i];
                $new = $tcell->createElement('div');

                // Copy old atts to new.
                foreach ($old->attributes as $att) {
                    $n = $att->nodeName;
                    $v = $att->nodeValue;
                    $new->setAttribute(esc_html($n), esc_attr($v));
                }

                // Get image.
                $id   = (is_numeric($old->nodeValue)) ? $old->nodeValue : 1;
                $id   = max(1, min(count($ids), $id));
                $id   = $ids[$id-1];
                $size = $this->props['tbl_image_quality'];
                $img  = wp_get_attachment_image_src($id, $size);
                $img  = esc_url($img[0]);

                // Set style.
                $style = esc_html($new->getAttribute('style'));
                $new->setAttribute('style', "background-image: url('{$img}');{$style}");

                // Set class.
                $class = $new->getAttribute('class');
                $new->setAttribute('class', trim(esc_attr("dvmd_tm_image {$class}")));

                // Replace old with new.
                $old->parentNode->replaceChild($new, $old);

            endfor;
        endif;
    }


    /**
     * Sets a single table cell’s outer element atrributes, including…
     * scope, style and class – keeping any attributes set by the user.
     * Also ouputs responsive css for table cells that have col/row spans.
     * Finally, populates the table array with the table cell.
     *
     * This function is only called if the table array cell (represented…
     * by c/r) is equal to null. By default, all cells in the table array…
     * are equal to null when the table array is initialised.
     *
     • When dealing with col/row spans, this function pre-populates…
     * their span positions in the table array with '' (ie. not null).
     * Thus, ensuring that once their positions are reached by the…
     * col/row loop, this function will not be called again.
     *
     * @since    2.0.2
     * @access   private
     *
     * @param    array     $a        The table attributes array.
     * @param    integer   $c        The current column index. (0 based)
     * @param    integer   $r        The current row index (0 based)
     * @param    html      $tcell    The table cell as a DOM document.
     * @param    array     $table    The table array. (byref)
     *
     * @return   void
     */
    private function dvmd_tm_build_tcell_outer($a, $c, $r, $tcell, &$table) {

        /**
         * Prepare properties for this function, including…
         * col/row header booleans, col/row span, and scope.
         */

        // Set booleans.
        $isColHead = ($a['ctype'] == 'chead');
        $isRowHead = ($a['ctype'] == 'rhead');

        // Get tcell element.
        $e = $tcell->documentElement;

        // Get and set col/row span.
        $cspan = $e->getAttribute('colspan');
        $rspan = $e->getAttribute('rowspan');
        $cspan = max(1, min($cspan, $a['ccount']-$c));
        $rspan = max(1, min($rspan, $a['rcount']-$r));
        $e->removeAttribute('colspan');
        $e->removeAttribute('rowspan');

        // Set header atts.
        $scope = '';
        if ($isColHead) {
            $scope = 'col';
            $rspan =  min($rspan, $a['cheads']-$r);
        } elseif ($isRowHead) {
            $scope = 'row';
            $cspan =  min($cspan, $a['rheads']-$c);
        }


        /**
         * Set the table cells attributes, including…
         * href, scope, class, and style.
         */

        // Set href.
        $pointer = '';
        if ($e->hasAttribute('href')) {
            $href = esc_url_raw($e->getAttribute('href'));
            $trgt = ($e->hasAttribute('target')) ? esc_attr($e->getAttribute('target')) : '_self';
            $pointer = 'cursor:pointer;';
            $e->setAttribute('onclick', "window.open('{$href}','{$trgt}')");
            $e->removeAttribute('href');
            $e->removeAttribute('target');
        }

        // Set scope.
        if ($scope) $e->setAttribute('scope', esc_attr($scope));

        // Set classes.
        $class = '';
        if (($c == 0) || (($c == $a['cheads']) && $isColHead)) $class  = 'dvmd_tm_col_first ';
        if (($r == 0) || (($r == $a['rheads']) && $isRowHead)) $class .= 'dvmd_tm_row_first ';
        if (($c+$cspan == $a['ccount']) || ($c+1 == $a['ccount'])) $class .= 'dvmd_tm_col_last ';
        if (($r+$rspan == $a['rcount']) || ($r+1 == $a['rcount'])) $class .= 'dvmd_tm_row_last ';
        $class .=  ($c % 2 != 0) ? 'dvmd_tm_col_even ' : 'dvmd_tm_col_odd ';
        $class .=  ($r % 2 != 0) ? 'dvmd_tm_row_even ' : 'dvmd_tm_row_odd ';
        $class .=  $e->getAttribute('class');
        $class  = "{$a['cslug']} dvmd_tm_tcell dvmd_tm_{$a['ctype']} dvmd_tm_col_{$c} dvmd_tm_row_{$r} {$class}";
        $e->setAttribute('class', trim(esc_attr($class)));

        // Set style.
        $style = $e->getAttribute('style');
        $grid  = sprintf('%s/%s/%s/%s', $r+1, $c+1, $r+1+$rspan, $c+1+$cspan);
        $style = "grid-area:{$grid};{$pointer}{$style}";
        $e->setAttribute('style', esc_html($style));


        /**
         * Print responsive css for table cells with col/row spans.
         *
         * Only some table cells, with col/row spans, require this
         * additional css. General css, for header and non-spanning
         * table cells, is printed from the render function.
         */

        $rs = null;
        $cs = null;

        if ($a['responsive']) {
            if (($cspan > 1) || ($rspan > 1)) {

                // Col-table cells that are not col-headers.
                if (($a['breakby'] == 'column') && (!$isColHead)) {
                    if ($isRowHead) {
                        $rs = $rspan; $cs = $cspan;
                    } elseif ($rspan > 1) {
                        $rs = $rspan; $cs = '1';
                    }

                // Row-table cells that are not row-headers.
                } elseif (($a['breakby'] == 'row') && (!$isRowHead)) {
                    if ($isColHead) {
                        $rs = $cspan; $cs = $rspan;
                    } elseif ($cspan > 1) {
                        $rs = $cspan; $cs = '1';
                    }
                }

                // Print the css.
                if ($rs && $cs) {
                    $s = "%%order_class%% .dvmd_tm_col_{$c}.dvmd_tm_row_{$r}";
                    $v = "span {$rs} / span {$cs} !important";
                    $this->dvmd_tm_set_style($a['render'], $s, 'grid-area', esc_html($v), $a['mquery']);
                }
            }
        }


        /**
         * Populate the table array with cells.
         *
         * Loops the row/col span adding cells to the table array as needed.
         * Cells with col/row spans are added at least once, and then copied…
         * as necessary for mobile display. When no cell is required, an empty…
         * string is printed so that its position in the array is not 'null'.
         */
        for ($cs = 0; $cs < $cspan; $cs++):
            for ($rs = 0; $rs < $rspan; $rs++):

                // Set col/row.
                $col = $c+$cs;
                $row = $r+$rs;

                // Don't copy cell for mobile if…
                // …not responsive.
                if (!$a['responsive']) {
                    if (($cs > 0) || ($rs > 0)) {
                        $table[$col][$row] = '';
                        continue;
                    }

                // …is row span or row header. (col-table)
                } elseif ($a['breakby'] == 'column') {
                    if (($rs > 0) || (($cs > 0) && ($isRowHead))) {
                        $table[$col][$row] = '';
                        continue;
                    }

                // …is col span or col header. (row-table)
                } elseif ($a['breakby'] == 'row') {
                    if (($cs > 0) || (($rs > 0) && ($isColHead))) {
                        $table[$col][$row] = '';
                        continue;
                    }
                }

                // Add mobile class for copies.
                if (($cs > 0) || ($rs > 0)) {
                    $e->setAttribute('class', esc_attr("{$class} dvmd_tm_mobile"));
                }

                // Print the cell.
                $table[$col][$row] = do_shortcode($tcell->saveHTML());

            endfor;
        endfor;
    }


    //-----------------------------------------------------------//
    //---------------------- CSS Functions ----------------------//
    //-----------------------------------------------------------//


    /**
     * Sets a CSS style by property/value.
     *
     * @since    2.0.0
     * @access   private
     *
     * @param    string    $rs   The render slug.
     * @param    string    $s    The CSS selector.
     * @param    string    $p    The CSS property.
     * @param    string    $v    The CSS value.
     * @param    string    $q    The media query.
     * @param    integer   $pr   The priority.
     *
     * @return   void
     */
    private function dvmd_tm_set_style($rs, $s, $p, $v, $q=null, $pr=10) {
        ET_Builder_Element::set_style($rs, array(
            'selector'    =>  $s,
            'declaration' => "{$p}:{$v};",
            'media_query' =>  $q,
            'priority'    =>  $pr,
        ));
    }


    /**
     * Sets a CSS style by declaration.
     *
     * @since    2.0.0
     * @access   private
     *
     * @param    string    $rs   The render slug.
     * @param    string    $s    The CSS selector.
     * @param    string    $d    The CSS declaration.
     * @param    string    $q    The media query.
     * @param    integer   $pr   The priority.
     *
     * @return   void
     */
    private function dvmd_tm_set_style_declaration($rs, $s, $d, $q=null, $pr=10) {
        ET_Builder_Element::set_style($rs, array(
            'selector'    => $s,
            'declaration' => $d,
            'media_query' => $q,
            'priority'    => $pr,
        ));
    }


    /**
     * Gets the responsive styles for a particular field.
     *
     * @since    2.0.0
     * @access   private
     *
     * @param    array    $p   The module’s properties.
     * @param    string   $f   The field to get.
     * @param    mixed    $d   The default value.
     *
     * @return   array    The responsive values.
     */
    private function dvmd_tm_get_responsive($p, $f, $d='') {
        return et_pb_responsive_options()->get_property_values($p, $f, $d);
    }


    /**
     * Fleshes-out responsive styles so there are no undefined properties.
     *
     * @since    2.0.0
     * @access   public
     *
     * @param    array   $styles   The styles to fleshout. (byref)
     *
     * @return   void
     */
    private function dvmd_tm_fleshout_responsive(&$s) {
        if (!$s['tablet']) $s['tablet'] = $s['desktop'];
        if (!$s['phone'])  $s['phone'] = $s['tablet'];
    }


    /**
     * Adds responsive CSS styles by property/value.
     *
     * @since   2.0.0
     * @access  private
     *
     * @param   string   $rs   The render slug.
     * @param   string   $s    The CSS selector.
     * @param   string   $p    The CSS property.
     * @param   array    $v    The CSS values.
     * @param   string   $a    The additional CSS. (eg. ' !important;')
     * @param   string   $t    The CSS value type.
     * @param   string   $pr   The declaration priority.
     */
    private function dvmd_tm_set_responsive($rs, $s, $p, $v, $a='', $t='range', $pr='') {
        et_pb_responsive_options()->generate_responsive_css($v, $s, $p, $rs, $a, $t, $pr);
    }


    /**
     * Generates responsive css for custom margin and padding.
     *
     * @since   2.0.0
     * @access  private
     *
     * @param   string    $rs    The render slug.
     * @param   string    $f     The field slug.
     * @param   string    $s     The selector
     * @param   string    $t     The type. (ie. margin/padding)
     * @param   boolean   $i     Is important?
     * @param   boolean   $p     The priority.
     */
    private function dvmd_tm_set_margin_padding($rs, $f, $s, $t, $i=false, $p=10) {

        // Get the field properties.
        $desktop     = $this->props[$f];
        $tablet      = $this->props["{$f}_tablet"];
        $phone       = $this->props["{$f}_phone"];
        $last_edited = $this->props["{$f}_last_edited"];
        $responsive  = et_pb_get_responsive_status($last_edited);

        // Desktop.
        if (isset($desktop) && !empty($desktop)) {
            $d = et_builder_get_element_style_css($desktop, $t, $i);
            $this->dvmd_tm_set_style_declaration($rs, $s, $d, null, $p);
        }

        // Tablet.
        if (isset($tablet) && !empty($tablet) && $responsive) {
            $d = et_builder_get_element_style_css($tablet, $t, $i);
            $q = ET_Builder_Element::get_media_query('max_width_980');
            $this->dvmd_tm_set_style_declaration($rs, $s, $d, $q, $p);
        }

        // Phone.
        if (isset($phone) && !empty($phone) && $responsive) {
            $d = et_builder_get_element_style_css($phone, $t, $i);
            $q = ET_Builder_Element::get_media_query('max_width_767');
            $this->dvmd_tm_set_style_declaration($rs, $s, $d, $q, $p);
        }
    }


    //----------------------------------------------------------------------//
    //---------------------- Computed Feild Functions ----------------------//
    //----------------------------------------------------------------------//


    /**
     * Converts gallery image ids into urls.
     * Used by the Visual Builder.
     *
     * @since   2.0.1
     * @access  static
     *
     * @param array $args {
     *     @type   string   $tbl_image_ids
     *     @type   string   $tbl_image_quality
     * }
     * @param   array   $conditional_tags
     * @param   array   $current_page
     *
     * @return  string  Attachments data
     */
    static function dvmd_tm_get_image_src($args = array(), $conditional_tags = array(), $current_page = array()) {

        // Defaults.
        $defaults = array(
            'tbl_image_ids'     =>  array(),
            'tbl_image_quality' => 'medium',
        );

        // Parse defaults.
        $args = wp_parse_args($args, $defaults);

        // Image properties.
        $ids  = explode(',', $args['tbl_image_ids']);
        $size = $args['tbl_image_quality'];
        $src  = array();

        // Get the urls.
        foreach ($ids as $id) {
            $img = wp_get_attachment_image_src($id, $size);
            array_push($src, esc_url($img[0]));
        }

        // Return.
        return implode(',', $src);
    }


    //---------------------------------------------------------------------//
    //---------------------- Global Assets Functions ----------------------//
    //---------------------------------------------------------------------//


    /**
     * Add assets to the late global asset list.
     *
     * @since   2.0.3
     * @access  public
     * @hook    et_global_assets_list
     *
     * @param   array  $assets  The list of assets.
     *
     * @return  array
     */
    public static function dvmd_tm_global_assets_list($assets) {

        // CPT suffix.
        $cpt_suffix = et_builder_should_wrap_styles() && ! et_is_builder_plugin_active() ? '_cpt' : '';


        // Bail.
        if (   isset($assets['et_icons_all'])
            && isset($assets['et_icons_fa'])
            && isset($assets["button{$cpt_suffix}"])
            && isset($assets["buttons{$cpt_suffix}"])) {
            return $assets;
        }

        // Add asssets.
        $assets_prefix = et_get_dynamic_assets_path();
        $assets['et_icons_all'] = array('css' => "{$assets_prefix}/css/icons_all.css",);
        $assets['et_icons_fa']  = array('css' => "{$assets_prefix}/css/icons_fa_all.css",);
        $assets['button']       = array('css' => "{$assets_prefix}/css/button{$cpt_suffix}.css",);
        $assets['buttons']      = array('css' => "{$assets_prefix}/css/buttons{$cpt_suffix}.css",);

        // Return.
        return $assets;
    }

}

// Init.
new DVMD_Table_Maker_Module;
