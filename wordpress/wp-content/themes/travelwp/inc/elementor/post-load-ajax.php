<?php

namespace Elementor;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

use Thim_EL_Kit\GroupControlTrait;

class Physc_Post_Load_Ajax_Element extends Thim_Ekit_Widget_List_Blog {
    public function get_name() {
        return 'post-load-ajax';
    }

    public function get_title() {
        return esc_html__('Post Load Ajax', 'travelwp'); 
    }

    public function get_icon() {
        return 'eicon-post-list';
    }
    public function get_categories() {
        return ['travelwp-elements'];
    }

    public function get_base() {
        return basename(__FILE__, '.php');
    }
    protected function register_controls() {
        $this->start_controls_section(
            'section_content_list',
            array(
                'label' => esc_html__('Settings', 'travelwp'),
            )
        );
        $this->add_control(
            'build_loop_item',
            array(
                'label'     => esc_html__('Build Loop Item', 'travelwp'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'separator' => 'before',
            )
        );
        $this->add_control(
            'template_id',
            array(
                'label'   => esc_html__('Choose a template', 'travelwp'),
                'type'    => Controls_Manager::SELECT2,
                'default' => '0',
                'options' => array('0' => esc_html__('None', 'travelwp')) + \Thim_EL_Kit\Functions::instance()->get_pages_loop_item('post'),
                'condition'   => array(
                    'build_loop_item' => 'yes',
                ),
            )
        );

        $this->add_control(
            'cat_id',
            array(
                'label'   => esc_html__('Select Category', 'travelwp'),
                'default' => 'all',
                'type'    => Controls_Manager::SELECT,
                'options' => \Thim_EL_Kit\Elementor::get_cat_taxonomy('category', array('all' => esc_html__('All', 'travelwp'))),
            )
        );

        $this->add_control(
            'number_posts',
            array(
                'label'   => esc_html__('Number Post', 'travelwp'),
                'default' => '4',
                'type'    => Controls_Manager::NUMBER,
            )
        );

        $this->add_responsive_control(
            'columns',
            array(
                'label'          => esc_html__('Columns', 'travelwp'),
                'type'           => Controls_Manager::SELECT,
                'default'        => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options'        => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
                'selectors'      => array(
                    '{{WRAPPER}}' => '--thim-ekits-post-columns: repeat({{VALUE}}, 1fr)',
                ),
            )
        );

        $this->add_control(
            'orderby',
            array(
                'label'   => esc_html__('Order by', 'travelwp'),
                'type'    => Controls_Manager::SELECT,
                'options' => array(
                    'popular' => esc_html__('Popular', 'travelwp'),
                    'recent'  => esc_html__('Date', 'travelwp'),
                    'title'   => esc_html__('Title', 'travelwp'),
                    'random'  => esc_html__('Random', 'travelwp'),
                ),
                'default' => 'recent',
            )
        );

        $this->add_control(
            'order',
            array(
                'label'   => esc_html__('Order by', 'travelwp'),
                'type'    => Controls_Manager::SELECT,
                'options' => array(
                    'asc'  => esc_html__('ASC', 'travelwp'),
                    'desc' => esc_html__('DESC', 'travelwp'),
                ),
                'default' => 'asc',
            )
        );

        $this->end_controls_section();
        $this->_register_content();
        $this->_register_style_blog();
        $this->_register_style_image();
        // Register content
        $this->start_controls_section(
            'section_style_content',
            array(
                'label'     => esc_html__('Content', 'travelwp'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'build_loop_item!' => 'yes',
                ),
            )
        );
        $this->end_controls_section();
        $this->_register_pagination_options();
        $this->_register_setting_prev_next_style();
        $this->register_style_pagination();
    }
    protected function _register_pagination_options() {
        $this->start_controls_section(
            'section_blog_pagination',
            array(
                'label' => esc_html__('Pagination', 'travelwp'),
            )
        );

        $this->add_control(
            'blog_pagination_type',
            array(
                'label'              => esc_html__('Pagination', 'travelwp'),
                'type'               => Controls_Manager::SELECT,
                'default'            => '',
                'options'            => array(
                    ''                          => esc_html__('None', 'travelwp'),
                    'numbers'                   => esc_html__('Numbers', 'travelwp'),
                    'prev_next'                 => esc_html__('Previous/Next', 'travelwp'),
                    'load_more_all' => esc_html__('All', 'travelwp'),
                ),
                'frontend_available' => true,
            )
        );

        // $this->add_control(
        //     'blog_pagination_page_limit',
        //     array(
        //         'label'     => esc_html__('Page Limit', 'travelwp'),
        //         'type'        => Controls_Manager::NUMBER,
        //         'label_block' => false,
        //         'min'         => 0,
        //         'step'        => 1,
        //         'default'   => '5',
        //         'condition'      => array(
        //             'blog_pagination_type!' => '',
        //         ),
        //     )
        // );
        $this->end_controls_section();
    }
    public function _register_setting_prev_next_style() {

        $this->start_controls_section(
            'slider_nav_style_tab',
            array(
                'label'     => esc_html__('Next/Prev', 'travelwp'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_pagination_type' => array('prev_next', 'load_more_all'),
                ]
            )
        );

        $this->start_controls_tabs(
            'slider_nav_group_tabs'
        );

        $this->start_controls_tab(
            'slider_nav_prev_tab',
            array(
                'label' => esc_html__('Prev', 'travelwp'),
            )
        );
        // $this->add_control(
        // 	'slider_arrows_left',
        // 	array(
        // 		'label'       => esc_html__( 'Prev Arrow Icon', 'travelwp' ),
        // 		'type'        => Controls_Manager::ICONS,
        // 		'skin'        => 'inline',
        // 		'label_block' => false,
        // 		'default'     => array(
        // 			'value'   => 'fas fa-arrow-left',
        // 			'library' => 'Font Awesome 5 Free',
        // 		),
        // 	)
        // );

        $this->add_control(
            'prev_offset_orientation_h',
            array(
                'label'       => esc_html__('Horizontal Orientation', 'travelwp'),
                'type'        => Controls_Manager::CHOOSE,
                'toggle'      => false,
                'default'     => 'left',
                'options'     => array(
                    'left'  => array(
                        'title' => esc_html__('Left', 'travelwp'),
                        'icon'  => 'eicon-h-align-left',
                    ),
                    'right' => array(
                        'title' => esc_html__('Right', 'travelwp'),
                        'icon'  => 'eicon-h-align-right',
                    ),
                ),
                'render_type' => 'ui',
            )
        );
        $this->add_responsive_control(
            'prev_indicator_offset_h',
            array(
                'label'       => esc_html__('Offset', 'travelwp'),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => -500,
                'step'        => 1,
                'default'     => 10,
                'selectors'   => array(
                    '{{WRAPPER}} .navigation-blog-sc .nav-prev' => '{{prev_offset_orientation_h.VALUE}}:{{VALUE}}%',
                ),
            )
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'slider_nav_next_tab',
            array(
                'label' => esc_html__('Next', 'travelwp'),
            )
        );
        // $this->add_control(
        // 	'slider_arrows_right',
        // 	array(
        // 		'label'       => esc_html__( 'Next Arrow Icon', 'travelwp' ),
        // 		'type'        => Controls_Manager::ICONS,
        // 		'skin'        => 'inline',
        // 		'label_block' => false,
        // 		'default'     => array(
        // 			'value'   => 'fas fa-arrow-right',
        // 			'library' => 'Font Awesome 5 Free',
        // 		),
        // 	)
        // );

        $this->add_control(
            'next_offset_orientation_h',
            array(
                'label'       => esc_html__('Horizontal Orientation', 'travelwp'),
                'type'        => Controls_Manager::CHOOSE,
                'toggle'      => false,
                'default'     => 'right',
                'options'     => array(
                    'left'  => array(
                        'title' => esc_html__('Left', 'travelwp'),
                        'icon'  => 'eicon-h-align-left',
                    ),
                    'right' => array(
                        'title' => esc_html__('Right', 'travelwp'),
                        'icon'  => 'eicon-h-align-right',
                    ),
                ),
                'render_type' => 'ui',
            )
        );

        $this->add_responsive_control(
            'next_indicator_offset_h',
            array(
                'label'       => esc_html__('Offset', 'travelwp'),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => -500,
                'step'        => 1,
                'default'     => 10,
                'selectors'   => array(
                    '{{WRAPPER}} .navigation-blog-sc .nav-next' => '{{next_offset_orientation_h.VALUE}}:{{VALUE}}%',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_control(
            'slider_nav_offset_position_v',
            array(
                'label'       => esc_html__('Vertical Position', 'travelwp'),
                'type'        => Controls_Manager::CHOOSE,
                'toggle'      => false,
                'default'     => '50',
                'options'     => array(
                    '0'   => array(
                        'title' => esc_html__('Top', 'travelwp'),
                        'icon'  => 'eicon-v-align-top',
                    ),
                    '50'  => array(
                        'title' => esc_html__('Middle', 'travelwp'),
                        'icon'  => 'eicon-v-align-middle',
                    ),
                    '100' => array(
                        'title' => esc_html__('Bottom', 'travelwp'),
                        'icon'  => 'eicon-v-align-bottom',
                    ),
                ),
                'render_type' => 'ui',
                'selectors'   => array(
                    '{{WRAPPER}} .nav-wrapper span' => 'top:{{VALUE}}%;',
                ),
            )
        );
        $this->add_responsive_control(
            'slider_nav_vertical_offset',
            array(
                'label'       => esc_html__('Vertical align', 'travelwp'),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => -500,
                'max'         => 500,
                'step'        => 1,
                'selectors'   => array(
                    '{{WRAPPER}} .navigation-blog-sc .nav-wrapper span' => '-webkit-transform: translateY({{VALUE}}%); -ms-transform: translateY({{SIZE}}%); transform: translateY({{SIZE}}%);',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_nav_font_size',
            array(
                'label'      => esc_html__('Font Size', 'travelwp'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array(
                    'px' => array(
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ),
                ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 36,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .navigation-blog-sc  .nav' => 'font-size: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_nav_border_radius',
            array(
                'label'      => esc_html__('Border Radius', 'travelwp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'em'),
                'selectors'  => array(
                    '{{WRAPPER}} .navigation-blog-sc  .nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_nav_width',
            array(
                'label'      => esc_html__('Width', 'travelwp'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array(
                    'px' => array(
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ),
                ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 50,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .navigation-blog-sc  .nav' => 'width: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_nav_height',
            array(
                'label'      => esc_html__('Height', 'travelwp'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array(
                    'px' => array(
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ),
                ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 50,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .navigation-blog-sc  .nav' => 'height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->start_controls_tabs(
            'slider_nav_hover_normal_tabs'
        );

        $this->start_controls_tab(
            'slider_nav_normal_tab',
            array(
                'label' => esc_html__('Normal', 'travelwp'),
            )
        );

        $this->add_responsive_control(
            'slider_nav_color_normal',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => array(
                    '{{WRAPPER}} .navigation-blog-sc  .nav' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .navigation-blog-sc  .nav svg path' => 'stroke: {{VALUE}}',
                ),
            )
        );
        $this->add_responsive_control(
            'slider_nav_bg_color_normal',
            array(
                'label'     => esc_html__('Background Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => array(
                    '{{WRAPPER}} .navigation-blog-sc  .nav' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'slider_nav_box_shadow_normal',
                'label'    => esc_html__('Box Shadow', 'travelwp'),
                'selector' => '{{WRAPPER}} .navigation-blog-sc  .nav',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'slider_nav_border_normal',
                'label'    => esc_html__('Border', 'travelwp'),
                'selector' => '{{WRAPPER}} .navigation-blog-sc  .nav',
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'slider_nav_hover_tab',
            array(
                'label' => esc_html__('Hover', 'travelwp'),
            )
        );

        $this->add_responsive_control(
            'slider_nav_color_hover',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .navigation-blog-sc  .nav:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .navigation-blog-sc  .nav:hover svg path' => 'stroke: {{VALUE}}',
                ),
            )
        );
        $this->add_responsive_control(
            'slider_nav_bg_color_hover',
            array(
                'label'     => esc_html__('Background Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .navigation-blog-sc  .nav:hover' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'slider_nav_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'travelwp'),
                'selector' => '{{WRAPPER}} .navigation-blog-sc  .nav:hover',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'slider_nav_border_hover',
                'label'    => esc_html__('Border', 'travelwp'),
                'selector' => '{{WRAPPER}} .navigation-blog-sc  .nav:hover',
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function register_style_pagination() {
        $this->start_controls_section(
            'section_style_pagination',
            array(
                'label' => esc_html__('Pagination', 'travelwp'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_pagination_type' => array('numbers', 'load_more_all'),
                ]
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'pagination_typography',
                'selector' => '{{WRAPPER}} .pagination-numbers',
            )
        );
        $this->add_responsive_control(
            'pagination_padding',
            array(
                'label'      => esc_html__('Padding', 'travelwp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .pagination-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),

            )
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border',
                'selector' => '{{WRAPPER}} .pagination-numbers',
            ]
        );
        $this->add_responsive_control(
            'slider_dot_border_radius',
            array(
                'label'      => esc_html__('Border radius', 'travelwp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'em'),
                'selectors'  => array(
                    '{{WRAPPER}} .pagination-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );
        $this->add_control(
            'pagination_color_heading',
            array(
                'label'     => esc_html__('Colors', 'travelwp'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->start_controls_tabs('pagination_colors'); 

        $this->start_controls_tab(
            'pagination_color_normal',
            array(
                'label' => esc_html__('Normal', 'travelwp'),
            )
        );

        $this->add_control(
            'pagination_color',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .pagination-numbers' => 'color: {{VALUE}};',
                ),
            )
        );
        $this->add_control(
            'pagination_bgcolor',
            array(
                'label'     => esc_html__('Background', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .pagination-numbers' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_color_hover',
            array(
                'label' => esc_html__('Hover', 'travelwp'),
            )
        );

        $this->add_control(
            'pagination_hover_color',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .pagination-numbers:hover' => 'color: {{VALUE}};',
                ),
            )
        );
        $this->add_control(
            'pagination_hover_bgcolor',
            array(
                'label'     => esc_html__('Background', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .pagination-numbers:hover' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_color_active',
            array(
                'label' => esc_html__('Active', 'travelwp'),
            )
        );

        $this->add_control(
            'pagination_active_color',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .pagination-numbers.current' => 'color: {{VALUE}};',
                ),
            )
        );
        $this->add_control(
            'pagination_active_bgcolor',
            array(
                'label'     => esc_html__('Background', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .pagination-numbers.current' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'pagination_spacing',
            array(
                'label'     => esc_html__('Space Between', 'travelwp'),
                'type'      => Controls_Manager::SLIDER,
                'separator' => 'before',
                'default'   => array(
                    'size' => 10,
                ),
                'range'     => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    'body:not(.rtl) {{WRAPPER}} .pagination-numbers:not(:first-child)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
                    'body:not(.rtl) {{WRAPPER}} .pagination-numbers:not(:last-child)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
                    'body.rtl {{WRAPPER}} .pagination-numbers:not(:first-child)' => 'margin-right: calc( {{SIZE}}{{UNIT}}/2 );',
                    'body.rtl {{WRAPPER}} .pagination-numbers:not(:last-child)' => 'margin-left: calc( {{SIZE}}{{UNIT}}/2 );',
                ),
            )
        );
        $this->add_responsive_control(
            'pagination_spacing_top',
            array(
                'label'     => esc_html__('Space top', 'travelwp'),
                'type'      => Controls_Manager::SLIDER,
                'separator' => 'before',
                'default'   => array(
                    'size' => 10,
                ),
                'range'     => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'selectors' => array(
                    'body {{WRAPPER}} .pagination-blog-loadmore' => 'margin-top:{{SIZE}}{{UNIT}};',

                ),
            )
        );

        $this->end_controls_section();
    }


    public function render() {
        $settings = $this->get_settings_for_display();
        $current_page     = max(1, get_query_var('paged'));
        $posts_per_page = absint($settings['number_posts']);
        $query_args = array(
            'post_type'           => 'post',
            'posts_per_page'      => $posts_per_page,
            'order'               => ('asc' == $settings['order']) ? 'asc' : 'desc',
            'ignore_sticky_posts' => true,
            'paged'          => $current_page,
        );

        if ($settings['cat_id'] && $settings['cat_id'] != 'all') {
            $query_args['category__in'] =  $settings['cat_id'];
        }

        switch ($settings['orderby']) {
            case 'recent':
                $query_args['orderby'] = 'post_date';
                break;
            case 'title':
                $query_args['orderby'] = 'post_title';
                break;
            case 'popular':
                $query_args['orderby'] = 'comment_count';
                break;
            default: // random
                $query_args['orderby'] = 'rand';
        }
        $query_vars = new \WP_Query($query_args);

        $class       = 'travelwp-blog-post thim-ekits-post';
        $class_inner = 'travelwp-blog-post__inner thim-ekits-post__inner';
        $class_item  = 'travelwp-blog-post__article thim-ekits-post__article';
        $icon_prev = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
		<path d="M20 26.14L10 16.14L20 6.14001" stroke="#4F5E71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>';
        $icon_next = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
		<path d="M12 6.14001L22 16.14L12 26.14" stroke="#4F5E71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>';
        $id          = 'travelwp-blog_' . wp_rand();
        $prev       = $current_page - 1;
        $next       = $current_page + 1;
        $class_prev =  '';
        $class_next = ($current_page == $query_vars->max_num_pages) ? 'disabled' : '';
        if ($query_vars->have_posts()) { // It's the global `wp_query` it self. and the loop was started from the theme.
        ?>
            <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>" data-current-page="<?php echo $current_page; ?>" data-params='<?php echo json_encode($query_args); ?>' data-max-page="<?php echo $query_vars->max_num_pages; ?>" <?php if (isset($settings['template_id']) && !empty($settings['template_id'])) {
                                                                                                                                                                                                                                                                                                                    echo 'data-templateid="' . $settings['template_id'] . '"';
                                                                                                                                                                                                                                                                                                                } ?>>
                <?php
                if (($settings['blog_pagination_type'] == 'prev_next'  || $settings['blog_pagination_type'] == 'load_more_all') && $query_vars->max_num_pages > 1) { ?>
                    <div class="page-navigation navigation-blog-sc">
                        <div class="nav-wrapper">
                            <?php
                            echo '<span class="nav nav-prev ' . $class_prev . '" data-page="' . $prev . '">' . $icon_prev . '</span>';
                            echo '<span class="nav nav-next ' . $class_next . '" data-page="' . $next . '">' . $icon_next . '</span>';
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="<?php echo esc_attr($class_inner); ?>">
                    <?php
                    while ($query_vars->have_posts()) {
                        $query_vars->the_post();
                        $this->current_permalink = get_permalink();
                        ?>
                        <div <?php post_class( array( $class_item ) ); ?>>
                        <?php
                            if ( $settings['build_loop_item'] == 'yes' ) {
                                \Thim_EL_Kit\Utilities\Elementor::instance()->render_loop_item_content( $settings['template_id'] );
                            } else {
                                get_template_part('template-parts/content');
                            }?>
		                </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                if (($settings['blog_pagination_type'] == 'numbers' || $settings['blog_pagination_type'] == 'load_more_all') && $query_vars->max_num_pages > 1) {
                    $page_limit = $query_vars->max_num_pages;
                    echo '<div class="pagination-archiver-attr pagination-blog-loadmore">';
                ?>
                    <a class="pagination-numbers nav-prev page-numbers" data-page=" <?php echo $prev; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path d="M15 19.8501L7.5 12.3501L15 4.8501" stroke="#4F5E71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></a>
                    <?php
                    for ($i = 1; $i <= $page_limit; $i++) {
                        $current = 'page-numbers pagination-numbers';
                        if ($i == 1) {
                            $current .= ' current';
                        }
                        echo '<a class="' . $current . '" data-page="' . $i . '">' . $i . '</a>';
                    }
                    ?>
                    <a class="pagination-numbers nav-next page-numbers" data-page=" <?php echo $next; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path d="M9 4.8501L16.5 12.3501L9 19.8501" stroke="#4F5E71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></a>
                <?php
                    echo '</div> ';
                } ?>
            </div>
        <?php
        } else {
            echo '<div class="message-info">' . __('No data were found matching your selection, you need to create Post or select Category of Widget.', 'travelwp') . '</div>';
        }
        wp_reset_postdata();
    }
}
