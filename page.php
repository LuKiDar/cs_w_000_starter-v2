<?php get_header(); ?>

<div class="default-page">
    <div class="container">
        <header class="default-page__header">
            <h1 class="default-page__title"><?= get_the_title(); ?></h1>
        </header>
        
        <div class="grid">
            <div class="col col--3">col</div>
            <div class="col col--6">col</div>
            <div class="col">col</div>
            <div class="col">col</div>
        </div>
        <?php while ( have_posts() ): the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>