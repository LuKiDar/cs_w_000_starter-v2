<?php
/**
 * WordPress Cleanup
 */

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


/*** Clean Nav Menu Classes ***/
function cs__clean_nav_menu_classes( $classes, $menu_item, $args ){
	if ( !is_array($classes) ){
		return $classes;
	}

	foreach ( $classes as $i=>$class ){
		// Remove class with menu item id.
		$id = strtok($class, 'menu-item-');
		if ( intval($id)>0 ){
			unset($classes[$i]);
		}

		// Remove menu-item-type-*.
		if ( strpos($class, 'menu-item-type-') ){
			unset($classes[$i]);
		}

		// Remove menu-item-object-*.
		if ( strpos($class, 'menu-item-object-')!==false ){
			unset($classes[$i]);
		}

		// Change page ancestor to menu ancestor.
		if ( $class==='current-page-ancestor' ){
			$classes[] = 'current-menu-ancestor';
			unset($classes[$i]);
		}
	}

	// Remove submenu class if depth is limited.
	if ( isset($args->depth) && $args->depth===1 ){
		$classes = array_diff($classes, array('menu-item-has-children'));
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'cs__clean_nav_menu_classes', 5, 3);


/*** Excerpt More ***/
function cs__excerpt_more(){
	return '&hellip;';
}
add_filter('excerpt_more', 'cs__excerpt_more');


/*** Disable emoji ***/
function cs__disable_emojicons_tinymce( $plugins ){
    if ( is_array($plugins) ){
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}
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
add_action('init', 'cs__disable_wp_emojicons');


/*** Disable comments ***/
add_action('admin_init', function (){
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ( $pagenow==='edit-comments.php' ){
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