<?php

namespace Elementor;

class Physc_Item_Tour_Element extends Widget_Base {
    public function get_name() {
        return 'item-tour';
    }

    public function get_title() {
        return esc_html__('Item Tour', 'travelwp');
    }
    /**
     * @return string
     */
    public function get_icon() {
        return 'eicon-post-content';
    }

    /**
     * @return string[]
     */
    public function get_categories() {
        return array(\TravelBooking\Tour_Elementor::TOUR_BOOKING);
    }

    protected function register_controls() {
        $this->start_controls_section(
            'general_settings',
            [
                'label' => esc_html__('General Settings', 'travelwp')
            ]
        );
        $this->add_control(
            'tours_ids',
            [
                'label'   => esc_html__('Select Tour', 'travelwp'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => false,
                'options' => $this->travel_booking_get_list_tour(),
            ]
        );
        $this->end_controls_section();
    }
    function travel_booking_get_list_tour() {
        $list_tours = array();
        $query_args = array(
            'post_type'      => array('product'),
            'wc_query'       => 'tours',
            'posts_per_page' => '-1',
            'tax_query'     => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array('tour_phys'),
                    'operator' => 'IN',
                )
            )
        );
        $the_query = new \WP_Query($query_args);
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) :
                $the_query->the_post();
                $list_tours[get_the_ID()] = get_the_title();
            endwhile;
        endif;
        return $list_tours;
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $query_args1 = array(
            'post_type'      => array('product'),
            'wc_query'       => 'tours',
            'posts_per_page' => '-1',
            'post__in'      => array($settings['tours_ids']),
            'tax_query'     => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array('tour_phys'),
                    'operator' => 'IN',
                )
            )
        );
        $the_query1 = new \WP_Query($query_args1);
        if ($the_query1->have_posts()) :
            while ($the_query1->have_posts()) :
                $the_query1->the_post(); ?>
                <div class="travel-tour-item-wapper">
                    <?php if (has_post_thumbnail()) {
                        echo '<div class="travel-tour-item-img">';
                        echo get_the_post_thumbnail(get_the_ID(), 'full');
                        echo ' </div>';
                    } ?>
                    <div class="travel-tour-item-content">
                        <h6 class="travel-tour-item-title"><?php the_title(); ?></h6>
                        <?php
                        $product = wc_get_product(get_the_ID());
                        if ($product && wc_review_ratings_enabled()) {
                            $count_rating = $product->get_average_rating();
                            echo '<div class="travel-tour-item-rattings woocommerce">';
                            if ($count_rating > 0) {
                                echo wc_get_rating_html($count_rating);
                            } else {
                                echo '<div class="star-rating star-rating-empty" role="img">' . wc_get_star_rating_html('5', '5') . '</div>';
                            }
                            $count_review = $product->get_review_count();
                            echo '<span class="number-average-rating">';
                            echo $product->get_average_rating();
                            echo '</span>';
                            echo '<span class="number-ratting">(';
                            printf(_n('%s review', '%s reviews', $count_review, 'travelwp'), $count_review);
                            echo ')</span>';
                            echo ' </div>';
                        }
                        echo '<div class="travel-tour-item-service">';
                            $tour_duration = get_post_meta(get_the_ID(), '_tour_duration', true);
                            if (!empty($tour_duration)) {
                                echo '<div class="travel-tour-item-duration">';
                                echo '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z" stroke="#4F5E71" stroke-width="1.5" stroke-miterlimit="10"/>
                                        <path d="M8 4.5V8H11.5" stroke="#4F5E71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        ';
                                echo '<span>' . $tour_duration . '</span>';
                                echo '</div>';
                            } ?>
                            <div class="travel-tour-item-cancel">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z" stroke="#4F5E71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.75 6.5L7.08125 10L5.25 8.25" stroke="#4F5E71" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span><?php esc_html_e('Free Cancellation','travelwp');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="travel-tour-item-right">
                        <div class="travel-tour-item-price">
                            <span><?php esc_html_e('from', 'travelwp'); ?></span>
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        <a class=" btn button item-tour-link" href="<?php echo get_the_permalink(); ?>"><?php esc_html_e('Book now', 'travelwp'); ?></a>
                    </div>
                </div>
<?php
            endwhile;
        endif;
        wp_reset_postdata();
    }
}
