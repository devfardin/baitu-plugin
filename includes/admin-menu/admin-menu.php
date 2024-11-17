<?php
/**
 * Notice Management in Admin Dashboard
 */

// Hook to add the menu and register the notice system
// add_action('admin_menu', 'baitu_notice_admin_menu');
// add_action('cmb2_admin_init', 'baitu_register_notice_settings');

/**
 * Add a custom menu for notices in the WordPress admin dashboard.
 */
function baitu_notice_admin_menu()
{
    add_menu_page(
        'Notice Management',     // Page title
        'Notices',               // Menu title
        'manage_options',        // Capability
        'baitu-notices',         // Menu slug
        'baitu_render_notice_page', // Callback function
        'dashicons-megaphone',   // Menu icon
        20                       // Position
    );
}

/**
 * Render the notice management page.
 */
function baitu_render_notice_page()
{
    ?>
    <div class="wrap">
        <h1>Notice Management</h1>
        <?php baitu_notice_section_callback(); ?>
    </div>
    <?php
}

/**
 * Callback function to display the CMB2 notice form.
 */
function baitu_notice_section_callback()
{
    // Get the CMB2 object for the notice form
    // $cmb = baitu_register_notice_form();

    // Display the CMB2 form
    // echo cmb2_get_metabox_form( $cmb, 'baitu_notice_options');
}

/**
 * Define the CMB2 metabox for the notice form.
 */
add_action('cmb2_admin_init', 'baitu_register_notice_form');

function baitu_register_notice_form()
{
    // Retrieve the saved options
    // $notices_data = get_option('baitu_notice_options');

    $cmb = new_cmb2_box(array(
        'id' => 'baitu_notices_metabox',
        'title' => esc_html__('Notices Management', 'baitu'),
        'object_types' => array('options-page'),
        'option_key' => 'baitu_notice_options',
        'icon_url' => 'dashicons-megaphone',
        'menu_title' => esc_html__('Notices', 'baitu'),
        'capability' => 'manage_options',
        'position' => 20,
    ));

    // Add Marquee field
    $cmb->add_field(array(
        'name' => 'Static Notice Marquee',
        // 'default' => $notices_data['notice_marquee'] ?? '', // Safely access the marquee data
        'id' => 'notice_marquee',
        'type' => 'textarea_small',
    ));

    // Add Group Field for Notices
    $group_field_id = $cmb->add_field(array(
        'id' => 'baitu_notice_group',
        'type' => 'group',
        'options' => array(
            'group_title' => __('Notice {#}', 'baitu'),
            'add_button' => __('Add Notice', 'baitu'),
            'remove_button' => __('Remove Notice', 'baitu'),
            'sortable' => true,
        ),
    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Description',
        'id' => 'notice_description',
        'type' => 'textarea',
    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Image',
        'id' => 'notice_image',
        'type' => 'file',
    ));
    return $cmb;

}

/*
 * Register the settings for saving notice options.
 */
function baitu_register_notice_settings()
{
    register_setting('baitu_notice_group', 'baitu_notice_options');
}
