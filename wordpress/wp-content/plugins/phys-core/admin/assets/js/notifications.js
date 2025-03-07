(function ($) {
	var Phys_Notifications = Backbone.View.extend({
		el: '#wpwrap',

		events: {
			'click .physcore-notice-dismiss': 'onDismiss'
		},

		/**
		 * Init notifications.
		 *
		 * @since 0.8.7
		 */
		initialize: function () {
			this.render();
		},

		onDismiss: function (e) {
			var $btn = this.$(e.target);
			var $notification = $btn.closest('.tc-notice');
			$notification.hide();
			var id = $notification.attr('data-id');

			this.request(id)
				.success(function (data) {
					console.info('Hiding successful!');
				})
				.error(function (error) {
					console.error(error);
				});
		},

		request: function (id) {
			return $.ajax({
				method: 'POST',
				url: phys_notifications.ajax,
				data: {id: id},
				dataType: 'json'
			});
		}
	});

	$(document).ready(function () {
		new Phys_Notifications();
	});
})(jQuery);
