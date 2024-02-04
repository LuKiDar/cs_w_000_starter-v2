<?php get_header(); ?>

<div class="default-page">
    <div class="container">
        <header class="default-page__header col col--12">
            <h1 class="default-page__title"><?= get_the_title(); ?></h1>
        </header>
        
        <?php while ( have_posts() ): the_post(); ?>
            <div class="col col--12">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>