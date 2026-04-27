<?php

class DSS_BeforeAfterSlider extends ET_Builder_Module
{

    public $slug = 'et_pb_ds_before_after_slider';
    public $vb_support = 'on';

    protected $module_credits = array(
        'module_uri' => 'https://divi-sensei.com/before-after-slider-for-divi',
        'author' => 'Divi Sensei',
        'author_uri' => 'https://divi-sensei.com',
    );

    public function init()
    {
        $this->name = esc_html__('Sensei Before After Slider', 'ds-before-after-slider');
        $this->icon_path = plugin_dir_path(__FILE__) . 'icon.svg';
    }

    public function get_settings_modal_toggles()
    {
        return [
            'general' => [
                'toggles' => [
                    'image' => esc_html__('Images', 'ds-before-after-slider'),
                    'labels' => esc_html__('Labels', 'ds-before-after-slider'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'slider' => esc_html__('Slider', 'ds-before-after-slider'),
                    'labels' => esc_html__('Labels', 'ds-before-after-slider'),
                    'overlay' => esc_html__('Overlay', 'ds-before-after-slider'),
                ],
            ],
        ];
    }

    public function get_fields()
    {
        return array(
            'before_image' => array(
                'label' => esc_html__('Before Image', 'ds-before-after-slider'),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', 'ds-before-after-slider'),
                'choose_text' => esc_attr__('Choose an Image', 'ds-before-after-slider'),
                'update_text' => esc_attr__('Set As Image', 'ds-before-after-slider'),
                'description' => esc_html__('Upload an image to display in the module.', 'ds-before-after-slider'),
                'toggle_slug' => 'image',
            ),

            'before_image_alt' => array(
                'label' => esc_html__('Before Image Alt Text', 'ds-before-after-slider'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Define the HTML ALT text for the image.', 'ds-before-after-slider'),
                'toggle_slug' => 'image',
            ),

            'after_image' => array(
                'label' => esc_html__('After Image', 'ds-before-after-slider'),
                'type' => 'upload',
                'option_category' => 'basic_option',
                'upload_button_text' => esc_attr__('Upload an image', 'ds-before-after-slider'),
                'choose_text' => esc_attr__('Choose an Image', 'ds-before-after-slider'),
                'update_text' => esc_attr__('Set As Image', 'ds-before-after-slider'),
                'description' => esc_html__('Upload an image to display in the module.', 'ds-before-after-slider'),
                'toggle_slug' => 'image',
            ),

            'after_image_alt' => array(
                'label' => esc_html__('After Image Alt Text', 'ds-before-after-slider'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Define the HTML ALT text for the image.', 'ds-before-after-slider'),
                'toggle_slug' => 'image',
            ),

            /* Slider Settings Labels */

            'before_label' => array(
                'label' => esc_html__('Before Label', 'ds-before-after-slider'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug' => 'labels',
                'description' => esc_html__('The label for the before image.', 'ds-before-after-slider'),
                'default' => esc_html__('Before', 'ds-before-after-slider'),
            ),

            'after_label' => array(
                'label' => esc_html__('After Label', 'ds-before-after-slider'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug' => 'labels',
                'description' => esc_html__('The label for the after image.', 'ds-before-after-slider'),
                'default' => esc_html__('After', 'ds-before-after-slider'),
            ),

            'always_show_labels' => array(
                'label' => esc_html__('Always Show Label', 'ds-before-after-slider'),
                'type' => 'yes_no_button',
                'option_category' => 'basic_option',
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
                'default' => 'off',
                'options' => array(
                    'off' => esc_html__('Off', 'ds-before-after-slider'),
                    'on' => esc_html__('On', 'ds-before-after-slider'),
                ),
                'description' => esc_html__('Whether to always show the labels or only show them on hover.', 'ds-before-after-slider'),
            ),

            //TODO: Label BG, Label Padding, Label Border Radius

            'before_label_bg_color' => [
                'label' => esc_html__('Before Label Bg Color', 'ds-before-after-slider'),
                'type' => 'color-alpha',
                'default' => "rgba(255, 255, 255, 0.2)",
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
            ],

            'after_label_bg_color' => [
                'label' => esc_html__('After Label Bg Color', 'ds-before-after-slider'),
                'type' => 'color-alpha',
                'default' => "rgba(255, 255, 255, 0.2)",
                'toggle_slug' => 'labels',
                'tab_slug' => 'advanced',
            ],

            /* Slider Settings Overlay */
            'enable_overlay' => array(
                'label' => esc_html__('Enable Overlay', 'ds-before-after-slider'),
                'type' => 'yes_no_button',
                'toggle_slug' => 'overlay',
                'tab_slug' => 'advanced',
                'default' => 'on',
                'options' => array(
                    'off' => esc_html__('Off', 'ds-before-after-slider'),
                    'on' => esc_html__('On', 'ds-before-after-slider'),
                ),
                'description' => esc_html__('Whether or not to show the overlay on hover.', 'ds-before-after-slider'),
            ),

            'overlay_color' => [
                'label' => esc_html__('Overlay  Color', 'ds-before-after-slider'),
                'type' => 'color-alpha',
                'default' => "rgba(0, 0, 0, 0.5)",
                'toggle_slug' => 'overlay',
                'tab_slug' => 'advanced',
            ],

            /* Slider Settings General */

            'direction' => array(
                'label' => esc_html__('Slider Direction', 'ds-before-after-slider'),
                'type' => 'select',
                'option_category' => 'basic_option',
                'options' => array(
                    'horizontal' => 'Horizontal',
                    'vertical' => 'Vertical',
                ),
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
                'default' => 'horizontal',
                'description' => esc_html__('The direction of the slider.', 'ds-before-after-slider'),
            ),

            'offset' => array(
                'label' => esc_html__('Slider Start Offset', 'ds-before-after-slider'),
                'type' => 'range',
                'option_category' => 'layout',
                'default' => '50',
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
                'unitless' => true,
                'range_settings' => array(
                    'min' => '0',
                    'max' => '100',
                    'step' => '1',
                ),
                'description' => esc_html__('The initial offset of the slider in percent.', 'ds-before-after-slider'),
            ),

            'move_on_hover' => array(
                'label' => esc_html__('Move On Hover', 'ds-before-after-slider'),
                'type' => 'yes_no_button',
                'option_category' => 'layout',
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
                'default' => 'off',
                'options' => array(
                    'off' => esc_html__('Off', 'ds-before-after-slider'),
                    'on' => esc_html__('On', 'ds-before-after-slider'),
                ),
                'description' => esc_html__('When enabled, hovering the mouse over the slider will move the handle.', 'ds-before-after-slider'),
            ),

            'slider_color' => [
                'label' => esc_html__('Slider Color', 'ds-before-after-slider'),
                'type' => 'color-alpha',
                'default' => "#ffffff",
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
            ],

            'slider_handle_color' => [
                'label' => esc_html__('Handle Color', 'ds-before-after-slider'),
                'type' => 'color-alpha',
                'default' => "#ffffff",
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
            ],

            'slider_handle_bg_color' => [
                'label' => esc_html__('Handle BG Color', 'ds-before-after-slider'),
                'type' => 'color-alpha',
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
            ],

            'slider_handle_icon_color' => [
                'label' => esc_html__('Handle Icon Color', 'ds-before-after-slider'),
                'type' => 'color-alpha',
                'toggle_slug' => 'slider',
                'tab_slug' => 'advanced',
                'default' => "#ffffff",
            ],
        );
    }

    public function get_advanced_fields_config()
    {
        return [
            'text' => false,
            'text_shadow' => false,
            'fonts' => [
                'labels' => [
                    'label' => esc_html__('Title', 'ds-before-after-slider'),
                    'toggle_slug' => 'labels',
                    'css' => [
                        'main' => "%%order_class%% .ds_before_after_slider_overlay .ds_before_after_slider_label:before",
                        'important' => 'all',
                    ],
                ],
            ],
        ];
    }

    public function get_custom_css_fields_config()
    {
        return [
            'dss_image_before' => [
                'label' => 'Before Image',
                'selector' => '%%order_class%% .ds_before_after_slider_before ',
            ],
            'dss_image_after' => [
                'label' => 'After Image',
                'selector' => '%%order_class%% .ds_before_after_slider_after ',
            ],
            'dss_label_before' => [
                'label' => 'Before Label',
                'selector' => '%%order_class%% .ds_before_after_slider_overlay .ds_before_after_slider_before_label:before',
            ],
            'dss_label_after' => [
                'label' => 'After Label',
                'selector' => '%%order_class%% .ds_before_after_slider_overlay .ds_before_after_slider_after_label:before',
            ],
            'dss_overlay' => [
                'label' => 'Overlay',
                'selector' => '%%order_class%% .ds_before_after_slider_overlay',
            ],
        ];
    }

    public function render($attrs, $content = null, $render_slug)
    {
        wp_enqueue_script('ds_before_after_slider');
        wp_enqueue_style('ds_before_after_slider');

        $this->render_css($render_slug);

        $json_string = json_encode($this->ds_before_after_slider());
        $options = htmlspecialchars($json_string, ENT_QUOTES, 'UTF-8');
        return sprintf(
            '<div class="ds_before_after_slider_container" data-options="%1$s"></div>',
            esc_attr($options)
        );
    }

    public function ds_before_after_slider()
    {
        return [
            "before_image" => esc_url($this->props["before_image"]),
            "before_image_alt" => esc_html($this->props["before_image_alt"]),
            "before_label" => esc_html($this->props["before_label"]),

            "after_image" => esc_url($this->props["after_image"]),
            "after_image_alt" => esc_html($this->props["after_image_alt"]),
            "after_label" => esc_html($this->props["after_label"]),

            "offset" => $this->props["offset"],
            "direction" => $this->props["direction"],
            "move_on_hover" => 'on' === $this->props["move_on_hover"],
        ];
    }

    public function render_css($render_slug)
    {
        if ("on" === $this->props["always_show_labels"]) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .ds_before_after_slider_overlay .ds_before_after_slider_after_label, %%order_class%% .ds_before_after_slider_overlay .ds_before_after_slider_before_label',
                'declaration' => 'opacity: 1 !important;',
            ]);
        }

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_overlay .ds_before_after_slider_before_label:before',
            'declaration' => sprintf(
                'background: %1$s;',
                esc_attr($this->props['before_label_bg_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_overlay .ds_before_after_slider_after_label:before',
            'declaration' => sprintf(
                'background: %1$s;',
                esc_attr($this->props['after_label_bg_color'])
            ),
        ]);

        if ('on' === $this->props['enable_overlay']) {
            ET_Builder_Element::set_style($render_slug, [
                'selector' => '%%order_class%% .ds_before_after_slider_overlay:hover',
                'declaration' => sprintf(
                    'background: %1$s;',
                    esc_attr($this->props['overlay_color'])
                ),
            ]);
        }

        //Slider handle color
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_handle:before, %%order_class%%  .ds_before_after_slider_handle:after',
            'declaration' => sprintf(
                'background: %1$s;',
                esc_attr($this->props['slider_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_horizontal .ds_before_after_slider_handle:before',
            'declaration' => sprintf(
                '-webkit-box-shadow: 0 3px 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);
                -moz-box-shadow: 0 3px 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);
                box-shadow: 0 3px 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);',
                esc_attr($this->props['slider_handle_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_horizontal .ds_before_after_slider_handle:after',
            'declaration' => sprintf(
                '-webkit-box-shadow: 0 -3px 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);
                -moz-box-shadow: 0 -3px 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);
                box-shadow: 0 -3px 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);',
                esc_attr($this->props['slider_handle_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_vertical .ds_before_after_slider_handle:before',
            'declaration' => sprintf(
                '-webkit-box-shadow: 3px 0 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);
                -moz-box-shadow: 3px 0 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);
                box-shadow: 3px 0 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);',
                esc_attr($this->props['slider_handle_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_vertical .ds_before_after_slider_handle:after',
            'declaration' => sprintf(
                '-webkit-box-shadow: -3px 0 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);
                -moz-box-shadow: -3px 0 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);
                box-shadow: -3px 0 0 %1$s, 0px 0px 12px rgba(51, 51, 51, 0.5);',
                esc_attr($this->props['slider_handle_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_handle',
            'declaration' => sprintf(
                'border-color: %1$s;',
                esc_attr($this->props['slider_handle_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_handle',
            'declaration' => sprintf(
                'background: %1$s;',
                esc_attr($this->props['slider_handle_bg_color'])
            ),
        ]);

        //Arrow of handle
        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_left_arrow',
            'declaration' => sprintf(
                'border-right-color: %1$s;',
                esc_attr($this->props['slider_handle_icon_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_right_arrow',
            'declaration' => sprintf(
                'border-left-color: %1$s;',
                esc_attr($this->props['slider_handle_icon_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_up_arrow',
            'declaration' => sprintf(
                'border-bottom-color: %1$s;',
                esc_attr($this->props['slider_handle_icon_color'])
            ),
        ]);

        ET_Builder_Element::set_style($render_slug, [
            'selector' => '%%order_class%% .ds_before_after_slider_down_arrow',
            'declaration' => sprintf(
                'border-top-color: %1$s;',
                esc_attr($this->props['slider_handle_icon_color'])
            ),
        ]);

    }
}

new DSS_BeforeAfterSlider;
