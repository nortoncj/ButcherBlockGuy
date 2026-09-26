<?php
/**
 * header.php — shared site header
 *
 * Replaces the hand-copied header that was duplicated across every static
 * page. Because this runs through WordPress, relative-path juggling
 * (../ and ../../) disappears entirely.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-espresso antialiased selection:bg-gold selection:text-white' ); ?>>
<?php wp_body_open(); ?>

<a class="sr-only focus:not-sr-only focus:absolute focus:z-[100] focus:top-2 focus:left-2 focus:bg-gold-light focus:text-stone-900 focus:px-4 focus:py-2 focus:rounded" href="#main">
	Skip to content
</a>

<!-- BEGIN: MainHeader -->
<header class="sticky top-0 z-50 bg-[#140c06]/95 backdrop-blur border-b border-[#3a2415]/80 text-ivory px-4 lg:px-12 py-3.5 transition-all">
	<div class="max-w-7xl mx-auto flex items-center justify-between">

		<a class="flex items-center gap-3.5 group" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img
				alt="<?php echo esc_attr( bbg_opt( 'brand_name', 'Butcher Block Group' ) ); ?> emblem"
				class="w-12 h-12 object-contain rounded-full ring-1 ring-gold/40 transition group-hover:ring-gold"
				src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>"
			>
			<div class="flex flex-col">
				<span class="font-headline text-lg sm:text-xl font-bold tracking-wider text-stone-100 uppercase leading-none">
					<?php echo esc_html( bbg_opt( 'brand_line_1', 'Butcher Block' ) ); ?>
				</span>
				<span class="font-headline text-xs sm:text-[13px] tracking-[0.25em] text-gold font-medium uppercase mt-0.5">
					<?php echo esc_html( bbg_opt( 'brand_line_2', 'Group' ) ); ?>
				</span>
			</div>
		</a>

		<?php
		$menu_items = array();
		$locations  = get_nav_menu_locations();
		if ( ! empty( $locations['primary'] ) ) {
			$menu_items = wp_get_nav_menu_items( $locations['primary'] );
		}
		?>

		<!-- Desktop nav -->
		<nav class="hidden lg:flex items-center space-x-7 text-xs font-semibold uppercase tracking-wider text-stone-300" aria-label="Primary">
			<?php if ( $menu_items ) : ?>
				<?php foreach ( $menu_items as $item ) :
					if ( (int) $item->menu_item_parent !== 0 ) continue; // top level only
					$icon = bbg_nav_icon( bbg_menu_item_slug( $item ) );
				?>
					<a class="hover:text-gold flex items-center gap-1.5 transition" href="<?php echo esc_url( $item->url ); ?>">
						<?php echo $icon; // safe: generated from a fixed internal map ?>
						<?php echo esc_html( $item->title ); ?>
					</a>
				<?php endforeach; ?>
			<?php else : ?>
				<span class="text-stone-500 normal-case tracking-normal">
					Assign a menu to the <strong>Primary</strong> location under Appearance &rarr; Menus.
				</span>
			<?php endif; ?>
		</nav>

		<!-- Desktop phone + quote -->
		<div class="hidden lg:flex items-center gap-4">
			<a class="flex items-center gap-2 text-stone-200 hover:text-gold text-sm font-semibold tracking-wide transition" href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>">
				<svg class="w-4 h-4 text-gold fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
				<span><?php echo esc_html( bbg_opt( 'phone', '(813) 555-0123' ) ); ?></span>
			</a>
			<a class="bg-gold-light hover:bg-gold-hover text-stone-900 font-bold px-4 py-2 text-xs uppercase tracking-wider rounded transition" href="<?php echo esc_url( bbg_opt( 'quote_url', home_url( '/contact/' ) ) ); ?>">
				Get Quote
			</a>
		</div>

		<!-- Mobile toggle -->
		<button aria-controls="bbg-mobile-menu" aria-expanded="false" aria-label="Open menu" class="lg:hidden text-ivory p-2 -mr-2" id="bbg-mobile-menu-btn" type="button">
			<svg class="w-6 h-6" id="bbg-icon-open" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"/></svg>
			<svg class="w-6 h-6 hidden" id="bbg-icon-close" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>
	</div>

	<!-- Mobile call buttons -->
	<div class="lg:hidden flex items-center gap-2.5 px-0 pt-3.5">
		<a class="flex-1 inline-flex items-center justify-center gap-2 bg-foundry hover:bg-[#4a2f1c] text-ivory font-headline font-bold text-xs uppercase tracking-wider px-4 py-3 rounded transition" href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>">
			<svg class="w-4 h-4 text-gold fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
			Call Now
		</a>
		<a class="flex-1 inline-flex items-center justify-center bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-xs uppercase tracking-wider px-4 py-3 rounded transition" href="<?php echo esc_url( bbg_opt( 'quote_url', home_url( '/contact/' ) ) ); ?>">
			Get Quote
		</a>
	</div>

	<!-- Mobile drawer -->
	<div class="lg:hidden hidden border-t border-[#3a2415]/80 bg-[#140c06] -mx-4 mt-3.5" id="bbg-mobile-menu">
		<nav class="max-w-7xl mx-auto flex flex-col px-4 py-2 text-sm font-semibold uppercase tracking-wider text-stone-300" aria-label="Mobile">
			<?php if ( $menu_items ) : ?>
				<?php
				$top = array_filter( $menu_items, function ( $i ) { return (int) $i->menu_item_parent === 0; } );
				$last = count( $top );
				$n = 0;
				foreach ( $top as $item ) :
					$n++;
					$icon = bbg_nav_icon( bbg_menu_item_slug( $item ) );
					$border = ( $n < $last ) ? ' border-b border-[#3a2415]/60' : '';
				?>
					<a class="flex items-center gap-3 py-3.5<?php echo esc_attr( $border ); ?> hover:text-gold transition" href="<?php echo esc_url( $item->url ); ?>">
						<span class="shrink-0"><?php echo $icon; ?></span>
						<?php echo esc_html( $item->title ); ?>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</nav>
	</div>
</header>
<!-- END: MainHeader -->

<main id="main">