<?php
/**
 * Template Name: Services Hub
 *
 * Converted from the static services.html prototype.
 * Header and footer now come from header.php / footer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<style data-purpose="page-styling">
body { background-color: #1c1108; color: #16110b; font-family: 'Manrope', sans-serif; }
    .font-headline { font-family: 'Oswald', sans-serif; letter-spacing: 0.03em; }
    .svc-card { background: #140c06; border: 1px solid #2c2119; border-radius: 0.375rem; overflow: hidden; display: flex; flex-direction: column; transition: border-color .25s, transform .25s; }
    .svc-card:hover { border-color: rgba(168,117,46,.65); transform: translateY(-3px); }
    .svc-card:hover img { transform: scale(1.06); }
    .svc-card img { transition: transform .5s ease; }
</style>
<!-- BEGIN: ServicesHero -->
<section class="relative h-[48vh] min-h-[340px] w-full overflow-hidden">
<img alt="Butcher block slab resting on a workshop bench" class="absolute inset-0 w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"/>
<div class="absolute inset-0 bg-gradient-to-r from-espresso via-espresso/85 to-espresso/25"></div>
<div class="absolute inset-0 bg-gradient-to-t from-espresso via-transparent to-transparent"></div>
<div class="relative z-10 h-full max-w-7xl mx-auto px-6 lg:px-12 flex flex-col justify-center">
<p class="font-headline text-gold text-xs sm:text-sm tracking-[0.25em] uppercase mb-3">
      Built by hand. Meant to last.
    </p>
<h1 class="font-headline font-bold text-ivory uppercase leading-[0.95] text-4xl sm:text-5xl lg:text-6xl mb-4">
      Our services
    </h1>
<p class="text-stone-300 text-sm sm:text-base mb-6">
      Custom woodwork, built around your space
    </p>
<span class="block h-0.5 w-16 bg-gold"></span>
</div>
</section>
<!-- END: ServicesHero -->

<!-- BEGIN: ServicesGrid -->
<section class="bg-[#150d07] px-4 lg:px-12 py-10 lg:py-14">
<div class="max-w-7xl mx-auto">

<p class="text-center text-stone-400 text-sm italic mb-10 max-w-3xl mx-auto">
      This is the service hub page — each card below links out to its own dedicated service page.
    </p>


<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-5">What we build</p>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

<?php
/**
 * All published services. Unlike the homepage (capped at 5), the hub
 * shows every one. The "Not sure yet?" card after the loop is not a
 * service — it's a lead-capture card pointing at Contact.
 */
$bbg_services = get_posts( array(
	'post_type'      => 'bg_service',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order title',
	'order'          => 'ASC',
) );

foreach ( $bbg_services as $bbg_svc ) :
	$bbg_img   = get_the_post_thumbnail_url( $bbg_svc->ID, 'bg-gallery-thumb' );
	$bbg_blurb = get_post_meta( $bbg_svc->ID, 'card_blurb', true );
	if ( ! $bbg_blurb ) {
		$bbg_blurb = wp_trim_words( wp_strip_all_tags( $bbg_svc->post_content ), 12 );
	}
?>
<a class="svc-card" href="<?php echo esc_url( get_permalink( $bbg_svc->ID ) ); ?>">
<div class="relative h-44 overflow-hidden">
	<?php if ( $bbg_img ) : ?>
		<img alt="<?php echo esc_attr( get_the_title( $bbg_svc ) ); ?>" class="w-full h-full object-cover" loading="lazy" src="<?php echo esc_url( $bbg_img ); ?>"/>
	<?php else : ?>
		<div class="w-full h-full bg-foundry"></div>
	<?php endif; ?>
	<div class="absolute inset-0 bg-gradient-to-t from-[#140c06] via-transparent to-transparent"></div>
</div>
<div class="p-5 flex flex-col flex-1">
	<span class="mb-3 block"><?php echo bbg_service_icon( $bbg_svc->post_name, 'w-7 h-7 text-gold stroke-current fill-none' ); ?></span>
	<h3 class="font-headline text-ivory text-base font-semibold uppercase tracking-wide mb-2"><?php echo esc_html( get_the_title( $bbg_svc ) ); ?></h3>
	<p class="text-stone-400 text-sm leading-relaxed mb-4 flex-1"><?php echo esc_html( $bbg_blurb ); ?></p>
	<span class="inline-flex items-center gap-2 text-gold text-sm font-medium">Learn more
		<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
	</span>
</div>
</a>
<?php endforeach; ?>

<?php if ( ! $bbg_services ) : ?>
<p class="col-span-full text-center text-stone-500 text-sm py-12">
	No services published yet &mdash; add them under <strong>Services</strong> in the admin.
</p>
<?php endif; ?>
<?php
$bbg_page_id  = get_queried_object_id();
              $extra_image  = $bbg_page_id ? get_post_meta( $bbg_page_id, '_frontpage_image', true ) : '';
?>
<!-- Static: lead capture, not a service -->
<a class="svc-card" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
<div class="relative h-44 overflow-hidden">
<img alt="Live edge slabs in the workshop" class="w-full h-full object-cover" loading="lazy" src="<?php echo $extra_image  ?>"/>
<div class="absolute inset-0 bg-gradient-to-t from-[#140c06] via-transparent to-transparent"></div>
</div>
<div class="p-5 flex flex-col flex-1">
<svg class="w-7 h-7 text-gold stroke-current fill-none mb-3" stroke-width="1.4" viewbox="0 0 24 24"><path d="M9 18h6M10 21h4M12 3a6 6 0 00-3.5 10.9c.3.3.5.7.5 1.1h6c0-.4.2-.8.5-1.1A6 6 0 0012 3z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<h3 class="font-headline text-ivory text-base font-semibold uppercase tracking-wide mb-2">Not sure yet?</h3>
<p class="text-stone-400 text-sm leading-relaxed mb-4 flex-1">Let's build something together</p>
<span class="inline-flex items-center gap-2 text-gold text-sm font-medium">Learn more
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</span>
</div>
</a>

</div>

</div>
</section>
<!-- END: ServicesGrid -->

<!-- BEGIN: HowItsMade -->
<section class="bg-[#150d07] px-4 lg:px-12 pb-10">
<div class="max-w-7xl mx-auto">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-6">How it's made</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="flex items-start gap-4">
<svg class="w-11 h-11 text-gold stroke-current fill-none shrink-0" stroke-width="1.2" viewbox="0 0 24 24">
<ellipse cx="7" cy="12" rx="3" ry="7"></ellipse>
<path d="M7 5h10a7 7 0 010 14H7" stroke-linejoin="round"></path>
<ellipse cx="7" cy="12" rx="1.2" ry="3"></ellipse>
</svg>
<div>
<h3 class="font-headline text-ivory text-sm font-semibold uppercase tracking-wider mb-1.5">Premium precut hardwood</h3>
<p class="text-stone-400 text-sm leading-relaxed">Sourced pre-glued blanks in Acacia, Hevea, Walnut, and more</p>
</div>
</div>

<div class="flex items-start gap-4">
<svg class="w-11 h-11 text-gold stroke-current fill-none shrink-0" stroke-width="1.2" viewbox="0 0 24 24">
<circle cx="12" cy="12" r="6.5"></circle>
<circle cx="12" cy="12" r="1.6"></circle>
<path d="M12 2.2v2M12 19.8v2M2.2 12h2M19.8 12h2M5 5l1.4 1.4M17.6 17.6L19 19M19 5l-1.4 1.4M6.4 17.6L5 19" stroke-linecap="round"></path>
</svg>
<div>
<h3 class="font-headline text-ivory text-sm font-semibold uppercase tracking-wider mb-1.5">Custom cut &amp; shaped</h3>
<p class="text-stone-400 text-sm leading-relaxed">Sized, edged, and cut out to fit your exact space</p>
</div>
</div>

<div class="flex items-start gap-4">
<svg class="w-11 h-11 text-gold stroke-current fill-none shrink-0" stroke-width="1.2" viewbox="0 0 24 24">
<path d="M8 13.5c0-2 1.5-3 3.5-3h5.5" stroke-linecap="round"></path>
<path d="M4 17c1.5-1.5 3-2 5-2" stroke-linecap="round"></path>
<path d="M14.5 8.5a3.5 3.5 0 113.7 5.8c-1.5.6-3.2.7-4.7.7H9a5 5 0 00-5 5" stroke-linejoin="round"></path>
</svg>
<div>
<h3 class="font-headline text-ivory text-sm font-semibold uppercase tracking-wider mb-1.5">Hand-finished</h3>
<p class="text-stone-400 text-sm leading-relaxed">Oil, wax, or poly, finished to your spec</p>
</div>
</div>
</div>

<p class="text-stone-500 text-xs italic mt-7 leading-relaxed">
      Note: pieces start from quality precut hardwood, not milled from rough lumber — the craft here is the custom fit and the finish.
    </p>
</div>
</section>
<!-- END: HowItsMade -->

<!-- BEGIN: FinishOptions -->
<section class="bg-[#150d07] px-4 lg:px-12 pb-12">
<div class="max-w-7xl mx-auto">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-5">Finish options</p>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
<div class="bg-[#140c06] border border-[#2c2119] rounded p-5 flex items-start gap-3.5">
<svg class="w-7 h-7 text-gold stroke-current fill-none shrink-0" stroke-width="1.4" viewbox="0 0 24 24"><path d="M12 3s6 6.5 6 10a6 6 0 01-12 0c0-3.5 6-10 6-10z" stroke-linejoin="round"></path></svg>
<div>
<h3 class="font-headline text-ivory text-sm font-semibold uppercase tracking-wider mb-1.5">Natural oil</h3>
<p class="text-stone-400 text-xs leading-relaxed">Food-safe, matte, needs occasional re-oiling</p>
</div>
</div>

<div class="bg-[#140c06] border border-[#2c2119] rounded p-5 flex items-start gap-3.5">
<svg class="w-7 h-7 text-gold stroke-current fill-none shrink-0" stroke-width="1.4" viewbox="0 0 24 24"><path d="M19 5c0 7-4.5 12-11 13 0-7 4-12 11-13z" stroke-linejoin="round"></path><path d="M8 18c1-3.5 3-6 6-8" stroke-linecap="round"></path></svg>
<div>
<h3 class="font-headline text-ivory text-sm font-semibold uppercase tracking-wider mb-1.5">Food-safe wax</h3>
<p class="text-stone-400 text-xs leading-relaxed">Extra sheen and protection over oil</p>
</div>
</div>

<div class="bg-[#140c06] border border-[#2c2119] rounded p-5 flex items-start gap-3.5">
<svg class="w-7 h-7 text-gold stroke-current fill-none shrink-0" stroke-width="1.4" viewbox="0 0 24 24"><path d="M12 3l7 3v5.5c0 4.3-2.9 7.9-7 9.5-4.1-1.6-7-5.2-7-9.5V6l7-3z" stroke-linejoin="round"></path></svg>
<div>
<h3 class="font-headline text-ivory text-sm font-semibold uppercase tracking-wider mb-1.5">Matte polyurethane</h3>
<p class="text-stone-400 text-xs leading-relaxed">Durable, low-maintenance, low shine</p>
</div>
</div>

<div class="bg-[#140c06] border border-[#2c2119] rounded p-5 flex items-start gap-3.5">
<svg class="w-7 h-7 text-gold stroke-current fill-none shrink-0" stroke-width="1.4" viewbox="0 0 24 24"><path d="M12 4l1.6 4.4L18 10l-4.4 1.6L12 16l-1.6-4.4L6 10l4.4-1.6L12 4z" stroke-linejoin="round"></path><path d="M18 16l.7 1.8L20.5 18.5l-1.8.7L18 21l-.7-1.8-1.8-.7 1.8-.7L18 16z" stroke-linejoin="round"></path></svg>
<div>
<h3 class="font-headline text-ivory text-sm font-semibold uppercase tracking-wider mb-1.5">Satin polyurethane</h3>
<p class="text-stone-400 text-xs leading-relaxed">Durable, higher shine, easiest to wipe down</p>
</div>
</div>
</div>
</div>
</section>
<!-- END: FinishOptions -->

<!-- BEGIN: ServicesCTA -->
<section class="bg-[#150d07] px-4 lg:px-12 pb-14">
<div class="max-w-7xl mx-auto">
<div class="relative rounded-lg border border-foundry bg-gradient-to-b from-[#241609] to-[#160d06] px-6 py-12 text-center">
<span class="absolute top-0 left-1/2 -translate-x-1/2 h-0.5 w-20 bg-gold"></span>
<h2 class="font-headline font-bold text-ivory uppercase text-2xl sm:text-3xl lg:text-4xl mb-3">
        Ready to see what it'd cost?
      </h2>
<p class="text-stone-300 text-sm sm:text-base mb-8">
        Get a quick estimate or send us the details of your project.
      </p>
<div class="flex flex-col sm:flex-row gap-4 justify-center">
<a class="inline-flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><rect height="16" rx="1" width="16" x="4" y="5"></rect><path d="M8 2v4M16 2v4M8 11h8M8 15h4" stroke-linecap="round"></path></svg>
          Pricing calculator
        </a>
<a class="inline-flex items-center justify-center gap-3 border border-stone-600 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-sm uppercase tracking-wider px-8 py-4 rounded transition" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><rect height="13" rx="2" width="17" x="3.5" y="5.5"></rect><path d="M4 6.5L12 13l8-6.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
          Contact us
        </a>
</div>
</div>
</div>
</section>
<!-- END: ServicesCTA -->

<?php get_footer();