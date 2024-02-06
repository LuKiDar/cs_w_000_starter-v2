<?php
/**
 * Admin
 * 
 * TO DO:
 * - add TinyMCE shortcodes
 */

/*** Admin menu ***/
function cs__custom_menu_order( $menu_order ){
	$new_positions = array(
		'index.php'								=> 1,	// Dashboard
		
		'separator1'							=> 10,	// First separator
		'edit.php?post_type=page'				=> 11,	// Pages
		'edit.php'								=> 12,	// Posts
		// 'edit.php?post_type=example_cpt'		=> 13,	// Custom CPT
		'upload.php'							=> 20,	// Media
		// 'wpcf7'									=> 21,	// Contact
		'theme-settings'						=> 22,	// ACF: Theme Settings
		// 'acf-options-general'				=> 23,	// ACF: Theme Settings
		
		'separator2'							=> 30,	// Second separator
		'themes.php'							=> 31,	// Appearance
		'plugins.php'							=> 32,	// Plugins
		'users.php'								=> 33,	// Users
		'tools.php'								=> 34,	// Tools
		'options-general.php'					=> 35,	// Settings
		
		'separator-last'						=> 40,	// Last separator
		'edit.php?post_type=acf-field-group'	=> 60,	// ACF
	);
	
	function move_element( &$array, $a, $b ){
		$out = array_splice($array, $a, 1);
		array_splice($array, $b, 0, $out);
	}
	
	foreach ( $new_positions as $value=>$new_index ){
		if ( $current_index=array_search($value, $menu_order) ){
			move_element($menu_order, $current_index, $new_index);
		}
	}

	return $menu_order;
}
add_filter('custom_menu_order', function() { return true; });
add_filter('menu_order', 'cs__custom_menu_order', 10, 1);


/*** Tidy up admin bar ***/
function remove_admin_bar_links(){
	global $wp_admin_bar;

	$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
	$wp_admin_bar->remove_menu('comments');         // Remove the comments link
	$wp_admin_bar->remove_menu('customize');
	$wp_admin_bar->remove_menu('dashboard');
	$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
	$wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
	$wp_admin_bar->remove_menu('menus');
	$wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
	$wp_admin_bar->remove_menu('themes');
	$wp_admin_bar->remove_menu('updates');          // Remove the updates link
	$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
	// $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
	// $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
	// $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
	// $wp_admin_bar->remove_menu('new-content');      // Remove the content link
	// $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
	// $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


/*** Disable content editor for specific pages ***/
function cs__hide_editor_for_pages(){
	if ( is_admin() ){
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
		if ( !isset($post_id) ) return;
	
		$template_file = get_post_meta($post_id, '_wp_page_template', true);

		$templates_array = array(
			'templates/tmpl-example.php',
		);
		
		if ( in_array($template_file, $templates_array) || $post_id==get_option('page_on_front') ){
			remove_post_type_support('page', 'editor');
		}
	}
}
// add_action('init', 'cs__hide_editor_for_pages');


/*** TinyMCE: add style selector ***/
function cs__mce_add_more_buttons( $buttons ){
	$buttons[] = 'styleselect';
	return $buttons;
}
add_filter('mce_buttons_2', 'cs__mce_add_more_buttons');

function cs__mce_before_init( $settings ){
	$textcolor_map = array(
		'000', 'Black',
		'595959', 'Dark gray',
		'919191', 'Medium gray',
		'F5F5F5', 'Light gray',
		'FFF', 'White',
	);
	$style_formats = array(
		array(
			'title' => 'Inline',
			'items' => array(
				['title' => 'Bold',				'icon' => 'bold',			'format' => 'bold'],
				['title' => 'Italic',			'icon' => 'italic',			'format' => 'italic'],
				['title' => 'Underline',		'icon' => 'underline',		'format' => 'underline'],
				['title' => 'Strikethrough',	'icon' => 'strikethrough',	'format' => 'strikethrough'],
				['title' => 'Superscript',		'icon' => 'superscript',	'format' => 'superscript'],
				['title' => 'Subscript',		'icon' => 'subscript',		'format' => 'subscript'],
				['title' => 'Code',				'icon' => 'code',			'format' => 'code'],
			)
		),
		// array(
		// 	'title' => 'Buttons',
		// 	'items' => array(
		// 		['title' => 'Default button',	'selector' => 'a',	'classes' => 'button--fill',		'icon' => 'link'],
		// 		['title' => 'Outlined button',	'selector' => 'a',	'classes' => 'button--outline',		'icon' => 'link'],
		// 		['title' => 'White button',		'selector' => 'a',	'classes' => 'button--fill-white',	'icon' => 'link'],
		// 	)
		// )
	);
	$settings['textcolor_cols'] = 6;
	$settings['textcolor_map'] = json_encode($textcolor_map);
	$settings['style_formats'] = json_encode($style_formats);
	return $settings;
}
add_filter('tiny_mce_before_init', 'cs__mce_before_init');


/*** TinyMCE: remove the Color Picker plugin ***/
function cs__mce_remove_custom_colors( $plugins ){
	foreach ( $plugins as $key=>$plugin_name ){
		if ( $plugin_name==='colorpicker' ){
			unset($plugins[$key]);
			return $plugins;            
		}
	}
	return $plugins;
}
add_filter('tiny_mce_plugins', 'cs__mce_remove_custom_colors');