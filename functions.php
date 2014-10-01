<?php

add_action( 'genesis_setup', 'pgh_child_theme_setup', 15 );
function pgh_child_theme_setup() {

//* Add HTML5 markup structure
	add_theme_support( 'html5' );

// Add viewport meta tag for mobile browsers	
	add_theme_support( 'genesis-responsive-viewport' ); 

// Add support for custom background
	add_theme_support( 'custom-background' ); 

// Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );

// Define child theme.
	define( 'CHILD_THEME_NAME', 'Pittsburgh' ); 
	define( 'CHILD_THEME_URL', 'http://www.fortpittwebshop.com/' );
	define( 'CHILD_THEME_VERSION', '1.0.0' );
	
/* Add support for post-thumbnails custom image sizes
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 */
	add_theme_support( 'post-thumbnails' );

// Remove Edit link
	add_filter( 'genesis_edit_post_link', '__return_false' );	

// HTML5 doctype with conditional classes
	remove_action( 'genesis_doctype', 'genesis_do_doctype' );
	add_action( 'genesis_doctype', 'pgh_html5_doctype' );

// Add Verify Authorship support
	add_action('wp_head', 'pgh_add_google_rel_author');	

// Add custom favicon
	add_filter( 'genesis_pre_load_favicon', 'pgh_favicon_filter' );

// Remove Query Strings From Static Resources
	add_filter( 'script_loader_src', 'pgh_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', 'pgh_remove_script_version', 15, 1 );
		
/** 
  * END Child Theme Setup
  */
}

// HTML5 doctype with conditional classes
	function pgh_html5_doctype() {
		?>
		<!DOCTYPE html>
		<!--[if IE 8]> <html class="lt-ie9" <?php language_attributes( 'html' ); ?>> <![endif]-->
		<!--[if gt IE 8]><!--> <html <?php language_attributes( 'html' ); ?>> <!--<![endif]-->
		<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<?php ;
	}

// Add Verify Authorship support
	function pgh_add_google_rel_author() {
		echo '<link rel="author" href="https://plus.google.com/106374492993670900494/posts" />'; 
	}
		
// Add custom favicon
	function pgh_favicon_filter( $favicon) { 
    	return get_stylesheet_directory_uri() . 'favicon.ico'; 
	}

// Remove Query Strings From Static Resources
	function pgh_remove_script_version( $src ){
		$parts = explode( '?ver', $src );
		return $parts[0]; 
}

/** Customize Genesis Footer */
function pgh_footer() {
	echo '<p>';
	echo 'Copyright &copy; ';
	echo date('Y');
	echo ' &middot; <a href="http://www.fortpittwebshop.com/" title="Fort Pitt Web Shop">Fort Pitt Web Shop</a> &middot; All rights reserved &middot; Pittsburgh, PA, USA. &middot <a href="http://www.fortpittwebshop.com/site-map/" title="Site map">Site map</a>'; }
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'pgh_footer' );
	

/**
 * Enqueue scripts and styles.
 */

add_action( 'wp_enqueue_scripts', 'pgh_scripts' );
function pgh_scripts() {
	wp_enqueue_style( 'pgh-style', get_stylesheet_uri() );
	wp_enqueue_script( 'pgh-scripts', get_stylesheet_directory_uri() . '/scripts/main-min.js', array('jquery'), NULL, true );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:300', array(), CHILD_THEME_VERSION ); 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
	
	

