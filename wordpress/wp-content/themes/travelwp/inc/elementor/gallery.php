<?php

namespace Elementor;

class Physc_Gallery_Element extends Widget_Base {
	public function get_name() {
		return 'tours-gallery';
	}

	public function get_title() {
		return esc_html__( 'Gallery', 'travelwp' );
	}

	public function get_icon() {
		return 'el-travelwp eicon-gallery-grid';
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
			'id_image',
			[
				'label'      => esc_html__( 'Add Images', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default'    => [],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'thumbnail_size',
				'default' => 'medium',
			)
		);
		$this->add_control(
			'show_filter',
			[
				'label'        => esc_html__( 'Show Filter', 'textdomain' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'textdomain' ),
				'label_off'    => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'column',
			[
				'label'   => esc_html__( 'Column', 'travelwp' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 4,
				'step'    => 1,
				'default' => 3,
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['id_image'] ) ) {
			return;
		}
		$ids = array();
		foreach ( $settings['id_image'] as $key => $id ) {
			array_push( $ids, $id['id'] );
		}
		// fix param for EL
		$settings['id_image']         = $ids;
		$settings['animation']   = '';
		$settings['filter']      = $settings['show_filter'] == 'yes' ? true : false;
		$settings['images_size'] = $settings['thumbnail_size_size'];
		$settings['column']      = 12 / $settings['column'];
		if ( $settings['thumbnail_size_size'] == 'custom' ) {
			$image_size_custom_dis   = $settings['thumbnail_size_custom_dimension'];
			$settings['images_size'] = array( $image_size_custom_dis['width'], $image_size_custom_dis['height'] );
		}
		// template
		travelwp_shortcode_template( array(
			'settings' => $settings
		), 'gallery' );

	}
}
