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
require_once( __DIR__ . '/includes/shortcodes/notices.php');

// admin menu 
require_once(__DIR__ . '/includes/admin-menu/admin-menu.php');
// require_once(__DIR__ . '/includes/admin-menu/old.php');

// Check if CMB2 is already loaded
if (!class_exists('CMB2_Bootstrap_270')) {
    // Try loading CMB2 from the bundled version
    if (file_exists(plugin_dir_path(__FILE__) . 'includes/cmb2/init.php')) {
        require_once plugin_dir_path(__FILE__) . 'includes/cmb2/init.php';
    } else {
        // Show admin notice if CMB2 is missing
        add_action('admin_notices', 'baitu_cmb2_missing_notice');
    }
}
/**
 * Show admin notice if CMB2 is missing.
 */
function baitu_cmb2_missing_notice() {
    echo '<div class="notice notice-error"><p>';
    echo '<strong>Baitu Plugin:</strong> CMB2 library is required for this plugin to function. ';
    echo 'Please install and activate the <a href="https://wordpress.org/plugins/cmb2/" target="_blank">CMB2 plugin</a>, ';
    echo 'or ensure the bundled CMB2 library is correctly installed.';
    echo '</p></div>';
}

// Register all css file
function render_style(){
    wp_register_style( 'latest_posts_style', BAITU_ASSETS_URI .'css/latest-posts.css');
    wp_register_style( 'phot_gallery_style', BAITU_ASSETS_URI .'css/photo-gallery.css');
    wp_register_style( 'pricing_plan_style', BAITU_ASSETS_URI .'css/pricing-plan.css');
    wp_register_style('notices_slider_custome', BAITU_ASSETS_URI . 'css/notice-slider-style.css');

}
add_action( 'wp_enqueue_scripts', 'render_style' );


// Register Custome widget for Elementor page builder\
function baitu_elementor_widget($widgets_manager){

    require_once(__DIR__ . '/includes/widgets/photo-gallery.php');
    require_once(__DIR__ . '/includes/widgets/show-packages.php');
    require_once(__DIR__ . '/includes/widgets/single-post.php');
    require_once(__DIR__ . '/includes/widgets/single-pricing-plan.php');
    
	$widgets_manager->register(new \Elementor_photo_gallery());
	$widgets_manager->register(new \Elementor_show_packages_plan());
	$widgets_manager->register(new \Elementor_single_post());
	$widgets_manager->register(new \Elementor_single_pricing_plan());
}
add_action("elementor/widgets/register","baitu_elementor_widget" );

