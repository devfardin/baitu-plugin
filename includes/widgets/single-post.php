<?php
class Elementor_single_post extends \Elementor\Widget_Base {

    public function get_name() {
        return 'single_post';
    }
    public function get_title() {
        return esc_html__( 'single_post', 'tri' );
    }
    public function get_icon() {
        return 'eicon-post-list';
    }
    public function get_categories() {
        return [ 'basic' ];
    }
    public function get_keywords() {
        return [ 'single_post','tri' ];
    }
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'single_post', 'tri' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $this->render_inline_styles(); 
        ?>
    

    <section class="posts_row">
         
        <article class="post__container">
            <div class="post_thumb">
                <a href="<?php the_permalink(); ?>" rel="bookmark"
                    aria-label="More about <?php echo get_the_title(); ?>">
                    <?php the_post_thumbnail('thumb_lg'); ?>
                </a>
            </div>
        

            <div class="single_post__info_wrap">
                <!-- Post Meta Info Start-->
                <div class="single_post__meta_info_wrap">
                <?php $author_id= get_the_author_meta('ID'); ?>
                
                <!-- post Author Inof    -->
                    <div class="single_post__auther_wrap">
                        <div class='single_post__auther'>
                            <img  class='post__author_avatar'
                            src="<?php echo get_avatar_url($author_id)?>" alt="<?php echo get_the_author_meta('display_name', $author_id) ?>" >

                            <h3 class='auther_display_name'>
                                <?php echo get_the_author_meta('display_name', $author_id); ?>
                            </h3>
                        </div>
                    </div>

                <!-- post Published date -->
                    <div class="post_published_date">
                        <?php $post_time = get_post_time() ;?>
                        <div class='post_published_date__icon'>
                        <svg aria-hidden="true" class="e-font-icon-svg e-far-calendar-alt" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M148 288h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm108-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 96v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96-260v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48zm-48 346V160H48v298c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"></path>
                        </svg>

                        </div>

                        <h3>
                            <?php echo date("M d, Y", $post_time ); ?>
                        </h3>
                    </div>       
            </div>
            <!-- Posts Meta Info End -->
            <!-- --------------------------- -->
            <div class='single_post_text__info'>
                <!-- Post Title -->
                <h1 class="single_post__post__title">
                    <?php echo get_the_title(); ?>
                </h1>
                <!-- Post Description  -->
                <p>
                <?php
                    $post_content= get_the_content();
                    echo  $post_content; ?>
                </p>

            </div>
        </div>
        </article>
        
        </section>
    <?php
    }
    protected function render_inline_styles(){ ?>
         <style>
            .single_post_row {
                display: flex;
                flex-direction: column;
                gap: 55px;
            }
            .post_thumb a img {
                border-radius: 15px;
                width: 100%;
                height: 700px;
                object-fit: cover;
            }
            .single_post__auther{
                display:flex;
                align-items: center;
                gap: 15px;
            }
            .single_post__auther img {
                width: 50px;
                height: 50px;
                object-fit: cover;
                border-radius: 50px !important;
            }
            .single_post__auther h3 {
                margin: 0px;
                font-size: 17px;
                font-weight: 400;
                color: #262420;
            }
            @media only screen and (min-width:425px){
                .single_post__auther h3 {
                font-size: 20px;
                }
            }
            .single_post__meta_info_wrap {
                display: flex;
                align-items: center;
                gap: 25px;
                margin-top:25px;
                padding: 0 15px;
            }
            .post_published_date h3 {
                font-size: 17px;
                color: #262420;
                font-weight: 400;
                margin:0px;
            }
            @media only screen and (min-width:425px){
                .post_published_date h3 {
                font-size: 20px;
                }
            }
            .post_published_date {
                display: flex;
                align-items: center;
                gap:15px;
            }

            .post_published_date__icon svg {
                width: 20px;
                margin: -5px;
                padding: 0px;
                fill: var(--e-global-color-primary);
            }
            .single_post_text__info{
                margin-top:10px;
                padding:0 15px;
            }
            .single_post_text__info h1 {
                color: #222222;
                font-size: 25px;
                line-height:1.2em;
                font-weight: 500;
                transition: all 0.3s;
                margin-bottom:10px;
            }
            @media only screen and (min-width:768px){
                .single_post_text__info h1 {
                font-size: 34px;
            }
            }

            .single_post_text__info a:hover {
                color:var(--e-global-color-primary)
            }
            .single_post_text__info p {
                font-size: 18px;
                color: #585858;
                margin: 10px 0;
            }
            @media only screen and (min-width:768px){
                .single_post_text__info p {
                font-size: 20px;
            }
            }    
         </style>
        <?php
    }
}