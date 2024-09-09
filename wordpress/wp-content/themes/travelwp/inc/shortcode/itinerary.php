<?php
function travelwp_shortcode_itinerary($atts, $content = null) {
	$number = $title = $style = '';
	extract(
		shortcode_atts(
			array(
				'title'  => '',
				'number' => '',
				'style'  => 'default',
			),
			$atts
		)
	);

	ob_start();
	$class_toggle = "";
	if ($style == 'toggle') {
		$class_toggle .= 'interary-toggle';
	}
?>
	<div class="interary-item <?php echo $class_toggle; ?>">
		<?php if ($number) : ?>
			<span class="icon-left"><?php echo esc_html($number); ?> </span>
		<?php endif; ?>
		<div class="item_content">
			<?php if ($title) : ?>
				<h3><strong><?php echo esc_html($title); ?></strong></h3>
			<?php endif; ?>
			<?php if ($style == 'toggle') {?>
				<div class="interary-toggle-content">
					<?php echo wpautop($content);?>
				</div>
			<?php }else{
				echo wpautop($content);
			}?>
			
		</div>
	</div>
<?php
	return ob_get_clean();
}

if (current_user_can('edit_posts') || current_user_can('edit_pages')) {
	add_action('print_media_templates', 'print_media_templates_sc_itinerary');
	add_action('admin_head', 'travelwp_sc_itinerary_editor_view');
	add_filter("mce_external_plugins", "travelwp_mce_external_plugin_itinerary");
	add_filter("mce_buttons", 'travelwp_add_button_sc_itinerary');
}
function travelwp_mce_external_plugin_itinerary($plugin_array) {
	$plugin_array['mce_itinerary'] = get_template_directory_uri() . '/assets/js/admin/itinerary-mce-button.js';

	return $plugin_array;
}

function travelwp_add_button_sc_itinerary($buttons) {
	array_push($buttons, 'mce_itinerary_button');

	return $buttons;
}

function print_media_templates_sc_itinerary() {
	if (!function_exists('get_current_screen')) {
		require_once ABSPATH . '/wp-admin/includes/screen.php';
	}
	if (!isset(get_current_screen()->id) || get_current_screen()->base !== 'post') {
		return;
	}
?>
	<script type="text/html" id="tmpl-editor-add-itinerary">
		<div class="interary-item">
			<# if ( data.number ) { #>
				<span class="icon-left">{{ data.number }}</span>
				<# } #>
					<div class="item_content">
						<# if ( data.title ) { #>
							<h3><strong>{{ data.title }}</strong></h3>
							<# } #>
								<# if ( data.content ) { #>
									{{{ data.content }}}
									<# } #>
					</div>
		</div>
	</script>
<?php

}

function travelwp_sc_itinerary_editor_view() {
	$current_screen = get_current_screen();
	if (!isset($current_screen->id) || $current_screen->base !== 'post') {
		return;
	}
	wp_enqueue_script('itinerary-editor-view', get_template_directory_uri() . '/assets/js/admin/itinerary-editor-view.js', array('jquery', 'wp-tinymce'), TRAVELWP_THEME_VERSION, true);
}
