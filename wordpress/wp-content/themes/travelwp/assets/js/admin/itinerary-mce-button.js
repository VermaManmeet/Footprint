/* global tinymce */
(function () {
	tinymce.PluginManager.add('mce_itinerary', function (editor) {
		editor.addButton('mce_itinerary_button', {
			text   : 'Itinerary',
			class  : 'woocommerce_options_panel',
			subtype: 'btn-itinerary',
			icon   : false,
			onclick: function () {
				wp.mce.add_itinerary.popupwindow(editor);
			}
		});
	});
})();
