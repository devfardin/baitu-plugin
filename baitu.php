<?php
/**
 * Plugin Name: Baitu
 * Plugin URI: https://github.com/devfardin
 * Description: Enhance your website’s functionality with Baitu Plugin – a lightweight, easy-to-use tool designed to add custom features and extend your site's capabilities seamlessly. 
 * Version: 1.0.0
 * Author: Fardin
 * Author URI: https://github.com/devfardin
 * Text Domain: baitu
 */

if( ! defined( 'ABSPATH' ) ) {
    die( 'Please do not access directly!' );
};

define ( 'BAITU_ASSETS_URI', plugin_dir_url( __FILE__ ) . 'assets/' );
define ( 'BAITU_VERSION', '1.0.0' );


// Home Latest post shortcode
require_once( __DIR__ . '/includes/shortcodes/latest-posts.php');

// Register all css file
function render_style(){
    wp_register_style( 'latest_posts_style', BAITU_ASSETS_URI .'css/latest-posts.css');
    wp_register_style( 'phot_gallery_style', BAITU_ASSETS_URI .'css/photo-gallery.css');

}
add_action( 'wp_enqueue_scripts', 'render_style' );


// Register Custome widget for Elementor page builder\
function baitu_elementor_widget($widgets_manager){

    require_once(__DIR__ . '/includes/widgets/photo-gallery.php');
    
	$widgets_manager->register(new \Elementor_single_photo_gallery());
}
add_action("elementor/widgets/register","baitu_elementor_widget" );