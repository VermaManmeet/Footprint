<?php

namespace Elementor;

use TravelWP_Elementor\GroupControlTrait;

class Physc_Text_Typed_Element extends Widget_Base {
	use GroupControlTrait;

	public function get_name() {
		return 'travel-text-typed';
	}

	public function get_title() {
		return esc_html__( 'Text Typed', 'travelwp' );
	}

	public function get_icon() {
		return 'el-travelwp eicon-animated-headline';
	}

	public function get_categories() {
		return [ 'travelwp-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'text_elements',
			[
				'label' => __( 'Content', 'travelwp' ),
			]
		);
		$this->add_control(
			'before_text',
			[
				'label'       => __( 'Text before Typed', 'travelwp' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'This page is', 'travelwp' ),
				'placeholder' => __( 'Enter your headline', 'travelwp' ),
				'label_block' => true,
				'separator'   => 'before',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'list_text',
			array(
				'label'   => esc_html__( 'Text', 'travelwp' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'List Text Typing', 'travelwp' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'list_rotating',
			[
				'label'       => esc_html__( 'Text Typing', 'travelwp' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '<span style="text-transform: capitalize;">{{{ list_text }}}</span>',
			]
		);

		$this->add_control(
			'type_speed',
			[
				'label'   => esc_html__( 'Typing Speed', 'elementor' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 1000,
				'step'    => 1,
				'default' => 100,
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'travelwp' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'travelwp' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'travelwp' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'travelwp' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .phys-typingEffect' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tag',
			[
				'label'   => __( 'HTML Tag', 'travelwp' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label' => __( 'General', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_text_style( 'text', '{{WRAPPER}} .phys-typingEffect' );

		$this->add_control(
			'typing_color',
			[
				'label'     => esc_html__( 'Text Typing Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .phys-typingEffect span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$rotating_text = '';
		if ( $settings['list_rotating'] ) {
			foreach ( $settings['list_rotating'] as $key => $item ) {
				$rotating_text .= ' data-strings' . $key . ' = "' . addslashes( $item['list_text'] ) . '"';
			}
		}
//		if ( ! $settings['before_text'] && ! $rotating_text ) {
//			return;
//		}
		wp_enqueue_script( 'travelwp-typed' );

		echo '<' . $settings['tag'] . ' class="phys-typingEffect">';
		echo esc_attr( $settings['before_text'] );

		if ( $rotating_text ) {
			echo ' <span class="phys-typingTextEffect" ' . $rotating_text . ' data-type-speed="' . $settings['type_speed'] . '"></span>';
		}
		echo "</{$settings['tag']}>";

	}

}
