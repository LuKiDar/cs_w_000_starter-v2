<?php
/**
 * Content / Post card
 */

$date_format = get_option('date_format');
$post_categories = wp_get_post_categories(get_the_ID(), array('fields'=>'ids'));

$modifier = ( isset($args['modifier']) ) ? $args['modifier'] : ''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card '. $modifier); ?>>
	<?php if ( has_post_thumbnail() ){ ?>
		<figure class="post-card__media-wrap" role="none">
			<?= wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'medium_large', false, array('class' => 'post-card__image')); ?>

			<a class="post-card__media-link" href="<?php the_permalink(); ?>" title="Read more: <?php the_title(); ?>"></a>
		</figure>
	<?php } ?>

	<div class="post-card__content-wrap">
		<ul class="post-card__meta">
			<li><?php the_time($date_format); ?></li>        
			<li>by <?= get_the_author(); ?></li>
		</ul>

		<?php if ( !empty($post_categories) ){ ?>
			<ul class="post-card__tags">
				<?php foreach ( $post_categories as $item ){ ?>
					<li>
						<a href="<?= get_category_link($item); ?>" title=""><?= get_cat_name($item); ?></a>    
					</li>
				<?php } ?>
			</ul>
		<?php } ?>

		<h4 class="post-card__title">
			<a class="builtin" href="<?php the_permalink(); ?>" title="Read more: <?php the_title(); ?>"><?php the_title(); ?></a>
		</h4>

		<div class="post-card__excerpt">
			<p><?php the_excerpt(); ?></p>
		</div>
	</div>

	<footer class="post-card__navigation">
		<a class="post-card__link button" href="<?php the_permalink(); ?>" title="Read more: <?php the_title(); ?>">Read more</a>
	</footer>
</article>