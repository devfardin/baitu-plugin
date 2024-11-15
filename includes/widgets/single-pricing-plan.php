<?php
class Elementor_single_pricing_plan extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'single_pricing_plan';
    }
    public function get_title()
    {
        return esc_html__('single_pricing_plan', 'baitu');
    }
    public function get_icon()
    {
        return 'eicon-post-list';
    }
    public function get_categories()
    {
        return ['basic'];
    }
    public function get_keywords()
    {
        return ['single_pricing_plan', 'baitu'];
    }
    protected function register_controls()
    {
    }

    protected function render()
    {
        $this->render_inline_styles();
        ?>
        <div class="single_pricing__content">
            <!-- Left side  -->
            <div class="single_pricing_left_feature">
                <?php the_post_thumbnail('medium_large'); ?>
            </div>

            <!-- Right side -->
            <div class="single_pricing_right_content">
                <div class="single_pricing__title">
                    <h1><?php echo get_the_title(); ?></h1>
                </div>
                <div class="single_pricing_meta">
                    <?php $start_from = get_field("start_from", get_the_ID()) ?>
                    <?php $valid_till = get_field("valid_till", get_the_ID()) ?>
                    <?php $rate_start_from = get_field("rate_start_from", get_the_ID()) ?>
                    <?php $hotline = get_field("hotline", get_the_ID()) ?>
                    <?php $post_content= get_the_content(); ?>
                    <!-- When start -->
                    <?php if ($start_from) {
                        ?>
                        <h2> <span>Start From:</span> <?php echo $start_from ?> </h2> <?php
                    } ?>
                    <!-- Valid till -->
                     <?php if($valid_till){
                        ?> <h2><span>Valid Till:</span> <?php echo $valid_till ?></h2> <?php 
                     } ?>
                     <!-- Rate start from -->
                     <?php if($rate_start_from){
                        ?> <h2><span>Rate Start From:</span> <?php echo $rate_start_from ?> BDT</h2> <?php 
                     } ?>
                     <!-- Hotline Number -->
                     <?php if($hotline){
                        ?> <h2><span>Hotline:</span> <a href="tel:<?php echo $hotline ?>"> <?php echo $hotline ?></a> </h2> <?php 
                     } ?>
                     <!-- Pricing Description -->
                     <div class="post_description">
                        <?php echo  $post_content; ?>
                     </div>
                    
                </div>
            </div>
        </div>
        <?php
    }
    protected function render_inline_styles()
    { ?>
        <style>
            .single_pricing__content {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                row-gap: 15px;

            }

            @media only screen and (min-width:768px) {
                .single_pricing__content {
                    grid-template-columns: repeat(6, 1fr);
                    column-gap: 30px;
                }
            }

            .single_pricing_left_feature {
                grid-column: 6;
            }

            @media only screen and (min-width:768px) {
                .single_pricing_left_feature {
                    grid-column: 1/4;
                }
            }

            .single_pricing_left_feature .attachment-medium_large {
                width: 100%;
                object-fit: cover;
                border-radius: 6px;
                border: 2px solid var(--e-global-color-primary);
            }

            .single_pricing_right_content {
                grid-column: 6;
            }

            @media only screen and (min-width:768px) {
                .single_pricing_right_content {
                    grid-column: 4/7;
                }
            }

            .single_pricing__title h1 {
                font-size: 24px;
                font-weight: 700;
                font-family: Inter;
                color: var(--e-global-color-primary);
                line-height: 1em;
            }
            @media only screen and (min-width:768px){
                .single_pricing__title h1{
                    font-size: 30px;
                }
            }
            .single_pricing_meta{
                margin-top: 40px;
                display: flex;
                flex-direction: column;
                gap: 13px;
            }
            .single_pricing_meta h2{
                font-size:20px;
                font-weight: 400;
                font-family: Inter;
                color: #212529;
                line-height: 1em;
                margin: 0;
            }
            .single_pricing_meta h2 a{
                color:var(--e-global-color-primary);
                font-weight: 500;
            }
            .single_pricing_meta h2 span{
                color:#363636;
                font-weight: 500;
            }
        </style>
        <?php
    }
}