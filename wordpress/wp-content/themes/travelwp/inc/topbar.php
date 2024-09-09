<div class="header_top_bar">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'top_bar_left' ) ) : ?>
				<div class="col-sm-3">
					<?php dynamic_sidebar( 'top_bar_left' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'top_bar_right' ) ) : ?>
				<div class="col-sm-9 topbar-right">
					<?php dynamic_sidebar( 'top_bar_right' ); ?>
 				</div>
			<?php endif; ?>
		</div>
	</div>
</div>