<?php

namespace Elementor;

use TravelWP_Elementor\GroupControlTrait;

class Physc_Search_Tour_Element extends Widget_Base {
	use GroupControlTrait;

	public function get_name() {
		return 'travel-search-tour';
	}

	public function get_title() {
		return esc_html__( 'Search Tour', 'travelwp' );
	}

	public function get_icon() {
		return 'el-travelwp eicon-search';
	}

	public function get_categories() {
		return [ 'travelwp-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'search_settings',
			[
				'label' => esc_html__( 'Search Settings', 'travelwp' )
			]
		);

		$this->_register_repeater_input();

		$this->add_control(
			'separator',
			array(
				'label'        => esc_html__( 'Separator Between', 'travelwp' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'separator'    => 'before',
				'prefix_class' => 'search-tours-has-separator-',
			)
		);
		$this->add_control(
			'separator_color',
			[
				'label'     => esc_html__( 'Color Separator', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
 				'selectors' => [
					'{{WRAPPER}}' => '--separator-color-item: {{VALUE}};',
				],
				'condition' => array(
					"separator" => 'yes',
				),
			]
		);

		$this->end_controls_section();

		// Style General
		$this->_register_style_general();

		// Style Input
		$this->start_controls_section(
			'section_style_input',
			array(
				'label' => esc_html__( 'Input', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->register_button_style( 'input', '.hb-form-field input' );
		$this->end_controls_section();
		// Style Select
		$this->start_controls_section(
			'section_style_select',
			array(
				'label' => esc_html__( 'Select', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->register_button_style( 'select', '.hb-form-field select' );
		$this->end_controls_section();

		// Style button
		$this->start_controls_section(
			'section_style_button',
			array(
				'label' => esc_html__( 'Button', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'icon_btn_color',
			[
				'label'     => esc_html__( 'Icon Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} button i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} button svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_btn_color_hover',
			[
				'label'     => esc_html__( 'Icon Color Hover', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} button:hover i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_btn_size',
			[
				'label'     => esc_html__( 'Icon Size', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} button i '  => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} button svg' => 'height: {{SIZE}}px;width: 100%;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_btn_space',
			[
				'label'     => esc_html__( 'Icon Space', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} button i, {{WRAPPER}} button svg' => 'margin-right: {{VALUE}}px;',
				],
			]
		);
		$this->register_button_style( 'button', '.hb-form-field button' );
		$this->end_controls_section();
	}

	protected function _register_repeater_input() {
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'key',
			array(
				'label'   => esc_html__( 'Type', 'travelwp' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'name_tour',
				'options' => $this->tour_search_get_type_field(),
			)
		);
		$repeater->add_control(
			'placeholder',
			array(
				'label'     => esc_html__( 'Placeholder', 'travelwp' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'key' => 'name_tour',
				),
			)
		);
		$repeater->add_control(
			'bt_name',
			array(
				'label'     => esc_html__( 'Text Button', 'travelwp' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Search',
				'condition' => array(
					'key' => 'submit',
				),
			)
		);
		$repeater->add_control(
			'label',
			array(
				'label' => esc_html__( 'Label', 'travelwp' ),
				'type'  => Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'icon',
			[
				'label'       => esc_html__( 'Icon', 'travelwp' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'render_type' => 'template',
			]
		);
		$repeater->add_responsive_control(
			'width',
			array(
				'label'      => esc_html__( 'Width', 'travelwp' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 30,
						'max'  => 1920,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hb-form-table {{CURRENT_ITEM}}' => 'flex-basis: {{SIZE}}{{UNIT}};flex-grow: unset;',
				),
			)
		);
		$this->add_control(
			'list_field',
			[
				'label'       => esc_html__( 'Field Search', 'travelwp' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'key' => 'name_tour',
					),
					array(
						'key' => 'tour_phys',
					),
					array(
						'key' => 'submit',
					),
				),
				'title_field' => '<span style="text-transform: capitalize;">{{{ key.replace("_", " ") }}}</span>',
			]
		);
	}

	protected function tour_search_get_type_field() {
		$option_attribute_to_search = get_option( 'tour_search_by_attributes' );
		$attribute                  = array(
			'name_tour' => esc_html__( 'Tour name', 'travelwp' ),
			'tour_phys' => esc_html__( 'Tour Type', 'travelwp' ),
			'submit'    => esc_html__( 'Button Submit', 'travelwp' ),
		);
		if ( ! empty( $option_attribute_to_search[0] ) ) {
			foreach ( $option_attribute_to_search as $taxonomy ) {
				$attribute[$taxonomy] = ucfirst( str_replace( 'pa_', '', $taxonomy ) );
			}
		}

		return $attribute;
	}

	protected function _register_style_general() {
		$this->start_controls_section(
			'section_style_general',
			array(
				'label' => esc_html__( 'General', 'travelwp' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'space_item',
			[
				'label'     => esc_html__( 'Space Item', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}}' => '--search-space-item: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'heading_icon_style',
			array(
				'label'     => esc_html__( 'Icon', 'travelwp' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .search-icon-wrapper i'                                       => 'color: {{VALUE}};',
					'{{WRAPPER}} .search-icon-wrapper i, {{WRAPPER}} .search-icon-wrapper svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => esc_html__( 'Size', 'elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .search-icon-wrapper '    => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .search-icon-wrapper svg' => 'height: {{SIZE}}{{UNIT}};width: 100%;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label'     => esc_html__( 'Space', 'elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}} .search-icon-wrapper' => 'padding-right: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'heading_label_style',
			array(
				'label'     => esc_html__( 'Label', 'travelwp' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->register_text_style( 'label', '{{WRAPPER}} .hb-form-field label' );

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$action_url = add_query_arg( 'page_id', get_option( \Tour_Settings_Tab_Phys::$_tours_show_page_id ), home_url() );

		if ( isset( $settings['list_field'] ) && is_array( $settings['list_field'] ) ) {
			$lang = isset( $_GET['lang'] ) ? '<input type="hidden" name="lang" value="' . $_GET['lang'] . '">' : '';

			echo '<div class="travel-booking-search travel-booking-search-elementor"><form name="hb-search-form" action="' . $action_url . '" method="GET"> <ul class="hb-form-table">';

			foreach ( $settings['list_field'] as $item ) {
				echo '<li class="hb-form-field elementor-repeater-item-' . $item['_id'] . '">';

				$this->render_icon_html( $item );

				if ( $item['key'] == 'name_tour' || $item['key'] == 'submit' ) {
					echo '<div class="hb-form-field-input">';
				} else {
					echo '<div class="hb-form-field-select">';
				}

				// echo label
				if ( isset( $item['label'] ) && $item['label'] ) :
					echo '<label for="' . $item['key'] . '">' . esc_attr( $item['label'] ) . '</label>';
				endif;

				switch ( $item['key'] ) {
					case 'name_tour':
						$placeholder = $item['placeholder'] ? $item['placeholder'] : esc_html__( 'Tour name', 'travelwp' );
						echo '<input type="text" name="name_tour" value="" placeholder="' . esc_attr( $placeholder ) . '">';
						break;
					case 'submit':
						echo '<button type="submit">';
						\Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
						echo esc_attr( $item['bt_name'] );
						echo '</button>';
						break;
					case 'tour_phys':
					default:
						$this->render_field_tour_phys( $item );
						break;
				}

				echo '</div></li>';
			}

			echo '</ul><input type="hidden" name="tour_search" value="1">' . $lang . '</form></div>';
		}
	}

	protected function render_field_tour_phys( $item ) {
		$tour_terms              = get_terms( $item['key'] );
		$select_option_tour_type = '';
		$default_label           = str_replace( array( 'pa_', '_' ), ' ', $item['key'] );
		if ( ! is_wp_error( $tour_terms ) ) {
			foreach ( $tour_terms as $term ) {
				$select_option_tour_type .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
			}
		}
		?>
		<select name="tourtax[<?php echo $item['key']; ?>]">
			<option value="0"><?php echo ucfirst( trim( $default_label ) ); ?></option>
			<?php echo $select_option_tour_type; ?>
		</select>
		<?php
	}

	protected function render_icon_html( $item ) {
		if ( ! empty( $item['icon']["value"] ) && $item['key'] != 'submit' ) :
			?>
			<div class="search-icon-wrapper">
				<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
		<?php
		endif;
	}
}
