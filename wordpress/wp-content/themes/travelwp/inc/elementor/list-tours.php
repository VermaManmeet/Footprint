<?php

namespace Elementor;

use TravelWP_Elementor\GroupControlTrait;

class Physc_List_Tours_Element extends Widget_Base {
	use GroupControlTrait;
	public function get_name() {
		return 'travel-list-tours';
	}

	public function get_title() {
		return esc_html__( 'List Tours', 'travelwp' );
	}

	public function get_icon() {
		return 'el-travelwp eicon-post-list';
	}

	public function get_categories() {
		return [ 'travelwp-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'general_settings',
			[
				'label' => esc_html__( 'Content', 'travelwp' )
			]
		);
		$this->add_control(
			'content_style',
			[
				'label'   => esc_html__( 'Content Style', 'travelwp' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'style_1' => esc_html__( 'Style 1', 'travelwp' ),
					'style_2' => esc_html__( 'Style 2', 'travelwp' ),

				],
				'default' => 'style_1',
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Layout', 'travelwp' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'pain'   => esc_html__( 'Pain', 'travelwp' ),
					'slider' => esc_html__( 'Slider', 'travelwp' ),

				],
				'default' => 'pain',
			]
		);
		$this->add_control(
			'show',
			[
				'label'   => esc_html__( 'Show', 'travelwp' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''         => esc_html__( 'All Tour', 'travelwp' ),
					'tour_cat' => esc_html__( 'Tour Category', 'travelwp' ),

				],
				'default' => '',
			]
		);
		$this->add_control(
			'tour_cat',
			[
				'label'       => esc_html__( 'Select Tour Type', 'travelwp' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->get_cats_tour(),
				'condition'   => array(
					'show' => 'tour_cat',
				),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order by', 'travelwp' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'       => esc_html__( 'Date', 'travelwp' ),
					'price'      => esc_html__( 'Price', 'travelwp' ),
					'rand'       => esc_html__( 'Random', 'travelwp' ),
					'sales'      => esc_html__( 'On-sale', 'travelwp' ),
					'menu_order' => esc_html__( 'Sort custom', 'travelwp' ),

				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'travelwp' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'desc' => esc_html__( 'DESC', 'travelwp' ),
					'asc'  => esc_html__( 'ASC', 'travelwp' ),

				],
				'default' => 'desc',
			]
		);
		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Limit', 'travelwp' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 6,
			]
		);
		$this->add_control(
			'tour_on_row',
			[
				'label'     => esc_html__( 'Columns', 'travelwp' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => 3,
				// 'selectors' => array(
				// 	'{{WRAPPER}}' => '--phys-travelwp-columns: repeat({{VALUE}}, 1fr)',
				// ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'     => esc_html__( 'Show navigation', 'travelwp' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'style' => 'slider',
				),
			]
		);


		$this->end_controls_section();

		$this->register_controls_style();
	}

	protected function register_controls_style() {
		// Arrow Style
		$this->start_controls_section(
			'section_style_arrow',
			array(
				'label'     => esc_html__( 'Navigation', 'travelwp' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style'      => 'slider',
					'navigation' => 'yes',
				),
			)
		);
		$this->_register_setting_arrow_style( '{{WRAPPER}} .wrapper-tours-slider .tours-type-slider .owl-nav > div' );
		$this->end_controls_section();
		//Dot Style
		$this->start_controls_section(
			'section_style_dot',
			array(
				'label'     => esc_html__( 'Dot - Mobile', 'travelwp' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'slider',
				),
			)
		);
		$this->add_responsive_control(
			'dot_space',
			[
				'label'     => esc_html__( 'Space', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .owl-controls' => 'margin-top: {{VALUE}}px;',
				],
			]
		);
		$this->_register_setting_dot_style( '{{WRAPPER}} .owl-dot span', '{{WRAPPER}} .owl-dot.active span, {{WRAPPER}} .owl-dot:hover span' );
		$this->end_controls_section();
	}

	protected function get_cats_tour() {
		$args                             = array(
			'pad_counts'         => 1,
			'show_counts'        => 1,
			'hierarchical'       => 1,
			'hide_empty'         => 1,
			'show_uncategorized' => 1,
			'orderby'            => 'name',
			'menu_order'         => false
		);
		$terms                            = get_terms( 'tour_phys', $args );
		$tour_cat                         = array();
		$tour_cat['Select Tour Category'] = '';
		if ( is_wp_error( $terms ) ) {
		} else {
			if ( empty( $terms ) ) {
			} else {
				foreach ( $terms as $term ) {
					$tour_cat[$term->slug] = $term->name;
				}
			}
		}

		return $tour_cat;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		// fix param for EL
		$settings['term_by']    = 'slug';
		$settings['animation']  = '';

		$settings['navigation'] = $settings['navigation'] == 'yes' ? "true" : "false";
		// template
		travelwp_shortcode_template( array(
			'settings' => $settings
		), 'list-tours' );
	}
}
