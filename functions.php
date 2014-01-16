<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.0.1' );

//* Ensures child theme styles load last
//* Source: <http://www.carriedils.com/woocommerce-genesis-important-style/>
/**
 * Remove Genesis child theme style sheet
 * @uses  genesis_meta  <genesis/lib/css/load-styles.php>
*/
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

/**
 * Enqueue Genesis child theme style sheet at higher priority
 * @uses wp_enqueue_scripts <http://codex.wordpress.org/Function_Reference/wp_enqueue_style>
 */
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 15 );

//* Enqueue Lato Google font
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,700', array(), CHILD_THEME_VERSION );
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


//** Load scripts before closing the body tag */
add_action('genesis_after_footer', 'child_script_managment');
function child_script_managment() {
    wp_enqueue_script( 'fitvids', get_stylesheet_directory_uri() . '/js/genesis.FitVids.min.js', array('jquery'), '', TRUE);
}

/** Add scripts & styles*/
add_action( 'wp_enqueue_scripts', 'load_fontawesome_style', 999 );
function load_fontawesome_style() {
      wp_register_style( 'font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
      wp_enqueue_style( 'font-awesome' );
}

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'victoria-blue'   => __( 'Victoria Blue', 'victoria' ),
	'victoria-green'  => __( 'Victoria Green', 'victoria' ),
	'victoria-orange' => __( 'Victoria Orange', 'victoria' ),
	'victoria-purple' => __( 'Victoria Purple', 'victoria' ),
) );

//* SEARCH FORM FUNCTIONS */
//* Clear search form content on focus */
add_action( 'wp_enqueue_scripts', 'sk_clear_search_form' );
function sk_clear_search_form() {

	wp_enqueue_script( 'clear-search-form',  get_stylesheet_directory_uri() . '/js/clear-search-form.js', array( 'jquery' ), '1.0.0', true );
}

//* Make Font Awesome available
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
}

//* Customize search form input button text
add_filter( 'genesis_search_button_text', 'sk_search_button_text' );
function sk_search_button_text( $text ) {
	return esc_attr( '&#xf002;' );
}