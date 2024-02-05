<?php
/**
 * Block / Tabs
 */

$modifier = $block['className']; ?>


<section id="<?= $block['anchor'] ? $block['anchor'] : ''; ?>" class="block-tabs <?= $modifier; ?>">
    <?php the_field('text'); ?>
</section>