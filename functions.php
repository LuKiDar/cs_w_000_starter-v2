<?php
define('CSWP', 'cswp', true);

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
    'main-menu' => __('Main Menu', CSWP),
    'footer-menu' => __('Footer Menu', CSWP),
));


/*** Disable emoji ***/
add_action('init', 'cs__disable_wp_emojicons');
function cs__disable_wp_emojicons(){
    // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // filter to remove TinyMCE emojis
    add_filter('tiny_mce_plugins', 'cs__disable_emojicons_tinymce');
}

function cs__disable_emojicons_tinymce( $plugins ){
    if ( is_array($plugins) ){
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}
/*** END Disable emoji ***/


/*** Disable comments ***/
add_action('admin_init', function (){
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ( $pagenow === 'edit-comments.php' ){
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach ( get_post_types() as $post_type ){
        if ( post_type_supports($post_type, 'comments') ){
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function (){
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function (){
    if ( is_admin_bar_showing() ){
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});
/*** END Disable comments ***/



/*------------------------------------*\
	Functions
\*------------------------------------*/
/*** Live Reload with Grunt in WordPress ***/
if ( in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')) ){
    wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
    wp_enqueue_script('livereload');
}


/*** Get template page ID ***/
function cs__get_template_page_ID( $template, $index=0 ){
    $pages = get_posts(array(
        'post_type' =>'page',
        'meta_key'  =>'_wp_page_template',
        'meta_value'=> 'templates/'. $template .'.php',
        'orderby' => 'ID',
        'order' => 'ASC'
    ));

    return $pages[$index]->ID;
}


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



/*
// Enqueue assets
include 'inc/enqueue.php';
// Create custom post types and taxonomies
include_once 'inc/post-types.php';
// ACF Settings
include_once 'inc/acf-config.php';
// Admin
include_once 'inc/admin.php';
// Gutenberg
//include_once 'inc/gutenberg.php';
// Pagination
include_once 'inc/pagination.php';
*/