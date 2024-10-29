<?php
/**
 * Theme functions and definitions
 */

// Constants
define('CSWP', 'cswp');
include 'inc/constants.php';

/*** Theme Support ***/
if ( function_exists('add_theme_support') ){
	add_theme_support('custom-logo', array(
		'height'      => '200',
		'flex-height' => true,
		'flex-width'  => true,
	));
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_theme_support('responsive-embeds');
	add_theme_support('title-tag');
	add_theme_support('wp-block-styles');
	// add_theme_support('align-wide');
	//add_theme_support('woocommerce');

	// Enable translations
	// load_theme_textdomain('cswp', get_template_directory() . '/languages');
}

add_filter('upload_mimes', 'cs__mime_types');
function cs__mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

// Register Navigation
register_nav_menus(array(
	'primary-menu' => __('Primary Menu', CSWP),
	'footer-menu' => __('Footer Menu', CSWP),
));


/*** Actions + Filters ***/
add_filter('get_custom_logo', function( $html ){ // Change custom logo class
	$html = str_replace('custom-logo-link', 'logo', $html);
	$html = str_replace('custom-logo', 'logo__image', $html);
	return $html;
});

// Theme
require_once 'inc/enqueue.php';
require_once 'inc/helper-functions.php';
require_once 'inc/wordpress-cleanup.php';

// Functionality
require_once 'inc/blocks.php';
include_once 'inc/admin.php';
require_once 'inc/post-types.php';
// require_once 'inc/breadcrumbs.php';
// require_once 'inc/menu-walker.php';
// include_once 'inc/pagination.php';
// require_once 'inc/post-types.php';
// include_once 'inc/shortcodes.php';
// require_once 'inc/widgets.php';

// Plugin support
require_once 'inc/acf.php';