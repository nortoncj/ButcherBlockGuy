<?php
/**
 * front-page.php — homepage
 *
 * Converted from the static index.html prototype.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<style data-purpose="page-styling">
body {
        background-color: #1c1108;
        color: #16110b;
        font-family: "Manrope", sans-serif;
      }
      .font-headline {
        font-family: "Oswald", sans-serif;
        letter-spacing: 0.03em;
      }
      .hero-img {
        background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
      }
</style>
<!-- BEGIN: HeroSection -->
    <section
      class="relative hero-img bg-espresso text-stone-100 overflow-hidden border-b border-foundry"
    >
      <!-- Hero Background Image & Overlay -->
      <div class="absolute inset-0 z-0">
        <img
          alt="Artisan Woodworker in Workshop"
          class="w-full h-full object-cover object-center opacity-30 scale-105 transform mix-blend-luminosity brightness-75 filter blur-[0.5px]"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuBN_-ZESCyQkDR87e_QjVoTI-k6zBjUq9mERN4egoxfbx8Z1ghQ5nArahxZVLsabDdzFBKd-xqdnnjfGO2ZH7AtZZwszzmf1KEgykp5ZpElfjbUtOxP0uR75snhuTiz6sfFGJWqTpJZQF_rWkBwW_5PqJaQz2hnATbGbpXTN_TW-EvWc50Z9ApcdVntRFBB3KutvacQYcaaH_WLgu7QhxLujHQyGjH7VnD6gezSeed4Tu-d_BD7Xf66mdA6-Gg-GUPw"
        />
        <div
          class="absolute inset-0 bg-gradient-to-r from-[#140c06] via-[#1c1108]/50 to-[#140c06]/75"
        ></div>
        <div
          class="absolute inset-0 bg-gradient-to-t from-espresso via-transparent to-black/20"
        ></div>
      </div>
      <div
        class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 pt-20 pb-28 md:pt-28 md:pb-36"
      >
        <div class="grid lg:grid-cols-12 gap-10 items-center">
          <div class="lg:col-span-7 space-y-6">
            <div class="inline-flex items-center gap-2">
              <span class="h-0.5 w-6 bg-gold"></span>
              <span
                class="font-headline text-gold-light text-2xl sm:text-sm font-semibold tracking-[0.25em] uppercase"
              >
                Custom Woodwork. Timeless Quality.
              </span>
            </div>
            <h1
              class="font-headline text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold uppercase tracking-tight text-stone-100 leading-[0.92]"
            >
              HANDCRAFTED.<br />
              <span class="text-gold-light">BUILT TO LAST.</span>
            </h1>
            <p
              class="text-stone-300 text-base sm:text-lg max-w-xl font-normal leading-relaxed"
            >
              Premium craftsmanship. Timeless design. Built for your home, your
              business, and your legacy.
            </p>
            <!-- Hero Action Buttons -->
            <div class="pt-4 flex flex-wrap gap-4 items-center">
              <a
                class="inline-flex items-center justify-center bg-gold-light hover:bg-gold-hover text-stone-950 font-headline font-bold text-sm tracking-wider uppercase px-7 py-3.5 rounded shadow-lg transition duration-200"
                href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"
              >
                View Gallery
              </a>
              <a
                class="inline-flex items-center justify-center border border-stone-600 hover:border-gold text-stone-200 hover:text-gold bg-espresso/60 font-headline font-semibold text-sm tracking-wider uppercase px-6 py-3.5 rounded backdrop-blur transition duration-200 gap-2"
                href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"
              >
                <svg
                  class="w-4 h-4 text-gold"
                  fill="none"
                  stroke="currentColor"
                  viewbox="0 0 24 24"
                >
                  <rect
                    height="18"
                    rx="2"
                    stroke-width="2"
                    width="16"
                    x="4"
                    y="3"
                  ></rect>
                  <line stroke-width="2" x1="8" x2="16" y1="7" y2="7"></line>
                  <circle cx="8" cy="11" fill="currentColor" r="1"></circle>
                  <circle cx="12" cy="11" fill="currentColor" r="1"></circle>
                  <circle cx="16" cy="11" fill="currentColor" r="1"></circle>
                  <circle cx="8" cy="15" fill="currentColor" r="1"></circle>
                  <circle cx="12" cy="15" fill="currentColor" r="1"></circle>
                  <circle cx="16" cy="15" fill="currentColor" r="1"></circle>
                </svg>
                Pricing Calculator
              </a>
            </div>
          </div>
          <!-- Featured Product Showcase Block -->
          <div class="lg:col-span-5 relative mt-6 lg:mt-0">
            <!-- <div
              class="relative rounded-lg overflow-hidden p-2 bg-[#2a1b10] border border-gold/30 shadow-2xl shadow-black/80 group"
            >
            
              <img
                alt="Detailed Handcrafted Butcher Block"
                class="w-full h-80 sm:h-96 object-cover rounded transform group-hover:scale-102 transition duration-500"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXEBuJtgnEo1fEbWqegkE53WmqCgO5mqZ6lGlKGGclVFaRaNJETXuSWvzqZhn0Qo3EY5C7ctlyht4rkGZ2II1WQDi2yuDSHHy59RBrTx8FX5wENAFt2_Xway5ssoTkGTK2wk5RZMZ67MVEWlAJddlFzQnUJY6JtHoRIJZAHlhGQidKTg4jSIhTvlwCTmaYAdmAkOMy0wmiY0mfwzQlxI1YZYVNwxlNgbnq8qzNYG7jbEUl5OvTZ-mrWSvmD2hPn5bA"
              />
              <div
                class="absolute bottom-4 right-4 bg-espresso/90 border border-gold/40 px-3.5 py-1.5 rounded text-right backdrop-blur"
              >
                <span
                  class="block text-[10px] text-gold-light font-bold uppercase tracking-widest"
                  >End-Grain Signature</span
                >
                <span class="block text-xs font-semibold text-stone-200"
                  >Brandon Florida Workshop</span
                >
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END: HeroSection -->
    <!-- BEGIN: ServicesSection -->
        <section
      class="bg-ivory text-ink py-20 px-6 lg:px-12 border-b border-ivory-high"
      id="services"
    >
      <div class="max-w-7xl mx-auto">
        <!-- Section Title Header -->
        <div class="text-center max-w-2xl mx-auto mb-14">
          <span
            class="font-headline text-gold text-xs sm:text-sm font-bold tracking-[0.25em] uppercase"
          >
            Our Services
          </span>
 
          <h2
            class="font-headline text-4xl sm:text-5xl font-bold uppercase tracking-tight text-ink mt-2 mb-4"
          >
            Quality Work. Custom to You.
          </h2>
          <p
            class="text-stone-700 text-sm sm:text-base leading-relaxed font-semibold"
          >
            From cutting boards to countertops, we bring your vision to life
            with wood that's built to perform and crafted to impress.
          </p>
        </div>
        <!-- 5 Services Grid -->
        <?php
        /**
         * Service cards come from the bg_service CPT. Add or reorder
         * Services in wp-admin and this grid follows — no template edit.
         *
         * Limited to 5 so the row stays even; the Services hub page shows
         * the full set. Raise posts_per_page and drop to lg:grid-cols-4
         * if you'd rather show all of them here.
         */
        $bbg_services = get_posts( array(
          'post_type'      => 'bg_service',
          'post_status'    => 'publish',
          'posts_per_page' => 5,
          'orderby'        => 'menu_order title',
          'order'          => 'ASC',
        ) );
        ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
        <?php if ( $bbg_services ) : foreach ( $bbg_services as $bbg_svc ) :
          $bbg_img   = get_the_post_thumbnail_url( $bbg_svc->ID, 'bg-gallery-thumb' );
          $bbg_blurb = get_post_meta( $bbg_svc->ID, 'card_blurb', true );
          if ( ! $bbg_blurb ) { $bbg_blurb = wp_trim_words( wp_strip_all_tags( $bbg_svc->post_content ), 18 ); }
        ?>
        <a href="<?php echo esc_url( get_permalink( $bbg_svc->ID ) ); ?>" >
          <div class="bg-ivory-low rounded border border-[#debfa2] hover:border-gold hover:shadow-xl transition flex flex-col group overflow-hidden">
            <div class="h-44 overflow-hidden relative">
              <?php if ( $bbg_img ) : ?>
                <img alt="<?php echo esc_attr( get_the_title( $bbg_svc ) ); ?>"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                     loading="lazy"
                     src="<?php echo esc_url( $bbg_img ); ?>" />
              <?php else : ?>
                <div class="w-full h-full bg-ivory-high"></div>
              <?php endif; ?>
              <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-9 h-9 rounded-full bg-espresso border border-gold flex items-center justify-center text-gold shadow">
                <?php echo bbg_service_icon( $bbg_svc->post_name ); // from a fixed internal map ?>
              </div>
            </div>
            <div class="p-5 pt-7 flex flex-col flex-grow text-center">
              <h3 class="font-headline text-lg font-bold uppercase text-ink tracking-wide">
                <?php echo esc_html( get_the_title( $bbg_svc ) ); ?>
              </h3>
              <p class="text-xs text-stone-600 mt-2 flex-grow leading-relaxed">
                <?php echo esc_html( $bbg_blurb ); ?>
              </p>
              <a class="mt-4 inline-flex items-center justify-center font-headline text-xs font-bold text-gold hover:text-ink uppercase tracking-wider gap-1"
                 href="<?php echo esc_url( get_permalink( $bbg_svc->ID ) ); ?>">
                Learn More <span>&rarr;</span>
              </a>
            </div>
          </div>
              </a>
        <?php endforeach; else : ?>
          <p class="col-span-full text-center text-stone-600 text-sm py-8">
            No services published yet &mdash; add them under <strong>Services</strong> in the admin.
          </p>
        <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- END: ServicesSection -->
    <!-- BEGIN: QualityTiersSection -->
    <section
      class="bg-[#191008] border-y border-[#3d2716] py-12 px-6 lg:px-12 text-stone-200"
    >
      <div class="max-w-6xl mx-auto">
        <div class="text-center mb-8">
          <span
            class="font-headline text-gold text-s font-bold tracking-[0.3em] uppercase"
          >
            <!-- Quality Tiers -->
            Wood Types
          </span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
          <!-- Tier 1: Standard -->
          <div
            class="border border-foundry/70 bg-[#21150b] rounded-lg p-6 flex items-center gap-5 hover:border-gold/50 transition"
          >
            <!-- Shield Badge -->
            <div
              class="w-16 h-18 py-2 px-1 rounded border border-gold/40 bg-espresso flex flex-col items-center justify-center text-center shadow-inner shrink-0"
            >
              <span
                class="text-[9px] font-bold text-gold tracking-widest uppercase"
                >GOOD</span
              >
              <div class="text-gold flex gap-0.5 my-1">
                <svg class="w-3 h-3 fill-current" viewbox="0 0 20 20">
                  <path
                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                  ></path>
                </svg>
              </div>
              <span class="text-[8px] text-stone-400 font-medium">TIER 1</span>
            </div>
            <div>
              <h4
                class="font-headline text-lg font-bold tracking-wide uppercase text-stone-100"
              >
                Hevea
              </h4>
              <p class="text-xs text-stone-400 mt-1 leading-relaxed">
                Premium hardwoods. Enhanced durability. Elevated oil or wax
                finish for luxury appeal.
              </p>
            </div>
          </div>
          <!-- Tier 2: Premium -->
          <div
            class="border border-gold/60 bg-[#2a1a0d] rounded-lg p-6 flex items-center gap-5 relative overflow-hidden shadow-lg"
          >
            <div
              class="absolute top-0 right-0 bg-gold text-stone-950 font-bold text-[9px] px-2 py-0.5 uppercase tracking-wider"
            >
              Popular
            </div>
            <!-- Shield Badge -->
            <div
              class="w-16 h-18 py-2 px-1 rounded border border-gold bg-[#1c1108] flex flex-col items-center justify-center text-center shadow-inner shrink-0"
            >
              <span
                class="text-[9px] font-bold text-gold tracking-widest uppercase"
                >BETTER</span
              >
              <div class="text-gold flex gap-0.5 my-1">
                <svg class="w-3 h-3 fill-current" viewbox="0 0 20 20">
                  <path
                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                  ></path>
                </svg>
                <svg class="w-3 h-3 fill-current" viewbox="0 0 20 20">
                  <path
                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                  ></path>
                </svg>
              </div>
              <span class="text-[8px] text-stone-400 font-medium">TIER 2</span>
            </div>
            <div>
              <h4
                class="font-headline text-lg font-bold tracking-wide uppercase text-stone-100"
              >
                Acacia
              </h4>
              <p class="text-xs text-stone-300 mt-1 leading-relaxed">
                Quality Acacia, shortleaf acacia, or espresso acacia. Expert
                craftsmanship. Built to perform and endure daily utility.
              </p>
            </div>
          </div>
          <!-- Tier 3: Signature -->
          <div
            class="border border-foundry/70 bg-[#21150b] rounded-lg p-6 flex items-center gap-5 hover:border-gold/50 transition"
          >
            <!-- Shield Badge -->
            <div
              class="w-16 h-18 py-2 px-1 rounded border border-gold/40 bg-espresso flex flex-col items-center justify-center text-center shadow-inner shrink-0"
            >
              <span
                class="text-[9px] font-bold text-gold tracking-widest uppercase"
                >BEST</span
              >
              <div class="text-gold flex gap-0.5 my-1">
                <svg class="w-3 h-3 fill-current" viewbox="0 0 20 20">
                  <path
                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                  ></path>
                </svg>
                <svg class="w-3 h-3 fill-current" viewbox="0 0 20 20">
                  <path
                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                  ></path>
                </svg>
                <svg class="w-3 h-3 fill-current" viewbox="0 0 20 20">
                  <path
                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                  ></path>
                </svg>
              </div>
              <span class="text-[8px] text-stone-400 font-medium">TIER 3</span>
            </div>
            <div>
              <h4
                class="font-headline text-lg font-bold tracking-wide uppercase text-stone-100"
              >
                Walnut & Custom
              </h4>
              <p class="text-xs text-stone-400 mt-1 leading-relaxed">
                Select exotic &amp; softer hardwoods. Heirloom quality.
                Hand-finished for generations.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END: QualityTiersSection -->
    <!-- BEGIN: WhoWeServeSection -->
    <section class="bg-ivory text-ink py-20 px-6 lg:px-12" id="who-we-serve">
      <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
          <!-- Left Column: Audience and checklist -->
          <div class="lg:col-span-6 space-y-6">
            <div class="inline-flex items-center gap-2">
              <span
                class="font-headline text-gold text-xs sm:text-sm font-bold tracking-[0.25em] uppercase"
              >
                Who We Serve
              </span>
              <span class="h-0.5 w-8 bg-gold"></span>
            </div>
            <h2
              class="font-headline text-4xl sm:text-5xl font-bold uppercase tracking-tight text-ink leading-tight"
            >
              Built For Those Who Value Quality.
            </h2>
            <p class="text-stone-700 text-sm sm:text-base leading-relaxed">
              We work with homeowners, designers, builders, and businesses who
              appreciate craftsmanship and want woodwork that stands the test of
              time.
            </p>
            <!-- 2-column audience checklist -->
            <div
              class="grid grid-cols-1 sm:grid-cols-2 gap-y-3.5 gap-x-6 pt-2 text-xs sm:text-sm font-medium text-stone-800"
            >
              <div class="flex items-center gap-2.5">
                <span
                  class="w-5 h-5 rounded-full bg-[#dfc5a6] text-[#784d16] flex items-center justify-center shrink-0"
                >
                  <svg class="w-3.5 h-3.5 fill-current" viewbox="0 0 20 20">
                    <path
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    ></path>
                  </svg>
                </span>
                <span>Homeowners &amp; Families</span>
              </div>
              <div class="flex items-center gap-2.5">
                <span
                  class="w-5 h-5 rounded-full bg-[#dfc5a6] text-[#784d16] flex items-center justify-center shrink-0"
                >
                  <svg class="w-3.5 h-3.5 fill-current" viewbox="0 0 20 20">
                    <path
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    ></path>
                  </svg>
                </span>
                <span>Boutique Retailers</span>
              </div>
              <div class="flex items-center gap-2.5">
                <span
                  class="w-5 h-5 rounded-full bg-[#dfc5a6] text-[#784d16] flex items-center justify-center shrink-0"
                >
                  <svg class="w-3.5 h-3.5 fill-current" viewbox="0 0 20 20">
                    <path
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    ></path>
                  </svg>
                </span>
                <span>Interior Designers</span>
              </div>
              <div class="flex items-center gap-2.5">
                <span
                  class="w-5 h-5 rounded-full bg-[#dfc5a6] text-[#784d16] flex items-center justify-center shrink-0"
                >
                  <svg class="w-3.5 h-3.5 fill-current" viewbox="0 0 20 20">
                    <path
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    ></path>
                  </svg>
                </span>
                <span>Office &amp; Commercial Spaces</span>
              </div>
              <div class="flex items-center gap-2.5">
                <span
                  class="w-5 h-5 rounded-full bg-[#dfc5a6] text-[#784d16] flex items-center justify-center shrink-0"
                >
                  <svg class="w-3.5 h-3.5 fill-current" viewbox="0 0 20 20">
                    <path
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    ></path>
                  </svg>
                </span>
                <span>Custom Home Builders</span>
              </div>
              <div class="flex items-center gap-2.5">
                <span
                  class="w-5 h-5 rounded-full bg-[#dfc5a6] text-[#784d16] flex items-center justify-center shrink-0"
                >
                  <svg class="w-3.5 h-3.5 fill-current" viewbox="0 0 20 20">
                    <path
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    ></path>
                  </svg>
                </span>
                <span>Woodworking Enthusiasts</span>
              </div>
              <div class="flex items-center gap-2.5">
                <span
                  class="w-5 h-5 rounded-full bg-[#dfc5a6] text-[#784d16] flex items-center justify-center shrink-0"
                >
                  <svg class="w-3.5 h-3.5 fill-current" viewbox="0 0 20 20">
                    <path
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    ></path>
                  </svg>
                </span>
                <span>Restaurants &amp; Cafés</span>
              </div>
              <div class="flex items-center gap-2.5">
                <span
                  class="w-5 h-5 rounded-full bg-[#dfc5a6] text-[#784d16] flex items-center justify-center shrink-0"
                >
                  <svg class="w-3.5 h-3.5 fill-current" viewbox="0 0 20 20">
                    <path
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    ></path>
                  </svg>
                </span>
                <span>Anyone Who Values Quality</span>
              </div>
            </div>
            <!-- Quality Standard Callout Box -->
            <div
              class="mt-8 bg-espresso text-stone-200 p-5 sm:p-6 rounded-lg border border-gold/40 flex items-start gap-4"
            >
              <div
                class="w-12 h-12 rounded-full border border-gold flex items-center justify-center shrink-0 text-gold bg-foundry"
              >
                <svg
                  class="w-6 h-6 stroke-current fill-none"
                  stroke-width="2"
                  viewbox="0 0 24 24"
                >
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
              </div>
              <div>
                <h4
                  class="font-headline text-gold text-sm tracking-widest uppercase font-bold"
                >
                  Our Quality Standard
                </h4>
                <p
                  class="text-xs sm:text-sm text-stone-300 mt-1 leading-relaxed"
                >
                  We use premium hardwoods, expert craftsmanship, and proven
                  techniques to deliver pieces that last
                  <strong class="text-white">for generations</strong>.
                </p>
              </div>
            </div>
          </div>
          <!-- Right Column: Workshop Image & 3 Pillars -->
          <div class="lg:col-span-6 space-y-6">
            <div
              class="rounded-lg overflow-hidden border-2 border-[#debfa2] shadow-xl"
            >
              <?php
              /**
               * "Front Page Extra Image" metabox on this page (inc/extra-fields.php).
               * get_queried_object_id() rather than get_the_ID() so this holds
               * even though the template never enters the loop.
               */
              $bbg_page_id  = get_queried_object_id();
              $extra_image  = $bbg_page_id ? get_post_meta( $bbg_page_id, '_frontpage_image', true ) : '';
              $bbg_fallback = 'https://lh3.googleusercontent.com/aida-public/AB6AXuC_cHUKMGaNqOhAKvpzUJYsVR4EojhTHN7ikSMapEdlRQ1w-j3PjKyiaOC9Qawip15wmCroGzsnb16Wow4K7qYy8SFMy6RJxoFjwWucahYzSe0ZK_3epNSVrF3hx-IqL_jC4OlL7R2kwtvvR-fsU8Q2383QQWreHV8VSueCwPPN5iNZdRUyKeZNZvXrAdBOC1f9c9iiFovMeJQPDSEJebYNme5TP4RWMAuCm506kZcZ4Q437bYJ4eLSIW9TTpovYxxU';

              $bbg_src = $extra_image ? $extra_image : $bbg_fallback;

              // Pull the real alt text when the image is in the media library.
              $bbg_alt = 'Butcher Block Kitchen Installation';
              if ( $extra_image ) {
                $bbg_att_id = attachment_url_to_postid( $extra_image );
                if ( $bbg_att_id ) {
                  $bbg_att_alt = get_post_meta( $bbg_att_id, '_wp_attachment_image_alt', true );
                  if ( $bbg_att_alt ) { $bbg_alt = $bbg_att_alt; }
                }
              }
              ?>

              <img
                alt="<?php echo esc_attr( $bbg_alt ); ?>"
                class="w-full h-80 sm:h-96 object-cover"
                loading="lazy"
                src="<?php echo esc_url( $bbg_src ); ?>"
              />

             
            </div>
            <!-- 3 Value Pillars -->
            <div class="grid grid-cols-3 gap-4 pt-2 text-center">
              <div class="space-y-1">
                <div
                  class="w-10 h-10 mx-auto rounded-full bg-ivory-high border border-gold/50 flex items-center justify-center text-gold mb-2"
                >
                  <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24">
                    <path
                      d="M12 2L3 9v11a2 2 0 002 2h14a2 2 0 002-2V9l-9-7zm0 4.5l5 3.88V19H7v-8.62L12 6.5z"
                    ></path>
                  </svg>
                </div>
                <h5
                  class="font-headline text-xs font-bold uppercase tracking-wider text-ink"
                >
                  Premium Materials
                </h5>
                <p class="text-[11px] text-stone-600">
                  Sourced responsibly from trusted mills
                </p>
              </div>
              <div class="space-y-1">
                <div
                  class="w-10 h-10 mx-auto rounded-full bg-ivory-high border border-gold/50 flex items-center justify-center text-gold mb-2"
                >
                  <svg
                    class="w-5 h-5 stroke-current fill-none"
                    stroke-width="2"
                    viewbox="0 0 24 24"
                  >
                    <path
                      d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"
                    ></path>
                  </svg>
                </div>
                <h5
                  class="font-headline text-xs font-bold uppercase tracking-wider text-ink"
                >
                  Expert Craftsmanship
                </h5>
                <p class="text-[11px] text-stone-600">
                  Attention to detail in every cut and finish
                </p>
              </div>
              <div class="space-y-1">
                <div
                  class="w-10 h-10 mx-auto rounded-full bg-ivory-high border border-gold/50 flex items-center justify-center text-gold mb-2"
                >
                  <svg
                    class="w-5 h-5 stroke-current fill-none"
                    stroke-width="2"
                    viewbox="0 0 24 24"
                  >
                    <path
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                    ></path>
                  </svg>
                </div>
                <h5
                  class="font-headline text-xs font-bold uppercase tracking-wider text-ink"
                >
                  Built to Last
                </h5>
                <p class="text-[11px] text-stone-600">
                  Heirloom quality you can count on
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END: WhoWeServeSection -->
    <!-- BEGIN: ProcessSection -->
    <section
      class="bg-ivory-low text-ink py-20 px-6 lg:px-12 border-t border-b border-[#debfa2]"
      id="process"
    >
      <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-16">
          <span
            class="font-headline text-gold text-xs sm:text-sm font-bold tracking-[0.25em] uppercase"
          >
            Our Process
          </span>
          <h2
            class="font-headline text-4xl sm:text-5xl font-bold uppercase tracking-tight text-ink mt-2 mb-4"
          >
            Simple. Clear. Personal.
          </h2>
          <p
            class="text-stone-700 text-sm sm:text-base leading-relaxed font-semibold"
          >
            We make it easy to bring your project to life with a smooth,
            collaborative process from start to finish.
          </p>
        </div>
        <!-- Process 3-Step Cards with Role Comparison -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
          <!-- Step 1 -->
          <div
            class="bg-ivory border border-[#d8be9f] rounded-lg p-6 shadow-sm flex flex-col relative"
          >
            <div
              class="w-9 h-9 rounded-full bg-[#8c5e20] text-ivory font-headline font-bold flex items-center justify-center text-sm absolute -top-4 left-6 shadow"
            >
              1
            </div>
            <!-- Step Icon & Name -->
            <div class="mt-3 flex items-center gap-3">
              <div class="p-2.5 bg-ivory-high rounded text-stone-800">
                <svg
                  class="w-6 h-6 stroke-current fill-none"
                  stroke-width="2"
                  viewbox="0 0 24 24"
                >
                  <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                  <path
                    d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"
                  ></path>
                </svg>
              </div>
              <div>
                <h3
                  class="font-headline text-lg font-bold uppercase tracking-wide"
                >
                  Consult &amp; Plan
                </h3>
              </div>
            </div>
            <p class="text-xs text-stone-600 mt-4 leading-relaxed flex-grow">
              You share your vision, measurements, and needs. We listen, offer
              expert guidance, and provide a custom quote.
            </p>
            <!-- Roles comparison matrix -->
            <div
              class="mt-6 pt-4 border-t border-[#debfa2] grid grid-cols-2 gap-3 text-[11px] bg-ivory-low/80 p-3 rounded"
            >
              <div>
                <span
                  class="font-headline font-bold text-gold uppercase tracking-wider block text-[10px]"
                  >Your Role</span
                >
                <ul class="text-stone-600 mt-1 space-y-1">
                  <li>• Share your ideas</li>
                  <li>• Provide measurements</li>
                  <li>• Approve the plan &amp; quote</li>
                </ul>
              </div>
              <div>
                <span
                  class="font-headline font-bold text-stone-700 uppercase tracking-wider block text-[10px]"
                  >Our Role</span
                >
                <ul class="text-stone-600 mt-1 space-y-1">
                  <li>• Offer recommendations</li>
                  <li>• Create a detailed plan</li>
                  <li>• Provide an accurate quote</li>
                </ul>
              </div>
            </div>
          </div>
          <!-- Step 2 -->
          <div
            class="bg-ivory border border-gold/60 rounded-lg p-6 shadow-md flex flex-col relative ring-1 ring-gold/30"
          >
            <div
              class="w-9 h-9 rounded-full bg-gold text-stone-950 font-headline font-bold flex items-center justify-center text-sm absolute -top-4 left-6 shadow"
            >
              2
            </div>
            <!-- Step Icon & Name -->
            <div class="mt-3 flex items-center gap-3">
              <div class="p-2.5 bg-ivory-high rounded text-stone-800">
                <svg
                  class="w-6 h-6 stroke-current fill-none"
                  stroke-width="2"
                  viewbox="0 0 24 24"
                >
                  <path
                    d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"
                  ></path>
                  <path
                    d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                  ></path>
                </svg>
              </div>
              <div>
                <h3
                  class="font-headline text-lg font-bold uppercase tracking-wide"
                >
                  Design &amp; Craft
                </h3>
              </div>
            </div>
            <p class="text-xs text-stone-600 mt-4 leading-relaxed flex-grow">
              We finalize the details and get to work crafting your piece with
              precision, patience, and meticulous care.
            </p>
            <!-- Roles comparison matrix -->
            <div
              class="mt-6 pt-4 border-t border-[#debfa2] grid grid-cols-2 gap-3 text-[11px] bg-ivory-low/80 p-3 rounded"
            >
              <div>
                <span
                  class="font-headline font-bold text-gold uppercase tracking-wider block text-[10px]"
                  >Your Role</span
                >
                <ul class="text-stone-600 mt-1 space-y-1">
                  <li>• Review &amp; approve final details</li>
                  <li>• Stay in the loop with updates</li>
                </ul>
              </div>
              <div>
                <span
                  class="font-headline font-bold text-stone-700 uppercase tracking-wider block text-[10px]"
                  >Our Role</span
                >
                <ul class="text-stone-600 mt-1 space-y-1">
                  <li>• Build with expert craftsmanship</li>
                  <li>• Quality check every step</li>
                </ul>
              </div>
            </div>
          </div>
          <!-- Step 3 -->
          <div
            class="bg-ivory border border-[#d8be9f] rounded-lg p-6 shadow-sm flex flex-col relative"
          >
            <div
              class="w-9 h-9 rounded-full bg-[#8c5e20] text-ivory font-headline font-bold flex items-center justify-center text-sm absolute -top-4 left-6 shadow"
            >
              3
            </div>
            <!-- Step Icon & Name -->
            <div class="mt-3 flex items-center gap-3">
              <div class="p-2.5 bg-ivory-high rounded text-stone-800">
                <svg
                  class="w-6 h-6 stroke-current fill-none"
                  stroke-width="2"
                  viewbox="0 0 24 24"
                >
                  <rect height="13" width="15" x="1" y="3"></rect>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                  <circle cx="5.5" cy="18.5" r="2.5"></circle>
                  <circle cx="18.5" cy="18.5" r="2.5"></circle>
                </svg>
              </div>
              <div>
                <h3
                  class="font-headline text-lg font-bold uppercase tracking-wide"
                >
                  Deliver &amp; Enjoy
                </h3>
              </div>
            </div>
            <p class="text-xs text-stone-600 mt-4 leading-relaxed flex-grow">
              We deliver your finished piece and make sure you love it and have
              proper care guidance for decades to come.
            </p>
            <!-- Roles comparison matrix -->
            <div
              class="mt-6 pt-4 border-t border-[#debfa2] grid grid-cols-2 gap-3 text-[11px] bg-ivory-low/80 p-3 rounded"
            >
              <div>
                <span
                  class="font-headline font-bold text-gold uppercase tracking-wider block text-[10px]"
                  >Your Role</span
                >
                <ul class="text-stone-600 mt-1 space-y-1">
                  <li>• Receive your piece</li>
                  <li>• Enjoy &amp; share your feedback</li>
                </ul>
              </div>
              <div>
                <span
                  class="font-headline font-bold text-stone-700 uppercase tracking-wider block text-[10px]"
                  >Our Role</span
                >
                <ul class="text-stone-600 mt-1 space-y-1">
                  <li>• Careful delivery</li>
                  <li>• Ensure complete satisfaction</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END: ProcessSection -->
    <!-- BEGIN: ReviewsSection -->
    <section
      class="bg-espresso text-stone-100 py-20 px-6 lg:px-12 border-b border-foundry"
      id="reviews"
    >
      <div class="max-w-7xl mx-auto">
        <!-- Section Title & Google Ratings Header -->
        <div
          class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12"
        >
          <div>
            <div class="inline-flex items-center gap-2">
              <span
                class="font-headline text-gold text-xs sm:text-sm font-bold tracking-[0.25em] uppercase"
              >
                Reviews From Our Clients
              </span>
              <span class="h-0.5 w-8 bg-gold"></span>
            </div>
            <h2
              class="font-headline text-4xl sm:text-5xl font-bold uppercase tracking-tight text-stone-100 mt-2"
            >
              Real Stories. Real Results.
            </h2>
            <p class="text-stone-400 text-sm sm:text-base mt-2">
              Don't just take our word for it. See what our clients have to say
              about their experience.
            </p>
          </div>
          <!-- Google Score Badge -->
          <div
            class="flex items-center gap-3 bg-[#24170d] border border-foundry px-4 py-2.5 rounded-lg shrink-0"
          >
            <svg class="w-7 h-7" viewbox="0 0 24 24">
              <path
                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                fill="#4285F4"
              ></path>
              <path
                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                fill="#34A853"
              ></path>
              <path
                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"
                fill="#FBBC05"
              ></path>
              <path
                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"
                fill="#EA4335"
              ></path>
            </svg>
            <div>
              <div class="flex items-center gap-1.5">
                <div class="flex text-amber-400 text-sm">★★★★★</div>
                <span class="font-headline font-bold text-stone-100 text-base"
                  >4.8</span
                >
              </div>
              <span class="text-[11px] text-stone-400"
                >Based on 20+ Google reviews</span
              >
            </div>
          </div>
        </div>
        <!-- 3 Testimonial Cards (Ivory on Dark) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Testimonial 1 -->
          <div
            class="bg-ivory text-ink rounded-lg p-7 flex flex-col justify-between shadow-lg relative"
          >
            <div>
              <div class="flex justify-between items-center mb-4">
                <div class="flex text-amber-600 text-sm">★★★★★</div>
                <!-- Google G Icon -->
                <span class="text-xs font-bold text-stone-400">G</span>
              </div>
              <p
                class="text-stone-700 text-xs sm:text-sm italic leading-relaxed"
              >
                "Our butcher block island is the centerpiece of our kitchen. The
                craftsmanship is incredible and the team was a pleasure to work
                with."
              </p>
            </div>
            <div
              class="flex items-center gap-3 mt-6 pt-4 border-t border-[#debfa2]"
            >
              <div
                class="w-10 h-10 rounded-full bg-stone-300 overflow-hidden flex items-center justify-center font-bold text-stone-700 text-sm"
              >
                SM
              </div>
              <div>
                <div class="font-headline font-bold text-sm text-ink">
                  Sarah M.
                </div>
                <div class="text-[11px] text-stone-600">Brandon, FL</div>
              </div>
            </div>
          </div>
          <!-- Testimonial 2 -->
          <div
            class="bg-ivory text-ink rounded-lg p-7 flex flex-col justify-between shadow-lg relative"
          >
            <div>
              <div class="flex justify-between items-center mb-4">
                <div class="flex text-amber-600 text-sm">★★★★★</div>
                <span class="text-xs font-bold text-stone-400">G</span>
              </div>
              <p
                class="text-stone-700 text-xs sm:text-sm italic leading-relaxed"
              >
                "Excellent quality and service from start to finish. They
                listened to our vision and delivered exactly what we needed for
                our restaurant."
              </p>
            </div>
            <div
              class="flex items-center gap-3 mt-6 pt-4 border-t border-[#debfa2]"
            >
              <div
                class="w-10 h-10 rounded-full bg-stone-300 overflow-hidden flex items-center justify-center font-bold text-stone-700 text-sm"
              >
                DR
              </div>
              <div>
                <div class="font-headline font-bold text-sm text-ink">
                  David R.
                </div>
                <div class="text-[11px] text-stone-600">Restaurant Owner</div>
              </div>
            </div>
          </div>
          <!-- Testimonial 3 -->
          <div
            class="bg-ivory text-ink rounded-lg p-7 flex flex-col justify-between shadow-lg relative"
          >
            <div>
              <div class="flex justify-between items-center mb-4">
                <div class="flex text-amber-600 text-sm">★★★★★</div>
                <span class="text-xs font-bold text-stone-400">G</span>
              </div>
              <p
                class="text-stone-700 text-xs sm:text-sm italic leading-relaxed"
              >
                "Beautiful custom shelving and a stunning countertop for our
                home office. You can tell they take pride in their work."
              </p>
            </div>
            <div
              class="flex items-center gap-3 mt-6 pt-4 border-t border-[#debfa2]"
            >
              <div
                class="w-10 h-10 rounded-full bg-stone-300 overflow-hidden flex items-center justify-center font-bold text-stone-700 text-sm"
              >
                ET
              </div>
              <div>
                <div class="font-headline font-bold text-sm text-ink">
                  Emily T.
                </div>
                <div class="text-[11px] text-stone-600">Homeowner</div>
              </div>
            </div>
          </div>
        </div>
        <!-- Reviews CTA -->
        <div class="text-center mt-10">
          <a
            class="inline-flex items-center gap-2 border border-stone-600 hover:border-gold px-6 py-2.5 rounded text-xs font-headline font-bold uppercase tracking-wider text-stone-200 hover:text-gold transition"
            href="https://www.google.com/search?q=butcher+block+group&sca_esv=828cbca0d690e3ec&sxsrf=APpeQnu05UUv8gYTkrcJ-lVBSM6STM2ZrQ%3A1789841161559&source=hp&ei=Cc-uaouzH5PE0PEP5vSQ0Qs&iflsig=ABILxe8AAAAAaq7dGQnrgsl7FTtM-0lQmtWnepcEBxV7&oq=butcher&gs_lp=Egdnd3Mtd2l6IgdidXRjaGVyKgQIARgnMgQQIxgnMgQQIxgnMggQABiABBixAzILEAAYgAQYigUYkgMyCxAAGIAEGIoFGJIDMgsQABiABBixAxjJAzIFEAAYgAQyCBAAGIAEGLEDMggQABiABBixAzIIEAAYgAQYsQNIlyJQAFiVFnABeACQAQCYAVmgAc4EqgEBOLgBA8gBAPgBAZgCCaAC_ATCAg4QLhiABBiKBRixAxiDAcICDhAuGIAEGLEDGMcBGNEDwgIREC4YgAQYsQMYgwEYxwEY0QPCAhEQABiABBiKBRiNBhixAxiDAcICCxAuGIAEGLEDGIMBwgIREC4YgAQYsQMYxwEYrwEYjgXCAgsQLhiABBjHARivAcICCBAuGIAEGLEDwgIIEC4YgAQYtAfCAgcQIxixAhgnwgIFEC4YgATCAgwQABiABBgKGAsYsQPCAg8QLhiABBgKGAsYsQMYtAfCAg8QABiABBgKGAsYsQMYyQPCAgsQLhiABBixAxi0B8ICCBAAGIAEGLQHmAMAkgcBOaAH1FuyBwE4uAf5BMIHBTAuMy42yAcfgAgB&sclient=gws-wiz#"
          >
            <svg
              class="w-4 h-4 text-gold"
              fill="none"
              stroke="currentColor"
              viewbox="0 0 24 24"
            >
              <path
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
              ></path>
            </svg>
            Read More Reviews <span>→</span>
          </a>
        </div>
      </div>
    </section>
    <!-- END: ReviewsSection -->
    <!-- BEGIN: CallToActionBanner -->
    <section
      class="relative bg-espresso text-stone-100 py-24 px-6 lg:px-12 overflow-hidden border-b border-foundry hero-img"
      id="quote"
    >
      <div class="absolute inset-0 z-0">
        <img
          alt="Workshop Crafting"
          class="w-full h-full object-cover object-center opacity-25 filter brightness-50"

          src="https://lh3.googleusercontent.com/aida-public/AB6AXuB1mXcPWwkFfB6Z3a1yGpKuHwGEzIjsPILV6ladU8Ew5fVxAUumr_RVFfINyGRYJhQw03xqlA465Fhf0lOb38FjFMFT1yD4cbWoy6Rfha6LO9Q-Ehh5LPw1kVi7Wn36-RlxouLOTgEpQT0CDT0qMSJ2VMGDNK7jl8iTs5jNu3-uWbgQX0m1W1VwSaV8l3vJE6d5PievrZlLIk9WUA9Das6EdXFgw0GbO_VB2dSJUDMLJtj7KPzULISUVuGf0y4pwihe"
        />
        <div class="absolute inset-0 bg-[#160d06]/85"></div>
      </div>
      <div class="relative z-10 max-w-5xl mx-auto text-center space-y-6">
        <div class="inline-flex items-center gap-2">
          <span
            class="font-headline text-gold text-xs sm:text-sm font-bold tracking-[0.25em] uppercase"
          >
            Ready to Get Started?
          </span>
          <span class="h-0.5 w-6 bg-gold"></span>
        </div>
        <h2
          class="font-headline text-4xl sm:text-6xl font-bold uppercase tracking-tight text-stone-100 max-w-3xl mx-auto leading-none"
        >
          Let's Build Something Extraordinary Together.
        </h2>
        <p
          class="text-stone-300 text-sm sm:text-base max-w-xl mx-auto leading-relaxed"
        >
          Tell us about your project and we'll provide expert guidance, a custom
          plan, and a detailed quote.
        </p>
        <div class="pt-4 flex flex-wrap justify-center gap-4">
          <a
            class="inline-flex items-center gap-2 bg-gold-light hover:bg-gold-hover text-stone-950 font-headline font-bold text-sm tracking-wider uppercase px-7 py-3.5 rounded shadow-lg transition"
            href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>\"
          >
            <svg
              class="w-4 h-4"
              fill="none"
              stroke="currentColor"
              viewbox="0 0 24 24"
            >
              <path
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
              ></path>
            </svg>
            Get a Quote
          </a>
          <a
            class="inline-flex items-center gap-2 border border-stone-600 hover:border-gold text-stone-200 hover:text-gold-light bg-espresso/80 font-headline font-semibold text-sm tracking-wider uppercase px-6 py-3.5 rounded backdrop-blur transition"
            href="#process"
          >
            <svg
              class="w-4 h-4 text-gold-light"
              fill="none"
              stroke="currentColor"
              viewbox="0 0 24 24"
            >
              <rect
                height="18"
                rx="2"
                stroke-width="2"
                width="16"
                x="4"
                y="3"
              ></rect>
              <circle cx="8" cy="11" fill="currentColor" r="1"></circle>
              <circle cx="12" cy="11" fill="currentColor" r="1"></circle>
              <circle cx="16" cy="11" fill="currentColor" r="1"></circle>
            </svg>
            Pricing Calculator
          </a>
        </div>
      </div>
    </section>
    <!-- END: CallToActionBanner -->

<?php get_footer();