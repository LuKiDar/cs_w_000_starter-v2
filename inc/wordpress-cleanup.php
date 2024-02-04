<?php
/**
 * WordPress Cleanup
 **/

/*** Header Meta Tags ***/
function cs__header_meta_tags(){
	echo '<meta charset="'. esc_attr(get_bloginfo('charset')) .'">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}
add_action('wp_head', 'cs__header_meta_tags');


/*** Extra body classes ***/
function cs__extra_body_classes( $classes ){
	if ( is_singular() ){
		$classes[] = 'singular';
	}
	return $classes;
}
add_filter('body_class', 'cs__extra_body_classes');


/*** Clean body classes ***/
function cs__clean_body_classes( $classes ){
	$allowed_classes = [
		'singular',
		'single',
		'page',
		'archive',
		'home',
		'search',
		'admin-bar',
		'logged-in',
		'wp-embed-responsive',
	];

	return array_intersect($classes, $allowed_classes);
}
add_filter('body_class', 'cs__clean_body_classes', 20);