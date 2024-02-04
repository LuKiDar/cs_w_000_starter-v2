<?php
/**
 * ACF Customizations
 **/

namespace BEStarter\ACF;

/**
 * Remove ACF admin menu
 */
function remove_acf_admin_menu(){
	if ( !(function_exists('wp_get_environment_type') && wp_get_environment_type()==='production') ){
		return;
	}

	$slug = 'edit.php?post_type=acf-field-group';
	remove_submenu_page($slug, $slug);
	remove_submenu_page($slug, 'post-new.php?post_type=acf-field-group');
}
add_action('admin_menu', __NAMESPACE__ .'\\remove_acf_admin_menu');

/**
 * Register Options Page
 */
function register_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			[
				'title'      => __( 'Site Options', 'bestarter_textdomain' ),
				'capability' => 'manage_options',
			]
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\\register_options_page' );