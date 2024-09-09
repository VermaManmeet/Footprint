<?php

namespace Elementor;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Physc_List_Category_Element extends Widget_Base {
    public function get_name() {
        return 'travel-list-category';
    }

    public function get_title() {
        return esc_html__('List Category', 'travelwp');
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
    }
    public function get_categories() {
        return ['travelwp-elements'];
    }

    public function get_base() {
        return basename(__FILE__, '.php');
    }
    protected function register_controls() {
        $this->start_controls_section(
            'general_settings',
            [
                'label' => esc_html__('Content', 'travelwp')
            ]
        );
        $this->add_control(
            'cats',
            [
                'label'   => esc_html__('Select Category', 'travelwp'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->get_categories_post(),
                'description' =>  esc_html__('Leave it blank to display all categories', 'travelwp'),
            ]
        );
        $this->add_responsive_control(
            'cats_number',
            [
                'label'       => esc_html__('Item show', 'travelwp'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 6,
            ]
        );
        $this->end_controls_section();
        $this->_register_style_general();
    }
    protected function _register_style_general() {
        $this->start_controls_section(
            'section_style_general',
            array(
                'label' => esc_html__('General', 'travelwp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_responsive_control(
            'align__general',
            array(
                'label'     => esc_html__('Align items', 'travelwp'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => array(
                    'space-between' => array(
                        'title' => esc_html__('Space between', 'travelwp'),
                        'icon'  => 'eicon-text-align-left',
                    ),
                    'center'     => array(
                        'title' => esc_html__('Center', 'travelwp'),
                        'icon'  => 'eicon-text-align-center',
                    ),
                    'flex-start'   => array(
                        'title' => esc_html__('Flex start', 'travelwp'),
                        'icon'  => 'eicon-align-start-h',
                    ),
                    'flex-end'   => array(
                        'title' => esc_html__('flex-end', 'travelwp'),
                        'icon'  => 'eicon-align-end-h',
                    ),

                ),
                'default'   => 'space-between',
                'toggle'    => true,
                'selectors' => array(
                    '{{WRAPPER}}  .list-cats-blog' => 'justify-content:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            '_general_spacing',
            array(
                'label'     => esc_html__('Spacing', 'travelwp'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => array(
                    'body {{WRAPPER}} .cat-list' => 'gap: {{SIZE}}{{UNIT}};',
                ),
            )
        );
        $this->add_control(
            '_general_color',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    'body {{WRAPPER}} .cat-list a,{{WRAPPER}}  .cat-more span' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            '_general_color_hover',
            array(
                'label'     => esc_html__('Color Hover', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    'body {{WRAPPER}} .cat-list a:hover,{{WRAPPER}}  .cat-more span:hover' => 'color: {{VALUE}}',
                ),
            )
        );
        $this->add_control(
            '_general_background_color',
            array(
                'label'     => esc_html__('Background', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cat-list a' => 'background-color: {{VALUE}}',
                ),
            )
        );
        $this->add_control(
            '_general_background_color_hover',
            array(
                'label'     => esc_html__('Background Hover ', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cat-list a:hover,{{WRAPPER}}  .cat-more span:hover' => 'background-color: {{VALUE}}',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => '_general_typography',
                'selector' => 'body {{WRAPPER}} .cat-list a,{{WRAPPER}}  .cat-more span',
            )
        );
        $this->add_responsive_control(
            '_general_padding',
            array(
                'label'      => esc_html__('Padding', 'travelwp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em'),
                'separator'  => 'before',
                'selectors'  => array(
                    '{{WRAPPER}} .cat-list a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => '_general_border',
                'label'    => esc_html__('Border', 'travelwp'),
                'selector' => '{{WRAPPER}} .cat-list a',
            )
        );
        $this->add_control(
            '_general_border_radius',
            array(
                'label'      => esc_html__('Border Radius', 'travelwp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .cat-list a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => '_general_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'travelwp'),
                'selector' => '{{WRAPPER}} .cat-list a',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style_popup',
            array(
                'label' => esc_html__('Dropdown', 'travelwp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'heading_layout_style',
            array(
                'label'     => esc_html__('Form', 'travelwp'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );
        $this->add_control(
            'layout_background_color',
            array(
                'label'     => esc_html__('Background', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cat-dropdown-modal' => 'background-color: {{VALUE}}',
                ),
            )
        );
        $this->add_responsive_control(
            'layout_padding',
            array(
                'label'      => esc_html__('Padding', 'travelwp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em'),
                'separator'  => 'before',
                'selectors'  => array(
                    '{{WRAPPER}} .cat-dropdown-modal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'layout__border',
                'label'    => esc_html__('Border', 'travelwp'),
                'selector' => '{{WRAPPER}} .cat-dropdown-modal',
            )
        );
        $this->add_control(
            'layout__border_radius',
            array(
                'label'      => esc_html__('Border Radius', 'travelwp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .cat-dropdown-modal' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'layout__box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'travelwp'),
                'selector' => '{{WRAPPER}} .cat-dropdown-modal',
            ]
        );
        $this->add_control(
            'heading_label_style',
            array(
                'label'     => esc_html__('Label', 'travelwp'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );
        $this->add_control(
            '_label_color',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    'body {{WRAPPER}} .cat-dropdown-modal h4' => 'color: {{VALUE}}',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => '_label_typography',
                'selector' => 'body {{WRAPPER}} .cat-dropdown-modal h4',
            )
        );
        $this->add_control(
            'heading_item_style',
            array(
                'label'     => esc_html__('Item', 'travelwp'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );
        $this->add_control(
            '_item_color',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    'body {{WRAPPER}} .pulldown-list a' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            '_item_color_hover',
            array(
                'label'     => esc_html__('Color Hover', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    'body {{WRAPPER}} .pulldown-list a:hover' => 'color: {{VALUE}}',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => '_item_typography',
                'selector' => 'body {{WRAPPER}} .pulldown-list a',
            )
        );
        $this->end_controls_section();
    }
    protected function get_categories_post() {
        $cats = array();
        $terms = new \WP_Term_Query(
            array(
                'taxonomy'     => 'category',
                'pad_counts'   => 1,
                'hierarchical' => 1,
                'hide_empty'   => 1,
                'orderby'      => 'name',
                'menu_order'   => true,
            )
        );
        if (is_wp_error($terms)) {
        } else {
            if (empty($terms->terms)) {
            } else {
                foreach ($terms->terms as $term) {
                    $prefix = '';
                    if ($term->parent > 0) {
                        $prefix = '--';
                    }
                    $cats[$term->slug] = $prefix . $term->name;
                }
            }
        }

        return $cats;
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $categories = get_categories(array('hide_empty' => true, 'parent' => 0));
        $break_list = 10;
        if (isset($settings['cats_number'])) {
            $break_list = $settings['cats_number'];
        };
        // var_dump($categories);
        if (is_array($categories)) {
            echo '<div class="nav-filter list-cats-blog">';
            $list = "";
            $list_dropdown = "";
            foreach ($categories as $i => $cat) {
                if (!empty($settings['cats'])) {
                    $categories = $settings['cats'];
                    if (in_array($cat->slug, $categories)) {
                        if ($i < $break_list) {
                            $list .= '<li class="cat-item"><a href="' . get_term_link($cat->slug, 'category') . '">' . $cat->name . '</a></li>';
                        } else {
                            $list_dropdown .= '<li class="cat-item"><a href="' . get_term_link($cat->slug, 'category') . '">' . $cat->name . '</a></li>';
                        }
                    }
                } else {
                    if ($i < $break_list) {
                        $list .= '<li class="cat-item"><a href="' . get_term_link($cat->slug, 'category') . '">' . $cat->name . '</a></li>';
                    } else {
                        $list_dropdown .= '<li class="cat-item"><a href="' . get_term_link($cat->slug, 'category') . '">' . $cat->name . '</a></li>';
                    }
                }
            };
            if ($list) {
                echo '<ul class="cat-list">' . $list . '</ul>';
            }

            if ($list_dropdown) {
                echo '<div class="cat-dropdown">';
                echo '<div class="cat-more"><span>' . esc_html__('More', 'travelwp') . '<i class="fa fa-angle-down" aria-hidden="true"></i></span></div>';
                echo '<div class="cat-dropdown-modal">';
                echo '<h4>' . esc_html__('Select your categories', 'travelwp') . '</h4>';
                echo '<ul class="pulldown-list">' . $list_dropdown . '</ul>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
}

