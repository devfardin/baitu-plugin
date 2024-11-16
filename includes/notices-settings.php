<?php 
add_action( 'cmb2_admin_init', 'baitu_register_notices_settings_page' );

function baitu_register_notices_settings_page(){
    
    $cmb = new_cmb2_box( array(
        'id'           => 'baitu_notices_metabox',
        'title'        => esc_html__( 'Notices Management', 'baitu' ),
        'object_types' => array( 'options-page' ),
        'option_key'      => 'myprefix_options',
        'icon_url'        => 'dashicons-megaphone', 
        'menu_title'      => esc_html__( 'Notices', 'baitu' ),
        'capability'      => 'manage_options',
        'position'        => 20,
    ) );

    // Add Marquee field
    $cmb->add_field(array(
        'name'    => 'Static Notice Marquee',
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

    $cmb->add_group_field('baitu_notice_group', array(
        'name' => 'Title',
        'id'   => 'notice_title',
        'type' => 'text',
    ));
    $cmb->add_group_field('baitu_notice_group', array(
        'name' => 'Description',
        'id'   => 'notice_description',
        'type' => 'textarea',
    ));
    $cmb->add_group_field('baitu_notice_group', array(
        'name' => 'Image',
        'id'   => 'notice_image',
        'type' => 'file',
    ));
}