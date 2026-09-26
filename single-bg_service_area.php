<?php
/**
 * single-bg_service_area.php — one template renders all service x city pages.
 * Converted from the static tampa.html prototype.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

if ( have_posts() ) : the_post();

$area_id   = get_the_ID();
$svc_post  = get_post( (int) get_post_meta( $area_id, 'service', true ) );
$city_post = get_post( (int) get_post_meta( $area_id, 'city', true ) );

$svc_name  = $svc_post  ? get_the_title( $svc_post )  : '';
$city_name = $city_post ? get_the_title( $city_post ) : '';

$hero_intro = get_post_meta( $area_id, 'hero_intro', true );
$why_city   = $city_post ? get_post_meta( $city_post->ID, 'why_city', true ) : '';
$landmarks  = $city_post ? bbg_lines( get_post_meta( $city_post->ID, 'landmarks', true ) ) : array();

$city_img   = '';
if ( $city_post ) {
	$ci = get_post_meta( $city_post->ID, 'hero_image', true );
	if ( is_array( $ci ) && ! empty( $ci['ID'] ) ) { $city_img = wp_get_attachment_image_url( (int) $ci['ID'], 'full' ); }
	elseif ( $ci ) { $city_img = wp_get_attachment_image_url( (int) $ci, 'full' ); }
}

// Local projects — relationship to bg_gallery. Intentionally shows nothing
// rather than borrowing another city's work.
$proj_ids = get_post_meta( $area_id, 'projects', true );
$proj_ids = array_filter( array_map( 'intval', (array) $proj_ids ) );
$projects = $proj_ids ? get_posts( array(
	'post_type' => 'bg_gallery', 'post__in' => $proj_ids,
	'orderby' => 'post__in', 'posts_per_page' => 4,
) ) : array();

$siblings = function_exists( 'bbg_sibling_areas' ) ? bbg_sibling_areas( $area_id ) : array();
?>

<style data-purpose="page-styling">
body { background-color: #1c1108; color: #16110b; font-family: 'Manrope', sans-serif; }
    .font-headline { font-family: 'Oswald', sans-serif; letter-spacing: 0.03em; }
    .proj-card { border: 1px solid #2c2119; border-radius: 0.375rem; overflow: hidden; background: #140c06; display: block; }
    .proj-card img { transition: transform .5s ease; }
    .proj-card:hover img { transform: scale(1.06); }
    .proj-card:hover { border-color: rgba(168,117,46,.6); }
    @keyframes bbg-pulse { 0% { transform: scale(.8); opacity: .5; } 70% { transform: scale(1.4); opacity: 0; } 100% { opacity: 0; } }
    .ring { animation: bbg-pulse 3.2s ease-out infinite; transform-origin: center; }
    .ring:nth-of-type(2) { animation-delay: 1.05s; }
    .ring:nth-of-type(3) { animation-delay: 2.1s; }
    @media (prefers-reduced-motion: reduce) { .ring { animation: none; opacity: .3; } }
</style>
<!-- BEGIN: LocationHero -->
<section class="relative min-h-[460px] w-full overflow-hidden">
<img alt="<?php echo esc_attr( $svc_name . " in " . $city_name ); ?>" class="absolute inset-0 w-full h-full object-cover" src="<?php echo esc_url( $city_img ? $city_img : get_the_post_thumbnail_url( $svc_post, "full" ) ); ?>"/>
<div class="absolute inset-0 bg-gradient-to-r from-espresso via-espresso/88 to-espresso/25"></div>
<div class="absolute inset-0 bg-gradient-to-t from-espresso via-transparent to-transparent"></div>

<div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 pt-6 pb-12">
<nav aria-label="Breadcrumb" class="flex items-center gap-2 font-headline text-[11px] uppercase tracking-wider mb-8">
<a class="text-gold hover:text-gold-light transition" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a>
<svg class="w-3 h-3 text-stone-600 stroke-current fill-none" stroke-width="2.5" viewbox="0 0 24 24"><path d="M9 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<a class="text-gold hover:text-gold-light transition" href="<?php echo esc_url( home_url( '/countertops/' ) ); ?>"><?php echo esc_html( $svc_name ); ?></a>
<svg class="w-3 h-3 text-stone-600 stroke-current fill-none" stroke-width="2.5" viewbox="0 0 24 24"><path d="M9 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<span class="text-stone-300"><?php echo esc_html( $city_name ); ?></span>
</nav>

<p class="font-headline text-gold text-xs sm:text-sm tracking-[0.25em] uppercase mb-3">
      Local experts. Lasting quality.
    </p>
<h1 class="font-headline font-bold text-ivory uppercase leading-[0.95] text-4xl sm:text-5xl lg:text-6xl mb-5">
      <?php echo esc_html( $svc_name ); ?><br/>in <?php echo esc_html( $city_name ); ?>
    </h1>
<p class="text-stone-300 text-sm sm:text-base max-w-md leading-relaxed mb-8"><?php echo esc_html( $hero_intro ); ?></p>

<div class="flex flex-wrap gap-8">
<div class="flex items-center gap-3">
<svg class="w-9 h-9 text-gold stroke-current fill-none shrink-0" stroke-width="1.2" viewbox="0 0 24 24"><path d="M12 2.5l8.5 4.9v9.2L12 21.5 3.5 16.6V7.4L12 2.5z" stroke-linejoin="round"></path><circle cx="12" cy="12" r="3"></circle></svg>
<div>
<p class="font-headline text-gold text-[10px] font-semibold uppercase tracking-wider">Local experience</p>
<p class="text-stone-400 text-xs">We know <?php echo esc_html( $city_name ); ?>.</p>
</div>
</div>
<div class="flex items-center gap-3">
<svg class="w-9 h-9 text-gold stroke-current fill-none shrink-0" stroke-width="1.2" viewbox="0 0 24 24"><path d="M12 2.5l8.5 4.9v9.2L12 21.5 3.5 16.6V7.4L12 2.5z" stroke-linejoin="round"></path><path d="M12 7l4.5 2.6v5.2L12 17.4 7.5 14.8V9.6L12 7z" stroke-linejoin="round"></path></svg>
<div>
<p class="font-headline text-gold text-[10px] font-semibold uppercase tracking-wider">Premium materials</p>
<p class="text-stone-400 text-xs">Built to last.</p>
</div>
</div>
<div class="flex items-center gap-3">
<svg class="w-9 h-9 text-gold stroke-current fill-none shrink-0" stroke-width="1.2" viewbox="0 0 24 24"><rect height="13" rx="2" width="16" x="4" y="6"></rect><path d="M8 6V4M16 6V4M4 11h16" stroke-linecap="round"></path><path d="M9 15l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<div>
<p class="font-headline text-gold text-[10px] font-semibold uppercase tracking-wider">Custom fit</p>
<p class="text-stone-400 text-xs">Your space, your style.</p>
</div>
</div>
</div>
</div>

<div class="absolute bottom-6 right-6 z-10 hidden lg:flex items-center gap-2 border-b border-gold/60 pb-1.5 pr-8">
<svg class="w-4 h-4 text-gold stroke-current fill-none" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>
<span class="text-ivory text-sm italic"><?php echo esc_html( $city_name ); ?></span>
</div>
</section>
<!-- END: LocationHero -->

<!-- BEGIN: WhyCity -->
<section class="bg-[#150d07] px-4 lg:px-12 py-12 lg:py-14">
<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[1fr_1.05fr] gap-10">

<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-3">Why <?php echo esc_html( $city_name ); ?>?</p>
<h2 class="font-headline font-bold text-ivory uppercase text-2xl sm:text-3xl leading-tight mb-5">
        Local knowledge.<br/>Better results.
      </h2>
<p class="text-stone-400 text-sm leading-relaxed mb-8 max-w-md"><?php echo esc_html( $why_city ); ?></p>

<!-- Service area panel -->
<div class="rounded-lg border border-foundry bg-[#120b05] p-6">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-1.5">Our service area</p>
<p class="text-stone-400 text-xs mb-5">Proudly serving all of <?php echo esc_html( $city_name ); ?> and surrounding areas.</p>

<div class="grid grid-cols-1 sm:grid-cols-[1.15fr_0.85fr] gap-5">
<!-- Locator graphic (designed stand-in — not a geographic map) -->
<div class="relative aspect-square rounded border border-foundry bg-[#0e0804] overflow-hidden flex items-center justify-center">
<svg class="absolute inset-0 w-full h-full opacity-20" aria-hidden="true">
<defs>
<pattern height="26" id="lgrid" patternUnits="userSpaceOnUse" width="26">
<path d="M26 0H0v26" fill="none" stroke="#a8752e" stroke-width="0.7"></path>
</pattern>
</defs>
<rect fill="url(#lgrid)" height="100%" width="100%"></rect>
</svg>
<svg class="relative w-40 h-40" viewbox="0 0 200 200" aria-hidden="true">
<circle class="ring" cx="100" cy="100" fill="none" r="66" stroke="#a8752e" stroke-width="1.4"></circle>
<circle class="ring" cx="100" cy="100" fill="none" r="66" stroke="#a8752e" stroke-width="1.4"></circle>
<circle class="ring" cx="100" cy="100" fill="none" r="66" stroke="#a8752e" stroke-width="1.4"></circle>
<circle cx="100" cy="100" fill="none" r="40" stroke="#a8752e" stroke-opacity=".28" stroke-width="1"></circle>
<circle cx="100" cy="100" fill="none" r="62" stroke="#a8752e" stroke-opacity=".18" stroke-width="1"></circle>
<path d="M100 86a10 10 0 00-10 10c0 7.5 10 17 10 17s10-9.5 10-17a10 10 0 00-10-10z" fill="#a8752e"></path>
<circle cx="100" cy="95.5" fill="#f4e7d3" r="3.4"></circle>
</svg>
<p class="absolute bottom-4 left-0 right-0 text-center font-headline text-ivory text-sm tracking-[0.12em] uppercase"><?php echo esc_html( $city_name ); ?></p>
</div>

<div>
<p class="font-headline text-gold text-[10px] font-semibold uppercase tracking-wider mb-3">Major roads &amp; landmarks</p>
<ul class="space-y-2.5">
<?php if ( $landmarks ) : foreach ( $landmarks as $lm ) : ?>
<li class="flex items-center gap-2.5 text-stone-300 text-xs"><svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.5" viewbox="0 0 24 24"><path d="M8 21L10 3M16 21L14 3M12 7v2M12 12v2M12 17v2" stroke-linecap="round"></path></svg><?php echo esc_html( $lm ); ?></li>
<?php endforeach; else : ?>
<li class="text-stone-500 text-xs">Add roads &amp; landmarks on the City record.</li>
<?php endif; ?>
</ul>
</div>
</div>
</div>

</div>
</section>
<!-- END: WhyCity -->

<!-- BEGIN: RecentProjects -->
<section class="bg-[#150d07] px-4 lg:px-12 pb-12 lg:pb-16">
<div class="max-w-7xl mx-auto">
<div class="flex flex-wrap items-end justify-between gap-4 mb-6">
<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-2">Recent projects in <?php echo esc_html( $city_name ); ?></p>
<h2 class="font-headline font-bold text-ivory uppercase text-2xl sm:text-3xl mb-2">Real homes. Real results.</h2>
<p class="text-stone-400 text-sm">See some of our latest <?php echo esc_html( strtolower( $svc_name ) ); ?> projects in the <?php echo esc_html( $city_name ); ?> area.</p>
</div>
<a class="inline-flex items-center gap-2 font-headline text-gold hover:text-gold-light text-xs uppercase tracking-wider border-b border-gold/50 pb-1 transition" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">
        View all projects
        <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
<?php if ( $projects ) : foreach ( $projects as $pr ) :
          $pr_city  = get_post( (int) get_post_meta( $pr->ID, 'job_city', true ) );
          $pr_thumb = get_the_post_thumbnail_url( $pr->ID, 'bg-gallery-thumb' );
          $pr_wood  = get_post_meta( $pr->ID, 'bg_wood_type', true );
          $pr_wood  = $pr_wood ? ucwords( str_replace( '-', ' ', $pr_wood ) ) : '';
        ?>
<a class="proj-card" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">
<div class="h-40 overflow-hidden">
<img alt="<?php echo esc_attr( get_the_title( $pr->ID ) ); ?>" class="w-full h-full object-cover" loading="lazy" src="<?php echo esc_url( $pr_thumb ); ?>"/>
</div>
<div class="p-4 space-y-2">
<p class="flex items-center gap-2 text-stone-300 text-xs"><svg class="w-3.5 h-3.5 text-gold stroke-current fill-none shrink-0" stroke-width="1.7" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg><?php echo esc_html( $pr_city ? get_the_title( $pr_city ) : $city_name ); ?></p>
<p class="flex items-center gap-2 text-stone-400 text-xs"><svg class="w-3.5 h-3.5 text-gold stroke-current fill-none shrink-0" stroke-width="1.7" viewbox="0 0 24 24"><circle cx="12" cy="12" r="8.5"></circle><path d="M12 3.5v17M3.5 12h17" stroke-linecap="round"></path></svg><?php echo esc_html( $pr_wood ); ?></p>
</div>
</a>
<?php endforeach; else : ?>
<p class="text-stone-500 text-sm col-span-full">No local projects linked yet. Better to show none than work from another city.</p>
<?php endif; ?>
</div>
</div>
</section>
<!-- END: RecentProjects -->

<!-- BEGIN: LocationCTA -->
<section class="relative px-4 lg:px-12 py-14 overflow-hidden">
<img alt="<?php echo esc_attr( $city_name ); ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy" src="<?php echo esc_url( $city_img ? $city_img : get_template_directory_uri() . '/assets/images/city-default.jpg' ); ?>"/>
<div class="absolute inset-0 bg-espresso/88"></div>

<div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[1.2fr_auto_0.9fr] gap-10 items-center">
<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-4">Ready to get started?</p>
<h2 class="font-headline font-bold text-ivory uppercase text-3xl sm:text-4xl leading-[0.95] mb-4">
        Let's build your<br/><?php echo esc_html( $city_name ); ?> project
      </h2>
<p class="text-stone-300 text-sm mb-8">Get a free quote or talk with our team about your <?php echo esc_html( strtolower( $svc_name ) ); ?> needs.</p>
<div class="flex flex-col sm:flex-row gap-4">
<a class="inline-flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><path d="M9 12h6m-6 4h4M7 3h7l5 5v11a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
          Get a quote
          <svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</a>
<a class="inline-flex items-center justify-center gap-3 border border-stone-500 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><path d="M6 3.5h3l1.4 4-2 1.6a12 12 0 005.5 5.5l1.6-2 4 1.4v3a1.5 1.5 0 01-1.6 1.5A16.5 16.5 0 014.5 5.1 1.5 1.5 0 016 3.5z" stroke-linejoin="round"></path></svg>
          Call now
        </a>
</div>
</div>

<div aria-hidden="true" class="hidden lg:block w-px self-stretch bg-gold/30"></div>

<div class="space-y-6">
<div class="flex items-start gap-3.5">
<svg class="w-8 h-8 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24"><path d="M12 3l7 3v5.5c0 4.3-2.9 7.9-7 9.5-4.1-1.6-7-5.2-7-9.5V6l7-3z" stroke-linejoin="round"></path><path d="M9.3 12.2l1.8 1.8 3.6-3.8" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<div>
<p class="font-headline text-ivory text-[11px] font-semibold uppercase tracking-wider mb-0.5">Free consultation</p>
<p class="text-stone-400 text-xs">Discuss your vision and needs.</p>
</div>
</div>
<div class="flex items-start gap-3.5">
<svg class="w-8 h-8 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3.2 2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<div>
<p class="font-headline text-ivory text-[11px] font-semibold uppercase tracking-wider mb-0.5">Accurate quote</p>
<p class="text-stone-400 text-xs">Based on your measurements &amp; material.</p>
</div>
</div>
<div class="flex items-start gap-3.5">
<svg class="w-8 h-8 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24"><rect height="12" rx="2" width="17" x="3.5" y="7"></rect><path d="M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2" stroke-linejoin="round"></path><path d="M9.5 13l2 2 3.5-3.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<div>
<p class="font-headline text-ivory text-[11px] font-semibold uppercase tracking-wider mb-0.5">Professional installation</p>
<p class="text-stone-400 text-xs">On time. On budget. Done right.</p>
</div>
</div>
</div>
</div>
</section>
<!-- END: LocationCTA -->

<?php if ( $siblings ) : ?>
<!-- BEGIN: NearbyAreas -->
<section class="bg-[#150d07] px-4 lg:px-12 py-10">
<div class="max-w-7xl mx-auto">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-4">Also serving nearby</p>
<div class="flex flex-wrap gap-3">
<?php foreach ( $siblings as $sib ) :
  $sib_city = get_post( (int) get_post_meta( $sib->ID, 'city', true ) ); ?>
<a class="inline-flex items-center gap-2 border border-stone-700 hover:border-gold text-stone-300 hover:text-gold text-sm px-4 py-2.5 rounded transition" href="<?php echo esc_url( get_permalink( $sib->ID ) ); ?>">
<svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.3"></circle></svg>
<?php echo esc_html( $sib_city ? get_the_title( $sib_city ) : '' ); ?>
</a>
<?php endforeach; ?>
</div>
</div>
</section>
<!-- END: NearbyAreas -->
<?php endif; ?>

<?php
else :
	echo '<p style="padding:4rem;text-align:center;color:#877270;">Page not found.</p>';
endif;

get_footer();
