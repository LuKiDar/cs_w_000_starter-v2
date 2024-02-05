<?php
/**
 * Helper functions
 */

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