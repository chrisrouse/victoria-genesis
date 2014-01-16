<?php

/**
 * To display entries from a Custom Post Type on site's front page in a 3-column responsive grid.
 * URL: http://sridharkatakam.com/front-page-template-to-show-cpt-entries-in-a-3-column-grid-in-genesis/
 */

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'sk_do_loop' );
/**
 * Outputs a custom loop
 *
 * @global mixed $paged current page number if paginated
 * @return void
 */
function sk_do_loop() {

	global $paged;

	// accepts any wp_query args
	$args = (array(
		'post_type'      => 'testimonial', // Set your CPT name here
	 	'paged'          => $paged,
	 	'posts_per_page' => 3 // Set your desired number of entries per page here
	));

	genesis_custom_loop( $args );

}

// Force excerpts regardless of theme's Content Archive settings
add_filter( 'genesis_pre_get_option_content_archive', 'sk_force_excerpts' );
function sk_force_excerpts() {
	return 'excerpts';
}

// Force featured images (if present) to be displayed regardless of theme's Content Archive settings
add_filter( 'genesis_pre_get_option_content_archive_thumbnail', 'sk_show_post_image' );
function sk_show_post_image() {
	return '1';
}

// Set custom excerpt length
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length ) {
	return 15;
}

// Move featured image from below post info to above post title
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

// Remove entry meta
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//Add Post Class Filter
add_filter('post_class', 'sk_post_class');
function sk_post_class($classes) {
	global $loop_counter;
	$classes[] = 'one-third';
	if (($loop_counter + 3) % 3 == 0) {
		$classes[] .= 'first';
	}
	$loop_counter++;
	return $classes;
}

// Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Modify the Excerpt read more link
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {

	return '... <a class="more-link" href="' . get_permalink() . '">Read more</a>';

}

genesis();
