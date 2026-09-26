<?php
/**
 * footer.php — shared site footer
 * Everything here is driven by the "Site Settings" Pods options page or
 * by WP menus, so Troy edits contact details in exactly one place.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$bbg_phone = bbg_opt( 'phone', '(813) 555-0123' );
$bbg_email = bbg_opt( 'email', 'hello@butcherblockgroup.com' );
$bbg_city  = bbg_opt( 'city', 'Brandon, FL' );
?>
</main>

<!-- BEGIN: MainFooter -->
<footer class="bg-espresso border-t border-foundry px-4 lg:px-12 pt-12 pb-6">
	<div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

		<!-- Brand -->
		<div>
			<div class="flex items-center gap-3 mb-4">
				<img
					alt="<?php echo esc_attr( bbg_opt( 'brand_name', 'Butcher Block Group' ) ); ?> emblem"
					class="w-12 h-12 object-contain rounded-full ring-1 ring-gold/40"
					src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>"
					loading="lazy"
				>
				<span class="font-headline text-ivory text-base font-bold uppercase tracking-wider leading-tight">
					<?php echo esc_html( bbg_opt( 'brand_name', 'Butcher Block Group' ) ); ?>
				</span>
			</div>
			<p class="text-stone-400 text-xs leading-relaxed mb-5">
				<?php echo esc_html( bbg_opt( 'tagline', 'Timeless craftsmanship. Premium materials. Built to last for generations.' ) ); ?>
			</p>

			<?php
			$socials = array(
				'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1"/>',
				'facebook'  => '<path d="M14 8.5V7a1.5 1.5 0 011.5-1.5H17V3h-2.5A4 4 0 0010.5 7v1.5H8V11h2.5v10H14V11h2.3l.4-2.5H14z"/>',
				'pinterest' => '<circle cx="12" cy="12" r="9"/><path d="M12 7c-2 0-3.3 1.3-3.3 3 0 .8.4 1.6 1 1.9.1 0 .2 0 .2-.2l.2-.6c0-.1 0-.2-.1-.3a2 2 0 01-.4-1.2c0-1.4 1-2.5 2.6-2.5 1.4 0 2.2.9 2.2 2 0 1.6-.7 2.9-1.7 2.9-.6 0-1-.5-.9-1.1l.5-1.9c.1-.5-.1-.9-.6-.9-.6 0-1.1.6-1.1 1.4 0 .5.2.9.2.9l-.8 3.3c-.2.8 0 1.9 0 2 .1 0 .2 0 .2-.1.1-.1.8-1 1-1.9l.3-1.2c.2.4.8.8 1.5.8 2 0 3.3-1.8 3.3-4.2C16.3 8.6 14.6 7 12 7z"/>',
			);
			$has_social = false;
			foreach ( $socials as $net => $path ) { if ( bbg_opt( $net . '_url' ) ) { $has_social = true; break; } }
			?>
			<?php if ( $has_social ) : ?>
			<div class="flex items-center gap-4">
				<?php foreach ( $socials as $net => $path ) :
					$url = bbg_opt( $net . '_url' );
					if ( ! $url ) continue; ?>
					<a class="text-stone-400 hover:text-gold transition" href="<?php echo esc_url( $url ); ?>" aria-label="<?php echo esc_attr( ucfirst( $net ) ); ?>" rel="noopener" target="_blank">
						<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true"><?php echo $path; ?></svg>
					</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>

		<!-- Quick links -->
		<div>
			<h3 class="font-headline text-gold text-[11px] font-semibold uppercase tracking-[0.2em] mb-4">Quick Links</h3>
			<?php if ( has_nav_menu( 'footer_quick' ) ) : ?>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer_quick',
					'container'      => false,
					'menu_class'     => 'space-y-2.5 text-stone-400 text-sm [&_a]:transition [&_a:hover]:text-gold',
					'depth'          => 1,
					'fallback_cb'    => false,
				) ); ?>
			<?php else : ?>
				<p class="text-stone-500 text-xs">Assign a menu to <strong>Footer — Quick Links</strong>.</p>
			<?php endif; ?>
		</div>

		<!-- Services -->
		<div>
			<h3 class="font-headline text-gold text-[11px] font-semibold uppercase tracking-[0.2em] mb-4">Services</h3>
			<?php if ( has_nav_menu( 'footer_service' ) ) : ?>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer_service',
					'container'      => false,
					'menu_class'     => 'space-y-2.5 text-stone-400 text-sm [&_a]:transition [&_a:hover]:text-gold',
					'depth'          => 1,
					'fallback_cb'    => false,
				) ); ?>
			<?php else : ?>
				<p class="text-stone-500 text-xs">Assign a menu to <strong>Footer — Services</strong>.</p>
			<?php endif; ?>
		</div>

		<!-- Contact -->
		<div>
			<h3 class="font-headline text-gold text-[11px] font-semibold uppercase tracking-[0.2em] mb-4">Contact</h3>
			<ul class="space-y-3 text-stone-400 text-sm">
				<li>
					<a class="flex items-center gap-2.5 hover:text-gold transition" href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>">
						<svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3.5h3l1.4 4-2 1.6a12 12 0 005.5 5.5l1.6-2 4 1.4v3a1.5 1.5 0 01-1.6 1.5A16.5 16.5 0 014.5 5.1 1.5 1.5 0 016 3.5z" stroke-linejoin="round"/></svg>
						<?php echo esc_html( $bbg_phone ); ?>
					</a>
				</li>
				<li>
					<a class="flex items-center gap-2.5 hover:text-gold transition" href="mailto:<?php echo esc_attr( $bbg_email ); ?>">
						<svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="5.5" width="17" height="13" rx="2"/><path d="M4 6.5 12 13l8-6.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<?php echo esc_html( $bbg_email ); ?>
					</a>
				</li>
				<li class="flex items-center gap-2.5">
					<svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.3"/></svg>
					<?php echo esc_html( $bbg_city ); ?>
				</li>
			</ul>
			<?php if ( bbg_opt( 'licensed_text' ) ) : ?>
				<p class="text-gold text-xs mt-4"><?php echo esc_html( bbg_opt( 'licensed_text' ) ); ?></p>
			<?php endif; ?>
		</div>
	</div>

	<div class="max-w-7xl mx-auto mt-10 pt-5 border-t border-foundry flex flex-wrap items-center justify-between gap-4 text-stone-500 text-xs">
		<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( bbg_opt( 'brand_name', 'Butcher Block Group' ) ); ?>. All rights reserved.</p>
		<p><?php echo esc_html( bbg_opt( 'footer_note', 'Handcrafted in Brandon, Florida.' ) ); ?></p>
	</div>
</footer>
<!-- END: MainFooter -->

<script>
(function () {
	var btn = document.getElementById('bbg-mobile-menu-btn');
	var menu = document.getElementById('bbg-mobile-menu');
	if (!btn || !menu) return;
	var iconOpen = document.getElementById('bbg-icon-open');
	var iconClose = document.getElementById('bbg-icon-close');

	function setOpen(open) {
		menu.classList.toggle('hidden', !open);
		iconOpen.classList.toggle('hidden', open);
		iconClose.classList.toggle('hidden', !open);
		btn.setAttribute('aria-expanded', String(open));
	}
	btn.addEventListener('click', function () { setOpen(menu.classList.contains('hidden')); });
	menu.querySelectorAll('a').forEach(function (l) { l.addEventListener('click', function () { setOpen(false); }); });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
