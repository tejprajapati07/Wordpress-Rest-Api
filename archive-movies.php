<?php
get_header();

// Get all movie categories for the filter dropdown
$categories = get_terms( array(
    'taxonomy' => 'moviescategory',
    'orderby' => 'name',
    'hide_empty' => true,
) );

// Capture the filter values from the URL (if any)
$selected_category = isset( $_GET['category_filter'] ) ? sanitize_text_field( $_GET['category_filter'] ) : '';
$selected_rating = isset( $_GET['rating_filter'] ) ? sanitize_text_field( $_GET['rating_filter'] ) : '';

// The query arguments for filtering movies
$args = array(
    'post_type' => 'movies',
    'posts_per_page' => -1,
);

// Apply category filter if selected
if ( !empty( $selected_category ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'moviescategory',
            'field'    => 'id',
            'terms'    => $selected_category,
            'operator' => 'IN',
        ),
    );
}

// Apply rating filter if selected (Custom Field filtering)
if ( !empty( $selected_rating ) ) {
    $args['meta_query'] = array(
        array(
            'key'     => 'ratings',
            'value'   => $selected_rating,
            'compare' => '=', // Exact match for selected rating (1-5)
            'type'    => 'NUMERIC',
        ),
    );
}

$query = new WP_Query( $args );
?>

<main id="primary" class="site-main no-sidebar">
    <!-- Filter Form -->
    <div class="movie-filters">
        <form method="get" action="" id="movie-filter-form">
            <div class="filter-category">
                <label for="category_filter">Category</label>
                <select name="category_filter" id="category_filter">
                    <option value="">All Categories</option>
                    <?php foreach ( $categories as $category ) : ?>
                        <option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $selected_category, $category->term_id ); ?>>
                            <?php echo esc_html( $category->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-rating">
                <label for="rating_filter">Rating</label>
                <select name="rating_filter" id="rating_filter">
                    <option value="">All Ratings</option>
                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                        <option value="<?php echo $i; ?>" <?php selected( $selected_rating, $i ); ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </form>
    </div>

    <div class="movies-grid">
        <?php
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'movie-item' ); ?>>
                <a href="<?php the_permalink(); ?>" class="movie-link">
                    <header class="entry-header">
                        <?php
                        if ( has_post_thumbnail() ) :
                            the_post_thumbnail( 'medium', array( 'class' => 'movie-featured-image' ) );
                        endif;
                        ?>
                        
                        <div class="movie-title">
                            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>

                    <footer class="entry-footer">
                        <?php
                        if ( function_exists( 'get_field' ) ) :
                            $rating = get_field( 'ratings' );
                            if ( $rating ) :
                                echo '<div class="movie-rating"><strong>Rating:</strong> ' . esc_html( $rating ) . '/5</div>';
                            else :
                                echo '<div class="movie-rating"><strong>Rating:</strong> Not rated yet.</div>';
                            endif;
                        endif;
                        ?>
                        <div class="movie-categories">
                            <?php echo get_the_term_list( get_the_ID(), 'moviescategory', 'Categories: ', ', ' ); ?>
                        </div>
                    </footer>
                </a>
            </article>

        <?php endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No movies found</p>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>

<!-- Add Styles for the Filter Form -->
<style>
/* Movie Filters Section */
.movie-filters {
    margin: 20px 0;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.filter-category,
.filter-rating {
    margin-right: 15px;
    margin-bottom: 10px;
}

/* Labels for Category and Rating Filters */
.filter-category label,
.filter-rating label {
    display: block;
    margin-bottom: 5px;
}

/* Select dropdowns for Category and Rating Filters */
.filter-category select,
.filter-rating select {
    width: 200px;
    padding: 8px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Main Grid Layout for Movies */
.movies-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 equal columns */
    gap: 20px;
    margin-top: 20px;
}

/* Each movie item box */
.movie-item {
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: transform 0.3s ease-in-out;
}

/* Hover effect on each movie item */
.movie-item:hover {
    transform: translateY(-5px); /* Hover effect */
}

/* Movie Featured Image */
.movie-featured-image {
    width: 100%;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
}

/* Movie Title */
.movie-title h2 {
    font-size: 1.5rem;
    font-weight: bold;
    margin-top: 15px;
    color: #333;
}

/* Movie Excerpt */
.entry-content {
    font-size: 1rem;
    color: #555;
    margin-top: 10px;
}

/* Rating Styling */
.movie-rating {
    font-size: 1.2rem;
    color: #ff9800;
    font-weight: bold;
    margin-top: 15px;
}

/* Categories Styling */
.movie-categories {
    font-size: 1rem;
    color: #777;
    margin-top: 10px;
}

/* Footer Styling */
.entry-footer {
    margin-top: 20px;
    border-top: 1px solid #ddd;
    padding-top: 15px;
}

/* Add link styling to the entire movie block */
.movie-link {
    display: block; /* Make the anchor tag a block element so it covers the entire movie item */
    text-decoration: none; /* Remove underline */
    color: inherit; /* Inherit the text color from the parent */
}

/* Responsive Styling for smaller screens */
@media (max-width: 768px) {
    .movies-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns on smaller screens */
    }
}

@media (max-width: 480px) {
    .movies-grid {
        grid-template-columns: 1fr; /* 1 column on very small screens */
    }

    .movie-title h2 {
        font-size: 1.2rem;
    }

    .movie-rating {
        font-size: 1rem;
    }
}

</style>

<!-- Add JavaScript to Trigger Form Submit on Change -->
<script>
    // Trigger form submission on filter change
    document.getElementById('category_filter').addEventListener('change', function() {
        document.getElementById('movie-filter-form').submit();
    });

    document.getElementById('rating_filter').addEventListener('change', function() {
        document.getElementById('movie-filter-form').submit();
    });
</script>
