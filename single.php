<?php
/**
 * single.php — one blog post.
 *
 * Dark hero, then an ivory reading area. Long-form body copy on the
 * espresso background is hard going; the Heritage Seal system calls for
 * a tonal transition at a change of purpose, and this is one.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

while ( have_posts() ) : the_post();
	$bbg_hero = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>

<article <?php post_class(); ?>>

	<!-- Hero -->
	<section class="relative bg-[#1c1108] border-b border-foundry overflow-hidden">
		<?php if ( $bbg_hero ) : ?>
			<img alt="" aria-hidden="true" class="absolute inset-0 w-full h-full object-cover opacity-25" src="<?php echo esc_url( $bbg_hero ); ?>">
			<div class="absolute inset-0 bg-gradient-to-t from-[#1c1108] via-[#1c1108]/80 to-[#1c1108]/60"></div>
		<?php endif; ?>

		<div class="relative z-10 max-w-3xl mx-auto px-4 lg:px-12 py-16 lg:py-20">
			<nav aria-label="Breadcrumb" class="font-headline text-[11px] uppercase tracking-wider text-stone-500 mb-6">
				<a class="text-gold hover:text-gold-light transition" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span class="mx-2">/</span>
				<?php
				$bbg_cats = get_the_category();
				if ( $bbg_cats ) :
					$bbg_cat = $bbg_cats[0];
				?>
					<a class="text-gold hover:text-gold-light transition" href="<?php echo esc_url( get_category_link( $bbg_cat->term_id ) ); ?>"><?php echo esc_html( $bbg_cat->name ); ?></a>
					<span class="mx-2">/</span>
				<?php endif; ?>
				<span class="text-stone-400"><?php echo esc_html( wp_trim_words( get_the_title(), 6, '…' ) ); ?></span>
			</nav>

			<p class="font-headline text-gold text-[11px] tracking-[0.25em] uppercase mb-4">
				<?php echo esc_html( get_the_date() ); ?>
			</p>

			<h1 class="font-headline font-bold text-ivory uppercase leading-[0.98] text-3xl sm:text-4xl lg:text-5xl mb-5">
				<?php the_title(); ?>
			</h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="text-stone-300 text-base leading-relaxed max-w-xl"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>

			<span class="block h-0.5 w-16 bg-gold mt-7"></span>
		</div>
	</section>

	<!-- Body -->
	<section class="bg-ivory px-4 lg:px-12 py-14 lg:py-16">
		<div class="max-w-3xl mx-auto">
			<div class="text-ink text-base leading-[1.8]
				[&_p]:mb-5
				[&_h2]:font-headline [&_h2]:uppercase [&_h2]:font-bold [&_h2]:text-espresso [&_h2]:text-2xl [&_h2]:mt-10 [&_h2]:mb-4
				[&_h3]:font-headline [&_h3]:uppercase [&_h3]:font-semibold [&_h3]:text-espresso [&_h3]:text-lg [&_h3]:mt-8 [&_h3]:mb-3
				[&_a]:text-gold-hover [&_a]:underline [&_a]:underline-offset-2 [&_a:hover]:text-espresso
				[&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-5 [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-5 [&_li]:mb-1.5
				[&_blockquote]:border-l-2 [&_blockquote]:border-gold [&_blockquote]:pl-5 [&_blockquote]:italic [&_blockquote]:text-stone-700 [&_blockquote]:my-6
				[&_img]:rounded [&_img]:my-6
				[&_figcaption]:text-xs [&_figcaption]:text-stone-500 [&_figcaption]:mt-2">
				<?php the_content(); ?>
			</div>

			<?php
			wp_link_pages( array(
				'before' => '<div class="mt-8 font-headline text-xs uppercase tracking-wider text-stone-600">' . esc_html__( 'Pages:', 'butcher-block-group' ) . ' ',
				'after'  => '</div>',
			) );
			?>

			<?php $bbg_tags = get_the_tags(); if ( $bbg_tags ) : ?>
				<div class="mt-10 pt-6 border-t border-ivory-high flex flex-wrap gap-2">
					<?php foreach ( $bbg_tags as $bbg_tag ) : ?>
						<a class="inline-flex items-center font-headline text-[10px] uppercase tracking-wider text-stone-600 hover:text-espresso border border-ivory-high hover:border-gold rounded-full px-3 py-1.5 transition"
						   href="<?php echo esc_url( get_tag_link( $bbg_tag->term_id ) ); ?>">
							<?php echo esc_html( $bbg_tag->name ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- Prev / next -->
	<?php
	$bbg_prev = get_previous_post();
	$bbg_next = get_next_post();
	if ( $bbg_prev || $bbg_next ) :
	?>
	<section class="bg-[#150d07] border-t border-foundry px-4 lg:px-12 py-10">
		<div class="max-w-3xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-4">
			<?php if ( $bbg_prev ) : ?>
				<a class="border border-stone-700 hover:border-gold rounded p-5 transition group" href="<?php echo esc_url( get_permalink( $bbg_prev ) ); ?>">
					<p class="font-headline text-gold text-[10px] uppercase tracking-[0.18em] mb-2">&larr; Previous</p>
					<p class="text-stone-300 group-hover:text-gold text-sm leading-snug transition"><?php echo esc_html( get_the_title( $bbg_prev ) ); ?></p>
				</a>
			<?php endif; ?>
			<?php if ( $bbg_next ) : ?>
				<a class="border border-stone-700 hover:border-gold rounded p-5 transition group sm:text-right" href="<?php echo esc_url( get_permalink( $bbg_next ) ); ?>">
					<p class="font-headline text-gold text-[10px] uppercase tracking-[0.18em] mb-2">Next &rarr;</p>
					<p class="text-stone-300 group-hover:text-gold text-sm leading-snug transition"><?php echo esc_html( get_the_title( $bbg_next ) ); ?></p>
				</a>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<!-- Closing CTA -->
	<section class="bg-[#1c1108] border-t border-foundry px-4 lg:px-12 py-14 text-center">
		<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-3">Got a project in mind?</p>
		<h2 class="font-headline font-bold text-ivory uppercase text-2xl sm:text-3xl mb-7">Let's build something that lasts</h2>
		<div class="flex flex-col sm:flex-row gap-4 justify-center">
			<a class="inline-flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="<?php echo esc_url( bbg_opt( 'quote_url', home_url( '/contact/' ) ) ); ?>">
				Get a quote
			</a>
			<a class="inline-flex items-center justify-center gap-3 border border-stone-600 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>">
				<?php echo esc_html( bbg_opt( 'phone', '(813) 555-0123' ) ); ?>
			</a>
		</div>
	</section>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<section class="bg-ivory px-4 lg:px-12 py-12">
			<div class="max-w-3xl mx-auto"><?php comments_template(); ?></div>
		</section>
	<?php endif; ?>

</article>

<?php
endwhile;

get_footer();