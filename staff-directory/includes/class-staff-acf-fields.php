<?php
/**
 * Staff ACF Fields Class
 * 
 * Handles registration of ACF field groups for staff members
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Staff_ACF_Fields {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('acf/init', array($this, 'register_field_groups'));
    }
    
    /**
     * Register ACF field groups for staff members
     */
    public function register_field_groups() {
        if (function_exists('acf_add_local_field_group')) {
            
            // Staff Information Field Group
            acf_add_local_field_group(array(
                'key' => 'group_staff_information',
                'title' => 'Staff Information',
                'fields' => array(
                    array(
                        'key' => 'field_staff_name',
                        'label' => 'Full Name',
                        'name' => 'staff_name',
                        'type' => 'text',
                        'instructions' => 'Enter the staff member\'s full name',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '50',
                        ),
                    ),
                    array(
                        'key' => 'field_staff_title',
                        'label' => 'Job Title',
                        'name' => 'staff_title',
                        'type' => 'text',
                        'instructions' => 'Enter the staff member\'s job title or position',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '50',
                        ),
                    ),
                    array(
                        'key' => 'field_staff_email',
                        'label' => 'Email Address',
                        'name' => 'staff_email',
                        'type' => 'email',
                        'instructions' => 'Enter the staff member\'s email address',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '50',
                        ),
                    ),
                    array(
                        'key' => 'field_staff_phone',
                        'label' => 'Phone Number',
                        'name' => 'staff_phone',
                        'type' => 'text',
                        'instructions' => 'Enter the staff member\'s phone number',
                        'required' => 0,
                        'wrapper' => array(
                            'width' => '50',
                        ),
                    ),
                    array(
                        'key' => 'field_staff_birthdate',
                        'label' => 'Birth Date',
                        'name' => 'staff_birthdate',
                        'type' => 'date_picker',
                        'instructions' => 'Select the staff member\'s birth date',
                        'required' => 0,
                        'display_format' => 'F j, Y',
                        'return_format' => 'Y-m-d',
                        'first_day' => 1,
                        'wrapper' => array(
                            'width' => '50',
                        ),
                    ),
                    array(
                        'key' => 'field_staff_department',
                        'label' => 'Department',
                        'name' => 'staff_department',
                        'type' => 'select',
                        'instructions' => 'Select the staff member\'s department',
                        'required' => 0,
                        'choices' => array(
                            'executive' => 'Executive',
                            'marketing' => 'Marketing',
                            'sales' => 'Sales',
                            'hr' => 'Human Resources',
                            'it' => 'Information Technology',
                            'finance' => 'Finance',
                            'operations' => 'Operations',
                            'customer-service' => 'Customer Service',
                            'other' => 'Other',
                        ),
                        'default_value' => array(),
                        'allow_null' => 1,
                        'multiple' => 0,
                        'ui' => 1,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => 'Select Department',
                        'wrapper' => array(
                            'width' => '50',
                        ),
                    ),
                    array(
                        'key' => 'field_staff_bio',
                        'label' => 'Biography',
                        'name' => 'staff_bio',
                        'type' => 'textarea',
                        'instructions' => 'Enter a brief biography or description of the staff member',
                        'required' => 0,
                        'rows' => 4,
                        'new_lines' => 'wpautop',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'staff',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
            
            // Social Media Links Field Group
            acf_add_local_field_group(array(
                'key' => 'group_staff_social_media',
                'title' => 'Social Media Links',
                'fields' => array(
                    array(
                        'key' => 'field_staff_social_links',
                        'label' => 'Social Media Links',
                        'name' => 'staff_social_links',
                        'type' => 'repeater',
                        'instructions' => 'Add social media links for this staff member',
                        'required' => 0,
                        'collapsed' => 'field_social_platform',
                        'min' => 0,
                        'max' => 10,
                        'layout' => 'table',
                        'button_label' => 'Add Social Link',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_social_platform',
                                'label' => 'Platform',
                                'name' => 'platform',
                                'type' => 'select',
                                'instructions' => 'Select the social media platform',
                                'required' => 1,
                                'choices' => array(
                                    'linkedin' => 'LinkedIn',
                                    'twitter' => 'Twitter',
                                    'facebook' => 'Facebook',
                                    'instagram' => 'Instagram',
                                    'github' => 'GitHub',
                                    'dribbble' => 'Dribbble',
                                    'behance' => 'Behance',
                                    'youtube' => 'YouTube',
                                    'other' => 'Other',
                                ),
                                'default_value' => array(),
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 1,
                                'return_format' => 'value',
                                'ajax' => 0,
                                'placeholder' => '',
                                'wrapper' => array(
                                    'width' => '30',
                                ),
                            ),
                            array(
                                'key' => 'field_social_url',
                                'label' => 'URL',
                                'name' => 'url',
                                'type' => 'url',
                                'instructions' => 'Enter the full URL to the social media profile',
                                'required' => 1,
                                'wrapper' => array(
                                    'width' => '70',
                                ),
                            ),
                        ),
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'staff',
                        ),
                    ),
                ),
                'menu_order' => 1,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
        }
    }
}