<?php
/**
 * Block / Example
 */

$content = get_field('content');
$margin_desktop = get_field('margin_desktop');
$margin_mobile = get_field('margin_mobile');

$modifier = ( isset($block['className']) ) ? $block['className'] : '';


if ( $content!='' ): ?>
	<section id="<?= isset($block['anchor']) ? $block['anchor'] : $block['id']; ?>" class="block-example <?= $modifier; ?>">
		<?= $content; ?>

		
		<?php cs__set_block_styles(isset($block['anchor']) ? $block['anchor'] : $block['id'], $margin_desktop, $margin_mobile); ?>
	</section>
<?php endif; ?>