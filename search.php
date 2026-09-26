<?php
/**
 * search.php — search results.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="bg-[#1c1108] border-b border-foundry px-4 lg:px-12 py-14 lg:py-16">
	<div class="max-w-7xl mx-auto">
		<p class="font-headline text-gold text-[11px] tracking-[0.25em] uppercase mb-3">Search results</p>
		<h1 class="font-headline font-bold text-ivory uppercase leading-[0.98] text-3xl sm:text-4xl">
			&ldquo;<?php echo esc_html( get_search_query() ); ?>&rdquo;
		</h1>
		<p class="text-stone-400 text-sm mt-4">
			<?php
			global $wp_query;
			printf(
				esc_html( _n( '%s result', '%s results', (int) $wp_query->found_posts, 'butcher-block-group' ) ),
				esc_html( number_format_i18n( (int) $wp_query->found_posts ) )
			);
			?>
		</p>
		<div class="mt-6 max-w-md [&_input[type=search]]:w-full [&_input[type=search]]:bg-[#140c06] [&_input[type=search]]:border [&_input[type=search]]:border-stone-700 [&_input[type=search]]:rounded [&_input[type=search]]:text-stone-200 [&_input[type=search]]:px-4 [&_input[type=search]]:py-3 [&_button]:hidden">
			<?php get_search_form(); ?>
		</div>
	</div>
</section>

<section class="bg-[#150d07] px-4 lg:px-12 py-12 lg:py-16">
	<div class="max-w-7xl mx-auto">
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/post-card' );
			endwhile; else : ?>
			<p class="col-span-full text-center text-stone-500 text-sm py-16">No matches. Try a different word.</p>
			<?php endif; ?>
		</div>
		<?php if ( have_posts() ) : ?>
		<div class="mt-10 flex justify-center [&_.page-numbers]:inline-flex [&_.page-numbers]:items-center [&_.page-numbers]:justify-center [&_.page-numbers]:min-w-10 [&_.page-numbers]:h-10 [&_.page-numbers]:px-3 [&_.page-numbers]:rounded [&_.page-numbers]:border [&_.page-numbers]:border-stone-700 [&_.page-numbers]:text-stone-300 [&_.page-numbers]:mx-1 [&_.page-numbers]:transition [&_a.page-numbers:hover]:border-gold [&_a.page-numbers:hover]:text-gold [&_.page-numbers.current]:bg-gold-light [&_.page-numbers.current]:border-gold-light [&_.page-numbers.current]:text-stone-900 [&_.page-numbers.current]:font-bold">
			<?php the_posts_pagination( array(
				'mid_size'  => 1,
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				'screen_reader_text' => __( 'Posts navigation', 'butcher-block-group' ),
			) ); ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();