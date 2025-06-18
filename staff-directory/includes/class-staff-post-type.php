<?php
/**
 * Staff Post Type Class
 * 
 * Handles registration of the staff custom post type
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Staff_Post_Type {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'register_post_type'));
        add_action('init', array($this, 'register_taxonomy'));
    }
    
    /**
     * Register the staff custom post type
     */
    public function register_post_type() {
        $labels = array(
            'name'                  => _x('Staff Members', 'Post type general name', 'staff-directory'),
            'singular_name'         => _x('Staff Member', 'Post type singular name', 'staff-directory'),
            'menu_name'             => _x('Staff Directory', 'Admin Menu text', 'staff-directory'),
            'name_admin_bar'        => _x('Staff Member', 'Add New on Toolbar', 'staff-directory'),
            'add_new'               => __('Add New', 'staff-directory'),
            'add_new_item'          => __('Add New Staff Member', 'staff-directory'),
            'new_item'              => __('New Staff Member', 'staff-directory'),
            'edit_item'             => __('Edit Staff Member', 'staff-directory'),
            'view_item'             => __('View Staff Member', 'staff-directory'),
            'all_items'             => __('All Staff Members', 'staff-directory'),
            'search_items'          => __('Search Staff Members', 'staff-directory'),
            'parent_item_colon'     => __('Parent Staff Members:', 'staff-directory'),
            'not_found'             => __('No staff members found.', 'staff-directory'),
            'not_found_in_trash'    => __('No staff members found in Trash.', 'staff-directory'),
            'featured_image'        => _x('Staff Photo', 'Overrides the "Featured Image" phrase', 'staff-directory'),
            'set_featured_image'    => _x('Set staff photo', 'Overrides the "Set featured image" phrase', 'staff-directory'),
            'remove_featured_image' => _x('Remove staff photo', 'Overrides the "Remove featured image" phrase', 'staff-directory'),
            'use_featured_image'    => _x('Use as staff photo', 'Overrides the "Use as featured image" phrase', 'staff-directory'),
            'archives'              => _x('Staff Member archives', 'The post type archive label', 'staff-directory'),
            'insert_into_item'      => _x('Insert into staff member', 'Overrides the "Insert into post" phrase', 'staff-directory'),
            'uploaded_to_this_item' => _x('Uploaded to this staff member', 'Overrides the "Uploaded to this post" phrase', 'staff-directory'),
            'filter_items_list'     => _x('Filter staff members list', 'Screen reader text for the filter links', 'staff-directory'),
            'items_list_navigation' => _x('Staff members list navigation', 'Screen reader text for the pagination', 'staff-directory'),
            'items_list'            => _x('Staff members list', 'Screen reader text for the items list', 'staff-directory'),
        );
        
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'staff'),
            'capability_type'    => 'post',
            'has_archive'        => false, // We'll use shortcode instead
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-groups',
            'supports'           => array(
                'title',
                'editor',
                'thumbnail',
                'page-attributes', // Enables menu_order for custom ordering
            ),
            'show_in_customizer' => false,
        );
        
        register_post_type('staff', $args);
    }
    
    /**
     * Register department taxonomy for staff members
     */
    public function register_taxonomy() {
        $labels = array(
            'name'              => _x('Departments', 'taxonomy general name', 'staff-directory'),
            'singular_name'     => _x('Department', 'taxonomy singular name', 'staff-directory'),
            'search_items'      => __('Search Departments', 'staff-directory'),
            'all_items'         => __('All Departments', 'staff-directory'),
            'parent_item'       => __('Parent Department', 'staff-directory'),
            'parent_item_colon' => __('Parent Department:', 'staff-directory'),
            'edit_item'         => __('Edit Department', 'staff-directory'),
            'update_item'       => __('Update Department', 'staff-directory'),
            'add_new_item'      => __('Add New Department', 'staff-directory'),
            'new_item_name'     => __('New Department Name', 'staff-directory'),
            'menu_name'         => __('Departments', 'staff-directory'),
        );
        
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'department'),
        );
        
        register_taxonomy('staff_department', array('staff'), $args);
    }
}