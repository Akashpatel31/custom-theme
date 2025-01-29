<?php
// Theme setup
function parks_theme_setup() {
    // Enable support for menus
    add_theme_support('menus');

    // Register navigation menu
    register_nav_menu('main-menu', 'Main Menu');
}
add_action('after_setup_theme', 'parks_theme_setup');

// Register Custom Post Type: Parks
function parks_register_post_type() {
    $args = array(
        'label'               => 'Parks',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-location', // Custom menu icon
        'supports'            => array('title', 'editor', 'custom-fields'),
        'has_archive'         => true,  // Enable archive page
        'rewrite'             => array('slug' => 'parks'),
        'show_in_rest'        => true, // Optional: Enable Gutenberg editor
    );
    register_post_type('parks', $args);
}
add_action('init', 'parks_register_post_type');

// Register Custom Taxonomy: Facilities
function parks_register_taxonomy() {
    $args = array(
        'hierarchical'        => true,
        'labels'              => array(
            'name'              => 'Facilities',
            'singular_name'     => 'Facility',
        ),
        'show_ui'             => true,
        'show_admin_column'   => true,  // Show in admin column
        'rewrite'             => array('slug' => 'facility'),
        'show_in_rest'        => true,  // Optional: Enable Gutenberg editor for taxonomy
    );
    register_taxonomy('facilities', 'parks', $args);
}
add_action('init', 'parks_register_taxonomy');

// Register the shortcode [parks]
function parks_shortcode($atts) {
    // Set default attributes
    $atts = shortcode_atts(array(
        'facility' => '',
    ), $atts, 'parks');

    // Query parks based on facility filter if provided
    $args = array(
        'post_type'      => 'parks',
        'posts_per_page' => -1,
    );

    if (!empty($atts['facility'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'facilities',
                'field'    => 'slug',
                'terms'    => $atts['facility'],
            ),
        );
    }

    $query = new WP_Query($args);
    
    // Start building the output
    $output = '<div class="parks-list">';
    
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            $location = get_post_meta(get_the_ID(), 'location', true);
            $hours_weekends = get_post_meta(get_the_ID(), 'hours_weekends', true);
            $hours_weekdays = get_post_meta(get_the_ID(), 'hours_weekdays', true);

            $output .= '<div class="park-item">';
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<p><strong>Location:</strong> ' . esc_html($location) . '</p>';
            $output .= '<p><strong>Hours (Weekdays):</strong> ' . esc_html($hours_weekdays) . '</p>';
            $output .= '<p><strong>Hours (Weekends):</strong> ' . esc_html($hours_weekends) . '</p>';
            $output .= '</div>';
        endwhile;
    } else {
        $output .= '<p>No parks found.</p>';
    }

    wp_reset_postdata();
    $output .= '</div>';
    return $output;
}
add_shortcode('parks', 'parks_shortcode');

// Enqueue styles and scripts
function parks_theme_enqueue_styles() {
    wp_enqueue_style('parks-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'parks_theme_enqueue_styles');
