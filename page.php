<?php
/**
 * page.php — default Page template.
 *
 * Catches any Page that has not been assigned one of the template-*.php
 * files (Privacy Policy, Terms, one-off landing pages, and anything Troy
 * creates later). Without this, WordPress falls through to index.php and
 * a Page renders as a post listing.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

while ( have_posts() ) : the_post();
	$bbg_hero = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>

<article <?php post_class(); ?>>

	<section class="relative bg-[#1c1108] border-b border-foundry overflow-hidden">
		<?php if ( $bbg_hero ) : ?>
			<img alt="" aria-hidden="true" class="absolute inset-0 w-full h-full object-cover opacity-25" src="<?php echo esc_url( $bbg_hero ); ?>">
			<div class="absolute inset-0 bg-gradient-to-t from-[#1c1108] via-[#1c1108]/80 to-[#1c1108]/60"></div>
		<?php endif; ?>
		<div class="relative z-10 max-w-3xl mx-auto px-4 lg:px-12 py-16">
			<h1 class="font-headline font-bold text-ivory uppercase leading-[0.98] text-3xl sm:text-4xl lg:text-5xl"><?php the_title(); ?></h1>
			<span class="block h-0.5 w-16 bg-gold mt-6"></span>
		</div>
	</section>

	<section class="bg-ivory px-4 lg:px-12 py-14">
		<div class="max-w-3xl mx-auto">
			<div class="text-ink text-base leading-[1.8]
				[&_p]:mb-5
				[&_h2]:font-headline [&_h2]:uppercase [&_h2]:font-bold [&_h2]:text-espresso [&_h2]:text-2xl [&_h2]:mt-10 [&_h2]:mb-4
				[&_h3]:font-headline [&_h3]:uppercase [&_h3]:font-semibold [&_h3]:text-espresso [&_h3]:text-lg [&_h3]:mt-8 [&_h3]:mb-3
				[&_a]:text-gold-hover [&_a]:underline [&_a]:underline-offset-2 [&_a:hover]:text-espresso
				[&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-5 [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:mb-5 [&_li]:mb-1.5
				[&_table]:w-full [&_th]:text-left [&_th]:font-headline [&_th]:uppercase [&_th]:text-xs [&_td]:py-2
				[&_img]:rounded [&_img]:my-6">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages( array(
				'before' => '<div class="mt-8 font-headline text-xs uppercase tracking-wider text-stone-600">' . esc_html__( 'Pages:', 'butcher-block-group' ) . ' ',
				'after'  => '</div>',
			) ); ?>
		</div>
	</section>

</article>

<?php
endwhile;

get_footer();