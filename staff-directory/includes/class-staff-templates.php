<?php
/**
 * Staff Templates Class
 * 
 * Handles template loading for staff post type
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Staff_Templates {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_filter('single_template', array($this, 'load_staff_template'));
        add_filter('template_include', array($this, 'template_include'));
    }
    
    /**
     * Load custom template for staff post type
     */
    public function load_staff_template($template) {
        if (is_singular('staff')) {
            $plugin_template = STAFF_DIRECTORY_PLUGIN_DIR . 'templates/single-staff.php';
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }
        return $template;
    }
    
    /**
     * Include custom templates
     */
    public function template_include($template) {
        if (is_singular('staff')) {
            $plugin_template = STAFF_DIRECTORY_PLUGIN_DIR . 'templates/single-staff.php';
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }
        return $template;
    }
}