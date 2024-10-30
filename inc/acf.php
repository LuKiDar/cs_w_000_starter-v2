<?php
/**
 * ACF Configuration
 */

/*** ACF: disable CPT and taxonomy functionality ***/
add_filter('acf/settings/enable_post_types', '__return_false');


/*** ACF: add Menu Level rule ***/
function cs__acf_location_rules_types( $choices ){
	$choices['Menu']['menu_level'] = 'Menu Level';
	
	return $choices;
}
add_filter('acf/location/rule_types', 'cs__acf_location_rules_types');

function cs__acf_location_rule_values_level( $choices ){
	$choices[0] = 'First';
	$choices[1] = 'Second';
	
	return $choices;
}
add_filter('acf/location/rule_values/menu_level', 'cs__acf_location_rule_values_level');

function cs__acf_location_rule_match_level( $match, $rule, $options, $field_group ){
	if ( $rule['operator']=='==' ){
		$match = ( $options['nav_menu_item_depth'] == $rule['value'] );
	}
	
	return $match;
}
add_filter('acf/location/rule_match/menu_level', 'cs__acf_location_rule_match_level', 10, 4);


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