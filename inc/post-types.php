<?php
/**
 * Post types
 */

/*** Register custom post types ***/
function cs__register_post_types(){
	$types = array(
		// Where the magic happens
		// array(
		// 	'slug'	 	 => 'example_cpt',
		// 	'single' 	 => 'Example',
		// 	'plural' 	 => 'Examples',
		// 	'icon'	 	 => 'dashicons-open-folder',
		// 	'rewrite'	 => array(),
		// 	'taxonomies' => array('example_tax')
		// )
	);

	foreach ( $types as $type ){
		$slug = $type['slug'];
		$single = $type['single'];
		$plural = $type['plural'];
		$icon = $type['icon'];
		$rewrite = !empty($type['rewrite']) ? $type['rewrite'] : array('slug' => str_replace('_', '-', $slug));
		$taxonomies = !empty($type['taxonomies']) ? $type['taxonomies'] : array();

		$labels = array_merge(DEFAULT_CPT_LABELS, array(
			'name'			 => _x($plural, 'Post type general name', CSWP),
			'singular_name'	 => _x($single, 'Post type singular name', CSWP),
			'all_items'		 => __('All '.$plural, CSWP),
			'archives'		 => __($single.' archives', 'The post type archive label used in nav menus. Default “Post Archives”', CSWP),
			'menu_name'		 => _x($plural, 'Admin Menu text', CSWP),
			'name_admin_bar' => _x($single, 'Add New on Toolbar', CSWP)
		));

		$args = array_merge(DEFAULT_CPT_ARGS, array(
			'labels'		=> $labels,
			'menu_position'	=> 5,
			'rewrite'		=> $rewrite,
			'menu_icon'		=> $icon,
			'taxonomies'	=> $taxonomies
		));

		register_post_type($slug, $args);
	}
}
add_action('init', 'cs__register_post_types');


/*** Register custom taxonomies ***/
function cs__register_taxonomies() {
	$taxonomies = array(
		// Where the magic happens
		// array(
		// 	'cpt'			=> 'example_cpt',
		// 	'slug'			=> 'example_tax',
		// 	'single'		=> 'Category',
		// 	'plural'		=> 'Categories',
		// 	'hierarchical'	=> true,
		// 	'rewrite'		=> array('slug' => 'category')
		// )
	);

	foreach ( $taxonomies as $taxonomy ){
		$cpt = $taxonomy['cpt'];
		$slug = $taxonomy['slug'];
		$single = $taxonomy['single'];
		$plural = $taxonomy['plural'];
		$hierarchical = $taxonomy['hierarchical'];
		$rewrite = !empty($taxonomy['rewrite']) ? $taxonomy['rewrite'] : array('slug' => str_replace('_', '-', $slug));

		$labels = array(
			'name'				=> _x($plural, 'General name for the taxonomy, usually plural', CSWP),
			'singular_name'		=> _x($single, 'Name for one object of this taxonomy', CSWP),
			'search_items'		=>  __('Search '. $plural, CSWP),
			'all_items'			=> __('All '. $plural, CSWP),
			'parent_item'		=> __('Parent '. $single, CSWP),
			'parent_item_colon'	=> __('Parent '. $single .':', CSWP),
			'edit_item'			=> __('Edit '. $single, CSWP),
			'view_item'			=> __('View '. $single, CSWP),
			'update_item'		=> __('Update '. $single, CSWP),
			'add_new_item'		=> __('Add New '. $single, CSWP)
		);
		
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'hierarchical'		=> $hierarchical,
			'show_ui'			=> true,
			'show_in_rest'		=> true,
			'show_admin_column'	=> true,
			'rewrite'			=> $rewrite,
			'query_var'			=> true,

		);

		register_taxonomy($slug, array($cpt), $args);
	}
}
add_action('init', 'cs__register_taxonomies', 0);