<?php
/**
 * ACF Configuration
 **/

/*** ACF: hide menu item ***/
//add_filter('acf/settings/show_admin', '__return_false');


/*** ACF: register Options page ***/
if ( function_exists('acf_add_options_page') ):
    acf_add_options_page(
        array(
            'page_title'    => __('Theme Settings', CSWP),
            'menu_title'    => __('Theme Settings', CSWP),
            'menu_slug'     => 'theme-settings',
            'capability'    => 'manage_options',
            'position'      => '59',
            'redirect'      => true,
        )
    );
    
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'General Theme Settings',
	// 	'menu_title'	=> 'General',
	// 	'parent_slug'	=> 'theme-settings'
	// ));
endif;


/*** ACF: Google API ***/
// function cs__acf_google_map_api($api){
//     $api['key'] = get_field('google_maps_api_key', 'options');
//     return $api;
// }
// add_filter('acf/fields/google_map/api', 'cs__acf_google_map_api');