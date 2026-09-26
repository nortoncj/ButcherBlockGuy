<?php
/**
 * template-parts/post-card.php
 * One post in a listing grid. Used by index.php, archive.php, search.php.
 * Expects to run inside the loop.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<article <?php post_class( 'bg-[#140c06] border border-[#2c2119] rounded overflow-hidden flex flex-col group hover:border-gold/60 transition' ); ?>>

	<a class="block h-44 overflow-hidden bg-foundry" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'bg-gallery-thumb', array(
				'class'   => 'w-full h-full object-cover transition duration-500 group-hover:scale-105',
				'loading' => 'lazy',
			) ); ?>
		<?php else : ?>
			<span class="w-full h-full flex items-center justify-center text-stone-600">
				<svg class="w-8 h-8 stroke-current fill-none" stroke-width="1.4" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="M20 16l-5-5-8.5 8.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</span>
		<?php endif; ?>
	</a>

	<div class="p-5 flex flex-col flex-grow">
		<p class="font-headline text-gold text-[10px] uppercase tracking-[0.18em] mb-2">
			<?php echo esc_html( get_the_date() ); ?>
		</p>

		<h2 class="font-headline text-ivory text-base font-semibold uppercase tracking-wide leading-tight mb-2">
			<a class="hover:text-gold transition" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<p class="text-stone-400 text-sm leading-relaxed flex-grow">
			<?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?>
		</p>

		<a class="mt-4 inline-flex items-center gap-2 font-headline text-xs font-bold text-gold hover:text-gold-light uppercase tracking-wider" href="<?php the_permalink(); ?>">
			Read more
			<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</a>
	</div>
</article>