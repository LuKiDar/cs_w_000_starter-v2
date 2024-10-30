<?php
/**
 * Enqueue
 */

/*** Load scripts ***/
// Theme scripts
function cs__enqueue_theme_scripts(){
	if ( $GLOBALS['pagenow']!='wp-login.php' && !is_admin() ){
		wp_register_script('theme-scripts', get_template_directory_uri() . '/assets/js/theme.js', array(), filemtime(get_template_directory() . '/assets/js/theme.js'), true);
		wp_enqueue_script('theme-scripts');
		// wp_deregister_script('jquery');
	}
}
add_action('wp_enqueue_scripts', 'cs__enqueue_theme_scripts');

// Editor scripts
function cs__enqueue_editor_scripts(){
	wp_enqueue_script('editor-scripts', get_template_directory_uri() .'/assets/js/block-styles.js', array('wp-blocks'), filemtime(get_template_directory() .'/assets/js/block-styles.js'), true);
}
add_action('enqueue_block_editor_assets', 'cs__enqueue_editor_scripts');


/*** Load styles ***/
// Theme styles
function cs__enqueue_theme_styles(){
	// Register theme css
	wp_register_style('theme-styles', get_template_directory_uri() . '/assets/css/theme.css', array(), filemtime(get_template_directory() . '/assets/css/theme.css'), 'all');
	wp_enqueue_style('theme-styles');
	
	// Remove Contact form 7 styles
	// wp_dequeue_style('contact-form-7');
}
add_action('wp_enqueue_scripts', 'cs__enqueue_theme_styles');


// Editor styles
function cs__enqueue_editor_styles(){
	add_theme_support('editor-styles');
	add_editor_style('assets/css/editor.css');
}
add_action('after_setup_theme', 'cs__enqueue_editor_styles');


// Admin styles
function cs__enqueue_admin_styles(){
	wp_register_style('admin-styles', get_template_directory_uri() . '/assets/css/build/admin.css', array(), filemtime(get_template_directory() . '/assets/css/admin.css'), 'all');
	wp_enqueue_style('admin-styles');
}
add_action('admin_enqueue_scripts', 'cs__enqueue_admin_styles');


// Login styles
function cs__enqueue_login_styles() {
	wp_register_style('login-styles', get_template_directory_uri() . '/assets/css/login.css', array(), filemtime(get_template_directory() . '/assets/css/login.css'), 'all');
	wp_enqueue_style('login-styles');
}
// add_action('login_head', 'cs__enqueue_login_styles');


// Disable default WooCommerce styles
// add_filter('woocommerce_enqueue_styles', '__return_empty_array');


/*** Live Reload with Grunt in WordPress ***/
if ( in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')) ){
	wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', null, false, true);
	wp_enqueue_script('livereload');
}