<?php
get_header();
?>

<main>
    <h1>Welcome to the Parks Website</h1>

    <div class="parks-list">
        <?php
        // Query and display parks
        $args = array(
            'post_type'      => 'parks',
            'posts_per_page' => -1,
        );
        $parks_query = new WP_Query($args);

        if ($parks_query->have_posts()) :
            while ($parks_query->have_posts()) : $parks_query->the_post();
        ?>
                <div class="park-item">
                    <h2><?php the_title(); ?></h2>
                    <p><strong>Location:</strong> <?php echo get_post_meta(get_the_ID(), 'location', true); ?></p>
                    <p><strong>Hours (Weekdays):</strong> <?php echo get_post_meta(get_the_ID(), 'hours_weekdays', true); ?></p>
                    <p><strong>Hours (Weekends):</strong> <?php echo get_post_meta(get_the_ID(), 'hours_weekends', true); ?></p>
                </div>
        <?php
            endwhile;
        else :
            echo '<p>No parks found.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</main>

<?php
get_footer();
