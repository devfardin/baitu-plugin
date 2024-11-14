<?php
class Elementor_show_packages_plan extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'pricing_plan';
    }
    public function get_title()
    {
        return esc_html__('Pricing Plan', 'baitu');
    }
    public function get_icon()
    {
        return 'eicon-price-table';
    }
    public function get_categories()
    {
        return ['basic'];
    }
    public function get_keywords()
    {
        return ['pricing', 'plan'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'baitu' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'package_category',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Package Category', 'baitu' ),
				'placeholder' => esc_html__( 'Enter Package Category', 'baitu' ),
			]
		);

        $this->end_controls_section();

    } //register_controls
    protected function render()
    {
        wp_enqueue_style("pricing_plan_style");
        $settings = $this->get_settings_for_display();
        $args = [
            'post_type' => 'pricing-plan',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    // custome texsonamy key name here
                    'taxonomy' => 'package-category',
                    'field' => 'slug',
                    'terms' => array($settings['package_category'],),
                )
            ),
            'posts_per_page'=> 10,
        ];
        $query = new \WP_Query($args);  ?>

       <div class="pricing_plan__wrap">
            <?php  if($query->have_posts()): ?>
                <div class="pricing_plan_container">
                    <?php while ( $query-> have_posts() ): $query->the_post(); ?>
                        <div class="pricing_plan_item">
                            <?php $feature_image=get_the_post_thumbnail_url(null, 'medium')?>
                            <img src="<?php  echo $feature_image ?>" alt="<?php echo get_the_title() ?>">  
                            <div class="pricing_plan__meta">

                                <div class="pricing_plan__top">
                                    <!-- top meta left item -->
                                    <div class="top_meta_left_item">
                                        <h2>Starts From BDT</h2>
                                        <?php $price=get_field( "rate_start_from", get_the_ID() ) ?>
                                        <?php if($price){  
                                        ?>  <h2> <span><?php echo $price ?></span>, Per Person </h2> <?php
                                        } ?>
                                    </div>

                                    <!-- Top meta right item -->
                                    <div class="top_meta_right_item">
                                        <?php $valid_till=get_field( "valid_till", get_the_ID() ) ?>
                                        <h2>Valid Till: </h2>
                                        <?php if($valid_till){
                                            ?> <h2> <span><?php echo $valid_till ?></span> </h2> <?php
                                        } ?>
                                    </div>
                                </div>
                                <!-- Pricing title -->
                                 <h1 class="pricing_plan__title"><?php echo get_the_title() ?></h1>
                                <!-- Pricing paln footer -->
                                 <div class="pricing_plan__footer">
                                    <?php $hotline = get_field( "hotline", get_the_ID() )  ?>
                                    <div>
                                    <a class="phone_number" href="tel:<?php echo $hotline ?>">
                                        <i aria-hidden="true" class="xlwpf wppb-font-phone-call"></i>
                                            <?php echo $hotline ?>
                                        </a>
                                    </div>
                                    <!-- pricing plan single btn -->
                                    <div>
                                        <a class="pricing_plan__details" href="<?php echo the_permalink(); ?>"> Details </a>
                                    </div>
                                 </div>


                            </div>
                        </div>
                    <?php  endwhile; ?> <!-- Loop Photo Gallery Items -->
                    <?php  wp_reset_postdata(); ?>
                </div>
               
                <!-- No Photo Gallery Message -->
                <?php else: ?> 
                    <div class='empty_message'> 
                        <p> No Pricing Plan to display at the moment </p>
                    </div>
            <?php endif; ?>
       </div>
    <?php
     }

}