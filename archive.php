<?php
/**
 * archive.php — category, tag, author, date and CPT archives.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<?php
$bbg_eyebrow = 'Archive';
if ( is_category() )      { $bbg_eyebrow = 'Category'; }
elseif ( is_tag() )       { $bbg_eyebrow = 'Tag'; }
elseif ( is_author() )    { $bbg_eyebrow = 'Author'; }
elseif ( is_date() )      { $bbg_eyebrow = 'Archive'; }
elseif ( is_post_type_archive() ) { $bbg_eyebrow = 'All'; }
?>
<section class="bg-[#1c1108] border-b border-foundry px-4 lg:px-12 py-14 lg:py-16">
	<div class="max-w-7xl mx-auto">
		<p class="font-headline text-gold text-[11px] tracking-[0.25em] uppercase mb-3"><?php echo esc_html( $bbg_eyebrow ); ?></p>
		<h1 class="font-headline font-bold text-ivory uppercase leading-[0.98] text-3xl sm:text-4xl lg:text-5xl">
			<?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?>
		</h1>
		<?php $bbg_desc = get_the_archive_description(); if ( $bbg_desc ) : ?>
			<div class="text-stone-400 text-sm mt-4 max-w-xl leading-relaxed"><?php echo wp_kses_post( $bbg_desc ); ?></div>
		<?php endif; ?>
		<span class="block h-0.5 w-16 bg-gold mt-6"></span>
	</div>
</section>

<section class="bg-[#150d07] px-4 lg:px-12 py-12 lg:py-16">
	<div class="max-w-7xl mx-auto">
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/post-card' );
			endwhile; else : ?>
			<p class="col-span-full text-center text-stone-500 text-sm py-16">Nothing filed under this yet.</p>
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