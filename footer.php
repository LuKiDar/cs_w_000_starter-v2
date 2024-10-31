<?php
/**
 * Site Footer
 */

$footer = get_field('footer', 'options'); ?>

		</main>

		<footer id="colophon" class="site-footer container">
			<div class="grid">
				<div class="col">
					<?php wp_nav_menu(array(
						'menu' => 'footer-menu',
						'menu_class' => 'footer-menu',
						'container' => false
					)); ?>
				</div>

				<div class="col">
					<?php get_template_part('parts/social-networks-menu'); ?>
				</div>

				<div class="col">
					<?php if ( $footer['copyright']!='' ){ ?>
						<p class="site-footer__copyright"><?= $footer['copyright']; ?></p>
					<?php } ?>
				</div>
			</div>
		</footer>
	</div>

	<!-- <script>
		const ajaxUrl = '<?= base64_encode(admin_url('admin-ajax.php')); ?>';
	</script> -->

	<?php wp_footer(); ?>
</body>
</html>