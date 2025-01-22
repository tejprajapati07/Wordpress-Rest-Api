<?php
get_header();
// Template Name: Home
?>

<main id="primary" class="site-main">
    <div class="homepage-content">
        <?php
        // Get the image from ACF field 'banner_image'
        $image = get_field('banner_image'); 
        $paragraph = get_field('paragraph');

        if ($image) :
            // Display the image
            echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" class="home-page-image">';
        endif;

        if ($paragraph) :
            // Display the paragraph text
            echo '<p class="home-paragraph">' . esc_html($paragraph) . '</p>';
        endif;

        ?>
    </div>

    <div class="books-list">
        <h2 class="books-heading">Books</h2>
        <div class="books-grid">
            <?php
            // Query to fetch books post type
            $args = array(
                'post_type' => 'books', // The slug of your custom post type
                'posts_per_page' => 9, // Number of posts to display (adjust as needed)
                'orderby' => 'date', // Order by date
                'order' => 'DESC', // Latest posts first
            );

            $books_query = new WP_Query($args);

            if ($books_query->have_posts()) :
                while ($books_query->have_posts()) :
                    $books_query->the_post();

                    // Retrieve ACF fields
                    $author = get_field('author'); // Replace 'author' with your ACF field name
                    $publications = get_field('publications'); // Replace 'publications' with your ACF field name
                    ?>
                    <div class="book-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'book-thumbnail']); ?>
                            </a>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php if ($author) : ?>
                            <p><strong>Author:</strong> <?php echo esc_html($author); ?></p>
                        <?php endif; ?>
                        <?php if ($publications) : ?>
                            <p><strong>Publication:</strong> <?php echo esc_html($publications); ?></p>
                        <?php endif; ?>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p>No books found.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

<style>
    .home-page-image {
        width: 100%;
        height: auto;
        max-width: 1200px;
        display: block;
        margin: 0 auto;
    }
    .home-paragraph {
        margin-top: 20px;
        font-size: 1.2rem;
        line-height: 1.8;
        color: #333; /* Text color */
        text-align: justify; /* Justify the text */
        max-width: 800px;
        margin-left: auto;
        margin-right: auto; /* Center-align with margins */
        padding: 10px 15px; /* Add padding */
        background-color: #f9f9f9; /* Light background */
        border: 1px solid #ddd; /* Subtle border */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Soft shadow */
    }

    .home-paragraph strong {
        font-weight: bold; /* Bold text for emphasis */
    }

    .home-paragraph em {
        font-style: italic; /* Italics for emphasized text */
    }

    .books-list {
        margin-top: 40px;
    }

    .books-heading {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 20px;
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 items per row */
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .book-item {
        text-align: center;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .book-item h3 {
        font-size: 1.25rem;
        margin: 10px 0;
    }

    .book-thumbnail {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .book-item p {
        font-size: 1rem;
        line-height: 1.5;
    }

    .book-item strong {
        font-weight: bold;
    }
</style>
