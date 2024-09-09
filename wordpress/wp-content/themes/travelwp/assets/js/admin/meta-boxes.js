jQuery(function ($) {
	checkboxToggle();
	toggleDisplaysetting();
	togglePostFormatMetaBoxes();
	togglePostFormatMetaBoxes_gutenberg__editor();
	/**
	 * Show, hide a <div> based on a checkbox
	 *
	 * @return void
	 * @since 1.0
	 */
	function checkboxToggle() {
		$('body').on('change', '.checkbox-toggle input', function () {
			var $this = $(this),
				$toggle = $this.closest('.checkbox-toggle'),
				action;
			if (!$toggle.hasClass('reverse'))
				action = $this.is(':checked') ? 'slideDown' : 'slideUp';
			else
				action = $this.is(':checked') ? 'slideUp' : 'slideDown';

			$toggle.next()[action]();
		});
		$('.checkbox-toggle input').trigger('change');
	}

	function toggleDisplaysetting() {
		jQuery('#page_template').change(function () {
			jQuery('#display-settings')[jQuery(this).val() == 'default' ? 'show' : 'hide']();
		}).trigger('change');
		jQuery('.post-type-attachment #display-settings').hide();
	}

	function togglePostFormatMetaBoxes() {
		var $input = $('input[name=post_format]'),
			$metaBoxes = $('[id^="meta-box-post-format-"]');

		$input.change(function () {
			$metaBoxes.hide();
			$('#meta-box-post-format-' + $(this).val()).show();
		});
		$input.filter(':checked').trigger('change');
	}

	function togglePostFormatMetaBoxes_gutenberg__editor() {
		var $metaBoxes = jQuery('.postbox[id*="meta-box-post-format-"]');
		jQuery(document).on('change', 'select[id*="post-format"]', function () {
			$metaBoxes.hide();
			jQuery('#meta-box-post-format-' + $(this).val()).show();
		}).trigger('change');
	}
	$(document).ready(function () {
		physcode_install_demo();
	});

	function physcode_install_demo() {
		if ($('.tc-importer-wrapper').length == 0) {
			return;
		}
		if ($('.tc-importer-wrapper .theme.installed[data-phys-demo^=demo-vc]').length == 0 || 
			$('.tc-importer-wrapper .theme.installed[data-phys-demo^=demo-el]').length == 0) {
				$('.tc-importer-wrapper').addClass('elementor');
			}
		if ($('.tc-importer-wrapper .theme.installed[data-phys-demo^=demo-vc]').length > 0) {
			$('.tc-importer-wrapper').addClass('visual_composer');
		}
		if ($('.tc-importer-wrapper .theme.installed[data-phys-demo^=demo-el]').length > 0) {
			$('.tc-importer-wrapper').addClass('elementor');
		}

		if ($('.tc-importer-wrapper .theme.installed').length > 0) {
			return;
		}

		var $html = '<div class="physcode-choose-page-builder"><h3 class="title">Please select page builder before Import Demo.</h3>';
		$html += '<select id="physcode-select-page-builder">';
		$html += '<option value="elementor">Elementor</option>';
		$html += '<option value="visual_composer">Visual Composer</option>';
		$html += '</select></div>';

		$('.tc-importer-wrapper').prepend($html);
		$('#physcode-select-page-builder').change(function () {
			var class_active = $(this).val();
			// $('.tc-importer-wrapper').addClass('active');
			$('.tc-importer-wrapper').addClass('overlay');
			setTimeout(function () {
				$('.tc-importer-wrapper').removeClass().addClass('tc-importer-wrapper');
				$('.tc-importer-wrapper').toggleClass(class_active);
			}, 400);
		})
		if ($('#physcode-select-page-builder').val() === '') {
			$('.tc-importer-wrapper').addClass('overlay');
		}

	}
});
