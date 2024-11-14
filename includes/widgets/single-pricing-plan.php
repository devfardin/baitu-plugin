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
                    <?php if ($start_from) {
                        ?>
                        <h2> Start From: <?php echo $start_from ?> </h2> <?php
                    } ?>

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
                
            }

            @media only screen and (min-width:768px) {
                .single_pricing__content {
                    grid-template-columns: repeat(6, 1fr);
                    gap: 20px;
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
        </style>
        <?php
    }
}