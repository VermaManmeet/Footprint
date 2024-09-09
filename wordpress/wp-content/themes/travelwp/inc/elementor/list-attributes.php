<?php

namespace Elementor;

use Elementor\Group_Control_Image_Size;
use TravelWP_Elementor\GroupControlTrait;

class Physc_List_Attributes_Element extends Widget_Base {
	use GroupControlTrait;

	public function get_name() {
		return 'travel-list-attributes';
	}

	public function get_title() {
		return esc_html__( 'List Attributes', 'travelwp' );
	}

	public function get_icon() {
		return 'el-travelwp eicon-gallery-justified';
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
			'style',
			[
				'label'   => esc_html__( 'Style', 'travelwp' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'style_1' => esc_html__( 'Style 1', 'travelwp' ),
					'style_2' => esc_html__( 'Style 2', 'travelwp' ),

				],
				'default' => 'style_1',
			]
		);

		$this->add_control(
			'attributes_woo',
			[
				'label'       => esc_html__( 'Select Attribute', 'travelwp' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->get_attribute(),
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
				'default' => 8,
			]
		);

		$this->add_control(
			'item_on_row',
			[
				'label'     => esc_html__( 'Item on row', 'travelwp' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => 5,
				'condition' => array(
					'style' => 'style_1',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image_size',
				'condition' => array(
					'style' => 'style_1',
				),
			)
		);
		$this->add_control(
			'show_count',
			[
				'label'     => esc_html__( 'Show Count', 'travelwp' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'style' => 'style_1',
				),
			]
		);
		$this->add_control(
			'navigation',
			[
				'label'     => esc_html__( 'Show navigation', 'travelwp' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => array(
					'style' => 'style_1',
				),
			]
		);

		$this->end_controls_section();

		$this->register_controls_general();

		$this->register_controls_style();
	}

	protected function register_controls_general() {
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => esc_html__( 'Genera;', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE
			)
		);

		$this->add_control(
			'content_pos',
			array(
				'label'       => esc_html__( 'Content Position', 'thim-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => 'top',
				'options'     => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'thim-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'thim-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'style' => 'style_1',
				),
			)
		);
		$this->add_responsive_control(
			'offset_h',
			array(
				'label'      => esc_html__( 'Offset', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'em', 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tours-type-slider .content-item' => '{{content_pos.VALUE}}:{{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'style' => 'style_1',
				),
			)
		);
		$this->add_control(
			'text_align',
			array(
				'label'     => __( 'Alignment', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'thim-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'thim-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'thim-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					"{{WRAPPER}} .tours-type-slider .content-item" => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style_1',
				),
			)
		);
		$this->add_control(
			'img_border_radius',
			array(
				'label'      => esc_html__( 'Image Border Radius', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => [
					'top'    => 50,
					'right'  => 50,
					'bottom' => 50,
					'left'   => 50,
					'unit'   => '%',
				],
				'selectors'  => array(
					"{{WRAPPER}} .tours-type-slider .tours-type__item__image img" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'style_1',
				),
			)
		);
		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => esc_html__( 'Padding', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"{{WRAPPER}} .tours-type-slider .content-item" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'style_1',
				),
			)
		);

		$this->add_control(
			'heading_title_style',
			array(
				'label'     => esc_html__( 'Title', 'travelwp' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->register_text_style( 'title', '{{WRAPPER}} .tours_type_item .content-item .item__title' );
		$this->add_control(
			'heading_count_style',
			array(
				'label'     => esc_html__( 'Count', 'travelwp' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->register_text_style( 'count', '{{WRAPPER}} .tours_type_item .content-item .count-attr' );
		$this->end_controls_section();
	}

	protected function register_controls_style() {
		// Arrow Style
		$this->start_controls_section(
			'section_style_arrow',
			array(
				'label'     => esc_html__( 'Navigation', 'travelwp' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style'      => 'style_1',
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
					'style' => 'style_1',
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

	protected function get_attribute() {
		$taxonomies                        = get_object_taxonomies( 'product', 'objects' );
		$attribute_arr                     = array();
		$attribute_arr['Select Attribute'] = '';
		if ( empty( $taxonomies ) ) {
			return '';
		}

		foreach ( $taxonomies as $tax ) {
			$tax_name = $tax->name;
			if ( 0 !== strpos( $tax_name, 'pa_' ) ) {
				continue;
			}

			if ( ! in_array( $tax_name, $attribute_arr ) ) {
				$attribute_arr[$tax_name] = $tax_name;
			}
		}

		return $attribute_arr;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		// fix param for EL
		$settings['animation']  = '';
		$settings['navigation'] = $settings['navigation'] == 'yes' ? "true" : "false";
		$thumbnail_size         = $settings['image_size_size'];
		if ( $thumbnail_size == 'custom' ) {
			$gallery_thumbnail = $settings['image_size_custom_dimension'];
			$thumbnail_size    = array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] );
		}
		$settings['thumbnail_size'] = $thumbnail_size;
		// template
		travelwp_shortcode_template( array(
			'settings' => $settings
		), 'list-attributes' );
	}
}
