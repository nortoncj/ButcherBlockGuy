<?php
/**
 * 404.php — not found.
 *
 * Worth having on this site specifically: the service x location matrix
 * produces a lot of URLs, and a mistyped or retired one should land
 * somewhere useful rather than on a bare WordPress error.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="bg-[#1c1108] px-4 lg:px-12 py-20 lg:py-28">
	<div class="max-w-2xl mx-auto text-center">

		<p class="font-headline text-gold text-[11px] tracking-[0.25em] uppercase mb-4">Error 404</p>

		<h1 class="font-headline font-bold text-ivory uppercase leading-[0.95] text-4xl sm:text-5xl mb-5">
			This one got cut short
		</h1>

		<p class="text-stone-400 text-sm leading-relaxed mb-10 max-w-md mx-auto">
			The page you're after isn't here. It may have moved, or the link may have a typo. Try one of these instead.
		</p>

		<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-10">
			<a class="border border-stone-700 hover:border-gold text-stone-300 hover:text-gold rounded px-5 py-4 font-headline text-xs uppercase tracking-wider transition" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a>
			<a class="border border-stone-700 hover:border-gold text-stone-300 hover:text-gold rounded px-5 py-4 font-headline text-xs uppercase tracking-wider transition" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">Gallery</a>
			<a class="border border-stone-700 hover:border-gold text-stone-300 hover:text-gold rounded px-5 py-4 font-headline text-xs uppercase tracking-wider transition" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
		</div>

		<div class="max-w-sm mx-auto mb-10
			[&_input[type=search]]:w-full [&_input[type=search]]:bg-[#140c06] [&_input[type=search]]:border [&_input[type=search]]:border-stone-700
			[&_input[type=search]]:rounded [&_input[type=search]]:text-stone-200 [&_input[type=search]]:px-4 [&_input[type=search]]:py-3
			[&_input[type=search]:focus]:border-gold [&_button]:hidden">
			<?php get_search_form(); ?>
		</div>

		<a class="inline-flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			Back to home
		</a>
	</div>
</section>

<?php get_footer();