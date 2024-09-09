<?php

namespace Elementor;

class Physc_Anchor_Tabs_Element extends Widget_Base {
    public function get_name() {
        return 'anchor-tabs';
    }

    public function get_title() {
        return esc_html__('Anchor tabs', 'travelwp');
    }

    public function get_icon() {
        return 'el-travelwp eicon-gallery-grid'; 
    }

    public function get_categories() {
        return array(\TravelBooking\Tour_Elementor::CATEGORY_SINGLE_TOUR);
    }

    protected function register_controls() {
        $this->start_controls_section(
            'general_settings',
            [
                'label' => esc_html__('Anchor', 'travelwp')
            ]
        );
        $anchor_group = new Repeater();
        $anchor_group->add_control(
            'icons',
            array(
                'label'       => esc_html__('Icon', 'travelwp'),
                'type'        => Controls_Manager::ICONS,
                'skin'        => 'inline',
                'label_block' => false,
            )
        );
        $anchor_group->add_control(
            'text',
            array(
                'label'       => esc_html__('Label', 'travelwp'),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => array(
                    'active' => true,
                ),
            )
        );
        $anchor_group->add_control(
            'anchor_item',
            [
                'label'   => esc_html__('Select Anchor', 'travelwp'),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->phys_list_metabox_tours_item(),
                'default' => 'description',
            ]
        );
        $anchor_group->add_control(
            'link',
            array(
                'label'         => esc_html__('Link', 'travelwp'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('#id', 'travelwp'),
                'show_external' => true,
                'default'       => array(
                    'url' => '',
                ),
                'dynamic'       => array(
                    'active' => true,
                ),
                'condition' => array(
                    'anchor_item' => 'custom'
                ),
            )
        );

        $this->add_control(
            'anchor_group',
            array(
                'label'       => esc_html__('Anchor item', 'travelwp'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $anchor_group->get_controls(),
                'default'     => array(
                    'anchor_item' => 'description',
                ),
                'title_field' => '{{{ anchor_item }}}',
            )
        );
        $this->end_controls_section();
        $this->_register_style_anchor_item();
    }
    protected function _register_style_anchor_item(){
        $this->start_controls_section(
            'section_style_archor',
            array(
                'label'     => esc_html__('Style', 'travelwp'),
                'tab'       => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'archor_item_typography',
                'selector' => '{{WRAPPER}} .anchor-item-text',
            )
        );
        $this->add_control(
            'archor_item_color',
            array(
                'label'     => esc_html__('Color', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .anchor-item-text' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'archor_item_color_hover',
            array(
                'label'     => esc_html__('Color Hover', 'travelwp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .anchor-item-text:hover' => 'color: {{VALUE}}',
                ),
            )
        );
        $this->add_responsive_control(
            'archor_item_space',
            array(
                'label'      => esc_html__('Margin', 'travelwp'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 300,
                'step' => 1,
                'default' => 64,
                'selectors'  => array(
                    '{{WRAPPER}} .thim-tour-scroll-anchor li ' => '  margin-right: calc({{VALUE}}px / 2);margin-left: calc({{VALUE}}px / 2);',
                ),
            )
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
?>
        <div id="thim-landing-tours-menu-tab-top" class="thim-tour-scroll-anchor">
            <ul>
                <?php
                foreach ($settings['anchor_group'] as  $key => $anchor_group_item) {
                    // var_dump($anchor_group_item);
                    switch ($anchor_group_item["anchor_item"]) {
                        case 'description':
                            $decs = get_the_content(get_the_ID());
                            if (!empty($decs)) {
                                $this->render_html_anchor_item($anchor_group_item, $key);
                            }
                            break;
                        case 'itinerary':
                            $itinerary = get_post_meta(get_the_ID(), '_tour_content_itinerary', true);
                            if (!empty($itinerary)) {
                                $this->render_html_anchor_item($anchor_group_item, $key);
                            }
                            break;
                        case 'faqs':
                            $faqs = get_post_meta(get_the_ID(), 'phys_tour_faq_options', true);
                            $faqs  = json_decode($faqs, true);
                            if ( is_array($faqs) && !empty($faqs)) {
                                $this->render_html_anchor_item($anchor_group_item, $key);
                            }
                            break;
                        case 'reviews':
                            $woocommerce_enable_reviews = get_option('woocommerce_enable_reviews');
                            if ($woocommerce_enable_reviews == 'yes') {
                                $this->render_html_anchor_item($anchor_group_item, $key);
                            }
                            break;
                        case 'map':
                            $tour_location_address = get_post_meta(get_the_ID(), '_tour_location_address', true);
                            if (!empty($tour_location_address)) {
                                $this->render_html_anchor_item($anchor_group_item, $key);
                            }
                            break;
                        default:
                            $this->render_html_anchor_item($anchor_group_item, $key);
                    }
                } ?>
            </ul>
        </div>
    <?php
    }
    protected function render_html_anchor_item($field, $key) {
        $list_array = $this->phys_list_metabox_tours_item();
        $anchor_link = '';
        $anchor_title = '';
        if ($field['anchor_item'] != 'custom') {
            if (array_key_exists($field['anchor_item'], $list_array)) {
                $anchor_title .= !empty($field['text']) ? $field['text'] :$list_array[$field['anchor_item']];
                $anchor_link .= '#' . $field['anchor_item'];
            }
        } else {
            if (!empty($field['text'])) {
                $anchor_title .= $field['text'];
            }
            if (!empty($field['link']["url"])) {
                $anchor_link .= $field['link']["url"];
            }
        }
        if (empty($anchor_title) || empty($anchor_link)) {
            return;
        }
        ?>
        <li class="anchor-inline-item">
            <a href="<?php echo $anchor_link; ?>" <?php if($key == 0) echo 'class="active"';?>>
                <?php \Elementor\Icons_Manager::render_icon($field['icons'], ['aria-hidden' => 'true']); ?>
                <span class="anchor-item-text"><?php esc_html_e($anchor_title, 'travelwp'); ?></span>
            </a>
        </li>
<?php }
    protected function phys_list_metabox_tours_item() {
        $list_anchor = array(
            'description' =>   esc_html__('Overview', 'travelwp'),
            'itinerary' =>   esc_html__('What To Expect', 'travelwp'),
            'faqs' =>   esc_html__('FAQs', 'travelwp'),
            'reviews' =>   esc_html__('Reviews', 'travelwp'),
            'map' =>   esc_html__('Map', 'travelwp'),
            'custom' =>   esc_html__('Custom', 'travelwp'),
        );
        return apply_filters('phys_anchor_tabs_el_widget/list_anchor', $list_anchor);
    }
}
