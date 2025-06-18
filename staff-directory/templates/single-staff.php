<?php
/**
 * Single Staff Member Template
 * 
 * Template for displaying individual staff member pages
 */

get_header(); ?>

<div class="staff-single-container">
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('staff-single-post'); ?>>
            
            <div class="staff-single-content">
                
                <!-- Staff Header Section -->
                <header class="staff-single-header">
                    <div class="staff-header-inner">
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="staff-single-image">
                                <?php the_post_thumbnail('large', array('class' => 'staff-photo')); ?>
                            </div>
                        <?php else : ?>
                            <div class="staff-single-image staff-single-no-image">
                                <div class="staff-placeholder-large">
                                    <span class="staff-placeholder-icon">👤</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="staff-header-info">
                            <?php
                            $staff_name = get_field('staff_name');
                            $staff_title = get_field('staff_title');
                            $staff_department = get_field('staff_department');
                            ?>
                            
                            <h1 class="staff-single-name">
                                <?php echo $staff_name ? esc_html($staff_name) : get_the_title(); ?>
                            </h1>
                            
                            <?php if ($staff_title) : ?>
                                <p class="staff-single-title"><?php echo esc_html($staff_title); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($staff_department) : ?>
                                <p class="staff-single-department">
                                    <strong><?php _e('Department:', 'staff-directory'); ?></strong>
                                    <?php echo esc_html($this->format_department($staff_department)); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </header>
                
                <!-- Staff Contact Information -->
                <section class="staff-contact-section">
                    <h2><?php _e('Contact Information', 'staff-directory'); ?></h2>
                    
                    <div class="staff-contact-grid">
                        <?php
                        $staff_email = get_field('staff_email');
                        $staff_phone = get_field('staff_phone');
                        $staff_birthdate = get_field('staff_birthdate');
                        ?>
                        
                        <?php if ($staff_email) : ?>
                            <div class="staff-contact-item">
                                <strong><?php _e('Email:', 'staff-directory'); ?></strong>
                                <a href="mailto:<?php echo esc_attr($staff_email); ?>">
                                    <?php echo esc_html($staff_email); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($staff_phone) : ?>
                            <div class="staff-contact-item">
                                <strong><?php _e('Phone:', 'staff-directory'); ?></strong>
                                <a href="tel:<?php echo esc_attr($staff_phone); ?>">
                                    <?php echo esc_html($staff_phone); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($staff_birthdate) : ?>
                            <div class="staff-contact-item">
                                <strong><?php _e('Birthday:', 'staff-directory'); ?></strong>
                                <?php echo date('F j', strtotime($staff_birthdate)); ?>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </section>
                
                <!-- Staff Biography -->
                <?php 
                $staff_bio = get_field('staff_bio');
                $post_content = get_the_content();
                ?>
                
                <?php if ($staff_bio || $post_content) : ?>
                    <section class="staff-bio-section">
                        <h2><?php _e('About', 'staff-directory'); ?></h2>
                        
                        <?php if ($staff_bio) : ?>
                            <div class="staff-bio-content">
                                <?php echo wp_kses_post($staff_bio); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($post_content) : ?>
                            <div class="staff-post-content">
                                <?php the_content(); ?>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>
                
                <!-- Social Media Links -->
                <?php
                $social_links = get_field('staff_social_links');
                if ($social_links && is_array($social_links)) :
                ?>
                    <section class="staff-social-section">
                        <h2><?php _e('Connect', 'staff-directory'); ?></h2>
                        
                        <div class="staff-social-links">
                            <?php foreach ($social_links as $social_link) : ?>
                                <?php if (!empty($social_link['url']) && !empty($social_link['platform'])) : ?>
                                    <a href="<?php echo esc_url($social_link['url']); ?>" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       class="staff-social-link staff-social-<?php echo esc_attr($social_link['platform']); ?>">
                                        <span class="staff-social-icon">
                                            <?php echo $this->get_social_icon($social_link['platform']); ?>
                                        </span>
                                        <span class="staff-social-label">
                                            <?php echo esc_html(ucfirst($social_link['platform'])); ?>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
                
                <!-- Back to Directory Link -->
                <nav class="staff-navigation">
                    <a href="#" onclick="history.back()" class="staff-back-link">
                        ← <?php _e('Back to Staff Directory', 'staff-directory'); ?>
                    </a>
                </nav>
                
            </div>
            
        </article>
        
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>

<?php
/**
 * Helper functions for the template
 */

function format_department($department) {
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

function get_social_icon($platform) {
    $icons = array(
        'linkedin' => '🔗',
        'twitter' => '🐦',
        'facebook' => '📘',
        'instagram' => '📷',
        'github' => '⚡',
        'dribbble' => '🏀',
        'behance' => '🎨',
        'youtube' => '📺',
        'other' => '🌐',
    );
    
    return isset($icons[$platform]) ? $icons[$platform] : '🌐';
}
?>