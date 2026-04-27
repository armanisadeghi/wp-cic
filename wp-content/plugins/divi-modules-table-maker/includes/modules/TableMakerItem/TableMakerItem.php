<?php


if (!defined('ABSPATH')) exit;


/**
 * Divi-Modules – Table Maker – Item.
 *
 * @since 2.0.3
 */
class DVMD_Table_Maker_Item_Module extends ET_Builder_Module {


    /**
     * Module properties initialization.
     *
     * @since 2.0.3
     */
    function init() {


        // Configuration.
        $this->vb_support       = 'on'; // on|partial
        $this->type             = 'child';
        $this->slug             = 'dvmd_table_maker_item';
        $this->name             =  esc_html__('Column', 'dvmd-table-maker');
        $this->plural           =  esc_html__('Columns', 'dvmd-table-maker');
        $this->main_css_element = '.dvmd_table_maker %%order_class%%';


        // Item title properties.
        $this->settings_text                =  esc_html__('Column Settings', 'dvmd-table-maker');
        $this->child_title_var              = 'col_label';
        $this->child_title_fallback_var     = 'col_label';
        $this->advanced_setting_title_text  =  esc_html__('Column', 'dvmd-table-maker');


        // Credits.
        /*
        $this->module_credits   = array(
            'module_uri'        => 'https://divi-modules.com/products/table-maker',
            'author'            => 'Divi-Modules',
            'author_uri'        => 'https://divi-modules.com',
        );
        */


        // Custom wrapper.
        $this->wrapper_settings = array(
             'parallax_background'     => '',
             'video_background'        => '',
             'attrs'                   => array('class' => 'dvmd_outer'),
             'inner_attrs'             => array("class" => "dvmd_inner"),
        );


        // Toggles.
        $this->settings_modal_toggles = array(

            // Content Tab. (general)
            'general'                   => array(
                'toggles'               => array(
                    'col_content'       => esc_html__('Column Content',         'dvmd-table-maker'),
                    'col_column'        => esc_html__('Column Width',           'dvmd-table-maker'),
                    'col_icon'          => esc_html__('Column Icons',           'dvmd-table-maker'),
                    'col_button'        => esc_html__('Column Buttons',         'dvmd-table-maker'),
                    'col_image'         => esc_html__('Column Images',          'dvmd-table-maker'),
                ),
            ),

            // Design Tab. (advanced)
            'advanced'                  => array(
                'toggles'               => array(
                    'col_tcell_cell'    => esc_html__('Column Cells',           'dvmd-table-maker'),
                    'col_tcell_text'    => esc_html__('Column Text',            'dvmd-table-maker'),
                    'col_chead_cell'    => esc_html__('Column Header Cells',    'dvmd-table-maker'),
                    'col_chead_text'    => esc_html__('Column Header Text',     'dvmd-table-maker'),
                    'col_rhead_cell'    => esc_html__('Row Header Cells',       'dvmd-table-maker'),
                    'col_rhead_text'    => esc_html__('Row Header Text',        'dvmd-table-maker'),
                    'col_cfoot_cell'    => esc_html__('Column Footer Cells',    'dvmd-table-maker'),
                    'col_cfoot_text'    => esc_html__('Column Footer Text',     'dvmd-table-maker'),
                    'col_rfoot_cell'    => esc_html__('Row Footer Cells',       'dvmd-table-maker'),
                    'col_rfoot_text'    => esc_html__('Row Footer Text',        'dvmd-table-maker'),
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

            'col_tcell_cells'   => array(
                'label'         => esc_html__('Column Cells', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell',
                'no_space_before_selector' => true,
            ),
            'col_tcell_content' => array(
                'label'         => esc_html__('Column Content', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell .dvmd_tm_cdata',
                'no_space_before_selector' => true,
            ),
            'col_chead_cells'   => array(
                'label'         => esc_html__('Column Header Cells', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell.dvmd_tm_chead',
                'no_space_before_selector' => true,
            ),
            'col_chead_content' => array(
                'label'         => esc_html__('Column Header Content', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell.dvmd_tm_chead .dvmd_tm_cdata',
                'no_space_before_selector' => true,
            ),
            'col_rhead_cells'   => array(
                'label'         => esc_html__('Row Header Cells', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell.dvmd_tm_rhead',
                'no_space_before_selector' => true,
            ),
            'col_rhead_content' => array(
                'label'         => esc_html__('Row Header Content', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell.dvmd_tm_rhead .dvmd_tm_cdata',
                'no_space_before_selector' => true,
            ),
            'col_cfoot_cells'   => array(
                'label'         => esc_html__('Column Footer Cells', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell.dvmd_tm_cfoot',
                'no_space_before_selector' => true,
            ),
            'col_cfoot_content' => array(
                'label'         => esc_html__('Column Footer Content', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell.dvmd_tm_cfoot .dvmd_tm_cdata',
                'no_space_before_selector' => true,
            ),
            'col_rfoot_cells'   => array(
                'label'         => esc_html__('Row Footer Cells', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell.dvmd_tm_rfoot',
                'no_space_before_selector' => true,
            ),
            'col_rfoot_content' => array(
                'label'         => esc_html__('Row Footer Content', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell.dvmd_tm_rfoot .dvmd_tm_cdata',
                'no_space_before_selector' => true,
            ),
            'col_icons'         => array(
                'label'         => esc_html__('Column Icons', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell .dvmd_tm_icon',
                'no_space_before_selector' => true,
            ),
            'col_buttons'       => array(
                'label'         => esc_html__('Column Buttons', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell .dvmd_tm_button',
                'no_space_before_selector' => true,
            ),
            'col_images'        => array(
                'label'         => esc_html__('Column Images', 'dvmd-table-maker'),
                'selector'      => 'div%%order_class%%.dvmd_tm_tcell .dvmd_tm_image',
                'no_space_before_selector' => true,
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
        $fields['background']           = false;
        $fields['link_options']         = false;
        $fields['text']                 = false;
        //$fields['fonts']                = false;
        $fields['button']               = false;
        $fields['max_width']            = false;
        $fields['height']               = false;
        $fields['margin_padding']       = false;
        $fields['borders']              = false;
        $fields['box_shadow']           = false;
        $fields['filters']              = true;
        //$fields['transform']            = false;
        //$fields['animation']            = false;


        //---------------------- Button ----------------------//


        // Table.
        $fields['button']['button'] = array(

            'label'                     =>  esc_html__('Buttons', 'dvmd-table-maker'),
            'option_category'           => 'layout',
            'tab_slug'                  => 'general',
            'toggle_slug'               => 'col_button',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element} .dvmd_tm_button",
                'limited_main'          => "{$this->main_css_element} .dvmd_tm_button",
            ),
            'box_shadow'                =>  array(
                'css'                   =>  array(
                    'main'              => "{$this->main_css_element} .dvmd_tm_button",
                ),
            ),
            'margin_padding'            =>  false,
            'use_alignment'             =>  false,
        );


        //---------------------- Fonts ----------------------//


        // Table.
        $fields['fonts']['col_tcell_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_tcell_text',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell .dvmd_tm_cdata",
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
        $fields['fonts']['col_chead_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_chead_text',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_chead .dvmd_tm_cdata",
            ),
            'hide_text_align'           =>  true,
            'font_size'                 =>  array(
              'default'                 => '',
            ),
            'text_color'                =>  array(
              'default'                 => '',
            ),
        );

        // Row Header.
        $fields['fonts']['col_rhead_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_rhead_text',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_rhead .dvmd_tm_cdata",
            ),
            'hide_text_align'           =>  true,
            'font_size'                 =>  array(
              'default'                 => '',
            ),
            'text_color'                =>  array(
              'default'                 => '',
            ),
        );

        // Column Footer.
        $fields['fonts']['col_cfoot_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_cfoot_text',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_cfoot .dvmd_tm_cdata",
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
        $fields['fonts']['col_rfoot_text'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_rfoot_text',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_rfoot .dvmd_tm_cdata",
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
        $fields['borders']['col_tcell_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_tcell_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => "{$this->main_css_element}.dvmd_tm_tcell",
                    'border_styles'     => "{$this->main_css_element}.dvmd_tm_tcell",
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
        $fields['borders']['col_chead_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_chead_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_chead",
                    'border_styles'     => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_chead",
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
        $fields['borders']['col_rhead_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_rhead_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_rhead",
                    'border_styles'     => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_rhead",
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
        $fields['borders']['col_cfoot_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_cfoot_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_cfoot",
                    'border_styles'     => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_cfoot",
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
        $fields['borders']['col_rfoot_cell_border'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_rfoot_cell',
            'css'                       =>  array(
                'main'                  =>  array(
                    'border_radii'      => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_rfoot",
                    'border_styles'     => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_rfoot",
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
        $fields['box_shadow']['col_tcell_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_tcell_cell',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell",
            ),
        );

        // Column Header.
        $fields['box_shadow']['col_chead_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_chead_cell',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_chead",
            ),
        );

        // Row Header.
        $fields['box_shadow']['col_rhead_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_rhead_cell',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_rhead",
            ),
        );

        // Column Footer.
        $fields['box_shadow']['col_cfoot_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_cfoot_cell',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_cfoot",
            ),
        );

        // Row Footer.
        $fields['box_shadow']['col_rfoot_cell_shadow'] = array(

            'option_category'           => 'layout',
            'tab_slug'                  => 'advanced',
            'toggle_slug'               => 'col_rfoot_cell',
            'css'                       =>  array(
                'main'                  => "{$this->main_css_element}.dvmd_tm_tcell.dvmd_tm_rfoot",
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
     * @since 2.0.3
     *
     * @return array
     */
    function get_fields() {


        // Content.
        $col_label = esc_html__(
            'Here you can set a label for the column in the builder for easy identification. This label will not be displayed on the front end.', 'dvmd-table-maker');
        $col_content = esc_html__(
            'Here you can enter content for this column’s rows. Rows are numbered for your convenience – one row in this editor equals one row in the table. Content can included HTML markup, which means characters such as &quot; &apos; &amp; &lt; &gt; will need to be avoided or escaped in order to avoid errors. Here, individual row cells can be styled and icons, buttons and images added using tags which are unique to this module. See documentation for details.', 'dvmd-table-maker');
        $col_content_default = esc_html__(
            'Here you can enter content for this column’s rows. Rows are numbered for your convenience – one row in this editor equals one row in the table.', 'dvmd-table-maker');

        // Columns/Rows Max-Min.
        $col_column_max_width = esc_html__(
            "Here you can set a maximum width for this column. For flexible-width columns, it’s recommended to use fraction (fr) units. This can also be set to 'auto'. For fixed-width columns, it’s recommended to use pixel (px) units.", 'dvmd-table-maker');
        $col_column_min_width = esc_html__(
            'Here you can set a minimum width for this column. It’s recommended to use pixel (px) units.', 'dvmd-table-maker');

        // Table Icon.
        $col_icon_type = esc_html__(
            'Here you can select this column’s default icon. This setting can be overridden per icon element. See documentation for details.', 'dvmd-table-maker');
        $col_icon_size = esc_html__(
            'Here you can set this column’s default icon size. This setting can be overridden per icon element. See documentation for details.', 'dvmd-table-maker');
        $col_icon_color = esc_html__(
            'Here you can set this column’s default icon color. This setting can be overridden per icon element. See documentation for details.', 'dvmd-table-maker');

        // Table Button.
        $col_button_text = esc_html__(
            'Here you can set this column’s default button text. This setting can be overridden per button element. See documentation for details.', 'dvmd-table-maker');
        $col_button_url = esc_html__(
            'Here you can set this column’s default button url. This setting can be overridden per button element. See documentation for details.', 'dvmd-table-maker');
        $col_button_target = esc_html__(
            'Here you can set this column’s default button target. This setting can be overridden per button element. See documentation for details.', 'dvmd-table-maker');
        $col_button_width = esc_html__(
            'Here you can set this column’s default button width. If set to Text Width, buttons will be as wide as their text. If set to Cell Width, buttons will stretch to fill their containing cell.', 'dvmd-table-maker');

        // Table Image.
        $col_image_proportion = esc_html__(
            'Here you can set this column’s default image proportion.', 'dvmd-table-maker');
        $col_image_scale = esc_html__(
            'Here you can choose how this column’s images are scaled. If set to Fit, images are scaled to fit their containing cell without cropping. If set to Fill, images are scaled to fill or cover their containing cell. This may result in some cropping.', 'dvmd-table-maker');
        $col_image_align_horz = esc_html__(
            'Here you can set this column’s default horizontal image alignment.', 'dvmd-table-maker');
        $col_image_align_vert = esc_html__(
            'Here you can set this column’s default vertical image alignment.', 'dvmd-table-maker');

        // Table Cell.
        $col_tcell_cell_color = esc_html__(
            'Here you can set this column’s cell background color.', 'dvmd-table-maker');
        $col_tcell_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of this column’s cell content.', 'dvmd-table-maker');
        $col_tcell_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of this column’s cell content.', 'dvmd-table-maker');
        $col_tcell_cell_padding = esc_html__(
            'Here you can set this column’s cell padding.', 'dvmd-table-maker');

        // Column Header Cell.
        $col_chead_cell_color = esc_html__(
            'Here you can set this column’s column header cell background color.', 'dvmd-table-maker');
        $col_chead_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of this column’s column header cell content.', 'dvmd-table-maker');
        $col_chead_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of this column’s column header cell content.', 'dvmd-table-maker');
        $col_chead_cell_padding = esc_html__(
            'Here you can set this column’s column header cell padding.', 'dvmd-table-maker');

        // Row Header Cell.
        $col_rhead_cell_color = esc_html__(
            'Here you can set this column’s row header cell background color.', 'dvmd-table-maker');
        $col_rhead_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of this column’s row header cell content.', 'dvmd-table-maker');
        $col_rhead_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of this column’s row header cell content.', 'dvmd-table-maker');
        $col_rhead_cell_padding = esc_html__(
            'Here you can set this column’s row header cell padding.', 'dvmd-table-maker');

        // Column Footer Cell.
        $col_cfoot_cell_color = esc_html__(
            'Here you can set this column’s column footer cell background color.', 'dvmd-table-maker');
        $col_cfoot_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of this column’s column footer cell content.', 'dvmd-table-maker');
        $col_cfoot_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of this column’s column footer cell content.', 'dvmd-table-maker');
        $col_cfoot_cell_padding = esc_html__(
            'Here you can set this column’s column footer cell padding.', 'dvmd-table-maker');

        // Row Footer Cell.
        $col_rfoot_cell_color = esc_html__(
            'Here you can set this column’s row footer cell background color.', 'dvmd-table-maker');
        $col_rfoot_cell_align_horz = esc_html__(
            'Here you can set the horizontal alignment of this column’s row footer cell content.', 'dvmd-table-maker');
        $col_rfoot_cell_align_vert = esc_html__(
            'Here you can set the vertical alignment of this column’s row footer cell content.', 'dvmd-table-maker');
        $col_rfoot_cell_padding = esc_html__(
            'Here you can set this column’s row footer cell padding.', 'dvmd-table-maker');

        // Table Text.
        $col_tcell_text_wrap = esc_html__(
            'Here you can choose whether to allow this column’s text to wrap to multiple lines.', 'dvmd-table-maker');
        $col_chead_text_wrap = esc_html__(
            'Here you can choose whether to allow this column’s column header text to wrap to multiple lines.', 'dvmd-table-maker');
        $col_rhead_text_wrap = esc_html__(
            'Here you can choose whether to allow this column’s row header text to wrap to multiple lines.', 'dvmd-table-maker');
        $col_cfoot_text_wrap = esc_html__(
            'Here you can choose whether to allow this column’s column footer text to wrap to multiple lines.', 'dvmd-table-maker');
        $col_rfoot_text_wrap = esc_html__(
            'Here you can choose whether to allow this column’s row footer text to wrap to multiple lines.', 'dvmd-table-maker');


        // Fields.
        $fields = array(



            //---------------------- Content ----------------------//


            'col_label'                     =>  array(
                'label'                     =>  esc_html__('Label', 'dvmd-table-maker'),
                'description'               =>  $col_label,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_content',
                'type'                      => 'text',
                'default'                   => 'Column',
            ),

            'col_content'                   =>  array(
                'label'                     =>  esc_html__('Rows', 'dvmd-table-maker'),
                'description'               =>  $col_content,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_content',
                'type'                      => 'codemirror',
                'mode'                      => 'html',
                'default'                   =>  $col_content_default,
                'default_on_front'          => '',
            ),


            //---------------------- Min Max ----------------------//


            // Columns.
            'col_column_max_width'          =>  array(
                'label'                     =>  esc_html__('Max Width', 'dvmd-table-maker'),
                'description'               =>  $col_column_max_width,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_column',
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('fr','%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allowed_values'            =>  array('default'),
                'allow_empty'               =>  true,
                'validate_unit'             =>  true,
                'default_unit'              => 'fr',
                'default'                   => 'default',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '5',
                    'step'                  => '.1',
                ),
            ),

            'col_column_min_width'          =>  array(
                'label'                     =>  esc_html__('Min Width', 'dvmd-table-maker'),
                'description'               =>  $col_column_min_width,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_column',
                'type'                      => 'range',
                'mobile_options'            =>  true,
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'allowed_values'            =>  array('default'),
                'allow_empty'               =>  true,
                'validate_unit'             =>  true,
                'default_unit'              => 'px',
                'default'                   => 'default',
                'range_settings'            =>  array(
                    'min'                   => '0',
                    'max'                   => '300',
                    'step'                  => '1',
                ),
            ),


            //---------------------- Icon ----------------------//


            'col_icon_type'                 =>  array(
                'label'                     =>  esc_html__('Default Icon', 'dvmd-table-maker'),
                'description'               =>  $col_icon_type,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_icon',
                'type'                      => 'select_icon',
                'default'                   => '',
            ),

            'col_icon_size'                 =>  array(
                'label'                     =>  esc_html__('Icon Size', 'dvmd-table-maker'),
                'description'               =>  $col_icon_size,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_icon',
                'type'                      => 'range',
                'range_settings'            =>  array(
                    'min'                   => '1',
                    'max'                   => '120',
                    'step'                  => '1',
                ),
                'allowed_units'             =>  array('%','em','rem','px','cm','mm','in','pt','pc','ex','vh','vw'),
                'default_unit'              => 'px',
                'mobile_options'            =>  true,
            ),

            'col_icon_color'                =>  array(
                'label'                     =>  esc_html__('Icon Color', 'dvmd-table-maker'),
                'description'               =>  $col_icon_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_icon',
                'type'                      => 'color-alpha',
                'mobile_options'            =>  true,
                'hover'                     => 'tabs',
            ),


            //---------------------- Button ----------------------//


            'col_button_text'               =>  array(
                'label'                     =>  esc_html__('Button Text', 'dvmd-table-maker'),
                'description'               =>  $col_button_text,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_button',
                'type'                      => 'text',
                'default'                   => 'Default',
            ),

            'col_button_url'                =>  array(
                'label'                     =>  esc_html__('Button URL', 'dvmd-table-maker'),
                'description'               =>  $col_button_url,
                'option_category'           => 'basic_option',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_button',
                'type'                      => 'text',
                'default'                   => '#',
                'dynamic_content'           => 'url',
            ),

            'col_button_target'             =>  array(
                'label'                     =>  esc_html__('Button Target', 'dvmd-table-maker'),
                'description'               =>  $col_button_target,
                'option_category'           => 'configuration',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_button',
                'type'                      => 'select',
                'default'                   => 'default',
                'options'                   =>  array(
                    'default'               =>  esc_html__('Default', 'dvmd-table-maker'),
                    '_self'                 =>  esc_html__('In The Same Window', 'et_builder'),
                    '_blank'                =>  esc_html__('In The New Tab', 'et_builder'),
                ),
            ),

            'col_button_width'              =>  array(
                'label'                     =>  esc_html__('Button Width', 'dvmd-table-maker'),
                'description'               =>  $col_button_width,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_button',
                'type'                      => 'multiple_buttons',
                'default'                   => '',
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


            'col_image_proportion'          =>  array(
                'label'                     =>  esc_html__('Image Proportion', 'dvmd-table-maker'),
                'description'               =>  $col_image_proportion,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_image',
                'type'                      => 'select',
                'mobile_options'            =>  true,
                'default'                   => '',
                'options'                   =>  array(
                    ''                      =>  esc_html__('Default', 'dvmd-table-maker'),
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

            'col_image_scale'               =>  array(
                'label'                     =>  esc_html__('Image Scale', 'dvmd-table-maker'),
                'description'               =>  $col_image_scale,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_image',
                'type'                      => 'multiple_buttons',
                'default'                   => '',
                'options'                   =>  array(
                    'contain'               =>  array(
                        'title'             =>  esc_html__('Fit', 'dvmd-table-maker'),
                    ),
                    'cover'                 =>  array(
                        'title'             =>  esc_html__('Fill', 'dvmd-table-maker'),
                    ),
                ),
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),

            'col_image_align_horz'          =>  array(
                'label'                     =>  esc_html__('Image Alignment (Horizontal)', 'dvmd-table-maker'),
                'description'               =>  $col_image_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_image',
                'type'                      => 'multiple_buttons',
                'default'                   => '',
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
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),

            'col_image_align_vert'          =>  array(
                'label'                     =>  esc_html__('Image Alignment (Vertical)', 'dvmd-table-maker'),
                'description'               =>  $col_image_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'general',
                'toggle_slug'               => 'col_image',
                'type'                      => 'multiple_buttons',
                'default'                   => '',
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
                'toggleable'                =>  true,
                'multi_selection'           =>  false,
            ),


            //---------------------- Cell ----------------------//


            // Table.
            'col_tcell_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $col_tcell_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_tcell_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          => '',
            ),

            'col_tcell_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_tcell_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_tcell_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_tcell_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_tcell_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_tcell_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_tcell_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $col_tcell_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_tcell_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),

            // Column Header.
            'col_chead_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $col_chead_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_chead_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          => '',
            ),

            'col_chead_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_chead_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_chead_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_chead_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_chead_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_chead_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_chead_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $col_chead_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_chead_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),

            // Row Header.
            'col_rhead_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $col_rhead_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rhead_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          => '',
            ),

            'col_rhead_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_rhead_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rhead_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_rhead_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_rhead_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rhead_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_rhead_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $col_rhead_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rhead_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),

            // Column Footer.
            'col_cfoot_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $col_cfoot_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_cfoot_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          => '',
            ),

            'col_cfoot_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_cfoot_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_cfoot_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_cfoot_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_cfoot_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_cfoot_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_cfoot_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $col_cfoot_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_cfoot_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),

            // Row Footer.
            'col_rfoot_cell_color'          =>  array(
                'label'                     =>  esc_html__('Background Color', 'dvmd-table-maker'),
                'description'               =>  $col_rfoot_cell_color,
                'option_category'           => 'color_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rfoot_cell',
                'type'                      => 'color-alpha',
                'default'                   => '',
                'default_on_front'          => '',
            ),

            'col_rfoot_cell_align_horz'     =>  array(
                'label'                     =>  esc_html__('Horizontal Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_rfoot_cell_align_horz,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rfoot_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_rfoot_cell_align_vert'     =>  array(
                'label'                     =>  esc_html__('Vertical Alignment', 'dvmd-table-maker'),
                'description'               =>  $col_rfoot_cell_align_vert,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rfoot_cell',
                'type'                      => 'text_align',
                'options'                   =>  et_builder_get_text_orientation_options(array('justified')),
            ),

            'col_rfoot_cell_padding'        =>  array(
                'label'                     =>  esc_html__('Padding', 'dvmd-table-maker'),
                'description'               =>  $col_rfoot_cell_padding,
                'option_category'           => 'layout',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rfoot_cell',
                'type'                      => 'custom_padding',
                'mobile_options'            =>  true,
                //'default'                   => '',
                //'default_on_front'          => '|||',
            ),


            //---------------------- Text ----------------------//


            // Table.
            'col_tcell_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $col_tcell_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_tcell_text',
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

            // Column Header.
            'col_chead_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $col_chead_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_chead_text',
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
            'col_rhead_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $col_rhead_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rhead_text',
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
            'col_cfoot_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $col_cfoot_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_cfoot_text',
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
            'col_rfoot_text_wrap'           =>  array(
                'label'                     =>  esc_html__('Text Wrap', 'dvmd-table-maker'),
                'description'               =>  $col_rfoot_text_wrap,
                'option_category'           => 'font_option',
                'tab_slug'                  => 'advanced',
                'toggle_slug'               => 'col_rfoot_text',
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

        );


        // Return
        return $fields;
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


        //-----------------------------------------------------------//
        //---------------------- Styles Output ----------------------//
        //-----------------------------------------------------------//


        // Properties.
        $rs          = $render_slug;
        $props       = $this->props;
        $order_class = ET_Builder_Element::get_module_order_class($render_slug);


        //---------------------- Text & Cell ------------------------//


        $types = array('tcell', 'rhead', 'chead', 'rfoot', 'cfoot');
        $order = array('50', '51', '52', '53', '54');

        foreach ($types as $i => $type):

            // Classes.
            $classes = "div%%order_class%%.dvmd_tm_{$type}";
            if ($type !== 'tcell') $classes = "div%%order_class%%.dvmd_tm_tcell.dvmd_tm_{$type}";

            // Text wrap.
            $v = $props["col_{$type}_text_wrap"];
            if ($v) {
                $s = "{$classes} .dvmd_tm_cdata";
                $this->dvmd_tm_set_style($rs, $s, 'white-space', esc_html($v), null, $order[$i]);
            }

            // Cell Color.
            $s = $classes;
            $v = $props["col_{$type}_cell_color"];
            if ($v) $this->dvmd_tm_set_style($rs, $s, 'background', esc_html($v), null, $order[$i]);

            // Cell Horizontal alignment.
            $v = $props["col_{$type}_cell_align_horz"];
            if ($v) $this->dvmd_tm_set_style($rs, $s, 'text-align', esc_html($v), null, $order[$i]);

            // Cell Vertical alignment.
            $v = $props["col_{$type}_cell_align_vert"];
            if ($v) {
                if ($v == 'left')  $v = 'flex-start';
                if ($v == 'right') $v = 'flex-end';
                $this->dvmd_tm_set_style($rs, $s, 'justify-content', esc_html($v), null, $order[$i]);
            }

            // Cell Padding.
            $this->dvmd_tm_set_margin_padding($rs, "col_{$type}_cell_padding", $s, 'padding', false, $order[$i]);

        endforeach;


        //---------------------- Column Icon ----------------------//


        // Icon.
        if ($props['col_icon_type']) {

            $icon = $props['col_icon_type'];
            $s = "div%%order_class%% .dvmd_tm_icon.ei-default:before";

            // Pre 4.13.
            if (false === strpos($icon, '||')) {

                // Icon value.
                $icon = html_entity_decode(esc_attr(et_pb_process_font_icon($icon)));
                $this->dvmd_tm_set_style($rs, $s, 'content', "'{$icon}'", null, '50');
            }

            // Post 4.13.
            elseif (function_exists('et_pb_get_extended_font_icon_value')) {

                // Icon value.
                $icon = esc_attr(et_pb_get_extended_font_icon_value($icon, true));
                $this->dvmd_tm_set_style($rs, $s, 'content', "'{$icon}'", null, '50');

                // Icon styles.
                $this->generate_styles(array(
                    'utility_arg'    => 'icon_font_family',
                    'render_slug'    =>  $rs,
                    'base_attr_name' => 'col_icon_type',
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
        $s = "div%%order_class%% .dvmd_tm_icon";
        $v =  $this->dvmd_tm_get_responsive($props, 'col_icon_size');
        $this->dvmd_tm_fleshout_responsive($v);
        $this->dvmd_tm_set_responsive($rs, $s, 'font-size', $v, '', 'range', '50');

        // Icon color.
        $v = $this->dvmd_tm_get_responsive($props, 'col_icon_color');
        $this->dvmd_tm_fleshout_responsive($v);
        $this->dvmd_tm_set_responsive($rs, $s, 'color', $v, '', 'color', '50');

        // Icon color hover.
        if (et_builder_is_hover_enabled('col_icon_color', $props)) {
            $s = "div%%order_class%% .dvmd_tm_icon:hover";
            $v = $this->get_hover_value('col_icon_color');
            $this->dvmd_tm_set_style($rs, $s, 'color', esc_html($v), null, 50);
        }


        //---------------------- Column Button ----------------------//


        // Set button.
        $button = '';
        if ('on' == $props['custom_button']) {

            // Get icons.
            $icons = $this->dvmd_tm_get_responsive($props, 'button_icon');

            // Render button.
            $button = $this->render_button(array(
                'has_wrapper'         => false,
                'button_classname'    => array('dvmd_tm_button'),
                'button_custom'       => $props['custom_button'],
                'button_rel'          => $props['button_rel'],
                'button_text'         => 'Default',
                'button_text_escaped' => true,
                'button_url'          => '#',
                'url_new_window'      => 'off',
                'custom_icon'         => $icons['desktop'],
                'custom_icon_tablet'  => $icons['tablet'],
                'custom_icon_phone'   => $icons['phone'],
            ));
        }

        // Set button data.
        $data['col_button']         = $button;
        $data['col_button_text']    = $props['col_button_text'];
        $data['col_button_url']     = $props['col_button_url'];
        $data['col_button_target']  = $props['col_button_target'];

        // Button width.
        $v = $props['col_button_width'];
        if ($v) {
            $s = "div%%order_class%% .dvmd_tm_button";
            $this->dvmd_tm_set_style($rs, $s, 'display', esc_html($v), null, '50');
        }


        //---------------------- Column Image ----------------------//


        // Image proportion.
        $s = "div%%order_class%% .dvmd_tm_image";
        $v = $this->dvmd_tm_get_responsive($props, 'col_image_proportion');
        $this->dvmd_tm_fleshout_responsive($v);
        if ($v) $this->dvmd_tm_set_responsive($rs, $s, 'padding-top', $v, '', 'custom', '50');

        // Image size.
        $v = $props['col_image_scale'];
        if ($v) $this->dvmd_tm_set_style($rs, $s, 'background-size', esc_html($v), null, '50');

        // Image alignment.
        $x = $props['col_image_align_horz'];
        $y = $props['col_image_align_vert'];
        if ($x || $y) {
            if (!$x) $x = 'center';
            if (!$y) $y = 'center';
            $v = "{$x} {$y}";
            $this->dvmd_tm_set_style($rs, $s, 'background-position', esc_html($v), null, '50');
        }


        //------------------------------------------------------------//
        //---------------------- Core Functions ----------------------//
        //------------------------------------------------------------//


        // Get column min/max.
        $mins = $this->dvmd_tm_get_responsive($props, 'col_column_min_width');
        $maxs = $this->dvmd_tm_get_responsive($props, 'col_column_max_width');

        // Handle default min/max.
        if ($mins['desktop'] == 'default') $mins['desktop'] = '';
        if ($mins['tablet']  == 'default') $mins['tablet'] = '';
        if ($mins['phone']   == 'default') $mins['phone'] = '';
        if ($maxs['desktop'] == 'default') $maxs['desktop'] = '';
        if ($maxs['tablet']  == 'default') $maxs['tablet'] = '';
        if ($maxs['phone']   == 'default') $maxs['phone'] = '';

        // Get rows data.
        $rows = $props['col_content'];

        // Escape characters.
        $find    = array('{{lt}}', '{{gt}}', '{{amp}}', '{{quot}}', '{{apos}}');
        $replace = array('&lt;', '&gt;', '&amp;', '&quot;', '&apos;');
        $rows = str_replace($find, $replace, $rows);

        // Explode rows data.
        $rows = explode("\n", $rows);

        // Prepare column data.
        $data['slug']   = $order_class;
        $data['mins']   = $mins;
        $data['maxs']   = $maxs;
        $data['rows']   = $rows;
        $data['count']  = count($rows);

        // Return data.
        $data = wp_json_encode($data);
        return "[kabooom]{$data}[kabooom]";
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

}

// Init.
new DVMD_Table_Maker_Item_Module;
