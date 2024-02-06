<?php get_header();

$page_for_posts = get_option('page_for_posts');

$args = array(
    'taxonomy' => 'category',
    'fields' => 'id=>name',
    'hide_empty' => false,
);
$taxonomy_category = get_categories($args); ?>

<div class="news-feed container">
    <header class="news-feed__header grid grid--1">
        <div class="col">
            <h1 class="news-feed__title"><?= get_the_title($page_for_posts); ?></h1>

            <?php if ( !empty($taxonomy_category) ){ ?>
                <ul class="feed-categories">
                    <li class="feed-categories__item is-active">
                        <a class="builtin" href="<?= get_permalink($page_for_posts); ?>">All</a>
                    </li>

                    <?php foreach ( $taxonomy_category as $id=>$name ){ ?>
                        <li class="feed-categories__item">
                            <a class="builtin" href="<?= get_category_link($id); ?>"><?= $name; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </header>

    <div class="news-feed__container grid">
        <?php if ( have_posts() ): ?>
            <?php while ( have_posts() ): the_post(); ?>
                <div class="news-feed__item col col--4 col--md-6 col--sm-6 col--xs-12">
                    <?php get_template_part('parts/content/post-card'); ?>
                </div>
            <?php endwhile; ?>

        <?php else: ?>
            <div class="news-feed__item col col--12">
                <h2><?php _e('Sorry, no posts found.', CSWP); ?></h2>
            </div>

        <?php endif; ?>
    </div>

    <footer class="news-feed__footer grid grid--1">
        <div class="col">
            <?php cs__the_pagination(); ?>
        </div>
    </footer>
</div>

<?php get_footer(); ?>