<?php

namespace TravelWP_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

trait GroupControlTrait {
	// Slider

	public function _register_setting_arrow_style( string $selector ) {

		$this->add_responsive_control(
			'vertical_offset',
			array(
				'label'       => esc_html__( 'Vertical Position', 'thim-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'max'         => 500,
				'step'        => 1,
				'default'     => - 25,
				'selectors'   => array(
					$selector => 'margin-top:{{SIZE}}px;',
				),
			)
		);
		$this->add_responsive_control(
			'vertical_offset_preview',
			array(
				'label'       => esc_html__( 'Horizontal Position - Preview', 'thim-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'max'         => 500,
				'default'     => - 40,
				'step'        => 1,
				'selectors'   => array(
					$selector . '.owl-prev' => 'left:{{SIZE}}px;',
				),
			)
		);
		$this->add_responsive_control(
			'vertical_offset_next',
			array(
				'label'       => esc_html__( 'Horizontal Position - Next', 'thim-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'max'         => 500,
				'default'     => - 40,
				'step'        => 1,
				'selectors'   => array(
					$selector . '.owl-next' => 'right:{{SIZE}}px;',
				),
			)
		);
		$this->add_responsive_control(
			'icon_arrow_size',
			[
				'label'     => esc_html__( 'Icon Size', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'selectors' => [
					$selector . ' i' => 'font-size: {{SIZE}}px;',
				],
			]
		);
		$this->add_control(
			'icon_arrow_color',
			[
				'label'     => esc_html__( 'Icon Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					$selector => 'color: {{VALUE}}; opacity: 1;',
				],
			]
		);
		$this->add_control(
			'icon_arrow_color_hover',
			[
				'label'     => esc_html__( 'Icon Color Hover', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					$selector . ':hover' => 'color: {{VALUE}};',
				],
			]
		);

	}

	public function _register_setting_dot_style( string $selector, string $selector_active ) {
		$this->add_responsive_control(
			'dot_margin',
			array(
				'label'      => esc_html__( 'Margin', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);
		$this->add_control(
			'dot_border_radius',
			array(
				'label'      => esc_html__( 'Border radius', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => "dot_border",
				'selector' => "$selector",
				'exclude'  => [ 'color' ]
			)
		);

		$this->add_responsive_control(
			'dot_width',
			array(
				'label'     => esc_html__( 'Width', 'thim-elementor-kit' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'selectors' => array(
					$selector => 'width: {{VALUE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'dot_height',
			array(
				'label'     => esc_html__( 'Height', 'thim-elementor-kit' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'selectors' => array(
					$selector => 'height: {{VALUE}}px;',
				),
			)
		);

		$this->start_controls_tabs( "tabs_dot_style" );

		$this->start_controls_tab(
			"tab_dot_normal",
			array(
				'label' => esc_html__( 'Normal', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			"background_color",
			array(
				'label'     => esc_html__( 'Background Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					$selector => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			"dot_border_color",
			array(
				'label'     => esc_html__( 'Border Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					"dot_border_border!" => '',
				),
				'selectors' => array(
					$selector => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			"tab_dot_hover",
			array(
				'label' => esc_html__( 'Hover & Active', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			"dot_background_hover",
			array(
				'label'     => esc_html__( 'Background', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector_active => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			"dot_border_color_hover",
			array(
				'label'     => esc_html__( 'Border Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					"dot_border_border!" => '',
				),
				'selectors' => array(
					$selector_active => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
	}

	// style for button
	protected function register_button_style( string $prefix_name, string $selector ) {

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => "{$prefix_name}_typography",
				'selector' => "{{WRAPPER}} $selector",
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => "{$prefix_name}_border",
				'selector' => "{{WRAPPER}} $selector",
				'exclude'  => [ 'color' ]
			)
		);

		$this->add_control(
			$prefix_name . '_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"{{WRAPPER}} $selector" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => $prefix_name . '_box_shadow',
				'selector' => "{{WRAPPER}} $selector",
			)
		);

		$this->add_responsive_control(
			"{$prefix_name}_padding",
			array(
				'label'      => esc_html__( 'Padding', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					"{{WRAPPER}} $selector" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( "tabs_{$prefix_name}_style" );

		$this->start_controls_tab(
			"tab_{$prefix_name}_normal",
			array(
				'label' => esc_html__( 'Normal', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			"{$prefix_name}_color",
			array(
				'label'     => esc_html__( 'Text Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					"{{WRAPPER}} $selector" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			"{$prefix_name}_background",
			array(
				'label'     => esc_html__( 'Background', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} $selector" => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			"{$prefix_name}_border_color",
			array(
				'label'     => esc_html__( 'Border Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					"{$prefix_name}_border_border!" => '',
				),
				'selectors' => array(
					"{{WRAPPER}} $selector" => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			"tab_{$prefix_name}_hover",
			array(
				'label' => esc_html__( 'Hover', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			"{$prefix_name}_color_hover",
			array(
				'label'     => esc_html__( 'Text Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} $selector:hover, {{WRAPPER}} $selector:focus" => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			"{$prefix_name}_background_hover",
			array(
				'label'     => esc_html__( 'Background', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					"{{WRAPPER}} $selector:hover" => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			"{$prefix_name}_border_color_hover",
			array(
				'label'     => esc_html__( 'Border Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					"{$prefix_name}_border_border!" => '',
				),
				'selectors' => array(
					"{{WRAPPER}} $selector:hover, {{WRAPPER}} $selector:focus" => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	protected function register_text_style( string $prefix_name, string $selector, $selector_hover = '' ) {
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => $prefix_name . '_typography',
				'selector' => $selector,
			)
		);
		$this->add_control(
			$prefix_name . '_color',
			array(
				'label'     => esc_html__( 'Color', 'travelwp' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector => 'color: {{VALUE}}',
				),
			)
		);
		if ( $selector_hover ) {
			$this->add_control(
				$prefix_name . '_color_hover',
				array(
					'label'     => esc_html__( 'Color Hover', 'travelwp' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						$selector_hover => 'color: {{VALUE}}',
					),
				)
			);
		}
		$this->add_responsive_control(
			$prefix_name . '_margin',
			array(
				'label'      => esc_html__( 'Margin', 'travelwp' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
	}
}
