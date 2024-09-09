<?php

namespace Elementor;

class Physc_Deals_Discounts_Element extends Widget_Base {
	public function get_name() {
		return 'discounts';
	}

	public function get_title() {
		return esc_html__( 'Deals And Discounts', 'travelwp' );
	}

	public function get_icon() {
		return 'el-travelwp eicon-countdown';
	}

	public function get_categories() {
		return [ 'travelwp-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'General', 'travelwp' ),
			]
		);
		$this->add_control(
			'date_time',
			[
				'label' => esc_html__( 'Choose Date Time', 'travelwp' ),
				'type'  => Controls_Manager::DATE_TIME,
			]
		);
		$this->end_controls_section();
		$this->register_controls_styles();

	}

	protected function register_controls_styles() {
		$this->start_controls_section(
			'section_design_style',
			array(
				'label' => esc_html__( 'General', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'width_item',
			[
				'label'     => esc_html__( 'Width Item (px)', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .counter-block .counter' => 'width: {{VALUE}}px;',
				],
			]
		);
		$this->add_responsive_control(
			'height_item',
			[
				'label'     => esc_html__( 'Height Item (px)', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .counter-block .counter' => 'height: {{VALUE}}px;',
				],
			]
		);
		$this->add_control(
			'date_color',
			[
				'label'     => esc_html__( 'Background Color', 'travelwp' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter .number' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'space_item',
			[
				'label'      => esc_html__( 'Space item', 'travelwp' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
				],
				'selectors'  => [
					'{{WRAPPER}} .counter-block' => 'margin-right: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'countdown_shadow',
				'label'    => esc_html__( 'Box Shadow', 'travelwp' ),
				'selector' => '{{WRAPPER}} .counter .number',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'countdown_border',
				'label'    => esc_html__( 'Border', 'travelwp' ),
				'selector' => '{{WRAPPER}} .counter .number',
			]
		);
		$this->add_responsive_control(
			'countdown_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'travelwp' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .counter .number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'countdown_text_h',
			[
				'label'     => esc_html__( 'Text', 'travelwp' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( ' Color', 'travelwp' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter-caption' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .counter-caption',
			]
		);
		$this->add_responsive_control(
			'label_margin',
			array(
				'label'      => esc_html__( 'Margin', 'travelwp' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .counter-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'countdown_number_h',
			[
				'label'     => esc_html__( 'Number', 'travelwp' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'number_color',
			[
				'label'     => esc_html__( ' Color', 'travelwp' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter .number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'selector' => '{{WRAPPER}} .counter .number',
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['date_time'] ) ) {
			return;
		}

		$end_date = strtotime( $settings['date_time'] );
		wp_enqueue_script( 'travelwp-comingsoon' );

		$localization = esc_html__( 'days', 'travelwp' ) . ',' . esc_html__( 'hours', 'travelwp' ) . ',' . esc_html__( 'minutes', 'travelwp' ) . ',' . esc_html__( 'seconds', 'travelwp' );

		echo '<div class="row centered text-center deals-discounts"  data-year="' . date( "Y", $end_date ) . '" data-month="' . date( "m", $end_date ) . '" data-date="' . date( "d", $end_date ) . '" data-hour="' . date( "G", $end_date ) . '" data-min="' . date( "i", $end_date ) . '" data-sec="' . date( "s", $end_date ) . '" data-gmt="' . get_option( 'gmt_offset' ) . '" data-text="' . $localization . '">';
		$this->render_edit_mode();
		echo '</div>';
	}

	public function render_edit_mode() {
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			echo '<div class="counter-group">';
			for ( $i = 0; $i <= 3; $i ++ ) {
				echo '<div class="counter-block">
					<div class="counter days">
 						<div class="number show n1 tens">0</div>
						<div class="number show n1 units">0</div> 
					</div>
					<div class="counter-caption">Label</div>
				</div>';
			}
			echo '</div>';
		}
	}
}
