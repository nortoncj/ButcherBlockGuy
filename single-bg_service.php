<?php
/**
 * single-bg_service.php — one template renders every service.
 * Converted from the static countertops.html prototype.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

if ( have_posts() ) : the_post();

$svc_id      = get_the_ID();
$svc_title   = get_the_title();
$svc_tagline = get_post_meta( $svc_id, 'tagline', true );
$svc_cat     = get_post_meta( $svc_id, 'gallery_category', true );
$svc_mode    = get_post_meta( $svc_id, 'pricing_mode', true ) ?: 'install';
$svc_hero    = get_the_post_thumbnail_url( $svc_id, 'full' );

// Gallery photos for this service, pulled by product type.
$svc_photos = ( $svc_cat && function_exists( 'bg_get_portfolio_items' ) )
	? array_slice( bg_get_portfolio_items( $svc_cat, 'all' ), 0, 4 )
	: array();

// Recommended finishes (relationship -> bg_finish).
$svc_finish_ids = (array) get_post_meta( $svc_id, 'finishes', false );
$svc_finish_ids = array_filter( array_map( 'intval', (array) ( is_array( reset( $svc_finish_ids ) ) ? reset( $svc_finish_ids ) : $svc_finish_ids ) ) );
$svc_finishes   = $svc_finish_ids ? get_posts( array(
	'post_type' => 'bg_finish', 'post__in' => $svc_finish_ids,
	'orderby' => 'post__in', 'posts_per_page' => -1,
) ) : array();

// Cities this service is offered in.
$svc_areas = function_exists( 'bbg_areas_for_service' ) ? bbg_areas_for_service( $svc_id ) : array();

$svc_home_city = bbg_opt( 'city', 'Brandon, FL' );
?>

<style data-purpose="page-styling">
body { background-color: #1c1108; color: #16110b; font-family: 'Manrope', sans-serif; }
    .font-headline { font-family: 'Oswald', sans-serif; letter-spacing: 0.03em; }
    .gal-card { position: relative; display: block; border-radius: 0.375rem; overflow: hidden; height: 11rem; border: 1px solid #2c2119; }
    .gal-card img { transition: transform .5s ease; }
    .gal-card:hover img { transform: scale(1.07); }
    .loc-btn { display: flex; align-items: center; justify-content: space-between; gap: .75rem; border: 1px solid rgba(168,117,46,.45); border-radius: 0.375rem; padding: .85rem 1rem; color: #e7e5e4; font-size: .875rem; transition: border-color .2s, background .2s; }
    .loc-btn:hover { border-color: #a8752e; background: rgba(168,117,46,.08); }
    @keyframes bbg-pulse { 0% { transform: scale(.8); opacity: .5; } 70% { transform: scale(1.4); opacity: 0; } 100% { opacity: 0; } }
    .ring { animation: bbg-pulse 3.2s ease-out infinite; transform-origin: center; }
    .ring:nth-of-type(2) { animation-delay: 1.05s; }
    .ring:nth-of-type(3) { animation-delay: 2.1s; }
    @media (prefers-reduced-motion: reduce) { .ring { animation: none; opacity: .3; } }
</style>
<!-- Breadcrumb — helps SEO and gives a route back to the hub -->
<div class="bg-[#150d07] px-4 lg:px-12 pt-5">
<nav aria-label="Breadcrumb" class="max-w-7xl mx-auto text-xs text-stone-500">
<a class="hover:text-gold transition" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a>
<span class="mx-2">/</span>
<span class="text-stone-300"><?php echo esc_html( $svc_title ); ?></span>
</nav>
</div>

<!-- BEGIN: ServiceHero -->
<section class="relative h-[46vh] min-h-[330px] w-full overflow-hidden">
<img alt="<?php echo esc_attr( $svc_title ); ?>" class="absolute inset-0 w-full h-full object-cover" src="<?php echo esc_url( $svc_hero ? $svc_hero : get_template_directory_uri() . "/assets/images/service-default.jpg" ); ?>"/>
<div class="absolute inset-0 bg-gradient-to-r from-espresso via-espresso/85 to-espresso/20"></div>
<div class="absolute inset-0 bg-gradient-to-t from-espresso via-transparent to-transparent"></div>
<div class="relative z-10 h-full max-w-7xl mx-auto px-6 lg:px-12 flex flex-col justify-center">
<p class="font-headline text-gold text-xs sm:text-sm tracking-[0.25em] uppercase mb-3">
      Built by hand. Meant to last.
    </p>
<h1 class="font-headline font-bold text-ivory uppercase leading-[0.95] text-4xl sm:text-5xl lg:text-6xl mb-4">
      <?php echo esc_html( $svc_title ); ?>
    </h1>
<p class="text-stone-300 text-sm sm:text-base mb-5">
      <?php echo esc_html( $svc_tagline ); ?>
    </p>
<span class="block h-0.5 w-16 bg-gold"></span>
</div>
</section>
<!-- END: ServiceHero -->

<!-- BEGIN: AboutService -->
<section class="bg-[#150d07] px-4 lg:px-12 py-12">
<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[0.9fr_1.1fr] gap-10 items-center">
<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-4">About this service</p>
<div class="text-stone-400 text-sm leading-relaxed [&_p]:mb-4"><?php the_content(); ?></div>
</div>
<div class="rounded border border-foundry overflow-hidden h-56 lg:h-64">
<img alt="End-grain butcher block countertop" class="w-full h-full object-cover" loading="lazy" src="https://images.pexels.com/photos/7601073/pexels-photo-7601073.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=900"/>
</div>
</div>
</section>
<!-- END: AboutService -->

<!-- BEGIN: FromTheGallery -->
<section class="bg-[#150d07] px-4 lg:px-12 pb-12">
<div class="max-w-7xl mx-auto">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-5">From the gallery</p>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
<?php if ( $svc_photos ) : foreach ( $svc_photos as $p ) : ?>
<a class="gal-card" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">
<img alt="<?php echo esc_attr( $p->bg_img_alt ? $p->bg_img_alt : get_the_title( $p->ID ) ); ?>" class="w-full h-full object-cover" loading="lazy" src="<?php echo esc_url( $p->bg_img_url ); ?>"/>
<div class="absolute inset-0 bg-gradient-to-t from-espresso via-espresso/25 to-transparent"></div>
<span class="absolute bottom-4 left-4 right-4 font-headline text-ivory text-sm font-semibold uppercase tracking-wide leading-tight"><?php echo esc_html( get_the_title( $p->ID ) ); ?></span>
</a>
<?php endforeach; else : ?>
<p class="text-stone-500 text-sm col-span-full">No photos tagged for this service yet — add them under Portfolio Gallery.</p>
<?php endif; ?>
</div>

<a class="inline-flex items-center gap-2 text-gold hover:text-gold-light text-sm font-medium mt-5 transition" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">
      See all <?php echo esc_html( strtolower( $svc_title ) ); ?> work
      <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>
</section>
<!-- END: FromTheGallery -->

<!-- BEGIN: RecommendedFinishes -->
<section class="bg-[#150d07] px-4 lg:px-12 pb-12">
<div class="max-w-7xl mx-auto">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-5">Recommended finishes</p>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
<?php if ( $svc_finishes ) : foreach ( $svc_finishes as $f ) : ?>
<div class="bg-[#140c06] border border-gold/40 rounded p-5 flex items-center gap-3.5">
<svg class="w-7 h-7 text-gold stroke-current fill-none shrink-0" stroke-width="1.4" viewbox="0 0 24 24"><path d="M12 3s6 6.5 6 10a6 6 0 01-12 0c0-3.5 6-10 6-10z" stroke-linejoin="round"></path></svg>
<div>
<h3 class="text-ivory text-sm font-semibold mb-0.5"><?php echo esc_html( get_the_title( $f->ID ) ); ?></h3>
<p class="text-stone-500 text-xs"><?php echo esc_html( get_post_meta( $f->ID, 'blurb', true ) ); ?></p>
</div>
</div>
<?php endforeach; else : ?>
<p class="text-stone-500 text-sm col-span-full">No finishes selected for this service yet.</p>
<?php endif; ?>
</div>
</div>
</section>
<!-- END: RecommendedFinishes -->

<!-- BEGIN: ServiceLocations -->
<section class="bg-[#150d07] px-4 lg:px-12 pb-12" id="service-locations">
<div class="max-w-7xl mx-auto">
<div class="h-px w-full bg-foundry mb-10"></div>

<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-4">Service locations</p>

<div class="grid grid-cols-1 lg:grid-cols-[1.15fr_0.85fr] gap-10 items-center">

<div>
<h2 class="font-headline font-semibold text-ivory text-xl sm:text-2xl mb-3">Find <?php echo esc_html( strtolower( $svc_title ) ); ?> services near you</h2>
<p class="text-stone-400 text-sm leading-relaxed mb-7 max-w-md">
          We proudly serve <?php echo esc_html( $svc_home_city ); ?> and the surrounding area. Click your location below to view service details, availability, and request a quote.
        </p>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
<?php if ( $svc_areas ) : foreach ( $svc_areas as $area ) :
            $area_city = get_post( (int) get_post_meta( $area->ID, 'city', true ) ); ?>
<a class="loc-btn" href="<?php echo esc_url( get_permalink( $area->ID ) ); ?>">
<span class="flex items-center gap-2.5">
<svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>
              <?php echo esc_html( $svc_title ); ?> in <?php echo esc_html( $area_city ? get_the_title( $area_city ) : '' ); ?>
            </span>
<svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
<?php endforeach; else : ?>
<p class="text-stone-500 text-sm sm:col-span-2">No service areas published for this service yet.</p>
<?php endif; ?>
</div>
</div>

<!-- Service-radius graphic (designed stand-in, not a geographic map) -->
<div class="flex items-center gap-5">
<div class="relative aspect-square flex-1 rounded-lg border border-foundry bg-[#120b05]/80 overflow-hidden flex items-center justify-center">
<svg class="absolute inset-0 w-full h-full opacity-20" aria-hidden="true">
<defs>
<pattern height="28" id="sgrid" patternUnits="userSpaceOnUse" width="28">
<path d="M28 0H0v28" fill="none" stroke="#a8752e" stroke-width="0.7"></path>
</pattern>
</defs>
<rect fill="url(#sgrid)" height="100%" width="100%"></rect>
</svg>
<svg class="relative w-44 h-44" viewbox="0 0 200 200" aria-hidden="true">
<circle class="ring" cx="100" cy="100" fill="none" r="68" stroke="#a8752e" stroke-width="1.4"></circle>
<circle class="ring" cx="100" cy="100" fill="none" r="68" stroke="#a8752e" stroke-width="1.4"></circle>
<circle class="ring" cx="100" cy="100" fill="none" r="68" stroke="#a8752e" stroke-width="1.4"></circle>
<circle cx="100" cy="100" fill="none" r="42" stroke="#a8752e" stroke-opacity=".28" stroke-width="1"></circle>
<circle cx="100" cy="100" fill="none" r="64" stroke="#a8752e" stroke-opacity=".18" stroke-width="1"></circle>
<path d="M100 86a10 10 0 00-10 10c0 7.5 10 17 10 17s10-9.5 10-17a10 10 0 00-10-10z" fill="#a8752e"></path>
<circle cx="100" cy="95.5" fill="#f4e7d3" r="3.4"></circle>
</svg>
<p class="absolute bottom-5 left-0 right-0 text-center font-headline text-ivory text-xs tracking-[0.15em] uppercase"><?php echo esc_html( $svc_home_city ); ?></p>
</div>
<div class="shrink-0">
<p class="font-headline text-gold text-sm font-semibold mb-2">Tampa Bay area</p>
<p class="text-stone-400 text-xs leading-relaxed"><?php
              $names = array();
              foreach ( $svc_areas as $a ) { $cp = get_post( (int) get_post_meta( $a->ID, 'city', true ) ); if ( $cp ) { $names[] = get_the_title( $cp ); } }
              echo esc_html( implode( ' • ', $names ) );
            ?></p>
</div>
</div>

</div>
</div>
</section>
<!-- END: ServiceLocations -->

<!-- BEGIN: ServiceCTAPanel -->
<section class="bg-[#150d07] px-4 lg:px-12 pb-14">
<div class="max-w-7xl mx-auto">
<div class="rounded-lg border border-foundry bg-gradient-to-r from-[#241609] to-[#160d06] p-8 grid grid-cols-1 lg:grid-cols-[1.4fr_auto_1fr] gap-8 items-center">

<div class="flex items-start gap-5">
<svg class="w-14 h-14 text-gold stroke-current fill-none shrink-0 hidden sm:block" stroke-width="1.2" viewbox="0 0 24 24"><rect height="18" rx="2" width="16" x="4" y="3"></rect><rect height="3.5" rx="0.6" width="10" x="7" y="6"></rect><circle cx="8.5" cy="13" r=".9"></circle><circle cx="12" cy="13" r=".9"></circle><circle cx="15.5" cy="13" r=".9"></circle><circle cx="8.5" cy="17" r=".9"></circle><circle cx="12" cy="17" r=".9"></circle><circle cx="15.5" cy="17" r=".9"></circle></svg>
<div>
<h2 class="font-headline font-bold text-ivory uppercase text-xl sm:text-2xl mb-2">Ready to see what it'd cost?</h2>
<p class="text-stone-400 text-sm mb-5">Get a quick estimate or send us the details of your project.</p>
<a class="inline-flex items-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-xs uppercase tracking-wider px-7 py-3.5 rounded transition" href="<?php echo esc_url( home_url( '/pricing/#' . $svc_mode ) ); ?>">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><rect height="16" rx="1" width="16" x="4" y="5"></rect><path d="M8 2v4M16 2v4M8 11h8M8 15h4" stroke-linecap="round"></path></svg>
              Open pricing calculator
              <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>
</div>

<div aria-hidden="true" class="hidden lg:block w-px self-stretch bg-foundry"></div>

<div class="flex items-start gap-4">
<svg class="w-11 h-11 text-gold stroke-current fill-none shrink-0" stroke-width="1.2" viewbox="0 0 24 24"><circle cx="12" cy="12" r="9.5"></circle><path d="M8.5 7.5h1.6l.8 2.2-1.1.9a7 7 0 003.6 3.6l.9-1.1 2.2.8v1.6a.9.9 0 01-1 .9A10 10 0 018.5 8.5z" stroke-linejoin="round"></path></svg>
<div>
<h3 class="font-headline text-ivory text-sm font-semibold uppercase tracking-wider mb-1">Get in touch</h3>
<p class="text-stone-400 text-xs mb-4">Have questions? We're here to help.</p>
<a class="inline-flex items-center gap-2.5 border border-stone-600 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-xs uppercase tracking-wider px-6 py-3 rounded transition" href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><path d="M6 3.5h3l1.4 4-2 1.6a12 12 0 005.5 5.5l1.6-2 4 1.4v3a1.5 1.5 0 01-1.6 1.5A16.5 16.5 0 014.5 5.1 1.5 1.5 0 016 3.5z" stroke-linejoin="round"></path></svg>
              Call now
              <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>
</div>

</div>
</div>
</section>
<!-- END: ServiceCTAPanel -->

<!-- BEGIN: ClosingBanner -->
<section class="relative px-4 lg:px-12 py-16 overflow-hidden">
<img alt="Finished butcher block surface" class="absolute inset-0 w-full h-full object-cover" loading="lazy" src="https://images.pexels.com/photos/37162560/pexels-photo-37162560.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1600"/>
<div class="absolute inset-0 bg-espresso/88"></div>
<div class="relative z-10 max-w-3xl mx-auto text-center">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-4">Quality work. Local service.</p>
<h2 class="font-headline font-bold text-ivory uppercase text-3xl sm:text-4xl mb-3">Let's build something great</h2>
<p class="text-stone-300 text-sm mb-8">Choose your location to get started or give us a call today.</p>
<div class="flex flex-col sm:flex-row gap-4 justify-center">
<a class="inline-flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="#service-locations">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.5"></circle></svg>
          View service locations
          <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
<a class="inline-flex items-center justify-center gap-3 border border-stone-500 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><path d="M6 3.5h3l1.4 4-2 1.6a12 12 0 005.5 5.5l1.6-2 4 1.4v3a1.5 1.5 0 01-1.6 1.5A16.5 16.5 0 014.5 5.1 1.5 1.5 0 016 3.5z" stroke-linejoin="round"></path></svg>
          Call now
          <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>
</div>
</section>
<!-- END: ClosingBanner -->

<?php
else :
	echo '<p style="padding:4rem;text-align:center;color:#877270;">Service not found.</p>';
endif;

get_footer();
