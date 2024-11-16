<?php
/**
 * Notice Management in Admin Dashboard
 */

// Hook to add the menu and register the notice system
add_action('admin_menu', 'baitu_notice_admin_menu');
add_action('admin_init', 'baitu_register_notice_settings');

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
    $cmb = baitu_register_notice_form();

    // Display the CMB2 form
    echo cmb2_get_metabox_form($cmb, 'baitu_notice_options');
}

/**
 * Define the CMB2 metabox for the notice form.
 */
function baitu_register_notice_form()
{
    // Retrieve the saved options
    $notices_data = get_option('baitu_notice_options');
    $notices = $notices_data['baitu_notice_group'] ?? []; // Use null coalescing for safety

    // Define the CMB2 metabox
    $cmb = new_cmb2_box(array(
        'id'           => 'baitu_notice_metabox',
        'title'        => 'Notice Details',
        'object_types' => array('options-page'),  // Use options page type
        'option_key'   => 'baitu_notice_options', // Save to this option
        'parent_slug'  => 'baitu-notices',        // Attach to the menu
    ));

    // Add Marquee field
    $cmb->add_field(array(
        'name'    => 'Test Text Area Small',
        'default' => $notices_data['notice_marquee'] ?? '', // Safely access the marquee data
        'id'      => 'notice_marquee',
        'type'    => 'textarea_small',
    ));

    // Add Group Field for Notices
    $group_field_id = $cmb->add_field(array(
        'id'      => 'baitu_notice_group',
        'type'    => 'group',
        'options' => array(
            'group_title'   => __('Notice {#}', 'baitu'),
            'add_button'    => __('Add Notice', 'baitu'),
            'remove_button' => __('Remove Notice', 'baitu'),
            'sortable'      => true,
        ),
    ));

    // Check if there are saved notices
    if (!empty($notices)) {
        foreach ($notices as $index => $notice) {
            // Add Title field
            $cmb->add_group_field($group_field_id, array(
                'name'    => 'Title',
                'id'      => "notice_title", // Ensure unique IDs
                'type'    => 'text',
                'default' => $notice['notice_title'] ?? '', // Default to saved title
            ));
            // Add Description field
            $cmb->add_group_field($group_field_id, array(
                'name'    => 'Description',
                'id'      => "notice_description", // Ensure unique IDs
                'type'    => 'textarea',
                'default' => $notice['notice_description'] ?? '', // Default to saved description
            ));
            // Add Image field
            $cmb->add_group_field($group_field_id, array(
                'name'    => 'Image',
                'id'      => "notice_image", // Ensure unique IDs
                'type'    => 'file',
                'default' => $notice['notice_image'] ?? '', // Default to saved image URL
            ));
        }
    } else {
        // Add default fields for new notices
        $cmb->add_group_field($group_field_id, array(
            'name' => 'Title',
            'id'   => 'notice_title',
            'type' => 'text',
        ));
        $cmb->add_group_field($group_field_id, array(
            'name' => 'Description',
            'id'   => 'notice_description',
            'type' => 'textarea',
        ));
        $cmb->add_group_field($group_field_id, array(
            'name' => 'Image',
            'id'   => 'notice_image',
            'type' => 'file',
        ));
    }

    return $cmb;
}

/*
 * Register the settings for saving notice options.
 */
function baitu_register_notice_settings()
{
    register_setting('baitu_notice_group', 'baitu_notice_options');
}
