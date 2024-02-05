<?php
define('CSWP', 'cswp');

// Constants
include 'inc/constants.php';

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

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


/*------------------------------------*\
	Actions + Filters
\*------------------------------------*/

/*** Add Actions ***/

/*** Remove Actions ***/
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/*** Add Filters ***/
// add_filter('acf/settings/show_admin', '__return_false');//  Hide ACF field group menu item
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_length', function(){ return 30; }); // Change Excerpt length
add_filter('excerpt_more', function( $more ){ return '...'; }); // Change Excerpt "read more" string
add_filter('get_custom_logo', function( $html ){ // Change custom logo class
	$html = str_replace('custom-logo-link', 'logo', $html);
	$html = str_replace('custom-logo', 'logo__image', $html);
	return $html;
});

/*** Remove Filters ***/
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


// Theme
require_once 'inc/enqueue.php';
require_once 'inc/helper-functions.php';
require_once 'inc/wordpress-cleanup.php';

// Functionality
// include_once 'inc/admin.php';
require_once 'inc/blocks.php';
// include_once 'inc/pagination.php';
require_once 'inc/post-types.php';

// Plugin support
require_once 'inc/acf.php';