<?php
/**
 * Default page
 */

get_header(); ?>

<div class="default-page container">
	<header class="default-page__header ">
		<h1 class="default-page__title"><?= get_the_title(); ?></h1>
	</header>
	
	<?php while ( have_posts() ): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>