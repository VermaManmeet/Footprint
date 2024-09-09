<?php

/**
 * Class Phys_Core_Customizer
 *
 * @package   Phys_Core
 * @since     0.1.0
 */
if ( ! class_exists( 'Phys_Core_Customizer' ) ) {
	class Phys_Core_Customizer extends Phys_Singleton {

		const KEY_STYLESHEET_URI = 'phys_core_stylesheet';

		public static $stylesheet_dir = null;

		public static $stylesheet_uri = null;

		protected static $fields = array();

		protected function __construct() {
			$this->init();
			$this->init_hooks();
		}



		private function prepare() {
			$wp_upload_dir = wp_upload_dir();
			$path_uploads  = $wp_upload_dir['basedir'];
			$uri_uploads   = $wp_upload_dir['baseurl'];

			$container = '/tc_stylesheets';

			self::$stylesheet_dir = $path_uploads . $container;
			$uri                  = $uri_uploads . $container;
			self::$stylesheet_uri = str_replace( 'http://', '//', $uri );
		}

		/**
		 * Get directory contain stylesheet option.
		 *
		 * @since 1.1.1
		 *
		 * @return string
		 */
		public function get_directory() {
			if ( self::$stylesheet_dir === null ) {
				$this->prepare();
			}

			return self::$stylesheet_dir;
		}

		/**
		 * Get url stylesheet option.
		 *
		 * @since 1.1.1
		 *
		 * @return string
		 */
		private function get_url() {
			if ( self::$stylesheet_uri === null ) {
				$this->prepare();
			}

			return self::$stylesheet_uri;
		}

		/**
		 * Init class.
		 *
		 * @since 0.1.0
		 */
		private function init() {
			$this->include_customizer_module();
		}

		/**
		 * Init hooks.
		 *
		 * @since 0.1.0
		 */
		private function init_hooks() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_stylesheet_uri' ), 2000 );


			add_filter( 'customize_save_response', array( $this, 'customize_save_response' ) );

			add_action( 'wp_loaded', array( $this, 'customizer_register' ) );

			add_action( 'after_setup_theme', array( $this, 'add_section_documentation' ) );
			add_action( 'after_setup_theme', array( $this, 'add_section_notice_php_version' ) );
		}

		/**
		 * Add section notice PHP version < 7.0
		 *
		 * @since 1.2.0
		 */
		public function add_section_notice_php_version() {
			$php_version = phpversion();

			if ( version_compare( $php_version, '7.0', '>=' ) ) {
				return;
			}

			$guide = sprintf(
				__( 'Your server is running PHP versions %1$s. It is recommended to be on at least PHP 7.0 and preferably PHP 7.x to process all the theme\'s functionalities. See %2$s', 'phys-core' ),
				$php_version,
				'<a href="https://goo.gl/WRBYv3" target="_blank" rel="noopener">' . __( 'How to update your PHP version.', 'phys-core' ) . '</a>'
			);

			$this->add_section(
				array(
					'id'       => 'tc-theme-notice-php-version',
					'title'    => esc_html__( 'Upgrade PHP version', 'phys-core' ),
					'priority' => 0,
					'icon'     => 'dashicons-warning',
				)
			);

			$this->add_field(
				array(
					'id'       => 'tc-theme-notice-php-version',
					'type'     => 'custom',
					'default'  => $guide,
					'priority' => 1,
					'section'  => 'tc-theme-notice-php-version',
				)
			);
		}

		/**
		 * Add section documentation.
		 *
		 * @since 1.0.0
		 */
		public function add_section_documentation() {
			$documentation = apply_filters( 'phys_core_customize_section_documentation', false );

			if ( ! $documentation ) {
				return;
			}

			$this->add_section(
				array(
					'id'       => 'tc-theme-documentation',
					'title'    => esc_html__( 'Support and Documentation', 'phys-core' ),
					'priority' => 1,
					'icon'     => 'dashicons-book',
				)
			);

			$this->add_field(
				array(
					'id'       => 'tc-theme-documentation',
					'type'     => 'custom',
					'default'  => $documentation,
					'priority' => 1,
					'section'  => 'tc-theme-documentation',
				)
			);
		}

		/**
		 * Include Customizer module.
		 */
		private function include_customizer_module() {
			include_once PHYS_CORE_INC_PATH . '/customizer/init.php';
		}

		/**
		 * Register hook register customizer.
		 *
		 * @since 0.1.0
		 */
		public function customizer_register() {
			do_action( 'phys_customizer_register' );
		}

		public function add_panel( array $panel ) {
			if ( class_exists( '\PhysCode\Customizer\Modules\Panel' ) ) {
				new \PhysCode\Customizer\Modules\Panel( $panel['id'], $panel );
			}
		}

		public function add_section( array $section ) {
			if ( class_exists( '\PhysCode\Customizer\Modules\Section' ) ) {
				new \PhysCode\Customizer\Modules\Section( $section['id'], $section );
			}
		}

		public function add_field( array $field ) {
			// In Kirki use 'settings' for field id.
			if ( array_key_exists( 'settings', $field ) ) {
				$field['id'] = $field['settings'];
			}

			if ( $field['type'] == 'code' ) {
				$field['label'] = isset( $field['label'] ) ? $field['label'] : '';
			}

			if ( isset( $field['alpha'] ) && $field['type'] !== 'multicolor' ) {
				unset( $field['alpha'] );

				$choices          = isset( $field['choices'] ) ? $field['choices'] : array();
				$choices['alpha'] = true;

				$field['choices'] = $choices;
			}

			// Fix new line js_var
			if ( ! empty( $field['js_vars'] ) && is_array( $field['js_vars'] ) ) {
				$js_vars     = $field['js_vars'];
				$new_js_vars = array();

				foreach ( $js_vars as $js_var ) {
					$element           = isset( $js_var['element'] ) ? $js_var['element'] : '';
					$str               = preg_replace( '#\s+#', ' ', trim( $element ) );
					$js_var['element'] = $str;

					$new_js_vars[] = $js_var;
				}

				$field['js_vars'] = $new_js_vars;
			}

			self::$fields[ $field['id'] ] = $field;

			$str = str_replace( array( 'tp_', 'kirki-' ), '', $field['type'] ); // replace "tp_notice" to "notice"
			$str = str_replace( array( '-', '_' ), ' ', $str );

			$classname = '\PhysCode\Customizer\Field\\' . str_replace( ' ', '_', ucwords( $str ) );

			if ( $field['type'] === 'switch' ) {
				$classname = '\PhysCode\Customizer\Field\Checkbox_Switch';
			}

			if ( class_exists( $classname ) ) {
				unset( $field['type'] );
				new $classname( $field );
				return;
			}
		}

		public function add_group( array $group ) {
			$section  = $group['section'];
			$groups   = $group['groups'];
			$priority = isset( $group['priority'] ) ? $group['priority'] : 10;

			foreach ( $groups as $group ) {
				$fields   = $group['fields'];
				$group_id = $group['id'];

				foreach ( $fields as $field ) {
					$update_field             = $field;
					$update_field['section']  = $section;
					$update_field['priority'] = $priority;
					$update_field['hide']     = true;

					$this->add_field( $update_field );
				}
			}
		}

		/**
		 * Get SASS variables from customizer.
		 *
		 * @return array
		 * @since 0.1.0
		 */
		public static function get_sass_variables() {
			$variables = array();
			$prefix    = PC::$prefix;

			$fields = self::$fields;

			/**
			 * Fixes get old values.
			 */
			global $phys_customizer_options;
			$phys_customizer_options = get_theme_mods();

			foreach ( $fields as $field_id => $field ) {
				$type          = $field['type'];
				$excluded_type = array(
					'repeater',
					'phys-generic',
					'phys-sortable',
					'phys-code',
					'phys-editor',
					'phys-dropdown-pages',
					'phys-custom',
				);

				if ( in_array( $type, $excluded_type ) ) {// Excluded
					continue;
				}

				$default_value = $field['default'] ?? '';
				$values        = self::get_option( $field_id, $default_value );

				/**
				 * Add double quote if the field is text.
				 */
				$string_type = array(
					'phys-image',
					'image',
					'upload',
					'cropped_image',
					'phys-radio-image',
				);
				if ( in_array( $type, $string_type ) ) {
					$values = str_replace( 'https://', '//', $values );
					$values = str_replace( 'http://', '//', $values );

					$values = '"' . $values . '"';
				}

				if ( is_array( $values ) ) {
					foreach ( $values as $key => $val ) {
						if ( 'subsets' === $key ) {// Excluded subsets
							continue;
						}

						if ( 'variant' === $key ) {
							if ( 'regular' === $val ) {
								$val = '400normal';
							}

							if ( 'italic' === $val ) {
								$val = '400italic';
							}

							$font_weight = intval( $val );

							if ( 0 === $font_weight ) {
								$font_weight = 400;
							}

							$font_style = str_replace( $font_weight, '', $val );

							if ( empty( $font_style ) ) {
								$font_style = 'normal';
							}

							$key = $field_id;
							$key = $prefix . $key;

							$variables[ $key . '_font_weight' ] = $font_weight;
							$variables[ $key . '_font_style' ]  = $font_style;
							continue;
						}

						$key = $field_id . '_' . $key;
						$key = $prefix . $key;
						$key = str_replace( '-', '_', $key );

						$variables[ $key ] = $val;
					}
				} else {
					if ( empty( $values ) ) {
						$values = '""';
					}
					$variables[ $prefix . $field_id ] = $values;
				}
			}

			$variables = apply_filters( 'tc_variables_compile_scss_theme', $variables );

			return $variables;
		}

		/**
		 * Get options customizer.
		 *
		 * @return array
		 * @since 0.1.0
		 */
		public static function get_options() {
			global $phys_customizer_options;

			if ( empty( $phys_customizer_options ) ) {
				$phys_customizer_options = get_theme_mods();
			}

			return (array) $phys_customizer_options;
		}

		/**
		 * Get option customizer by key.
		 *
		 * @param string  $key
		 * @param        $default
		 *
		 * @return mixed|null
		 * @since 0.1.0
		 */
		public static function get_option( $key, $default = false ) {
			$phys_customizer_options = self::get_options();

			if ( ! array_key_exists( $key, $phys_customizer_options ) ) {
				return $default;
			}

			return $phys_customizer_options[ $key ];
		}


		/**
		 * Filter response after saving customizer.
		 *
		 * @param $response
		 *
		 * @return object
		 * @since 0.1.0
		 */
		public function customize_save_response( $response ) {
			$message = esc_html__( 'Save customizer successfully!', 'phys-core' );
			$message = apply_filters( 'phys_core_message_response_save_customize', $message );

			$r        = new stdClass();
			$r->error = apply_filters( 'phys_core_error_save_customize', false );
			$r->msg   = $message;

			if ( PC::is_debug() ) {
				$r->info               = array(
					'mem' => @memory_get_usage( true ) / 1048576,
					'php' => @phpversion(),
				);
				$r->stylesheet_options = self::get_stylesheet_uri();
				$r->theme_mods         = get_theme_mods();
			}

			// Add custom information
			$response['phys'] = $r;

			return $response;
		}

		/**
		 * Add filter notify error in response when save customize.
		 *
		 * @param $error
		 *
		 * @return true
		 * @since 0.1.0
		 */
		public static function notify_error_customize( $error ) {
			return add_filter(
				'phys_core_error_save_customize',
				function () use ( $error ) {
					return $error;
				}
			);
		}

		/**
		 * Add filter message in response when save customize.
		 *
		 * @param $message
		 *
		 * @return true
		 * @since 0.1.0
		 */
		public static function message_customize( $message ) {
			return add_filter(
				'phys_core_message_response_save_customize',
				function () use ( $message ) {
					return $message;
				}
			);
		}

		/**
		 * Add filter message error in response when save customize.
		 *
		 * @param $message
		 *
		 * @return bool
		 * @since 0.1.0
		 */
		public static function message_customize_error( $message ) {
			return self::notify_error_customize( true ) && self::message_customize( $message );
		}

		/**
		 * Get uri stylesheet.
		 *
		 * @return bool|mixed
		 * @since 0.1.0
		 */
		public static function get_stylesheet_uri() {
			$option = self::get_option( self::KEY_STYLESHEET_URI );

			if ( empty( $option ) ) {
				return false;
			}

			return $option;
		}

		/**
		 * Update uri stylesheet.
		 *
		 * @param string $uri
		 *
		 * @since 0.1.0
		 */
		public function update_stylesheet_uri( $uri ) {
			set_theme_mod( self::KEY_STYLESHEET_URI, $uri );
		}

		/**
		 * Get file name custom css theme.
		 *
		 * @since 1.0.1
		 *
		 * @return string
		 */
		private function get_file_name_custom_css_theme() {
			$key_theme = Phys_Theme_Manager::get_current_theme();

			$rand = time();
			$name = "$key_theme.$rand.css";

			return apply_filters( 'phys_core_file_name_custom_css_theme', $name );
		}

		/**
		 * Get file name custom css theme (For developer).
		 *
		 * @since 1.1.1
		 *
		 * @return string
		 */
		public static function get_file_dev_name_custom_css_theme() {
			$key_theme = Phys_Theme_Manager::get_current_theme();

			$name = "$key_theme.demo.css";

			return $name;
		}

		/**
		 * Save file stylesheet.
		 *
		 * @param $content
		 *
		 * @return string
		 * @since 0.1.0
		 */
		private function save_file_theme_options( $content ) {
			$file_name = $this->get_file_name_custom_css_theme();

			/**
			 * Remove old file.
			 */
			$old_file = get_option( PC::$prefix . 'custom_css_name' );

			if ( ! empty( $old_file ) ) {
				Phys_File_Helper::remove_file( trailingslashit( $this->get_directory() ) . $old_file );
			}

			Phys_File_Helper::put_file( $this->get_directory(), $file_name, $content );

			update_option( PC::$prefix . 'custom_css_name', $file_name );

			/**
			 * Return uri file.
			 */
			return trailingslashit( $this->get_url() ) . $file_name;
		}

		/**
		 * Save file theme options (For developer).
		 *
		 * @since 1.1.1
		 *
		 * @param $content
		 *
		 * @return string
		 */
		private function save_file_dev_theme_options( $content ) {
			$file_name = self::get_file_dev_name_custom_css_theme();

			Phys_File_Helper::put_file( $this->get_directory(), $file_name, $content );

			return trailingslashit( $this->get_url() ) . $file_name;
		}

		/**
		 * Enqueue stylesheet (theme options) uri.
		 *
		 * @since 0.1.0
		 */
		public function enqueue_stylesheet_uri() {
			if ( ! $this->disable_save_sass_build() ) {
				return;
			}

			$stylesheet = self::get_stylesheet_uri();

			if ( ! $stylesheet ) {
				$stylesheet = apply_filters( 'phys_style_default_uri', trailingslashit( get_stylesheet_directory_uri() ) . 'inc/data/default.css' );
			}

			if ( ! $stylesheet ) {
				return;
			}

			$stylesheet_depends = apply_filters( 'phys_core_stylesheet_options_depends', array( 'phys-style' ) );
			$version            = apply_filters( 'phys_core_stylesheet_options_version', false );

			wp_enqueue_style( 'phys-style-options', $stylesheet, $stylesheet_depends, $version );
		}
	}
}
