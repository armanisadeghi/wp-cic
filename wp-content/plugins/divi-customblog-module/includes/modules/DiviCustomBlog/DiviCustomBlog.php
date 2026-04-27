<?php

//require_once  get_template_directory_uri(). '/includes/builder/module/helpers/Overlay.php';
class ET_Builder_Module_CustomBlog extends ET_Builder_Module_Type_PostBased
{
    /**
     * Track if the module is currently rendering to prevent unnecessary rendering and recursion.
     * @var bool
     */
    protected static $rendering = false;

    protected $module_credits = [
        'module_uri' => 'https://www.peeayecreative.com/',
        'author' => 'Peeaye Creative',
        'author_uri' => 'https://www.peeayecreative.com/',
    ];

    public function init()
    {
        $this->name = esc_html__('Custom Blog', 'et_builder');
        $this->plural = esc_html__('Custom Blogs', 'et_builder');
        $this->slug = 'et_pb_custblog';
        $this->vb_support = 'on';
        $this->main_css_element = '%%order_class%% .et_pb_post';
        $this->settings_modal_toggles = [
            'general' => [
                'toggles' => [
                    'main_content' => et_builder_i18n('Content'),
                    'elements' => et_builder_i18n('Elements'),
                ],
            ],
            'advanced' => [
                'toggles' => [
                    'layout' => et_builder_i18n('Layout'),
                    'overlay' => et_builder_i18n('Overlay'),
                    'image' => [
                        'title' => et_builder_i18n('Image'),
                        'priority' => 49,
                    ],
                    'text' => [
                        'title' => et_builder_i18n('Text'),
                        'priority' => 51,
                    ],
                ],
            ],
        ];
        $this->advanced_fields = [
            'fonts' => [
                'header' => [
                    'label' => et_builder_i18n('Title'),
                    'css' => [
                        'main' => "{$this->main_css_element} .entry-title, %%order_class%% .not-found-title",
                        'font' => "{$this->main_css_element} .entry-title a, %%order_class%% .not-found-title",
                        'color' => "{$this->main_css_element} .entry-title a, %%order_class%% .not-found-title",
                        'limited_main' => "{$this->main_css_element} .entry-title, {$this->main_css_element} .entry-title a, %%order_class%% .not-found-title",
                        'hover' => "{$this->main_css_element}:hover .entry-title, {$this->main_css_element}:hover .entry-title:hover a, %%order_class%% .not-found-title",
                        'color_hover' => "{$this->main_css_element}:hover .entry-title a, %%order_class%%:hover .not-found-title",
                        'important' => 'all',
                    ],
                    'header_level' => [
                        'default' => 'h2',
                        'computed_affects' => [
                            '__posts',
                        ],
                    ],
                ],
                'body' => [
                    'label' => et_builder_i18n('Body'),
                    'css' => [
                        'main' => "{$this->main_css_element} .post-content, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content p",
                        'color' => "{$this->main_css_element}, {$this->main_css_element} .post-content *",
                        'line_height' => "{$this->main_css_element} p",
                        'limited_main' => "{$this->main_css_element}, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_light .et_pb_post a.more-link, %%order_class%%.et_pb_bg_layout_dark .et_pb_post a.more-link",
                        'hover' => "{$this->main_css_element}:hover .post-content, %%order_class%%.et_pb_bg_layout_light:hover .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark:hover .et_pb_post .post-content p",
                        'color_hover' => "{$this->main_css_element}:hover, {$this->main_css_element}:hover .post-content *",
                    ],
                    'block_elements' => [
                        'tabbed_subtoggles' => true,
                        'bb_icons_support' => true,
                        'css' => [
                            'link' => "{$this->main_css_element} .post-content a, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content a, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content a",
                            'ul' => "{$this->main_css_element} .post-content ul li, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content ul li, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content ul li",
                            'ul_item_indent' => "{$this->main_css_element} .post-content ul, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content ul, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content ul",
                            'ol' => "{$this->main_css_element} .post-content ol li, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content ol li, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content ol li",
                            'ol_item_indent' => "{$this->main_css_element} .post-content ol, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content ol, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content ol",
                            'quote' => "{$this->main_css_element} .post-content blockquote, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content blockquote, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content blockquote",
                        ],
                    ],
                ],
                'meta' => [
                    'label' => esc_html__('Meta', 'et_builder'),
                    'css' => [
                        'main' => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a",
                        'limited_main' => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a, {$this->main_css_element} .post-meta span",
                        'hover' => "{$this->main_css_element}:hover .post-meta, {$this->main_css_element}:hover .post-meta a, {$this->main_css_element}:hover .post-meta span",
                    ],
                ],
                'read_more' => [
                    'label' => esc_html__('Read More', 'et_builder'),
                    'css' => [
                        'main' => "{$this->main_css_element} div.post-content a.more-link",
                        'hover' => "{$this->main_css_element} div.post-content a.more-link:hover",
                    ],
                    'hide_text_align' => true,
                ],
                'pagination' => [
                    'label' => esc_html__('Pagination', 'et_builder'),
                    'css' => [
                        'main' => function_exists('wp_pagenavi') ? '%%order_class%% .wp-pagenavi a, %%order_class%% .wp-pagenavi span' : '%%order_class%% .pagination a',
                        'important' => function_exists('wp_pagenavi') ? 'all' : [],
                        'text_align' => '%%order_class%% .wp-pagenavi',
                        'hover' => function_exists('wp_pagenavi') ? '%%order_class%% .wp-pagenavi a:hover, %%order_class%% .wp-pagenavi span:hover' : '%%order_class%% .pagination a:hover',
                    ],
                    'hide_text_align' => !function_exists('wp_pagenavi'),
                    'text_align' => [
                        'options' => et_builder_get_text_orientation_options(['justified'], []),
                    ],
                ],
            ],
            'background' => [
                'css' => [
                    'main' => '%%order_class%%',
                ],
            ],
            'borders' => [
                'default' => [
                    'css' => [
                        'main' => [
                            'border_radii' => '%%order_class%% .et_pb_blog_grid .et_pb_post',
                            'border_styles' => '%%order_class%% .et_pb_blog_grid .et_pb_post',
                            'border_styles_hover' => '%%order_class%% .et_pb_blog_grid .et_pb_post:hover',
                        ],
                    ],
                    'depends_on' => ['fullwidth'],
                    'depends_show_if' => 'off',
                    'defaults' => [
                        'border_radii' => 'on||||',
                        'border_styles' => [
                            'width' => '1px',
                            'color' => '#d8d8d8',
                            'style' => 'solid',
                        ],
                    ],
                    'label_prefix' => esc_html__('Grid Layout', 'et_builder'),
                ],
                'fullwidth' => [
                    'css' => [
                        'main' => [
                            'border_radii' => '%%order_class%%:not(.et_pb_blog_grid_wrapper) .et_pb_post',
                            'border_styles' => '%%order_class%%:not(.et_pb_custblog_grid_wrapper) .et_pb_post',
                        ],
                    ],
                    'depends_on' => ['fullwidth'],
                    'depends_show_if' => 'on',
                    'defaults' => [
                        'border_radii' => 'on||||',
                        'border_styles' => [
                            'width' => '0px',
                            'color' => '#333333',
                            'style' => 'solid',
                        ],
                    ],
                ],
                'image' => [
                    'css' => [
                        'main' => [
                            'border_radii' => '%%order_class%% .et_pb_post .entry-featured-image-url img, %%order_class%% .et_pb_post .et_pb_slides, %%order_class%% .et_pb_post .et_pb_video_overlay',
                            'border_styles' => '%%order_class%% .et_pb_post .entry-featured-image-url img, %%order_class%% .et_pb_post .et_pb_slides, %%order_class%% .et_pb_post .et_pb_video_overlay',
                        ],
                    ],
                    'label_prefix' => et_builder_i18n('Image'),
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'image',
                ],
            ],
            'box_shadow' => [
                'default' => [],
                'image' => [
                    'label' => esc_html__('Image Box Shadow', 'et_builder'),
                    'option_category' => 'layout',
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'image',
                    'css' => [
                        'main' => '%%order_class%% .entry-featured-image-url, %%order_class%% img, %%order_class%% .et_pb_slides, %%order_class%% .et_pb_video_overlay',
                        'overlay' => 'inset',
                    ],
                    'default_on_fronts' => [
                        'color' => '',
                        'position' => '',
                    ],
                ],
            ],
            'height' => [
                'css' => [
                    'main' => '%%order_class%%',
                ],
            ],
            'margin_padding' => [
                'css' => [
                    'main' => '%%order_class%%',
                    'important' => ['custom_margin'],
                ],
            ],
            'text' => [
                'use_background_layout' => true,
                'css' => [
                    'text_shadow' => '%%order_class%%',
                ],
                'options' => [
                    'background_layout' => [
                        'depends_show_if' => 'on',
                        'default_on_front' => 'light',
                        'hover' => 'tabs',
                    ],
                ],
            ],
            'filters' => [
                'css' => [
                    'main' => '%%order_class%%',
                ],
                'child_filters_target' => [
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'image',
                ],
            ],
            'image' => [
                'css' => [
                    'main' => implode(
                        ', ',
                        [
                            '%%order_class%% img',
                            '%%order_class%% .et_pb_slides',
                            '%%order_class%% .et_pb_video_overlay',
                        ]
                    ),
                ],
            ],
            'scroll_effects' => [
                'grid_support' => 'yes',
            ],
            'button' => false,
        ];
        $this->custom_css_fields = [
            'title' => [
                'label' => et_builder_i18n('Title'),
                'selector' => '.entry-title',
            ],
            'content' => [
                'label' => et_builder_i18n('Body'),
                'selector' => '.post-content',
            ],
            'post_meta' => [
                'label' => esc_html__('Post Meta', 'et_builder'),
                'selector' => '.post-meta',
            ],
            'pagenavi' => [
                'label' => esc_html__('Pagenavi', 'et_builder'),
                'selector' => '.wp_pagenavi',
            ],
            'featured_image' => [
                'label' => esc_html__('Featured Image', 'et_builder'),
                'selector' => '.entry-featured-image-url img',
            ],
            'read_more' => [
                'label' => esc_html__('Read More Button', 'et_builder'),
                'selector' => 'a.more-link',
            ],
        ];
        $this->help_videos = [
            [
                'id' => 'PRaWaGI75wc',
                'name' => esc_html__('An introduction to the Blog module', 'et_builder'),
            ],
            [
                'id' => 'jETCzKVv6P0',
                'name' => esc_html__('How To Use Divi Blog Post Formats', 'et_builder'),
            ],
        ];
        // Render Blog CSS If
        /*$enable_inline_stylesheet = et_get_option('divi_inline_stylesheet', 'on');
        if ('on' === $enable_inline_stylesheet && et_use_dynamic_css()) {
            add_action('wp_enqueue_scripts', function () {
                $stylesheet_path = get_template_directory().'/includes/builder/feature/dynamic-assets/assets/css/blog.css';
                $stylesheet_contents = file_get_contents($stylesheet_path);
                wp_register_style('et-pb-custom-blog-inline', false, [], '1.0.0');
                wp_enqueue_style('et-pb-custom-blog-inline');
                wp_add_inline_style('et-pb-custom-blog-inline', $stylesheet_contents);
            });
        }*/
    }

    public function get_selectedterms($taxonomy = null)
    {
        //var_dump($taxonomy);
        if (is_null($taxonomy)) {
            $categories = get_terms();
        } else {
            $categories = get_terms('category', [
                'orderby' => 'count',
                'hide_empty' => 0,
            ]);
        }
        // var_dump($categories);
        foreach ($categories as $key => $value) {
            $output[$value->slug] = esc_html__($value->name, 'et_builder');
        }

        return $output;
    }

    public static function get_posttype()
    {

        $list = [];
        $args = [
            'public' => true,
        ];
        $post_types = get_post_types($args, 'objects');
        $list = wp_list_pluck($post_types, 'label', 'name');

        return $list;
    }

    public static function get_taxonomies($taxonomy_type)
    {

        $lists = [];
        $taxonomy_objects = get_object_taxonomies($taxonomy_type, 'objects');
        if (!empty($taxonomy_objects)) {
            foreach ($taxonomy_objects as $values) {
                $lists[$values->name] = ucwords($values->label);
            }
        }

        return $lists;
    }

    public static function get_lists($taxonomies_slug)
    {

        $lists = [];
        $args = [
            'taxonomy' => $taxonomies_slug,
            'hide_empty' => true,
        ];
        $taxonomies = get_terms($args);
        if (!empty($taxonomies)) {
            foreach ($taxonomies as $values) {
                $lists[$values->term_id] = ucwords($values->name);
            }
        }

        return $lists;
    }

    private static $computed_depends_on = [];

    protected static function _get_taxonomies_fields()
    {

        $fields = [];
        foreach (self::get_posttype() as $posttype_slug => $posttype) {

            $fields['taxonomy_'.$posttype_slug] = [
                'label' => esc_html__('Taxonomy', 'dita-divi-taxonomy'),
                'description' => esc_html__('Choose the type of taxonomies you want to display.', 'dita-divi-taxonomy'),
                'type' => 'select',
                'option_category' => 'configuration',
                'show_if' => [
                    'post_type' => $posttype_slug,
                    'use_nearby_loop' => 'off',
                    'use_relationship_posts' => 'off',
                ],
                'options' => self::get_taxonomies($posttype_slug),
                'default' => key(self::get_taxonomies($posttype_slug)),
                'toggle_slug' => 'main_content',
                'computed_affects' => [
                    '__posts',
                ],
            ];
            array_push(self::$computed_depends_on, 'taxonomy_'.$posttype_slug);
            foreach (self::get_taxonomies($posttype_slug) as $taxonomies_slug => $taxonomy) {

                $fields['include_categories_'.$taxonomies_slug] = [
                    'label' => esc_html__('Included Taxonomy Terms', 'dita-divi-taxonomy'),
                    'description' => esc_html__('Choose which taxonomies you would like to include in the feed.', 'dita-divi-taxonomy'),
                    'type' => 'categories',
                    'option_category' => 'configuration',
                    'show_if' => [
                        'post_type' => $posttype_slug,
                        'taxonomy_'.$posttype_slug => $taxonomies_slug,
                        'use_nearby_loop' => 'off',
                        'use_relationship_posts' => 'off',
                    ],
                    'meta_categories' => [
                        'current' => esc_html__('Current Category', 'et_builder'),
                    ],
                    'renderer_options' => [
                        'use_terms' => true,
                        'term_name' => $taxonomies_slug,
                    ],
                    'options' => self::get_lists($taxonomies_slug),
                    'toggle_slug' => 'main_content',
                    'computed_affects' => [
                        '__posts',
                    ],
                ];
                array_push(self::$computed_depends_on, 'include_categories_'.$taxonomies_slug);
            }
        }

        return $fields;
    }

    public function get_fields()
    {

        $post_related_fields = array_merge(
            ['post_type' => [
                'label' => esc_html__('Post Type', 'et_builder'),
                'type' => 'select',
                'option_category' => 'configuration',
                'options' => $this->get_posttype(),
                'default' => key($this->get_posttype()),
                'description' => esc_html__('Choose posts of which post type you would like to display.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'main_content',
                'show_if' => [
                    'use_current_loop' => 'off',
                ],
            ]], self::_get_taxonomies_fields()
        );
        $fields = [
            'use_nearby_loop' => [
                'label' => esc_html__('Use Nearest Posts', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('Enable this setting to show posts by the nearest distance to the current post.', 'et_builder'),
                'show_if' => ['use_relationship_posts' => 'off'],
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'main_content',
                'default' => 'off',
            ],
            'nearby_distance' => [
                'label' => esc_html__('Nearest Distance Boundary', 'et_builder'),
                'type' => 'text',
                'option_category' => 'configuration',
                'description' => esc_html__('Enter a number value to set a boundary to limit the maximum distance in mile away the nearest posts should be included. Any post outside this distance will not be included in the nearest posts loop.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'show_if' => ['use_nearby_loop' => 'on'],
                'show_if_not' => ['use_relationship_posts' => 'on'],
                'toggle_slug' => 'main_content',
                'default' => '',
                'dynamic_content' => 'text'
            ],
            'nearby_meta_key' => [
                'label' => esc_html__('ACF Google Map Meta Key', 'et_builder'),
                'type' => 'text',
                'option_category' => 'configuration',
                'description' => esc_html__('Enter the meta key of the ACF map custom field which is used for the nearest post feature.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'show_if' => ['use_nearby_loop' => 'on'],
                'show_if_not' => ['use_relationship_posts' => 'on'],
                'toggle_slug' => 'main_content',
                'default' => '',
                //'dynamic_content' => 'text'
            ],
            'use_relationship_posts' => [
                'label' => esc_html__('Show Posts With Relationship From Other Post Type', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('Enable this setting to show posts from another post type according to the relationship with the current post.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'main_content',
                'default' => 'off',
            ],
            'relationship_posts_metakey' => [
                'label' => esc_html__('ACF Relationship Meta Key', 'et_builder'),
                'type' => 'text',
                'option_category' => 'configuration',
                'description' => esc_html__('Enter the meta key of the ACF post object field which is used to indicate the relationship of a post from another post type to the current post.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'show_if' => ['use_relationship_posts' => 'on'],
                'toggle_slug' => 'main_content',
                'default' => '',
                //'dynamic_content' => 'text'
            ],
            'fullwidth' => [
                'label' => et_builder_i18n('Layout'),
                'type' => 'select',
                'option_category' => 'layout',
                'options' => [
                    'on' => esc_html__('Fullwidth', 'et_builder'),
                    'off' => esc_html__('Grid', 'et_builder'),
                ],
                'affects' => [
                    'background_layout',
                    'masonry_tile_background_color',
                    'border_radii_fullwidth',
                    'border_styles_fullwidth',
                    'border_radii',
                    'border_styles',
                ],
                'description' => esc_html__('Toggle between the various blog layout types.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'tab_slug' => 'advanced',
                'toggle_slug' => 'layout',
                'default_on_front' => 'on',
            ],
            'use_current_loop' => [
                'label' => esc_html__('Posts For Current Page', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('Display posts for the current page. Useful on archive and index pages.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'main_content',
                'default' => 'off',
                'show_if' => [
                    'function.isTBLayout' => 'on',
                    'use_nearby_loop' => 'off',
                    'use_relationship_posts' => 'off'
                ],
            ],
            'posts_number' => [
                'label' => esc_html__('Post Count', 'et_builder'),
                'type' => 'text',
                'option_category' => 'configuration',
                'description' => esc_html__('Choose how much posts you would like to display per page.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'main_content',
                'default' => 10,
            ],
            'meta_date' => [
                'label' => esc_html__('Date Format', 'et_builder'),
                'type' => 'text',
                'option_category' => 'configuration',
                'description' => esc_html__('If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder'),
                'toggle_slug' => 'main_content',
                'computed_affects' => [
                    '__posts',
                ],
                'default' => 'M j, Y',
            ],
            'show_thumbnail' => [
                'label' => esc_html__('Show Featured Image', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('This will turn thumbnails on and off.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'elements',
                'default_on_front' => 'on',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'show_content' => [
                'label' => esc_html__('Content Length', 'et_builder'),
                'type' => 'select',
                'option_category' => 'configuration',
                'options' => [
                    'off' => esc_html__('Show Excerpt', 'et_builder'),
                    'on' => esc_html__('Show Content', 'et_builder'),
                ],
                'affects' => [
                    'show_more',
                    'show_excerpt',
                    'use_manual_excerpt',
                    'excerpt_length',
                ],
                'description' => esc_html__('Showing the full content will not truncate your posts on the index page. Showing the excerpt will only display your excerpt text.', 'et_builder'),
                'toggle_slug' => 'main_content',
                'computed_affects' => [
                    '__posts',
                ],
                'default_on_front' => 'off',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'use_manual_excerpt' => [
                'label' => esc_html__('Use Post Excerpts', 'et_builder'),
                'description' => esc_html__('Disable this option if you want to ignore manually defined excerpts and always generate it automatically.', 'et_builder'),
                'type' => 'yes_no_button',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'default' => 'on',
                'computed_affects' => [
                    '__posts',
                ],
                'depends_show_if' => 'off',
                'toggle_slug' => 'main_content',
                'option_category' => 'configuration',
            ],
            'use_custom_fields' => [
                'label' => esc_html__('Show Custom Fields', 'et_builder'),
                'description' => esc_html__('Turn custom fields on or off.', 'et_builder'),
                'type' => 'yes_no_button',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'default' => 'off',
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'main_content',
                'option_category' => 'configuration',
            ],
            'custom_field_ids' => [
                'label' => esc_html__('Custom Field IDs', 'et_builder'),
                'description' => esc_html__('Enter the custom field IDs of any field you want to show in the blog. Each field ID should have a designated HTML tag in order to show the value within the respective tag. The custom field IDs must be entered in a specific pattern with the name following the HTML tag like tag:acf_field_id|tag:acf_field_id|tag:acf_field_id.', 'et_builder'),
                'type' => 'textarea',
                'default' => '',
                'computed_affects' => [
                    '__posts',
                ],
                'show_if' => ['use_custom_fields' => 'on'],
                'toggle_slug' => 'main_content',
                'option_category' => 'configuration',
            ],
            'excerpt_length' => [
                'label' => esc_html__('Excerpt Length', 'et_builder'),
                'description' => esc_html__('Define the length of automatically generated excerpts. Leave blank for default ( 270 ) ', 'et_builder'),
                'type' => 'text',
                'default' => '270',
                'computed_affects' => [
                    '__posts',
                ],
                'depends_show_if' => 'off',
                'toggle_slug' => 'main_content',
                'option_category' => 'configuration',
            ],
            'show_more' => [
                'label' => esc_html__('Show Read More Button', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'off' => et_builder_i18n('No'),
                    'on' => et_builder_i18n('Yes'),
                ],
                'depends_show_if' => 'off',
                'description' => esc_html__('Here you can define whether to show "read more" link after the excerpts or not.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'elements',
                'default_on_front' => 'off',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'show_author' => [
                'label' => esc_html__('Show Author', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('Turn on or off the author link.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'elements',
                'default_on_front' => 'on',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'show_date' => [
                'label' => esc_html__('Show Date', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('Turn the date on or off.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'elements',
                'default_on_front' => 'on',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'show_categories' => [
                'label' => esc_html__('Show Categories', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('Turn the category links on or off.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'elements',
                'default_on_front' => 'on',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'show_comments' => [
                'label' => esc_html__('Show Comment Count', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('Turn comment count on and off.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'elements',
                'default_on_front' => 'off',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'show_excerpt' => [
                'label' => esc_html__('Show Excerpt', 'et_builder'),
                'description' => esc_html__('Turn excerpt on and off.', 'et_builder'),
                'type' => 'yes_no_button',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'default_on_front' => 'on',
                'computed_affects' => [
                    '__posts',
                ],
                'depends_show_if' => 'off',
                'toggle_slug' => 'elements',
                'option_category' => 'configuration',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'show_pagination' => [
                'label' => esc_html__('Show Pagination', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'configuration',
                'options' => [
                    'on' => et_builder_i18n('Yes'),
                    'off' => et_builder_i18n('No'),
                ],
                'description' => esc_html__('Turn pagination on and off.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'toggle_slug' => 'elements',
                'default_on_front' => 'on',
                'mobile_options' => true,
                'hover' => 'tabs',
            ],
            'offset_number' => [
                'label' => esc_html__('Post Offset Number', 'et_builder'),
                'type' => 'text',
                'option_category' => 'configuration',
                'description' => esc_html__('Choose how many posts you would like to skip. These posts will not be shown in the feed.', 'et_builder'),
                'toggle_slug' => 'main_content',
                'computed_affects' => [
                    '__posts',
                ],
                'default' => 0,
            ],
            'use_overlay' => [
                'label' => esc_html__('Featured Image Overlay', 'et_builder'),
                'type' => 'yes_no_button',
                'option_category' => 'layout',
                'options' => [
                    'off' => et_builder_i18n('Off'),
                    'on' => et_builder_i18n('On'),
                ],
                'affects' => [
                    'overlay_icon_color',
                    'hover_overlay_color',
                    'hover_icon',
                ],
                'description' => esc_html__('If enabled, an overlay color and icon will be displayed when a visitors hovers over the featured image of a post.', 'et_builder'),
                'computed_affects' => [
                    '__posts',
                ],
                'tab_slug' => 'advanced',
                'toggle_slug' => 'overlay',
                'default_on_front' => 'off',
            ],
            'overlay_icon_color' => [
                'label' => esc_html__('Overlay Icon Color', 'et_builder'),
                'type' => 'color-alpha',
                'custom_color' => true,
                'depends_show_if' => 'on',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'overlay',
                'description' => esc_html__('Here you can define a custom color for the overlay icon', 'et_builder'),
                'mobile_options' => true,
                'sticky' => true,
            ],
            'hover_overlay_color' => [
                'label' => esc_html__('Overlay Background Color', 'et_builder'),
                'type' => 'color-alpha',
                'custom_color' => true,
                'depends_show_if' => 'on',
                'tab_slug' => 'advanced',
                'toggle_slug' => 'overlay',
                'description' => esc_html__('Here you can define a custom color for the overlay', 'et_builder'),
                'mobile_options' => true,
                'sticky' => true,
            ],
            'hover_icon' => [
                'label' => esc_html__('Overlay Icon', 'et_builder'),
                'type' => 'select_icon',
                'option_category' => 'configuration',
                'class' => ['et-pb-font-icon'],
                'depends_show_if' => 'on',
                'description' => esc_html__('Here you can define a custom icon for the overlay', 'et_builder'),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'overlay',
                'computed_affects' => [
                    '__posts',
                ],
                'mobile_options' => true,
                'sticky' => true,
            ],
            'masonry_tile_background_color' => [
                'label' => esc_html__('Grid Tile Background Color', 'et_builder'),
                'type' => 'color-alpha',
                'custom_color' => true,
                'toggle_slug' => 'background',
                'depends_show_if' => 'off',
                'depends_on' => [
                    'fullwidth',
                ],
                'hover' => 'tabs',
                'mobile_options' => true,
                'sticky' => true,
            ],
            '__posts' => [
                'type' => 'computed',
                'computed_callback' => ['ET_Builder_Module_CustomBlog', 'get_blog_posts'],
                'computed_depends_on' => array_merge(self::$computed_depends_on, [
                    'use_current_loop',
                    'post_type',
                    'fullwidth',
                    'posts_number',
                    'include_categories',
                    'meta_date',
                    'show_thumbnail',
                    'show_content',
                    'show_more',
                    'show_author',
                    'show_date',
                    'show_categories',
                    'show_comments',
                    'show_excerpt',
                    'use_manual_excerpt',
                    'excerpt_length',
                    'show_pagination',
                    'offset_number',
                    'use_overlay',
                    'hover_icon',
                    'hover_icon_tablet',
                    'hover_icon_phone',
                    'header_level',
                    '__page',
                ]),
            ],
            '__page' => [
                'type' => 'computed',
                'computed_callback' => ['ET_Builder_Module_CustomBlog', 'get_blog_posts'],
                'computed_affects' => [
                    '__posts',
                ],
            ],
        ];

        return array_merge($post_related_fields, $fields);
    }

    public function get_transition_fields_css_props()
    {
        $fields = parent::get_transition_fields_css_props();
        $fields['background_layout'] = [
            'color' => implode(
                ', ',
                [
                    '%%order_class%% .entry-title',
                    '%%order_class%% .post-meta',
                    '%%order_class%% .post-content',
                ]
            ),
        ];
        $fields['border_radii'] = ['border-radius' => self::$_->array_get($this->advanced_fields, 'borders.default.css.main.border_radii')];
        $fields['border_styles'] = ['border' => self::$_->array_get($this->advanced_fields, 'borders.default.css.main.border_styles')];
        $fields['border_radii_fullwidth'] = ['border-radius' => self::$_->array_get($this->advanced_fields, 'borders.fullwidth.css.main.border_radii')];
        $fields['border_styles_fullwidth'] = ['border' => self::$_->array_get($this->advanced_fields, 'borders.fullwidth.css.main.border_styles')];
        $fields['max_width'] = ['max-width' => '%%order_class%%'];
        $fields['width'] = ['width' => '%%order_class%%'];
        $fields['overlay_icon_color'] = ['background-color' => '%%order_class%% .et_overlay:before'];
        $fields['hover_overlay_color'] = ['background-color' => '%%order_class%% .et_overlay'];
        $fields['masonry_tile_background_color'] = ['background-color' => '%%order_class%% .et_pb_blog_grid .et_pb_post'];

        return $fields;
    }

    static function get_blog_posts($args = [], $conditional_tags = [], $current_page = [])
    {
        global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
        if (self::$rendering) {
            // We are trying to render a Blog module while a Blog module is already being rendered
            // which means we have most probably hit an infinite recursion. While not necessarily
            // the case, rendering a post which renders a Blog module which renders a post
            // which renders a Blog module is not a sensible use-case.
            return '';
        }
        $global_processing_original_value = $et_fb_processing_shortcode_object;
        // Default params are combination of attributes that is used by et_pb_custblog and
        // conditional tags that need to be simulated (due to AJAX nature) by passing args
        $defaults = [
            'use_current_loop' => 'off',
            'post_type' => '',
            'fullwidth' => '',
            'posts_number' => '',
            'include_categories' => '',
            'meta_date' => '',
            'show_thumbnail' => '',
            'show_content' => '',
            'show_author' => '',
            'show_date' => '',
            'show_categories' => '',
            'show_comments' => '',
            'show_excerpt' => '',
            'use_manual_excerpt' => '',
            'excerpt_length' => '',
            'show_pagination' => '',
            'background_layout' => '',
            'show_more' => '',
            'offset_number' => '',
            'masonry_tile_background_color' => '',
            'overlay_icon_color' => '',
            'hover_overlay_color' => '',
            'hover_icon' => '',
            'hover_icon_tablet' => '',
            'hover_icon_phone' => '',
            'use_overlay' => '',
            'header_level' => 'h2',
        ];
        // WordPress' native conditional tag is only available during page load. It'll fail during component update because
        // et_pb_process_computed_property() is loaded in admin-ajax.php. Thus, use WordPress' conditional tags on page load and
        // rely to passed $conditional_tags for AJAX call
        $is_front_page = et_fb_conditional_tag('is_front_page', $conditional_tags);
        $is_single = et_fb_conditional_tag('is_single', $conditional_tags);
        $et_is_builder_plugin_active = et_fb_conditional_tag('et_is_builder_plugin_active', $conditional_tags);
        $post_id = isset($current_page['id']) ? (int)$current_page['id'] : 0;
        $container_is_closed = false;
        // remove all filters from WP audio shortcode to make sure current theme doesn't add any elements into audio module
        remove_all_filters('wp_audio_shortcode_library');
        remove_all_filters('wp_audio_shortcode');
        remove_all_filters('wp_audio_shortcode_class');
        $args = wp_parse_args($args, $defaults);
        if ('on' === $args['use_current_loop']) {
            // Reset loop-affecting values to their defaults to simulate the current loop.
            $reset_keys = ['post_type', 'include_categories'];
            foreach ($reset_keys as $key) {
                $args[$key] = $defaults[$key];
            }
        }
        $processed_header_level = et_pb_process_header_level($args['header_level'], 'h2');
        $processed_header_level = esc_html($processed_header_level);
        $overlay_output = '';
        if ('on' === $args['use_overlay']) {
            $overlay_output = ET_Builder_Module_Helper_Overlay::render(
                [
                    'icon' => $args['hover_icon'],
                    'icon_tablet' => $args['hover_icon_tablet'],
                    'icon_phone' => $args['hover_icon_phone'],
                ]
            );
        }
        $overlay_class = 'on' === $args['use_overlay'] ? ' et_pb_has_overlay' : '';
        $query_args = [
            'posts_per_page' => intval($args['posts_number']),
            'post_status' => ['publish', 'private'],
            'perm' => 'readable',
            'post_type' => $args['post_type'],
        ];
        if (defined('DOING_AJAX') && isset($current_page['paged'])) {
            $paged = intval($current_page['paged']); //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
        } else {
            $paged = $is_front_page ? get_query_var('page') : get_query_var('paged'); //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
        }
        // support pagination in VB
        if (isset($args['__page'])) {
            $paged = $args['__page']; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
        }
        $query_args['cat'] = implode(',', self::filter_include_categories($args['include_categories'], $post_id));
        $query_args['paged'] = $paged;
        if ('' !== $args['offset_number'] && !empty($args['offset_number'])) {
            /**
             * Offset + pagination don't play well. Manual offset calculation required
             * @see: https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
             */
            if ($paged > 1) {
                $query_args['offset'] = (($paged - 1) * intval($args['posts_number'])) + intval($args['offset_number']);
            } else {
                $query_args['offset'] = intval($args['offset_number']);
            }
        }
        if ($is_single) {
            $main_query_post = ET_Post_Stack::get_main_post();
            if (null !== $main_query_post) {
                $query_args['post__not_in'][] = $main_query_post->ID;
            }
        }
        // Get query
        $query = new WP_Query($query_args);
        /**
         * Filters Blog module's main query.
         *
         * @param WP_Query $query
         *
         * @since 4.7.0
         */
        $query = apply_filters('et_builder_blog_query', $query); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- We intend to override $wp_query for blog module.
        // Keep page's $wp_query global
        $wp_query_page = $wp_query;
        // Turn page's $wp_query into this module's query
        $wp_query = $query; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
        $wp_query->et_pb_custblog_query = true;
        self::$rendering = true;
        // Manually set the max_num_pages to make the `next_posts_link` work
        if ('' !== $args['offset_number'] && !empty($args['offset_number'])) {
            $wp_query->found_posts = max(0, $wp_query->found_posts - intval($args['offset_number']));
            $posts_number = intval($args['posts_number']);
            $wp_query->max_num_pages = $posts_number > 1 ? ceil($wp_query->found_posts / $posts_number) : 1;
        }
        ob_start();
        if ($query->have_posts()) {
            if ('on' !== $args['fullwidth']) {
                echo '<div class="et_pb_salvattore_content" data-columns>';
            }
            while ($query->have_posts()) {
                $query->the_post();
                ET_Post_Stack::replace($post);
                global $et_fb_processing_shortcode_object;
                $global_processing_original_value = $et_fb_processing_shortcode_object;
                // reset the fb processing flag
                $et_fb_processing_shortcode_object = false;
                $thumb = '';
                $width = 'on' === $args['fullwidth'] ? 1080 : 400;
                $width = (int)apply_filters('et_pb_blog_image_width', $width);
                $height = 'on' === $args['fullwidth'] ? 675 : 250;
                $height = (int)apply_filters('et_pb_blog_image_height', $height);
                $classtext = 'on' === $args['fullwidth'] ? 'et_pb_post_main_image' : '';
                $titletext = get_the_title();
                $alttext = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                $thumbnail = get_thumbnail($width, $height, $classtext, $alttext, $titletext, false, 'Blogimage');
                $thumb = $thumbnail['thumb'];
                $no_thumb_class = '' === $thumb || 'off' === $args['show_thumbnail'] ? ' et_pb_no_thumb' : '';
                $excerpt_length = '' !== $args['excerpt_length'] ? intval($args['excerpt_length']) : 270;
                $post_format = et_pb_post_format();
                if (in_array($post_format, ['video', 'gallery'])) {
                    $no_thumb_class = '';
                }
                // Print output
                ?>
            <article id="" <?php post_class('et_pb_post clearfix'.$no_thumb_class.$overlay_class); ?>>
                <?php
                et_divi_post_format_content();
                if (!in_array($post_format, ['link', 'audio', 'quote'])) {
                    if ('video' === $post_format && false !== ($first_video = et_get_first_video())) :
                        $video_overlay = has_post_thumbnail() ? sprintf(
                            '<div class="et_pb_video_overlay" style="background-image: url(%1$s); background-size: cover;">
											<div class="et_pb_video_overlay_hover">
												<a href="#" class="et_pb_video_play"></a>
											</div>
										</div>',
                            et_core_esc_previously($thumb)
                        ) : '';
                        printf(
                            '<div class="et_main_video_container">
											%1$s
											%2$s
										</div>',
                            et_core_esc_previously($video_overlay),
                            et_core_esc_previously($first_video)
                        );
                    elseif ('gallery' === $post_format) :
                        et_pb_gallery_images('slider');
                    elseif ('' !== $thumb && 'on' === $args['show_thumbnail']) :
                        if ('on' !== $args['fullwidth']) {
                            echo '<div class="et_pb_image_container">';
                        }
                        ?>
                        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="entry-featured-image-url">
                            <?php print_thumbnail($thumb, $thumbnail['use_timthumb'], $titletext, $width, $height); ?>
                            <?php
                            if ('on' === $args['use_overlay']) {
                                echo et_core_esc_previously($overlay_output);
                            }
                            ?>
                        </a>
                        <?php
                        if ('on' !== $args['fullwidth']) {
                            echo '</div> <!-- .et_pb_image_container -->';
                        }
                    endif;
                }
                ?>
                <?php if ('off' === $args['fullwidth'] || !in_array($post_format, ['link', 'audio', 'quote'])) { ?>
                    <?php if (!in_array($post_format, ['link', 'audio'])) { ?>
                        <<?php echo et_core_esc_previously($processed_header_level); ?> class="entry-title">
                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></<?php echo et_core_esc_previously($processed_header_level); ?>>
                    <?php } ?>
                    <?php
                    if ('on' === $args['show_author'] || 'on' === $args['show_date'] || 'on' === $args['show_categories'] || 'on' === $args['show_comments']) {
                        $author = 'on' === $args['show_author']
                            ? et_get_safe_localization(sprintf(__('by %s', 'et_builder'), '<span class="author vcard">'.et_pb_get_the_author_posts_link().'</span>'))
                            : '';
                        $author_separator = 'on' === $args['show_author'] && 'on' === $args['show_date']
                            ? ' | '
                            : '';
                        $date = 'on' === $args['show_date']
                            ? et_get_safe_localization(sprintf(__('%s', 'et_builder'), '<span class="published">'.esc_html(get_the_date($args['meta_date'])).'</span>'))
                            : '';
                        $date_separator = (('on' === $args['show_author'] || 'on' === $args['show_date']) && 'on' === $args['show_categories'])
                            ? ' | '
                            : '';
                        $categories = 'on' === $args['show_categories']
                            ? et_builder_get_the_term_list(', ')
                            : '';
                        $categories_separator = (('on' === $args['show_author'] || 'on' === $args['show_date'] || 'on' === $args['show_categories']) && 'on' === $args['show_comments'])
                            ? ' | '
                            : '';
                        $comments = 'on' === $args['show_comments']
                            ? et_core_maybe_convert_to_utf_8(sprintf(esc_html(_nx('%s Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder')), number_format_i18n(get_comments_number())))
                            : '';
                        printf(
                            '<p class="post-meta">%1$s %2$s %3$s %4$s %5$s %6$s %7$s</p>',
                            et_core_esc_previously($author),
                            et_core_intentionally_unescaped($author_separator, 'fixed_string'),
                            et_core_esc_previously($date),
                            et_core_intentionally_unescaped($date_separator, 'fixed_string'),
                            et_core_esc_wp($categories),
                            et_core_intentionally_unescaped($categories_separator, 'fixed_string'),
                            et_core_esc_previously($comments)
                        );
                    }
                    $post_content = et_strip_shortcodes(et_delete_post_first_video(get_the_content()), true);
                    // reset the fb processing flag
                    $et_fb_processing_shortcode_object = false;
                    // set the flag to indicate that we're processing internal content
                    $et_pb_rendering_column_content = true;
                    // reset all the attributes required to properly generate the internal styles
                    ET_Builder_Element::clean_internal_modules_styles();
                    echo '<div class="post-content">';
                    if ('on' === $args['show_content']) {
                        global $more;
                        // page builder doesn't support more tag, so display the_content() in case of post made with page builder
                        if (et_pb_is_pagebuilder_used(get_the_ID())) {
                            $more = 1; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
                            echo et_core_intentionally_unescaped(apply_filters('the_content', $post_content), 'html');
                        } else {
                            $more = null; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
                            echo et_core_intentionally_unescaped(apply_filters('the_content', et_delete_post_first_video(get_the_content(esc_html__('read more...', 'et_builder')))), 'html');
                        }
                    } elseif ('on' === $args['show_excerpt']) {
                        if (has_excerpt() && 'off' !== $args['use_manual_excerpt']) {
                            the_excerpt();
                        } else {
                            if ('' !== $post_content) {
                                // set the $et_fb_processing_shortcode_object to false, to retrieve the content inside truncate_post() correctly
                                $et_fb_processing_shortcode_object = false;
                                echo et_core_intentionally_unescaped(wpautop(et_delete_post_first_video(strip_shortcodes(truncate_post($excerpt_length, false, '', true)))), 'html');
                                // reset the $et_fb_processing_shortcode_object to its original value
                                $et_fb_processing_shortcode_object = $global_processing_original_value;
                            } else {
                                echo '';
                            }
                        }
                    }
                    $et_fb_processing_shortcode_object = $global_processing_original_value;
                    // retrieve the styles for the modules inside Blog content
                    $internal_style = ET_Builder_Element::get_style(true);
                    // reset all the attributes after we retrieved styles
                    ET_Builder_Element::clean_internal_modules_styles(false);
                    $et_pb_rendering_column_content = false;
                    // append styles to the blog content
                    if ($internal_style) {
                        printf(
                            '<style type="text/css" class="et_fb_blog_inner_content_styles">
											%1$s
										</style>',
                            et_core_esc_previously($internal_style)
                        );
                    }
                    if ('on' !== $args['show_content']) {
                        $more = 'on' === $args['show_more'] ? sprintf(' <a href="%1$s" class="more-link" >%2$s</a>', esc_url(get_permalink()), esc_html__('read more', 'et_builder')) : ''; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
                        echo et_core_esc_previously($more);
                    }
                    echo '</div>';
                    ?>
                <?php } // 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote', 'gallery' ?>
                </article>
                <?php
                $et_fb_processing_shortcode_object = $global_processing_original_value;
                ET_Post_Stack::pop();
            } // endwhile
            ET_Post_Stack::reset();
            if ('on' !== $args['fullwidth']) {
                echo '</div>';
            }
            if ('on' === $args['show_pagination']) {
                // echo '</div> <!-- .et_pb_posts -->'; // @todo this causes closing tag issue
                $container_is_closed = true;
                if (function_exists('wp_pagenavi')) {
                    wp_pagenavi(
                        [
                            'query' => $query,
                        ]
                    );
                } else {
                    if ($et_is_builder_plugin_active) {
                        include ET_BUILDER_PLUGIN_DIR.'includes/navigation.php';
                    } else {
                        get_template_part('includes/navigation', 'index');
                    }
                }
            }
        }
        unset($wp_query->et_pb_custblog_query);
        // Reset $wp_query to its origin
        $wp_query = $wp_query_page; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
        if (!$posts = ob_get_clean()) {
            $posts = self::get_no_results_template(et_core_esc_previously($processed_header_level));
        }
        self::$rendering = false;

        return $posts;
    }

    public function render_pagination($echo = true)
    {
        if (!$echo) {
            ob_start();
        }
        add_filter('get_pagenum_link', ['ET_Builder_Module_CustomBlog', 'filter_pagination_url']);
        if (function_exists('wp_pagenavi')) {
            wp_pagenavi();
        } else {
            if (et_is_builder_plugin_active()) {
                include ET_BUILDER_PLUGIN_DIR.'includes/navigation.php';
            } else {
                get_template_part('includes/navigation', 'index');
            }
        }
        remove_filter('get_pagenum_link', ['ET_Builder_Module_CustomBlog', 'filter_pagination_url']);
        if (!$echo) {
            $output = ob_get_contents();
            ob_end_clean();

            return $output;
        }
    }

    public static function filter_pagination_url($result)
    {
        return add_query_arg('et_blog', '', $result);
    }

    public function render($attrs, $content, $render_slug)
    {
        $main_query_post = ET_Post_Stack::get_main_post();
        // var_dump( $attrs, $content, $render_slug );
        global $post, $paged, $wp_query, $wp_the_query, $wp_filter, $__et_blog_module_paged;
        // var_dump($attrs, $content, $render_slug);
        if (self::$rendering) {
            // We are trying to render a Blog module while a Blog module is already being rendered
            // which means we have most probably hit an infinite recursion. While not necessarily
            // the case, rendering a post which renders a Blog module which renders a post
            // which renders a Blog module is not a sensible use-case.
            return '';
        }
        // Keep a reference to the real main query to restore from later.
        $main_query = $wp_the_query;
        // Stored current global post as variable so global $post variable can be restored
        // to its original state when et_pb_custblog shortcode ends to avoid incorrect global $post
        // being used on the page (i.e. blog + shop module in backend builder)
        $post_cache = $post;
        /**
         * Cached $wp_filter so it can be restored at the end of the callback.
         * This is needed because this callback uses the_content filter / calls a function
         * which uses the_content filter. WordPress doesn't support nested filter
         */
        $wp_filter_cache = $wp_filter;
        // Helpers.
        $sticky = et_pb_sticky_options();
        $multi_view = et_pb_multi_view_options($this);
        $use_current_loop = isset($this->props['use_current_loop']) ? $this->props['use_current_loop'] : 'off';
        $post_type = isset($this->props['post_type']) ? $this->props['post_type'] : 'post';
        $taxonomy = isset($this->props['taxonomy_'.$post_type]) ? $this->props['taxonomy_'.$post_type] : 'category';
        $include_categories = isset($this->props['include_categories_'.$taxonomy]) ? explode(',', $this->props['include_categories_'.$taxonomy]) : ['0'];
        //var_dump($include_categories);
        $fullwidth = $this->props['fullwidth'];
        $posts_number = $this->props['posts_number'];
        // $include_categories = $this->props['include_categories'];
        $meta_date = $this->props['meta_date'];
        $show_thumbnail = $this->props['show_thumbnail'];
        $show_content = $this->props['show_content'];
        $show_author = $this->props['show_author'];
        $show_date = $this->props['show_date'];
        $show_categories = $this->props['show_categories'];
        $show_comments = $this->props['show_comments'];
        $show_excerpt = $this->props['show_excerpt'];
        $use_manual_excerpt = $this->props['use_manual_excerpt'];
        $excerpt_length = $this->props['excerpt_length'];
        $show_pagination = $this->props['show_pagination'];
        $show_more = $this->props['show_more'];
        $offset_number = $this->props['offset_number'];
        $use_overlay = $this->props['use_overlay'];
        $header_level = $this->props['header_level'];
        $background_layout = $this->props['background_layout'];
        $background_layout_hover = et_pb_hover_options()->get_value('background_layout', $this->props, 'light');
        $background_layout_hover_enabled = et_pb_hover_options()->is_enabled('background_layout', $this->props);
        $background_layout_values = et_pb_responsive_options()->get_property_values($this->props, 'background_layout');
        $background_layout_tablet = isset($background_layout_values['tablet']) ? $background_layout_values['tablet'] : '';
        $background_layout_phone = isset($background_layout_values['phone']) ? $background_layout_values['phone'] : '';
        $hover_icon = $this->props['hover_icon'];
        $hover_icon_values = et_pb_responsive_options()->get_property_values($this->props, 'hover_icon');
        $hover_icon_tablet = isset($hover_icon_values['tablet']) ? $hover_icon_values['tablet'] : '';
        $hover_icon_phone = isset($hover_icon_values['phone']) ? $hover_icon_values['phone'] : '';
        $hover_icon_sticky = $sticky->get_value('hover_icon', $this->props);
        $video_background = $this->video_background();
        $parallax_image_background = $this->get_parallax_image_background();
        $container_is_closed = false;
        $processed_header_level = et_pb_process_header_level($header_level, 'h2');
        // some themes do not include these styles/scripts so we need to enqueue them in this module to support audio post format
        wp_enqueue_style('wp-mediaelement');
        wp_enqueue_script('wp-mediaelement');
        // include easyPieChart which is required for loading Blog module content via ajax correctly
        wp_enqueue_script('easypiechart');
        // include ET Shortcode scripts
        wp_enqueue_script('et-shortcodes-js');
        // remove all filters from WP audio shortcode to make sure current theme doesn't add any elements into audio module
        remove_all_filters('wp_audio_shortcode_library');
        remove_all_filters('wp_audio_shortcode');
        remove_all_filters('wp_audio_shortcode_class');
        // Masonry Tile Background color.
        $this->generate_styles(
            [
                'base_attr_name' => 'masonry_tile_background_color',
                'selector' => '%%order_class%% .et_pb_blog_grid .et_pb_post',
                'css_property' => 'background-color',
                'render_slug' => $render_slug,
                'type' => 'color',
            ]
        );
        // Overlay Icon Color.
        $this->generate_styles(
            [
                'hover' => false,
                'base_attr_name' => 'overlay_icon_color',
                'selector' => '%%order_class%% .et_overlay:before',
                'css_property' => 'color',
                'render_slug' => $render_slug,
                'type' => 'color',
            ]
        );
        // Hover Overlay Color.
        $this->generate_styles(
            [
                'hover' => false,
                'base_attr_name' => 'hover_overlay_color',
                'selector' => '%%order_class%% .et_overlay',
                'css_property' => 'background-color',
                'render_slug' => $render_slug,
                'type' => 'color',
            ]
        );
        $overlay_output = '';
        if ('on' === $use_overlay) {
            $overlay_output = ET_Builder_Module_Helper_Overlay::render(
                [
                    'icon' => $hover_icon,
                    'icon_tablet' => $hover_icon_tablet,
                    'icon_phone' => $hover_icon_phone,
                    'icon_sticky' => $hover_icon_sticky,
                ]
            );
        }
        $overlay_class = 'on' === $use_overlay ? ' et_pb_has_overlay' : '';
        if ('on' !== $fullwidth) {
            wp_enqueue_script('salvattore');
            $background_layout = 'light';
            $background_layout_tablet = !empty($background_layout_tablet) ? 'light' : '';
            $background_layout_phone = !empty($background_layout_phone) ? 'light' : '';
        }
        $args = [
            'posts_per_page' => (int)$posts_number,
            'post_status' => 'publish',
            'perm' => 'readable',
            'post_type' => $post_type,
        ];
        // Nearby Feature
        $use_nearby_loop = isset($this->props['use_nearby_loop']) ? $this->props['use_nearby_loop'] : 'off';
        $nearby_distance = isset($this->props['nearby_distance']) ? $this->props['nearby_distance'] : '';
        $nearby_meta_key = isset($this->props['nearby_meta_key']) ? $this->props['nearby_meta_key'] : '';
        if ('on' === $use_nearby_loop && !empty($nearby_distance) && !empty($nearby_meta_key)) {
            $nearby_places = $this->nearby_places_ids($post_type, $main_query_post->ID, $nearby_distance, $nearby_meta_key);
            $args['orderby'] = 'post__in';
            $args['post__in'] = $nearby_places;
        }
        // Show Posts With ACF Relationship From Other Post Type
        $use_relationship_posts = isset($this->props['use_relationship_posts']) ? $this->props['use_relationship_posts'] : 'off';
        $relationship_posts_metakey = isset($this->props['relationship_posts_metakey']) ? $this->props['relationship_posts_metakey'] : '';
        if ('on' === $use_relationship_posts && !empty($relationship_posts_metakey)) {
            $field_object = get_field_object($relationship_posts_metakey, $post);
            if (isset($field_object['value'][0])) {
                if (is_integer($field_object['value'][0])) {
                    $relationship_posts_ids = $field_object['value'];
                } else {
                    $relationship_posts_ids = wp_list_pluck($field_object['value'], 'ID');
                }
                if (!empty($relationship_posts_ids)) {
                    $args['post__in'] = $relationship_posts_ids;
                }
            }
        }
        $include_categories = array_filter($include_categories, 'strlen');
        if (!empty($include_categories)) {
            if (in_array('current', $include_categories)) {
                $post_terms = wp_get_post_terms($main_query_post->ID, $taxonomy, ['fields' => 'ids']);
                if (!is_wp_error($post_terms)) {
                    $args['tax_query'] = [
                        [
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => $post_terms,
                        ]
                    ];
                }
            } else {
                $args['tax_query'] = [
                    [
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => $include_categories,
                    ]
                ];
            }
        }
        $et_paged = is_front_page() ? get_query_var('page') : get_query_var('paged');
        if ($__et_blog_module_paged > 1) {
            $et_paged = $__et_blog_module_paged;
            $paged = $__et_blog_module_paged; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
            $args['paged'] = $__et_blog_module_paged;
        }
        if (is_front_page()) {
            $paged = $et_paged; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
        }
        // $args['cat'] = implode( ',', self::filter_include_categories( $include_categories ) );
        $args['paged'] = $et_paged;
        if ('' !== $offset_number && !empty($offset_number)) {
            /**
             * Offset + pagination don't play well. Manual offset calculation required
             * @see: https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
             */
            if ($paged > 1) {
                $args['offset'] = (($et_paged - 1) * intval($posts_number)) + intval($offset_number);
            } else {
                $args['offset'] = intval($offset_number);
            }
        }
        if ($main_query_post && is_singular($main_query_post->post_type) && !isset($args['post__not_in'])) {
            $args['post__not_in'] = [$main_query_post->ID];
        }
        // Images: Add CSS Filters and Mix Blend Mode rules (if set)
        if (array_key_exists('image', $this->advanced_fields) && array_key_exists('css', $this->advanced_fields['image'])) {
            $this->add_classname(
                $this->generate_css_filters(
                    $render_slug,
                    'child_',
                    self::$data_utils->array_get($this->advanced_fields['image']['css'], 'main', '%%order_class%%')
                )
            );
        }
        self::$rendering = true;
        $post_meta_remove_keys = [
            'show_author',
            'show_date',
            'show_categories',
            'show_comments',
        ];
        $post_meta_removes = [
            'desktop' => [
                'none' => 'none',
            ],
            'tablet' => [
                'none' => 'none',
            ],
            'phone' => [
                'none' => 'none',
            ],
            'hover' => [
                'none' => 'none',
            ],
        ];
        foreach ($post_meta_removes as $mode => $post_meta_remove) {
            foreach ($post_meta_remove_keys as $post_meta_remove_key) {
                if ($multi_view->has_value($post_meta_remove_key, 'on', $mode, true)) {
                    continue;
                }
                $post_meta_remove[$post_meta_remove_key] = $post_meta_remove_key;
            }
            $post_meta_removes[$mode] = implode(',', $post_meta_remove);
        }
        $multi_view->set_custom_prop('post_meta_removes', $post_meta_removes);
        $multi_view->set_custom_prop('post_content', $multi_view->get_values('show_content'));
        $show_thumbnail = $multi_view->has_value('show_thumbnail', 'on');
        ob_start();
        // Stash properties that will not be the same after wp_reset_query().
        $wp_query_props = [
            'current_post' => $wp_query->current_post,
            'in_the_loop' => $wp_query->in_the_loop,
        ];
        $show_no_results_template = true;
        //var_dump($args);
        if ('off' === $use_current_loop) {
            query_posts($args);
        } elseif (is_singular()) {
            // Force an empty result set in order to avoid loops over the current post.
            query_posts(['post__in' => [0]]);
            $show_no_results_template = false;
        } else {
            // Only allow certain args when `Posts For Current Page` is set.
            $original = $wp_query->query_vars;
            $custom = array_intersect_key($args, array_flip(['posts_per_page', 'offset', 'paged']));
            // Trick WP into reporting this query as the main query so third party filters
            // that check for is_main_query() are applied.
            $wp_the_query = $wp_query = new WP_Query(array_merge($original, $custom));
        }
        /**
         * Filters Blog module's main query.
         *
         * @param WP_Query $wp_query
         *
         * @since 4.7.0
         */
        $wp_query = apply_filters('et_builder_blog_query', $wp_query); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- We intend to override $wp_query for blog module.
        // Manually set the max_num_pages to make the `next_posts_link` work
        if ('' !== $offset_number && !empty($offset_number)) {
            global $wp_query;
            $wp_query->found_posts = max(0, $wp_query->found_posts - intval($offset_number));
            $posts_number = intval($posts_number);
            $wp_query->max_num_pages = $posts_number > 1 ? ceil($wp_query->found_posts / $posts_number) : 1;
        }
        $blog_order = self::_get_index([self::INDEX_MODULE_ORDER, $render_slug]);
        $items_count = 0;
        $wp_query->et_pb_custblog_query = true;
        if (have_posts()) {
            if ('off' === $fullwidth) {
                $attribute = et_core_is_fb_enabled() ? 'data-et-vb-columns' : 'data-columns';
                echo '<div class="et_pb_salvattore_content" '.et_core_intentionally_unescaped($attribute, 'fixed_string').'>';
            }
            while (have_posts()) {
                the_post();
                ET_Post_Stack::replace($post);
                $post_format = et_pb_post_format();
                $thumb = '';
                $width = 'on' === $fullwidth ? 1080 : 400;
                $width = (int)apply_filters('et_pb_blog_image_width', $width);
                $height = 'on' === $fullwidth ? 675 : 250;
                $height = (int)apply_filters('et_pb_blog_image_height', $height);
                $classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
                $titletext = get_the_title();
                $alttext = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                $thumbnail = get_thumbnail($width, $height, $classtext, $alttext, $titletext, false, 'Blogimage');
                $thumb = $thumbnail['thumb'];
                $no_thumb_class = '' === $thumb || !$show_thumbnail ? ' et_pb_no_thumb' : '';
                if (in_array($post_format, ['video', 'gallery'])) {
                    $no_thumb_class = '';
                }
                $item_class = sprintf(' et_pb_blog_item_%1$s_%2$s', $blog_order, $items_count);
                $items_count++;
                ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post clearfix'.$no_thumb_class.$overlay_class.$item_class); ?>>

                <?php
                et_divi_post_format_content();
                if (!in_array($post_format, ['link', 'audio', 'quote']) || post_password_required($post)) {
                    if ('video' === $post_format && false !== ($first_video = et_get_first_video())) :
                        $video_overlay = has_post_thumbnail() ? sprintf(
                            '<div class="et_pb_video_overlay" style="background-image: url(%1$s); background-size: cover;">
								<div class="et_pb_video_overlay_hover">
									<a href="#" class="et_pb_video_play"></a>
								</div>
							</div>',
                            $thumb
                        ) : '';
                        printf(
                            '<div class="et_main_video_container">
								%1$s
								%2$s
							</div>',
                            et_core_esc_previously($video_overlay),
                            et_core_esc_previously($first_video)
                        );
                    elseif ('gallery' === $post_format) :
                        et_pb_gallery_images('slider');
                    elseif ('' !== $thumb && $show_thumbnail) :
                        if ('on' !== $fullwidth) {
                            echo '<div class="et_pb_image_container">';
                        }
                        $thumbnail_output = print_thumbnail($thumb, $thumbnail['use_timthumb'], $titletext, $width, $height, '', false);
                        if ('on' === $use_overlay) {
                            $thumbnail_output .= et_core_esc_previously($overlay_output);
                        }
                        if ($thumbnail_output) {
                            $multi_view->render_element(
                                [
                                    'tag' => 'a',
                                    'content' => $thumbnail_output,
                                    'attrs' => [
                                        'href' => get_the_permalink(),
                                        'class' => 'entry-featured-image-url',
                                    ],
                                    'visibility' => [
                                        'show_thumbnail' => 'on',
                                    ],
                                    'required' => [
                                        'show_thumbnail' => 'on',
                                    ],
                                    'hover_selector' => '%%order_class%% .et_pb_post',
                                ],
                                true
                            );
                        }
                        if ('on' !== $fullwidth) {
                            echo '</div> <!-- .et_pb_image_container -->';
                        }
                    endif;
                }
                ?>
                <?php if ('off' === $fullwidth || !in_array($post_format, ['link', 'audio', 'quote']) || post_password_required($post)) { ?>
                    <?php if (!in_array($post_format, ['link', 'audio']) || post_password_required($post)) { ?>
                        <<?php echo et_core_intentionally_unescaped($processed_header_level, 'fixed_string'); ?> class="entry-title">
                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></<?php echo et_core_intentionally_unescaped($processed_header_level, 'fixed_string'); ?>>
                    <?php } ?>
                    <?php
                    // Meta
                    $multi_view->render_element(
                        [
                            'tag' => 'p',
                            'content' => '{{post_meta_removes}}',
                            'attrs' => [
                                'class' => 'post-meta',
                            ],
                            'hover_selector' => '%%order_class%% .et_pb_post',
                        ],
                        true
                    );
                    echo '<div class="post-content">';
                    // Excerpt
                    $multi_view->render_element(
                        [
                            'tag' => 'div',
                            'content' => '{{post_content}}',
                            'attrs' => [
                                'class' => 'post-content-inner',
                            ],
                            'visibility' => [
                                'show_excerpt' => 'on',
                            ],
                            'classes' => [
                                'et_pb_blog_show_content' => [
                                    'show_content' => 'on',
                                ],
                            ],
                            'hover_selector' => '%%order_class%% .et_pb_post',
                        ],
                        true
                    );
                    // Custom Fields
                    $use_custom_fields = isset($this->props['use_custom_fields']) ? $this->props['use_custom_fields'] : 'off';
                    $custom_field_ids = isset($this->props['custom_field_ids']) ? $this->props['custom_field_ids'] : '';
                    if ('on' === $use_custom_fields && !empty($custom_field_ids)) {
                        $explode_by_pipe = explode('|', $custom_field_ids);
                        if (!empty($explode_by_pipe) && is_array($explode_by_pipe)) {
                            echo '<div class="acf-custom-fields">';
                            foreach ($explode_by_pipe as $parent) {
                                $explode_by_colon = explode(':', $parent);
                                if (!empty($explode_by_colon[0]) && !empty($explode_by_colon[1])) {
                                    $tag = $explode_by_colon[0];
                                    $field_id = $explode_by_colon[1];
                                    $field_obj = get_field_object($field_id);
                                    $field_data = get_field($field_id);
                                    if (!empty($field_obj) && !empty($field_data)) {
                                        $field_name = $field_obj['name'];
                                        $field_type = strtolower(trim($field_obj['type']));
                                        if (in_array($field_type, ['text', 'textarea', 'number', 'email', 'url', 'file', 'password', 'wysiwyg', 'image', 'oembed', 'checkbox', 'radio', 'true_false'])) {

                                            // image
                                            if ('image' === $field_type) {
                                                if (is_array($field_data) && isset($field_data['url']) && isset($field_data['id'])) {
                                                    $img_url = $field_data['url'];
                                                    $img_alt = $field_data['alt'];
                                                } else if (is_string($field_data)) {
                                                    $img_url = $field_data;
                                                    $img_alt = get_post_meta(attachment_url_to_postid($field_data), '_wp_attachment_image_alt', true);
                                                } else {
                                                    $img_url = wp_get_attachment_url($field_data);
                                                    $img_alt = get_post_meta($field_data, '_wp_attachment_image_alt', true);
                                                }
                                                echo sprintf('<%1$s><img src="%2$s" alt="%3$s" class="acf_field_'.$field_name.'"></%1$s>', $tag, $img_url, $img_alt);
                                            } // oembed
                                            elseif ('oembed' === $field_type) {
                                                echo sprintf('<%1$s class="acf_field_'.$field_name.'">%2$s</%1$s>', $tag, $field_data);
                                            } // checkbox
                                            elseif ('checkbox' === $field_type && 'label' === $field_obj['return_format']) {
                                                echo sprintf('<%1$s class="acf_field_'.$field_name.'"><b>%2$s</b>: %3$s</%1$s>', $tag, $field_obj['label'], implode(',', $field_data));
                                            } // radio
                                            elseif ('radio' === $field_type && 'label' === $field_obj['return_format']) {
                                                echo sprintf('<%1$s class="acf_field_'.$field_name.'"><b>%2$s</b>: %3$s</%1$s>', $tag, $field_obj['label'], $field_data);
                                            } // true_false
                                            elseif ('true_false' === $field_type) {
                                                echo sprintf('<%1$s class="acf_field_'.$field_name.'"><b>%2$s</b>: %3$s</%1$s>', $tag, $field_obj['label'], $field_data ? 'Yes' : 'No');
                                            } // file
                                            elseif ('file' === $field_type && filter_var($field_data, FILTER_VALIDATE_URL)) {
                                                $label = isset($field_obj['label']) ? $field_obj['label'] : 'Download';
                                                $filename = pathinfo(basename($field_data), PATHINFO_FILENAME);
                                                $filename = preg_replace('/[^\w\s]/', ' ', $filename);
                                                $filename = str_replace(['-', '_'], ' ', $filename);
                                                $fileext = strtoupper(pathinfo(basename($field_data), PATHINFO_EXTENSION));
                                                if (preg_match('/^(jpg|jpeg|png|gif|bmp|tiff|webp)$/i', $fileext)) {
                                                    $label .= " Image";
                                                } elseif (preg_match('/^(doc|docx|txt|pdf)$/i', $fileext)) {
                                                    $label .= " File";
                                                }
                                                echo sprintf('<b>%1$s</b><a class="acf_field_'.$field_name.'" href="%2$s" download="">: %3$s</a>', $label, $field_data, $filename);
                                            } else {
                                                echo sprintf('<%1$s class="acf_field_'.$field_name.'">%2$s</%1$s>', $tag, $field_data);
                                            }
                                        }
                                    }
                                }
                            }
                            echo '</div>';
                        }

                    }
                    // Read More
                    $multi_view->render_element(
                        [
                            'tag' => 'a',
                            'content' => esc_html__('read more', 'et_builder'),
                            'attrs' => [
                                'class' => 'more-link',
                                'href' => esc_url(get_permalink()),
                            ],
                            'visibility' => [
                                'show_content' => 'off',
                                'show_more' => 'on',
                            ],
                            'required' => [
                                'show_content' => 'off',
                                'show_more' => 'on',
                            ],
                            'hover_selector' => '%%order_class%% .et_pb_post',
                        ],
                        true
                    );
                    echo '</div>';
                    ?>
                <?php } // 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote', 'gallery' ?>
                </article> <!-- .et_pb_post -->
                <?php
                ET_Post_Stack::pop();
            } // endwhile
            ET_Post_Stack::reset();
            if ('off' === $fullwidth) {
                echo '</div><!-- .et_pb_salvattore_content -->';
            }
            if ($multi_view->has_value('show_pagination', 'on')) {
                $multi_view->render_element(
                    [
                        'tag' => 'div',
                        'content' => $this->render_pagination(false),
                        'visibility' => [
                            'show_pagination' => 'on',
                        ],
                        'hover_selector' => '%%order_class%% .et_pb_post',
                    ],
                    true
                );
                echo '</div> <!-- .et_pb_posts -->';
                $container_is_closed = true;
            }
        } elseif ($show_no_results_template) {
            echo self::get_no_results_template(et_core_intentionally_unescaped($processed_header_level, 'fixed_string'));
        }
        unset($wp_query->et_pb_custblog_query);
        $wp_the_query = $wp_query = $main_query;
        wp_reset_query();
        ET_Post_Stack::reset();
        // Restore stashed properties.
        foreach ($wp_query_props as $prop => $value) {
            $wp_query->{$prop} = $value;
        }
        $posts = ob_get_contents();
        ob_end_clean();
        self::$rendering = false;
        // Remove automatically added classnames
        $this->remove_classname(
            [
                $render_slug,
            ]
        );
        // Background layout data attributes.
        $background_layout_props = array_merge(
            $this->props,
            [
                'background_layout' => $background_layout,
                'background_layout_tablet' => $background_layout_tablet,
                'background_layout_phone' => $background_layout_phone,
            ]
        );
        $data_background_layout = et_pb_background_layout_options()->get_background_layout_attrs($background_layout_props);
        if ('on' !== $fullwidth) {
            // Module classname
            $this->add_classname(
                [
                    'et_pb_blog_grid_wrapper',
                ]
            );
            // Remove auto-added classname for module wrapper because on grid mode these classnames
            // are placed one level below module wrapper
            $this->remove_classname(
                [
                    'et_pb_section_video',
                    'et_pb_preload',
                    'et_pb_section_parallax',
                ]
            );
            // Inner module wrapper classname
            $inner_wrap_classname = [
                'et_pb_blog_grid',
                'clearfix',
                $this->get_text_orientation_classname(),
            ];
            // Background layout class names.
            $background_layout_class_names = et_pb_background_layout_options()->get_background_layout_class($background_layout_props, false, true);
            array_merge($inner_wrap_classname, $background_layout_class_names);
            if ('' !== $video_background) {
                $inner_wrap_classname[] = 'et_pb_section_video';
                $inner_wrap_classname[] = 'et_pb_preload';
            }
            if ('' !== $parallax_image_background) {
                $inner_wrap_classname[] = 'et_pb_section_parallax';
            }
            $output = sprintf(
                '<div%4$s class="%5$s"%9$s>
					<div class="%1$s">
					%7$s
					%6$s
					<div class="et_pb_ajax_pagination_container">
						%2$s
					</div>
					%3$s %8$s
				</div>',
                esc_attr(implode(' ', $inner_wrap_classname)),
                $posts,
                (!$container_is_closed ? '</div> <!-- .et_pb_posts -->' : ''),
                $this->module_id(),
                $this->module_classname($render_slug), // #5
                $video_background,
                $parallax_image_background,
                $this->drop_shadow_back_compatibility($render_slug),
                et_core_esc_previously($data_background_layout)
            );
        } else {
            // Module classname
            $this->add_classname(
                [
                    'et_pb_posts',
                    "et_pb_bg_layout_{$background_layout}",
                    $this->get_text_orientation_classname(),
                ]
            );
            if (!empty($background_layout_tablet)) {
                $this->add_classname("et_pb_bg_layout_{$background_layout_tablet}_tablet");
            }
            if (!empty($background_layout_phone)) {
                $this->add_classname("et_pb_bg_layout_{$background_layout_phone}_phone");
            }
            $output = sprintf(
                '<div%4$s class="%1$s"%8$s>
				%6$s
				%5$s
				<div class="et_pb_ajax_pagination_container">
					%2$s
				</div>
				%3$s %7$s',
                $this->module_classname($render_slug),
                $posts,
                (!$container_is_closed ? '</div> <!-- .et_pb_posts -->' : ''),
                $this->module_id(),
                $video_background, // #5
                $parallax_image_background,
                $this->drop_shadow_back_compatibility($render_slug),
                et_core_esc_previously($data_background_layout)
            );
        }
        // Restore $wp_filter
        $wp_filter = $wp_filter_cache; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
        unset($wp_filter_cache);
        // Restore global $post into its original state when et_pb_custblog shortcode ends to avoid
        // the rest of the page uses incorrect global $post variable
        $post = $post_cache; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

        return $output;
    }

    public function process_box_shadow($function_name)
    {
        if (isset($this->props['fullwidth']) && $this->props['fullwidth'] === 'off') {
            // Only override 'default' box shadow because we also defined
            // box shadow settings for the image.
            $this->advanced_fields['box_shadow']['default'] = [
                'css' => [
                    'main' => '%%order_class%% article.et_pb_post',
                    'hover' => '%%order_class%% article.et_pb_post:hover',
                    'overlay' => 'inset',
                ],
            ];
        }
        parent::process_box_shadow($function_name);
    }

    private function drop_shadow_back_compatibility($functions_name)
    {
        $utils = ET_Core_Data_Utils::instance();
        $atts = $this->props;
        if (
            version_compare($utils->array_get($atts, '_builder_version', '3.0.93'), '3.0.94', 'lt')
            &&
            'on' !== $utils->array_get($atts, 'fullwidth')
            &&
            'on' === $utils->array_get($atts, 'use_dropshadow')
        ) {
            $class = self::get_module_order_class($functions_name);

            return sprintf(
                '<style>%1$s</style>',
                sprintf('.%1$s  article.et_pb_post { box-shadow: 0 1px 5px rgba(0,0,0,.1) }', esc_html($class))
            );
        }

        return '';
    }

    public function multi_view_filter_value($raw_value, $args, $multi_view)
    {
        $name = isset($args['name']) ? $args['name'] : '';
        $mode = isset($args['mode']) ? $args['mode'] : '';
        $context = isset($args['context']) ? $args['context'] : '';
        if ('post_content' === $name && 'content' === $context) {
            global $et_pb_rendering_column_content;
            $post_content = et_strip_shortcodes(et_delete_post_first_video(get_the_content()), true);
            $et_pb_rendering_column_content = true;
            if ('on' === $raw_value) {
                global $more;
                if (et_pb_is_pagebuilder_used(get_the_ID())) {
                    $more = 1; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
                    $raw_value = et_core_intentionally_unescaped(apply_filters('the_content', $post_content), 'html');
                } else {
                    $more = null; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
                    $raw_value = et_core_intentionally_unescaped(apply_filters('the_content', et_delete_post_first_video(get_the_content(esc_html__('read more...', 'et_builder')))), 'html');
                }
            } else {
                $use_manual_excerpt = isset($this->props['use_manual_excerpt']) ? $this->props['use_manual_excerpt'] : 'off';
                $excerpt_length = isset($this->props['excerpt_length']) ? $this->props['excerpt_length'] : 270;
                if (has_excerpt() && 'off' !== $use_manual_excerpt) {
                    /**
                     * Filters the displayed post excerpt.
                     *
                     * @param string $post_excerpt The post excerpt.
                     *
                     * @since 3.29
                     */
                    $raw_value = apply_filters('the_excerpt', get_the_excerpt());
                } else {
                    $raw_value = et_core_intentionally_unescaped(wpautop(et_delete_post_first_video(strip_shortcodes(truncate_post($excerpt_length, false, '', true)))), 'html');
                }
            }
            $et_pb_rendering_column_content = false;
        } elseif ('show_content' === $name && 'visibility' === $context) {
            $raw_value = $multi_view->has_value($name, 'on', $mode, true) ? 'on' : $raw_value;
        } elseif ('post_meta_removes' === $name && 'content' === $context) {
            $post_meta_remove_keys = [
                'show_author' => true,
                'show_date' => true,
                'show_categories' => true,
                'show_comments' => true,
            ];
            $post_meta_removes = explode(',', $raw_value);
            if ($post_meta_removes) {
                foreach ($post_meta_removes as $post_meta_remove) {
                    unset($post_meta_remove_keys[$post_meta_remove]);
                }
            }
            $post_meta_datas = [];
            if (isset($post_meta_remove_keys['show_author'])) {
                $post_meta_datas[] = et_get_safe_localization(sprintf(__('by %s', 'et_builder'), '<span class="author vcard">'.et_pb_get_the_author_posts_link().'</span>'));
            }
            if (isset($post_meta_remove_keys['show_date'])) {
                $post_meta_datas[] = et_get_safe_localization(sprintf(__('%s', 'et_builder'), '<span class="published">'.esc_html(get_the_date($this->props['meta_date'])).'</span>'));
            }
            if (isset($post_meta_remove_keys['show_categories'])) {
                $post_meta_datas[] = et_builder_get_the_term_list(', ');
            }
            if (isset($post_meta_remove_keys['show_comments'])) {
                $post_meta_datas[] = sprintf(esc_html(_nx('%s Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder')), number_format_i18n(get_comments_number()));
            }
            $raw_value = implode(' | ', $post_meta_datas);
        }

        return $raw_value;
    }

    private function nearby_places_ids($post_type, $current_post_id, $nearby_distance, $field_selector)
    {
        $location = get_field($field_selector, $current_post_id);
        $current_post_lat = isset($location['lat']) ? $location['lat'] : '';
        $current_post_long = isset($location['lng']) ? $location['lng'] : '';
        $nearest_data = [];
        if (!empty($current_post_lat) && !empty($current_post_long)) {
            $posts = get_posts([
                'post_type' => $post_type,
                'posts_per_page' => -1,
                'post__not_in' => [$current_post_id],
                'fields' => 'ids'
            ]);
            foreach ($posts as $post) {
                $location = get_field($field_selector, $post);
                if (isset($location['lat']) && isset($location['lng'])) {
                    $places_distance = $this->get_distance($current_post_lat, $current_post_long, $location['lat'], $location['lng']);
                    if ($places_distance < $nearby_distance) {
                        //pac_dicbm_dd('PLACE '.get_the_title($post).'  Distance: '.$places_distance, false);
                        $nearest_data[$post] = $places_distance;
                    }
                }
            }
            asort($nearest_data);
        }
        if (isset($_GET['pac_debug'])) {
            pac_dicbm_dd($nearest_data, false);
        }

        return array_keys($nearest_data);
    }

    public function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi')
    {
        $theta = $longitude1 - $longitude2;
        $distance = sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        switch ($unit) {
            case 'Mi':
                break;
            case 'Km' :
                $distance = $distance * 1.609344;
        }

        return (round($distance, 2));
    }

    private function get_distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $dist = $dist * 60 * 1.1515;

        return round($dist, 2);
    }
}

new ET_Builder_Module_CustomBlog();