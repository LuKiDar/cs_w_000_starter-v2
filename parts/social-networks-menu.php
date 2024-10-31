<?php
/**
 * Social networks menu
 */


if ( have_rows('social_networks', 'options') ): ?>
	<ul class="social-networks-menu">
		<?php while ( have_rows('social_networks', 'options') ): the_row();
			$name = get_sub_field('name');
			$url = get_sub_field('url'); ?>

			<?php if ( $name!='' && $url!='' ){ ?>
				<li class="social-networks-menu__item">
					<a class="social-networks-menu__icon social-networks-menu__icon--<?= $name; ?>" href="<?= $url; ?>" aria-label="<?= $name; ?> - link opens in a new tab" rel="noopener noreferrer" target="_blank" title="<?= $name; ?>"></a>
				</li>
			<?php } ?>
		<?php endwhile; ?>
	</ul>
<?php endif; ?>