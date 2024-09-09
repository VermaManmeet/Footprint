<?php

namespace Elementor;

use TravelWP_Elementor\GroupControlTrait;

class Physc_Tours_Review_Element extends Widget_Base {
	use GroupControlTrait;

	public function get_name() {
		return 'travel-tours-review';
	}

	public function get_title() {
		return esc_html__( 'Tours Review', 'travelwp' );
	}

	public function get_icon() {
		return 'el-travelwp eicon-review';
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
			'review_id',
			[
				'label'       => esc_html__( 'Review ID', 'travelwp' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter Review ID for shortcode (Note: divide ID with ",")', 'travelwp' )
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
			'item_on_row',
			[
				'label'   => esc_html__( 'Item on row', 'travelwp' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 3,
			]
		);

		$this->end_controls_section();

		$this->register_controls_style();
	}

	protected function register_controls_style() {
		// Style Author
		$this->start_controls_section(
			'section_style_author',
			array(
				'label' => esc_html__( 'Author Name', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->register_text_style( 'author_name', '{{WRAPPER}} .tour-reviews-item .reviews-item-info-name' );
		$this->add_control(
			'heading_ratting_style',
			array(
				'label'     => esc_html__( 'Ratting', 'travelwp' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$this->add_control(
			'ratting_color',
			array(
				'label'     => esc_html__( 'Color', 'travelwp' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} .tour-reviews-item .star-rating span" => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		// Style Title
		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => esc_html__( 'Title', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->register_text_style( 'title', '{{WRAPPER}} .tour-reviews-item .reviews-item-title', '{{WRAPPER}} .tour-reviews-item .reviews-item-title a:hover' );

		$this->end_controls_section();
		// Style Description
		$this->start_controls_section(
			'section_style_description',
			array(
				'label' => esc_html__( 'Description', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->register_text_style( 'description', '{{WRAPPER}} .tour-reviews-item .reviews-item-description' );

		$this->end_controls_section();

		//Dot Style
		$this->start_controls_section(
			'section_style_dot',
			array(
				'label' => esc_html__( 'Dot', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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

	protected function render() {
		$settings = $this->get_settings_for_display();
		// fix param for EL
		$settings['animation'] = $settings['title'] = $settings['css_shortcode'] = '';
		// template
		travelwp_shortcode_template( array(
			'settings' => $settings
		), 'tours-review' );
	}
}
