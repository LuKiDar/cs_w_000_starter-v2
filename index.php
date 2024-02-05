<?php
/**
 * Base template
 **/

get_header();

if ( have_posts() ):
	if ( is_home() && !is_front_page() ){ ?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>
	<?php }

	/* Start the Loop */
	while ( have_posts() ): the_post();
		get_template_part('parts/content/'. get_post_type() .'-card/'. get_post_type() .'-card');
	endwhile;

	the_posts_navigation();

else:
	get_template_part('parts/content/none');

endif;

get_footer(); ?>