<?php
get_header(); ?>

<main id="primary" class="site-main no-sidebar">
    <?php
    while ( have_posts() ) :
        the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php
                if ( has_post_thumbnail() ) :
                    the_post_thumbnail( 'large', array( 'class' => 'movie-featured-image' ) );
                endif;

                the_title( '<h1 class="entry-title">', '</h1>' );
                ?>
            </header>

            <div class="entry-content">
                <?php
                the_content();

                // Custom Fields - Check if ACF is available
                if ( function_exists( 'get_field' ) ) :
                    $custom_field = get_field( 'custom_field_name' ); // Replace with your custom field key
                    if ( $custom_field ) :
                        echo '<p><strong>Custom Field:</strong> ' . esc_html( $custom_field ) . '</p>';
                    endif;
                else :
                    echo '<p>Custom Fields functionality is not available. Please install and activate the ACF plugin.</p>';
                endif;
                ?>
            </div>

            <footer class="entry-footer">
                <span class="posted-on">Published on: <?php echo get_the_date(); ?></span>
                <span class="categories"><?php echo get_the_term_list( get_the_ID(), 'moviescategory', 'Categories: ', ', ' ); ?></span>
                <?php comments_template(); ?>
            </footer>
        </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
