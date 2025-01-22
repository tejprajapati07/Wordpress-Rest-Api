<?php
function my_theme_enqueue_styles() {
    $parent_style = 'astra-style'; // Parent theme style handle
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Register Custom Post Type movies
function create_movies_cpt() {
    $labels = array(
        'name' => _x( 'Movies', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'Movie', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => __( 'Movies', 'textdomain' ),
        'name_admin_bar' => __( 'Movie', 'textdomain' ),
        'archives' => __( 'Movie Archives', 'textdomain' ),
        'attributes' => __( 'Movie Attributes', 'textdomain' ),
        'all_items' => __( 'All Movies', 'textdomain' ),
        'add_new_item' => __( 'Add New Movie', 'textdomain' ),
        'add_new' => __( 'Add New', 'textdomain' ),
        'new_item' => __( 'New Movie', 'textdomain' ),
        'edit_item' => __( 'Edit Movie', 'textdomain' ),
        'update_item' => __( 'Update Movie', 'textdomain' ),
        'view_item' => __( 'View Movie', 'textdomain' ),
        'search_items' => __( 'Search Movies', 'textdomain' ),
        'not_found' => __( 'Not found', 'textdomain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    );
    $args = array(
        'label' => __( 'Movie', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-format-video',
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'comments' ),
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'show_in_rest' => true,
    );
    register_post_type( 'movies', $args );
}
add_action( 'init', 'create_movies_cpt', 0 );

// Register Taxonomy movies_category
function create_moviescategory_tax() {
    $labels = array(
        'name' => _x( 'Movie Categories', 'taxonomy general name', 'textdomain' ),
        'singular_name' => _x( 'Movie Category', 'taxonomy singular name', 'textdomain' ),
        'search_items' => __( 'Search Categories', 'textdomain' ),
        'all_items' => __( 'All Categories', 'textdomain' ),
        'edit_item' => __( 'Edit Category', 'textdomain' ),
        'add_new_item' => __( 'Add New Category', 'textdomain' ),
        'menu_name' => __( 'Categories', 'textdomain' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    );
    register_taxonomy( 'moviescategory', array( 'movies' ), $args );
}
add_action( 'init', 'create_moviescategory_tax' );

// Register Custom Post Type books
function create_books_cpt() {
    $labels = array(
        'name' => _x( 'Books', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'Book', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => __( 'Books', 'textdomain' ),
        'name_admin_bar' => __( 'Book', 'textdomain' ),
        'archives' => __( 'Book Archives', 'textdomain' ),
        'attributes' => __( 'Book Attributes', 'textdomain' ),
        'all_items' => __( 'All Books', 'textdomain' ),
        'add_new_item' => __( 'Add New Book', 'textdomain' ),
        'add_new' => __( 'Add New', 'textdomain' ),
        'new_item' => __( 'New Book', 'textdomain' ),
        'edit_item' => __( 'Edit Book', 'textdomain' ),
        'update_item' => __( 'Update Book', 'textdomain' ),
        'view_item' => __( 'View Book', 'textdomain' ),
        'search_items' => __( 'Search Books', 'textdomain' ),
        'not_found' => __( 'Not found', 'textdomain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    );
    $args = array(
        'label' => __( 'Book', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-book',
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'comments' ),
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'show_in_rest' => true,
    );
    register_post_type( 'books', $args );
}
add_action( 'init', 'create_books_cpt', 0 );

// Register Taxonomy bookscategory
function create_bookscategory_tax() {
    $labels = array(
        'name' => _x( 'Book Categories', 'taxonomy general name', 'textdomain' ),
        'singular_name' => _x( 'Book Category', 'taxonomy singular name', 'textdomain' ),
        'search_items' => __( 'Search Categories', 'textdomain' ),
        'all_items' => __( 'All Categories', 'textdomain' ),
        'edit_item' => __( 'Edit Category', 'textdomain' ),
        'add_new_item' => __( 'Add New Category', 'textdomain' ),
        'menu_name' => __( 'Categories', 'textdomain' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    );
    register_taxonomy( 'bookscategory', array( 'books' ), $args );
}
add_action( 'init', 'create_bookscategory_tax' );


// // Add ACF fields to REST API for books
// function add_acf_fields_to_books_rest_api() {
//     // Expose the 'author' field
//     register_rest_field(
//         'books', // The custom post type slug
//         'author', // The key for the field in the REST API
//         array(
//             'get_callback' => function ($post) {
//                 return get_field('author', $post['id']); // Get the 'author' field using ACF
//             },
//             'schema' => array(
//                 'type' => 'string',
//                 'description' => 'The author of the book',
//             ),
//         )
//     );

//     // Expose the 'publications' field
//     register_rest_field(
//         'books', // The custom post type slug
//         'publications', // The key for the field in the REST API
//         array(
//             'get_callback' => function ($post) {
//                 return get_field('publications', $post['id']); // Get the 'publications' field using ACF
//             },
//             'schema' => array(
//                 'type' => 'string',
//                 'description' => 'The publication of the book',
//             ),
//         )
//     );
// }
// add_action('rest_api_init', 'add_acf_fields_to_books_rest_api');

// Add ACF field 'paragraph' to REST API for posts or pages
function add_paragraph_to_rest_api() {
    register_rest_field(
        'page', // You can change this to 'post' or any other post type if needed
        'paragraph', // The key to expose in the REST API
        array(
            'get_callback' => function ($post) {
                return get_field('paragraph', $post['id']); // Get the 'paragraph' field using ACF
            },
            'schema' => array(
                'type' => 'string',
                'description' => 'The paragraph content for the page or post',
            ),
        )
    );
}
add_action('rest_api_init', 'add_paragraph_to_rest_api');

