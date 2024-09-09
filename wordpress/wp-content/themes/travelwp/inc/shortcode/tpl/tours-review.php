<?php
echo '<div class="tours-reviews ' . $settings['animation'] . '">';
if ( $settings['review_id'] ) {
	$comment__id = explode( ',', $settings['review_id'] );
} else {
	$comment__id = '';
}
$reviews = get_comments(
	array(
		'number'      => $settings['item_on_row'],
		'status'      => 'approve',
		'post_status' => 'publish',
		'post_type'   => array( 'product' ),
		'orderby'     => 'comment_date_gmt',
		'order'       => $settings['order'],
		'comment__in' => $comment__id,
		'meta_key'    => 'tour_rating',
		'meta_value'  => '1',
	)
);

$class = 'pain';
$data  = '';
if ( count( $reviews ) > 1 ) {
	$class = 'slider';
	$data  .= ' data-dots="true"';
	$data  .= ' data-nav="false"';
	$data  .= ' data-responsive=\'{"0":{"items":1}, "480":{"items":1}, "768":{"items":1}, "992":{"items":1}, "1200":{"items":1}}\'';
};

if ( $settings['title'] ) {
	echo '<div class="shortcode_title shortcode-title-style_1">
			<h2 class="title_primary">' . $settings['title'] . '</h2>
				<span class="line_after_title"></span>
			</div>';
}


echo '<div class="'.$settings['css_shortcode'].'wrapper-tours-' . $class . ' woocommerce"><div class="tours-type-' . $class . '"' . $data . '>';
if ( $reviews ) {
	foreach ( $reviews as $review ) {
		echo '<div class="tour-reviews-item">
                	<div class="reviews-item-info">' . get_avatar( $review->user_id > 0 ? $review->user_id : $review->comment_author_email, 90 ) . '
                    <div class="reviews-item-info-name">' . esc_html( $review->comment_author ) . '</div>';
		travel_tours_renders_stars_rating( $review->comment_ID, 'rating', true );
		echo '</div>';
		echo '<div class="reviews-item-content">
			<h3 class="reviews-item-title">
				<a href="' . esc_url( get_permalink( $review->comment_post_ID ) ) . '">' . esc_html( $review->post_title ) . '</a>
			</h3>
			<div class="reviews-item-description">' . esc_html( $review->comment_content ) . '</div>
          	</div>
    </div> ';
	}
} else {
	echo '<div class="message-info">' . __( 'No review were found matching your selection', 'travelwp' ) . '</div>';
}
echo '</div></div>';


echo '</div>';
