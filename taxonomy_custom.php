<?php

function tc_wpdocs_codex_book_init() {

    $labels = array(
        'name'                  => _x( 'Books', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Book', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Books', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Book', 'textdomain' ),
        'new_item'              => __( 'New Book', 'textdomain' ),
        'edit_item'             => __( 'Edit Book', 'textdomain' ),
        'view_item'             => __( 'View Book', 'textdomain' ),
        'all_items'             => __( 'All Books', 'textdomain' ),
        'search_items'          => __( 'Search Books', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
        'not_found'             => __( 'No books found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        // 'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
    );

     $argsd = array(
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
 
    register_post_type( 'book', $args );
}	
 
add_action( 'init', 'tc_wpdocs_codex_book_init' );

function create_posttype() {
 
    register_post_type( 'movies',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Movies' ),
                'singular_name' => __( 'Movie' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movies'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function wpdocs_create_book_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Languages', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Language', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Languages', 'textdomain' ),
        'all_items'         => __( 'All Languages', 'textdomain' ),
        'parent_item'       => __( 'Parent Language', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Language:', 'textdomain' ),
        'edit_item'         => __( 'Edit Language', 'textdomain' ),
        'update_item'       => __( 'Update Language', 'textdomain' ),
        'add_new_item'      => __( 'Add New Language', 'textdomain' ),
        'new_item_name'     => __( 'New Language Name', 'textdomain' ),
        'menu_name'         => __( 'Language', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'language' ),
    );
 
    register_taxonomy( 'Language', array( 'book' ), $args );
 
    unset( $args );
    unset( $labels );
 
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Authors', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Author', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Authors', 'textdomain' ),
        'popular_items'              => __( 'Popular Authors', 'textdomain' ),
        'all_items'                  => __( 'All Authors', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Author', 'textdomain' ),
        'update_item'                => __( 'Update Author', 'textdomain' ),
        'add_new_item'               => __( 'Add New Author', 'textdomain' ),
        'new_item_name'              => __( 'New Author Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate Authors with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove Authors', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used Authors', 'textdomain' ),
        'not_found'                  => __( 'No Authors found.', 'textdomain' ),
        'menu_name'                  => __( 'Authors', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'Author' ),
    );
 
    register_taxonomy( 'author', 'book', $args );


    $labels = array(
        'name'                       => _x( 'Subjects', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Subject', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Subjects', 'textdomain' ),
        'popular_items'              => __( 'Popular Subjects', 'textdomain' ),
        'all_items'                  => __( 'All Subjects', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Subject', 'textdomain' ),
        'update_item'                => __( 'Update Subject', 'textdomain' ),
        'add_new_item'               => __( 'Add New Subject', 'textdomain' ),
        'new_item_name'              => __( 'New Subject Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate Subjects with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove Subjects', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used Subjects', 'textdomain' ),
        'not_found'                  => __( 'No Subjects found.', 'textdomain' ),
        'menu_name'                  => __( 'Subjects', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'Subject' ),
    );
 
    register_taxonomy( 'subject', 'book', $args );




    $labels = array(
        'name'                       => _x( 'Exams', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Exam', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Exams', 'textdomain' ),
        'popular_items'              => __( 'Popular Exams', 'textdomain' ),
        'all_items'                  => __( 'All Exams', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Exam', 'textdomain' ),
        'update_item'                => __( 'Update Exam', 'textdomain' ),
        'add_new_item'               => __( 'Add New Exam', 'textdomain' ),
        'new_item_name'              => __( 'New Exam Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate Exams with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove Exams', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used Exams', 'textdomain' ),
        'not_found'                  => __( 'No Exams found.', 'textdomain' ),
        'menu_name'                  => __( 'Exams', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'Exam' ),
    );
 
    register_taxonomy( 'exam', 'book', $args );
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'wpdocs_create_book_taxonomies', 0 );


add_filter( 'page_template', 'wpa3396_page_template' );
function wpa3396_page_template( $page_template )
{
    if ( is_page( 'sample-page' ) ) {
        $page_template = dirname( __FILE__ ) . '/custom-page-template.php';
    }
    return $page_template;
}



/**
 * Register meta box(es).
 */
function bookmeta_register_meta_boxes() {
	add_meta_box( 'home_page_setting_meta_box', __( 'Meta for texonomy', 'textdomain' ), 'book_post_metabox_html', 'book' );
}
add_action( 'add_meta_boxes', 'bookmeta_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function book_post_metabox_html( $post ) {
	$number_of_page = get_post_meta($post->ID, 'number_of_page', true);
	$price = get_post_meta($post->ID, 'price', true);
	$printing_year = get_post_meta($post->ID, 'printing_year', true);
	$gsm = get_post_meta($post->ID, 'gsm', true);
	$discount_price = get_post_meta($post->ID, 'discount_price', true);
	?>
	Number of Page :: <input type="name" name="number_of_page" value="<?= $number_of_page ?>" > <br>
	Price :: <input type="text" name="price" value="<?= $price ?>"><br>
	Printing year :: <input type="text" name="printing_year" value="<?= $printing_year ?>"><br>
	GSM :: <input type="text" name="gsm" value="<?= $gsm ?>"><br>
	DISCOUNT Price :: <input type="text" name="discount_price" value="<?= $discount_price ?>"><br>
	<input type="hidden" name="hps0_form">
	<?php
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function bookmeta_save_meta_box( $post_id ) {
	if(isset($_POST['hps0_form'])){
		update_post_meta($post_id, 'number_of_page', $_POST['number_of_page']);
		update_post_meta($post_id, 'price', $_POST['price']);
		update_post_meta($post_id, 'printing_year', $_POST['printing_year']);
		update_post_meta($post_id, 'gsm', $_POST['gsm']);
		update_post_meta($post_id, 'discount_price', $_POST['discount_price']);
	}
}
add_action( 'save_post', 'bookmeta_save_meta_box' );
