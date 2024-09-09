/* global tinyMCE */
(function ($) {
	var media = wp.media, shortcode_string = 'itinerary';
	wp.mce = wp.mce || {};
	wp.mce.add_itinerary = {
		shortcode_data: {},
		template: media.template('editor-add-itinerary'),
		getContent: function () {
			var options = this.shortcode.attrs.named;
			options.content = wp.editor.removep(this.shortcode.content);
			return this.template(options);
		},
		View: {
			template: media.template('editor-add-itinerary'),
			postID: $('#post_ID').val(),
			initialize: function (options) {
				this.shortcode = options.shortcode;
				wp.mce.add_itinerary.shortcode_data = this.shortcode;
			},
		},
		edit: function (data, update) {
			var shortcode_data = wp.shortcode.next(shortcode_string, data); 
			if (!shortcode_data) {
				return;
			}
			var values = shortcode_data.shortcode.attrs.named;
			values.content = wp.editor.removep(shortcode_data.shortcode.content);
			values.style = shortcode_data.shortcode.attrs.named.style || 'default'; // Ensure 'type' is set
			wp.mce.add_itinerary.popupwindow(tinyMCE.activeEditor, values, update);
		},
		popupwindow: function (editor, values, update, onsubmit_callback ) {
			values = values || {};
			if (typeof onsubmit_callback !== 'function') {
				onsubmit_callback = function (e) {
					var args = {
						tag: shortcode_string,
						type: e.data.content.length ? 'closed' : 'single',
						content: e.data.content,
						attrs: {
							title: e.data.title,
							number: e.data.number,
							style: e.data.style // Include the new select field data
						}
					};
					if (update) {
						update(wp.shortcode.string(args));
					} else {
						editor.insertContent(wp.shortcode.string(args));
					}
				};
			}
			editor.windowManager.open({
				title: 'Add Itinerary',
				body: [
					{
						type: 'textbox',
						name: 'number',
						label: 'Number',
						value: values.number
					},
					{
						type: 'textbox',
						name: 'title',
						label: 'Title',
						value: values.title
					},
					{
						type: 'listbox',
						name: 'style',
						label: 'Style',
						values: [
							{ text: 'Default', value: 'default' },
							{ text: 'Toggle', value: 'toggle' }
						],
						value: values.style || 'default' // Default value if not provided
					},
					{
						type: 'textbox',
						name: 'content',
						label: ' ',
						multiline: true,
						minWidth: 700,
						minHeight: 400,
						value: values.content,
						id: 'itinerary-content'
					},
				],
				classes: 'itineraryPopup',
				onsubmit: onsubmit_callback,
				onPostRender: function () {
					var switchButtons = `
                        <div class="wp-core-ui wp-editor-wrap">
                            <div class="wp-editor-tools hide-if-no-js">
                                <div class="wp-media-buttons">
                                    <button type="button" id="ct-insert-media-button" class="button insert-media add_media" data-editor="itinerary-content">
                                        <span class="wp-media-buttons-icon"></span> Add Media
                                    </button>
                                </div>
                                <div class="wp-editor-tabs">
                                    <button id="ct-itinerary-content-tmce" class="wp-switch-editor switch-tmce" data-wp-editor-id="itinerary-content">Visual</button>
                                    <button id="ct-itinerary-content-html" class="wp-switch-editor switch-html" data-wp-editor-id="itinerary-content">Text</button>
                                </div>
                            </div>
                        </div>`;
					$('#itinerary-content').before(switchButtons);

					if (typeof tinyMCEPreInit !== 'undefined') {
						var init = $.extend(false, {}, tinyMCEPreInit.mceInit['content']);
						init.selector = '#itinerary-content';
						init.setup = function (editor) {
							console.log('TinyMCE editor setup function called');
							editor.on('change', function (e) {
								console.log('Editor content changed');
								editor.save();
							});
						};

						if (!tinymce.get('itinerary-content')) {
							tinymce.init(init);
							console.log('TinyMCE initialized for itinerary-content');
						}
						// Event listeners for switching between Visual and Text modes
						$('#ct-itinerary-content-tmce').on('click', function () {
							switchEditors.go('itinerary-content', 'tmce');
							$('#qt_itinerary-content_toolbar').hide(); // Ensure the QTags toolbar is hidden in TinyMCE mode
						});
						$('#ct-itinerary-content-html').on('click', function () {
							switchEditors.go('itinerary-content', 'html');
							if (typeof QTags !== 'undefined') {
								var qtSettings = $.extend(true, {}, tinyMCEPreInit.qtInit['content']);
								qtSettings.id = 'itinerary-content';
								if (!$('#qt_itinerary-content_toolbar').length) {
									QTags(qtSettings);
									QTags._buttonsInit();
								}
							}
							$('#qt_itinerary-content_toolbar').show(); // Ensure the QTags toolbar is visible in HTML mode
						});

						// Event listener for Add Media button
						$('#ct-insert-media-button').on('click', function () {
							wp.media.editor.open('itinerary-content');
						});
					}

				},

				onClose: function () {
					// Remove TinyMCE instance when the window is closed
					if (tinymce.get('itinerary-content')) {
						tinymce.get('itinerary-content').remove();
					}
				}
			});
		}
	};
	wp.mce.views.register(shortcode_string, wp.mce.add_itinerary);
}(jQuery));
