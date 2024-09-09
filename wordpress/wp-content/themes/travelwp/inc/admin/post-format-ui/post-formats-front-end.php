<?php

add_action( 'travelwp_entry_top', 'travelwp_post_formats_view' );

/**
 * Show entry format images, video, gallery, audio, etc.
 * @return void
 */

function travelwp_post_formats_view( $size ) {
	global $post;
	if ( has_post_format( 'gallery' ) ) : ?>
		<?php $images = get_post_meta( $post->ID, '_format_gallery_images', false ); ?>
		<?php
		if ( $images ) :
			wp_enqueue_script( 'travelwp-flexslider' );
			?>
			<div class="img_post feature-image">
				<div class="flexslider">
					<ul class="slides">
						<?php foreach ( $images as $image ) : ?>
							<?php $the_image = wp_get_attachment_image_src( $image, $size ); ?>
							<?php $the_caption = get_post_field( 'post_excerpt', $image ); ?>
							<li>
								<img src="<?php echo esc_url( $the_image[0] ); ?>" <?php if ( $the_caption ) : ?>title="<?php echo esc_url( $the_caption ); ?>"<?php endif; ?> />
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php endif; ?>

	<?php elseif ( has_post_format( 'video' ) ) : ?>
		<?php $travelwp_video = get_post_meta( $post->ID, '_format_video_embed', true ); ?>
		<?php if ( $travelwp_video ) { ?>
			<div class="img_post feature-image">
				<div class="video-container">
					<?php if ( wp_oembed_get( $travelwp_video ) ) : ?>
						<?php echo @wp_oembed_get( $travelwp_video ); ?>
					<?php else : ?>
						<?php echo ent2ncr( $travelwp_video ); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php } ?>
	<?php elseif ( has_post_format( 'audio' ) ) : ?>

		<?php $travelwp_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>

		<?php if ( wp_oembed_get( $travelwp_audio ) ) :
			echo '<div class="img_post feature-image">' . wp_oembed_get( $travelwp_audio ) . '</div>';
		else :
			echo '<div class="img_post feature-image">' . $travelwp_audio . '</div>';
		endif;
	else :
		echo '<div class="img_post feature-image">';
		if ( !is_single() && !has_post_format( 'link' ) ) {
			echo '<a href="' . get_permalink() . '" class="entry-thumbnail">';
		}
		if ( has_post_thumbnail() ) {
			echo get_the_post_thumbnail( get_the_ID(), $size );
		}
		if ( !is_single() && !has_post_format( 'link' ) ) {
			echo '</a>';
		}
		echo '</div>';
		?>

	<?php endif;
}