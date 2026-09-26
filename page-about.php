<?php
/**
 * Template Name: About
 *
 * Converted from the static about.html prototype.
 * Header and footer now come from header.php / footer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<style data-purpose="page-styling">
body { background-color: #1c1108; color: #16110b; font-family: 'Manrope', sans-serif; }
    .font-headline { font-family: 'Oswald', sans-serif; letter-spacing: 0.03em; }
    .cat-card { position: relative; border-radius: 0.375rem; overflow: hidden; display: block; height: 9rem; }
    .cat-card img { transition: transform .5s ease; }
    .cat-card:hover img { transform: scale(1.07); }
    @keyframes bbg-pulse { 0% { transform: scale(.8); opacity: .5; } 70% { transform: scale(1.4); opacity: 0; } 100% { opacity: 0; } }
    .ring { animation: bbg-pulse 3.2s ease-out infinite; transform-origin: center; }
    .ring:nth-of-type(2) { animation-delay: 1.05s; }
    .ring:nth-of-type(3) { animation-delay: 2.1s; }
    @media (prefers-reduced-motion: reduce) { .ring { animation: none; opacity: .3; } }
</style>
<!-- BEGIN: AboutHero -->
<section class="relative h-[52vh] min-h-[380px] w-full overflow-hidden">
<img alt="Butcher block island with integrated sink" class="absolute inset-0 w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"/>
<div class="absolute inset-0 bg-gradient-to-r from-espresso via-espresso/85 to-espresso/20"></div>
<div class="absolute inset-0 bg-gradient-to-t from-espresso via-transparent to-transparent"></div>
<div class="relative z-10 h-full max-w-7xl mx-auto px-6 lg:px-12 flex flex-col justify-center">
<p class="font-headline text-gold text-xs sm:text-sm tracking-[0.25em] uppercase mb-3">
      Built by hand. Meant to last.
    </p>
<h1 class="font-headline font-bold text-ivory uppercase leading-[0.95] text-4xl sm:text-5xl lg:text-6xl mb-5 max-w-xl">
        <?php the_title() ?>
    </h1>
<p class="text-stone-300 text-sm sm:text-base max-w-sm leading-relaxed mb-6">
      Custom woodwork. Real people. A local business with a passion for craftsmanship.
    </p>
<span class="block h-0.5 w-16 bg-gold"></span>
</div>
</section>
<!-- END: AboutHero -->

<!-- BEGIN: OurStory -->
 <?php
$bbg_page_id  = get_queried_object_id();
              $extra_image  = $bbg_page_id ? get_post_meta( $bbg_page_id, '_frontpage_image', true ) : '';
?>
<section class="bg-[#150d07] px-4 lg:px-12 py-12 lg:py-16">
<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[0.85fr_1.2fr_auto_0.7fr] gap-8 lg:gap-10 items-start">

<div class="rounded overflow-hidden h-72 lg:h-80">
<img alt="Craftsman working a wood slab at the bench" class="w-full h-full object-cover" loading="lazy" src="<?php $extra_image ?>"/>
</div>

<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-3">Our story</p>
<h2 class="font-headline font-semibold text-ivory text-2xl sm:text-3xl leading-tight mb-5">
        From a Small Shop<br/>to a Growing Dream
      </h2>
      <?php echo the_content(); ?>

<a class="inline-flex items-center gap-3 border border-stone-600 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-xs uppercase tracking-wider px-6 py-3.5 rounded transition" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">
        Our services
        <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>

<div aria-hidden="true" class="hidden lg:block w-px self-stretch bg-foundry"></div>

<div class="space-y-7">
<div class="flex items-start gap-3.5">
<svg class="w-8 h-8 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24"><path d="M5 19l6-6M19 19l-6-6M5 5l14 14M19 5L5 19" stroke-linecap="round"></path></svg>
<div>
<h3 class="font-headline text-gold text-[11px] font-semibold uppercase tracking-wider mb-1">Handcrafted</h3>
<p class="text-stone-400 text-xs leading-relaxed">Built by skilled craftspeople, not machines.</p>
</div>
</div>
<div class="flex items-start gap-3.5">
<svg class="w-8 h-8 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24"><path d="M12 3a5 5 0 00-4.9 4A4 4 0 006 13.9V14h12v-.1A4 4 0 0016.9 7 5 5 0 0012 3z" stroke-linejoin="round"></path><path d="M12 14v7" stroke-linecap="round"></path></svg>
<div>
<h3 class="font-headline text-gold text-[11px] font-semibold uppercase tracking-wider mb-1">Premium materials</h3>
<p class="text-stone-400 text-xs leading-relaxed">We source the best woods and materials.</p>
</div>
</div>
<div class="flex items-start gap-3.5">
<svg class="w-8 h-8 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24"><path d="M12 3l7 3v5.5c0 4.3-2.9 7.9-7 9.5-4.1-1.6-7-5.2-7-9.5V6l7-3z" stroke-linejoin="round"></path><path d="M9.3 12.2l1.8 1.8 3.6-3.8" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<div>
<h3 class="font-headline text-gold text-[11px] font-semibold uppercase tracking-wider mb-1">Local &amp; trusted</h3>
<p class="text-stone-400 text-xs leading-relaxed">Proudly serving Brandon and nearby communities.</p>
</div>
</div>
</div>

</div>
</section>
<!-- END: OurStory -->

<!-- BEGIN: OurRoots -->
<section class="relative px-4 lg:px-12 py-12 lg:py-16 overflow-hidden">
<img alt="Tampa Bay skyline at sunset" class="absolute inset-0 w-full h-full object-cover" loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/pngtree-close-up-shot-of-acacia-wood-texture-image_13659025-915530926.png'  ?>"/>
<div class="absolute inset-0 bg-espresso/90"></div>

<div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[0.85fr_1fr_0.85fr] gap-8 lg:gap-10 items-center">

<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-3">Our roots</p>
<h2 class="font-headline font-semibold text-ivory text-2xl sm:text-3xl mb-5">Brandon, FL</h2>
<p class="text-stone-400 text-sm leading-relaxed mb-7">
        We're based in Brandon, and it's more than just our business location — it's our home. Our deep roots in <span class="text-gold">Brandon</span> and the surrounding <span class="text-gold">Tampa Bay</span> area drive us to deliver high-quality work to the local community, from <span class="text-gold">Valrico</span> and <span class="text-gold">Riverview</span> to <span class="text-gold">Tampa</span>, <span class="text-gold">St. Petersburg</span>, and beyond.
      </p>
<a class="inline-flex items-center gap-3 border border-stone-600 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-xs uppercase tracking-wider px-6 py-3.5 rounded transition" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
        View service areas
        <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>

<!-- Service-radius graphic (designed stand-in, not a geographic map — see note) -->
<div class="relative aspect-[4/3] rounded-lg border border-foundry bg-[#120b05]/80 overflow-hidden flex items-center justify-center">
        <iframe class="absolute inset-0 w-full h-full opacity-80" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3526.198263954929!2d-82.2932118!3d27.8958885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c2d32023f38cdb%3A0xb1bb15b46aace2c8!2sButcher%20Block%20Group!5e0!3m2!1sen!2sus!4v1789918392137!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>

<p class="absolute bottom-6 left-0 right-0 text-center font-headline text-ivory text-sm tracking-[0.15em] uppercase">Brandon</p>
</div>

<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-1">Proudly serving</p>
<span class="block h-px w-20 bg-gold/50 mb-5"></span>
<div class="grid grid-cols-2 gap-x-6 gap-y-3.5">
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Brandon</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Tampa</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Valrico</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Riverview</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Seffner</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Lithia</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Plant City</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Apollo Beach</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>St. Petersburg</span>
<span class="flex items-center gap-2 text-stone-300 text-sm"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>Clearwater</span>
</div>
<p class="text-stone-500 text-xs mt-4 pl-6">and surrounding areas</p>
</div>

</div>
</section>
<!-- END: OurRoots -->

<!-- BEGIN: WhatWeDo -->
<section class="bg-[#150d07] px-4 lg:px-12 py-12 lg:py-16">
<div class="max-w-7xl mx-auto">

<div class="grid grid-cols-1 lg:grid-cols-[0.9fr_1.1fr_auto] gap-8 items-center mb-8">
<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-3">What we do</p>
<h2 class="font-headline font-semibold text-ivory text-2xl sm:text-3xl leading-tight">
          Quality Craftsmanship.<br/>Every Project.
        </h2>
</div>
<p class="text-stone-400 text-sm leading-relaxed">
        From stunning kitchen countertops to custom dining tables, we create woodwork that fits your space and your style. Explore our gallery to see examples of our work, or check out our services to learn more about what we offer.
      </p>
<a class="inline-flex items-center justify-center gap-3 border border-stone-600 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-xs uppercase tracking-wider px-6 py-3.5 rounded transition shrink-0" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">
        View gallery
        <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
<!-- Servive Grid -->
 <?php
/**
 * Featured services. Limited to 4 so the row stays even — set menu_order
 * on the Services you want here, since this takes the first four.
 */
$bbg_cats = get_posts( array(
	'post_type'      => 'bg_service',
	'post_status'    => 'publish',
	'posts_per_page' => 4,
	'orderby'        => 'menu_order title',
	'order'          => 'ASC',
) );

if ( $bbg_cats ) : foreach ( $bbg_cats as $bbg_cat ) :
	$bbg_img = get_the_post_thumbnail_url( $bbg_cat->ID, 'bg-gallery-thumb' );
?>
<a class="cat-card" href="<?php echo esc_url( get_permalink( $bbg_cat->ID ) ); ?>">
	<?php if ( $bbg_img ) : ?>
		<img alt="<?php echo esc_attr( get_the_title( $bbg_cat ) ); ?>" class="w-full h-full object-cover" loading="lazy" src="<?php echo esc_url( $bbg_img ); ?>"/>
	<?php else : ?>
		<div class="w-full h-full bg-foundry"></div>
	<?php endif; ?>
	<div class="absolute inset-0 bg-gradient-to-t from-espresso via-espresso/30 to-transparent"></div>
	<span class="absolute bottom-4 left-4 right-4 flex items-center justify-between font-headline text-ivory text-sm font-semibold uppercase tracking-wide">
		<?php echo esc_html( get_the_title( $bbg_cat ) ); ?>
		<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
	</span>
</a>
<?php endforeach; endif; ?>
</div>

</div>
</section>
<!-- END: WhatWeDo -->

<!-- BEGIN: AboutCTA -->
<section class="relative px-4 lg:px-12 py-14 lg:py-16 overflow-hidden">
        
<img alt="Stacked hardwood in the workshop" class="absolute inset-0 w-full h-full object-cover" loading="lazy" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"/>
<div class="absolute inset-0 bg-gradient-to-t from-espresso via-transparent to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-espresso via-espresso/85 to-espresso/20"></div>
<div class="absolute inset-0 bg-espresso/88"></div>

<div class="relative z-10 max-w-4xl mx-auto text-center">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-4">Let's connect</p>
<h2 class="font-headline font-semibold text-ivory text-2xl sm:text-3xl lg:text-4xl mb-3">Ready to Build Your Project?</h2>
<p class="text-stone-300 text-sm mb-8">Have questions? Want a custom quote? We'd love to hear from you.</p>

<div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
<a class="inline-flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><path d="M6 3.5h3l1.4 4-2 1.6a12 12 0 005.5 5.5l1.6-2 4 1.4v3a1.5 1.5 0 01-1.6 1.5A16.5 16.5 0 014.5 5.1 1.5 1.5 0 016 3.5z" stroke-linejoin="round"></path></svg>
          Contact us
          <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
<a class="inline-flex items-center justify-center gap-3 border border-stone-500 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><rect height="16" rx="2" width="18" x="3" y="4"></rect><circle cx="8.5" cy="9.5" r="1.5"></circle><path d="M20 16l-5-5-8.5 8.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
          View gallery
          <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-0 max-w-3xl mx-auto">
<div class="flex items-center gap-3 justify-center sm:border-r sm:border-foundry sm:px-4">
<svg class="w-7 h-7 text-gold stroke-current fill-none shrink-0" stroke-width="1.4" viewbox="0 0 24 24"><path d="M12 3l7 3v5.5c0 4.3-2.9 7.9-7 9.5-4.1-1.6-7-5.2-7-9.5V6l7-3z" stroke-linejoin="round"></path><path d="M9.3 12.2l1.8 1.8 3.6-3.8" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<div class="text-left">
<p class="font-headline text-ivory text-[11px] font-semibold uppercase tracking-wider">Free consultation</p>
<p class="text-stone-400 text-xs">Discuss your vision.</p>
</div>
</div>
<div class="flex items-center gap-3 justify-center sm:border-r sm:border-foundry sm:px-4">
<svg class="w-7 h-7 text-gold stroke-current fill-none shrink-0" stroke-width="1.4" viewbox="0 0 24 24"><rect height="16" rx="1" width="16" x="4" y="5"></rect><path d="M8 2v4M16 2v4M8 11h8M8 15h4" stroke-linecap="round"></path></svg>
<div class="text-left">
<p class="font-headline text-ivory text-[11px] font-semibold uppercase tracking-wider">Accurate quote</p>
<p class="text-stone-400 text-xs">Based on your measurements.</p>
</div>
</div>
<div class="flex items-center gap-3 justify-center sm:px-4">
<svg class="w-7 h-7 text-gold stroke-current fill-none shrink-0" stroke-width="1.4" viewbox="0 0 24 24"><path d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<div class="text-left">
<p class="font-headline text-ivory text-[11px] font-semibold uppercase tracking-wider">Professional installation</p>
<p class="text-stone-400 text-xs">On time. On budget.</p>
</div>
</div>
</div>
</div>
</section>
<!-- END: AboutCTA -->

<?php get_footer();