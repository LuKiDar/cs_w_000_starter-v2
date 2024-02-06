<?php
/**
 * Shortcodes
 */

/*** Alerts ***/
function cs__shortcode_alerts( $atts, $content=null ){
	extract(shortcode_atts(array(
		'type' => 'info',	/* info, success, warning, error */
		'close' => 'false',	/* display close link */
	), $atts));

	$output = '<div class="alert is-style-'. $type .'">';
		$output .= ( $close=='true' ) ? '<a class="alert__close" data-dismiss="alert">×</a>' : '';
		$output .= $content;
	$output .= '</div>';

	return $output;
}
add_shortcode('alert', 'cs__shortcode_alerts');


/*** Buttons ***/
function cs__shortcode_buttons( $atts, $content=null ){
	extract(shortcode_atts(array(
		'type' => 'default',	/* primary, default, info, success, danger, warning, inverse */
		'size' => 'default',	/* xs, sm, default, lg, xl */
		'url'  => '',
	), $atts));

	$type = ( $type!='default' ) ? 'is-style-'. $type : '';
	$size = ( $size!='default' ) ? 'is-style-'. $size : '';

	$output = '<a class="button '. $type .' '. $size .'" href="'. $url .'">';
		$output .= $content;
	$output .= '</a>';

	return $output;
}
add_shortcode('button', 'cs__shortcode_buttons');