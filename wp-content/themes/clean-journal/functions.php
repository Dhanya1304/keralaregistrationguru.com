<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core clean-journalcore and provides some helper functions using clean-journalcuston-functions.
 * Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * @package Catch Themes
 * @subpackage Clean Journal
 * @since Clean Journal 0.1
 */

//define theme version
if ( !defined( 'CLEAN_JOURNAL_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();

	define ( 'CLEAN_JOURNAL_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the core functions
 */
require trailingslashit( get_template_directory() ) . 'inc/clean-journal-core.php';
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * @author    Yadu Chandran
 */
add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'Add Data', 'Add Form Data', 'manage_options', 'document_form.php', '', 'dashicons-welcome-write-blog', 90 );
}

add_action( 'admin_menu', 'register_my_custom_menu_form' );
function register_my_custom_menu_form() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'View Data', 'Data Listings', 'manage_options', 'view_form.php', '', 'dashicons-format-aside', 90 );
}

function wpse_enqueue_datepicker() {
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui' );  
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_datepicker' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Homepage articles', 'twentyseventeen' ),
		'id'            => 'homepage-articles',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Homepage Forum', 'twentyseventeen' ),
		'id'            => 'homepage-forum',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        register_sidebar( array(
		'name'          => __( 'Homepage News', 'twentyseventeen' ),
		'id'            => 'homepage-news',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );