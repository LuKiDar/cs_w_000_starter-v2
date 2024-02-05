<?php
/**
 * Site Header
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Page -->
	<div id="page" class="site-container">
		<a class="screen-reader-shortcut" href="#menu-primary-menu" aria-label="Skip to primary menu">Skip to primary menu</a>
		<a class="screen-reader-shortcut" href="#main" aria-label="Skip to main content">Skip to main content</a>
		<a class="screen-reader-shortcut" href="#footer" aria-label="Skip to footer content">Skip to footer content</a>

		<header id="masthead" class="site-header" role="banner">
			<div class="site-header__container container">
				<div class="site-header__toggle col">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="navbar-toggle__bar"></span>.
					</button>
				</div>
			</div>

			<div class="header__logo col">
				<?php if ( !has_custom_logo() ){ ?>
					<a class="logo" href="<?= get_home_url(); ?>" title="Go to Home page">
						<img class="logo__image" src="<?php bloginfo('template_url'); ?>/assets/img/logo.png" alt="<?php bloginfo('name'); ?>, logo" />
					</a>
				<?php } else { ?>
					<?php the_custom_logo(); ?>
				<?php } ?>
			</div>

			<div class="header__menu col">
				<?php if ( has_nav_menu('primary-menu') ){
					wp_nav_menu(array(
						'container' => false,
						'menu_class' => 'primary-menu',
						'theme_location' => 'primary-menu'
						// 'walker' => new cs__header_menu_walker()
					));
				} ?>
			</div>
		</header>

		<!-- Container -->
		<main id="primary" class="site-main">