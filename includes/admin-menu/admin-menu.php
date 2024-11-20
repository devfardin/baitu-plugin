<?php
/**
 * Define the CMB2 metabox for the notice form.
 */
add_action('cmb2_admin_init', 'baitu_register_notice_form');

function baitu_register_notice_form()
{
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
        'id' => 'notice_marquee',
        'type' => 'textarea_small',
    ));

    // Add Button label 1
    $cmb->add_field(array(
        'name' => 'Button Label 1',
        'id' => 'button_lebel_1',
        'type' => 'Text',
    ));
    // Add Button url 1
    $cmb->add_field(array(
        'name' => 'Button Url 1',
        'id' => 'button_url_1',
        'type' => 'text_url',
    ));

    // Add Button label 2
    $cmb->add_field(array(
        'name' => 'Button Label 2',
        'id' => 'button_lebel_2',
        'type' => 'Text',
    ));
      // Add Button url 2
      $cmb->add_field(array(
        'name' => 'Button Url 1',
        'id' => 'button_url_2',
        'type' => 'text_url',
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