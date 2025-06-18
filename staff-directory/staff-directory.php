<?php
/**
 * Plugin Name: Staff Directory
 * Plugin URI: https://github.com/OrasesWPDev/aw-demo
 * Description: A WordPress plugin to manage staff members with ACF Pro integration. Features custom post type, shortcode display, and individual staff pages.
 * Version: 1.0.1
 * Author: Orases
 * License: GPL v2 or later
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * Text Domain: staff-directory
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('STAFF_DIRECTORY_VERSION', '1.0.1');
define('STAFF_DIRECTORY_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('STAFF_DIRECTORY_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Main Staff Directory Plugin Class
 */
class Staff_Directory_Plugin {
    
    /**
     * Single instance of the plugin
     */
    private static $instance = null;
    
    /**
     * Get singleton instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        add_action('plugins_loaded', array($this, 'init'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    /**
     * Initialize plugin
     */
    public function init() {
        // Check if ACF Pro is active
        if (!class_exists('ACF')) {
            add_action('admin_notices', array($this, 'acf_missing_notice'));
            return;
        }
        
        // Load plugin classes
        $this->load_classes();
        
        // Initialize components
        new Staff_Post_Type();
        new Staff_ACF_Fields();
        new Staff_Shortcode();
        new Staff_Templates();
    }
    
    /**
     * Load required classes
     */
    private function load_classes() {
        require_once STAFF_DIRECTORY_PLUGIN_DIR . 'includes/class-staff-post-type.php';
        require_once STAFF_DIRECTORY_PLUGIN_DIR . 'includes/class-staff-acf-fields.php';
        require_once STAFF_DIRECTORY_PLUGIN_DIR . 'includes/class-staff-shortcode.php';
        require_once STAFF_DIRECTORY_PLUGIN_DIR . 'includes/class-staff-templates.php';
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        // Flush rewrite rules to register custom post type
        flush_rewrite_rules();
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    /**
     * Show admin notice if ACF Pro is not active
     */
    public function acf_missing_notice() {
        ?>
        <div class="notice notice-error">
            <p><?php _e('Staff Directory plugin requires Advanced Custom Fields Pro to be installed and activated.', 'staff-directory'); ?></p>
        </div>
        <?php
    }
}

// Initialize the plugin
Staff_Directory_Plugin::get_instance();