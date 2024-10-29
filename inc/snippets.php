<?php /*** Accordion ***/ ?>

<?php if ( have_rows('accordion') ): ?>
	<dl class="accordion">
		<?php while ( have_rows('accordion') ): the_row();
			$title = get_sub_field('title');
			$text = get_sub_field('text'); ?>

			<?php if ( $title!='' && $text!='' ){ ?>
				<dt class="accordion__header" tabindex="0"><?= $title; ?></dt>
				<dd class="accordion__content"><?= $text; ?></dd>
			<?php } ?>
		<?php endwhile; ?>
	</dl>
<?php endif; ?>



<?php /*** ACF messages***/ ?>

You can manage content of the Newsletter block here: <a href="/wp-admin/admin.php?page=acf-options-newsletter-block" title="">Theme Settings > Newsletter block</a>

The 3 latest posts from the selected blog feed will be shown here.



<?php /*** CF7 form ***/ ?>

[response]
<div class="form">
	<div class="form__col">
		<div class="form__field">
			<label class="form__label" for="name-field">Name:</label>
			[text* name-field id:name-field placeholder "Enter your full name"]
		</div>

		<div class="form__field">
			<label class="form__label" for="email-field">Email:</label>
			[email* email-field id:email-field placeholder "Enter your email address"]
		</div>

		<div class="form__field">
			<label class="form__label" for="email-confirm-field">Confirm Email:</label>
			[confirm_email* email-confirm-field id:email-confirm-field placeholder "Enter your email address again"]
		</div>
	</div>

	<div class="form__col">
		<div class="form__field">
			<label class="form__label" for="message-field">Message:</label>
			[textarea message-field id:message-field placeholder "Add your message"]
		</div>

		<div class="form__field form__field--submit">
			[submit class:button class:button--plum class:button--arrow "Send message"]
		</div>
	</div>
</div>



<?php /*** Custom select, links ***/ ?>

<div class="custom-select custom-select--links">
	<span class="custom-select__title">Sort By: Newest</span>

	<ul class="custom-select__list">
		<li class="custom-select__item">
			<a href="#">Sort By: Newest</a>
		</li>
		<li class="custom-select__item">
			<a href="#">Sort By: Oldest</a>
		</li>
	</ul>
</div>



<?php /*** admin.php / Disable Posts post type ***/ ?>

<?php /*** Remove Posts post type ***/
// Remove side menu
add_action('admin_menu', 'cs__remove_default_post_type');
function cs__remove_default_post_type(){
	remove_menu_page('edit.php');
}

// Remove +New post in top Admin Menu Bar
add_action('admin_bar_menu', 'cs__remove_default_post_type_menu_bar', 999);
function cs__remove_default_post_type_menu_bar( $wp_admin_bar ){
	$wp_admin_bar->remove_node('new-post');
}

// Remove Quick Draft Dashboard Widget
add_action('wp_dashboard_setup', 'cs__remove_draft_widget', 999);
function cs__remove_draft_widget(){
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
} ?>



<?php /*** Image ***/ ?>

<?php if ( has_post_thumbnail() ){ ?>
	<figure class="post__media-wrap">
		<picture class="post__image">
			<source media="(max-width: 360px)" srcset="<?= get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true); ?>">
			<source media="(min-width: 361px)" srcset="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>">
			<img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?= get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true); ?>">
		</picture>
	</figure>
<?php } ?>

<?php if ( !empty($image) ){ ?>
	<figure class="section-banner__media-wrap">
		<picture class="section-banner__image">
			<source media="(max-width: 1024px)" srcset="<?= $image['sizes']['large']; ?>">
			<source media="(min-width: 1025px) and (max-width: 1500px)" srcset="<?= $image['sizes']['1536x1536']; ?>">
			<source media="(min-width: 1501px)" srcset="<?= $image['sizes']['2048x2048']; ?>">
			<img src="<?= $image['sizes']['2048x2048']; ?>" alt="<?= $image['alt']; ?>">
		</picture>
	</figure>
<?php } ?>



<?php /*** Map ***/ ?>

<?php if ( !empty($map) ): ?>
	<iframe height="100%" width="100%" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://maps.google.com/maps/embed/v1/place?key=<?= $google_maps_api_key; ?>&q=<?= $map['address']; ?>&zoom=<?= $map['zoom']; ?>"></iframe>
<?php endif; ?>



<?php /*** Modal ***/ ?>

<a href="#" data-modal="modal-modal_name"><?= $button_title; ?></a>
<div id="modal-modal_name" class="modal-container">
	<dialog class="modal" open>
		<button class="modal__close-button"></button>
		<div class="modal__content"></div>
	</dialog>
</div>

<!-- Template: Modal / Modal_name -->
<template id="tmpl-modal-modal_name">
	<div id="modal-modal_name" class="modal-container">
		<dialog class="modal" open>
			<button class="modal__close-button"></button>
			<div class="modal__content"></div>
		</dialog>
	</div>
</template>



<?php /*** Tabs ***/ ?>

<?php if ( have_rows('tabs') ): ?>
	<div class="tabs">
		<nav class="tabs__header">
			<?php $i=0; while ( have_rows('tabs') ): the_row(); $i++;
				$title = get_sub_field('title'); ?>

				<?php if ( $title!='' ){ ?>
					<a class="tabs__title <?= $i==1 ? 'is-active' : ''; ?>" href="#" data-tab="tab-<?= $i; ?>"><?= $title; ?></a>
				<?php } ?>
			<?php endwhile; ?>
		</nav>

		<dl class="tabs__body">
			<?php $i=0; while ( have_rows('tabs') ): the_row(); $i++;
				$title = get_sub_field('title');
				$content = get_sub_field('content'); ?>

				<?php if ( $title!='' && $content!='' ){ ?>
					<dt class="tabs__title <?= $i==1 ? 'is-active' : ''; ?>" data-tab="tab-<?= $i; ?>">
						<?= $title; ?>
					</dt>
					<dd id="tab-<?= $i; ?>" class="tabs__content <?= $i==1 ? 'is-active' : ''; ?>">
						<?= $content; ?>
					</dd>
				<?php } ?>
			<?php endwhile; ?>
		</dl>
	</div>
<?php endif; ?>



<?php /*** Social networks ***/ ?>

<?php if ( have_rows('social_networks', 'options') ): ?>
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