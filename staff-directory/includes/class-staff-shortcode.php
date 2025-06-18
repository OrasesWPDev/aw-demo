<?php
/**
 * Staff Shortcode Class
 * 
 * Handles the [staff_directory] shortcode functionality
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Staff_Shortcode {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_shortcode('staff_directory', array($this, 'render_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }
    
    /**
     * Enqueue frontend styles
     */
    public function enqueue_styles() {
        wp_enqueue_style(
            'staff-directory-styles',
            STAFF_DIRECTORY_PLUGIN_URL . 'assets/css/staff-directory.css',
            array(),
            STAFF_DIRECTORY_VERSION
        );
    }
    
    /**
     * Render the staff directory shortcode
     */
    public function render_shortcode($atts) {
        // Parse shortcode attributes
        $atts = shortcode_atts(array(
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'limit' => -1,
            'columns' => 3,
            'department' => '',
        ), $atts, 'staff_directory');
        
        // Prepare query arguments
        $query_args = array(
            'post_type' => 'staff',
            'post_status' => 'publish',
            'posts_per_page' => intval($atts['limit']),
        );
        
        // Handle ordering
        switch ($atts['orderby']) {
            case 'alphabetical':
                $query_args['orderby'] = 'title';
                $query_args['order'] = 'ASC';
                break;
            case 'department':
                $query_args['meta_key'] = 'staff_department';
                $query_args['orderby'] = 'meta_value';
                $query_args['order'] = 'ASC';
                break;
            case 'menu_order':
            default:
                $query_args['orderby'] = 'menu_order';
                $query_args['order'] = $atts['order'];
                break;
        }
        
        // Filter by department if specified
        if (!empty($atts['department'])) {
            $query_args['meta_query'] = array(
                array(
                    'key' => 'staff_department',
                    'value' => $atts['department'],
                    'compare' => '='
                )
            );
        }
        
        // Execute query
        $staff_query = new WP_Query($query_args);
        
        if (!$staff_query->have_posts()) {
            return '<p class="staff-directory-no-results">' . __('No staff members found.', 'staff-directory') . '</p>';
        }
        
        // Start output buffering
        ob_start();
        
        // Generate grid classes
        $columns = max(1, min(6, intval($atts['columns'])));
        $grid_class = 'staff-directory-grid staff-directory-columns-' . $columns;
        
        ?>
        <div class="staff-directory-container">
            <div class="<?php echo esc_attr($grid_class); ?>">
                <?php while ($staff_query->have_posts()) : $staff_query->the_post(); ?>
                    <?php $this->render_staff_card(get_the_ID()); ?>
                <?php endwhile; ?>
            </div>
        </div>
        <?php
        
        // Clean up
        wp_reset_postdata();
        
        return ob_get_clean();
    }
    
    /**
     * Render individual staff card
     */
    private function render_staff_card($post_id) {
        // Get ACF fields
        $staff_name = get_field('staff_name', $post_id);
        $staff_title = get_field('staff_title', $post_id);
        $staff_email = get_field('staff_email', $post_id);
        $staff_department = get_field('staff_department', $post_id);
        $featured_image = get_the_post_thumbnail($post_id, 'medium');
        
        // Use post title as fallback for name
        if (empty($staff_name)) {
            $staff_name = get_the_title($post_id);
        }
        
        // Get permalink for single page
        $permalink = get_permalink($post_id);
        
        ?>
        <div class="staff-directory-card">
            <div class="staff-card-inner">
                <?php if ($featured_image) : ?>
                    <div class="staff-card-image">
                        <a href="<?php echo esc_url($permalink); ?>">
                            <?php echo $featured_image; ?>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="staff-card-image staff-card-no-image">
                        <a href="<?php echo esc_url($permalink); ?>">
                            <div class="staff-placeholder-image">
                                <span class="staff-placeholder-icon">👤</span>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="staff-card-content">
                    <h3 class="staff-card-name">
                        <a href="<?php echo esc_url($permalink); ?>">
                            <?php echo esc_html($staff_name); ?>
                        </a>
                    </h3>
                    
                    <?php if ($staff_title) : ?>
                        <p class="staff-card-title"><?php echo esc_html($staff_title); ?></p>
                    <?php endif; ?>
                    
                    <?php if ($staff_department) : ?>
                        <p class="staff-card-department"><?php echo esc_html($this->format_department($staff_department)); ?></p>
                    <?php endif; ?>
                    
                    <?php if ($staff_email) : ?>
                        <p class="staff-card-email">
                            <a href="mailto:<?php echo esc_attr($staff_email); ?>">
                                <?php echo esc_html($staff_email); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    
                    <div class="staff-card-actions">
                        <a href="<?php echo esc_url($permalink); ?>" class="staff-card-link">
                            <?php _e('View Profile', 'staff-directory'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * Format department name for display
     */
    private function format_department($department) {
        $departments = array(
            'executive' => 'Executive',
            'marketing' => 'Marketing',
            'sales' => 'Sales',
            'hr' => 'Human Resources',
            'it' => 'Information Technology',
            'finance' => 'Finance',
            'operations' => 'Operations',
            'customer-service' => 'Customer Service',
            'other' => 'Other',
        );
        
        return isset($departments[$department]) ? $departments[$department] : ucfirst($department);
    }
}