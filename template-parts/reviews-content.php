<?php
/**
 * Template Name: Reviews
 *
 * Block & Grain — Reviews Page
 * Heirloom Contrast Design System
 *
 * THIS IS THE ONE PAGE WHERE PLUGINS ARE INTENTIONAL.
 * Everywhere else in this theme avoids plugins on purpose — but syncing
 * live Google/Facebook reviews from scratch (API keys, OAuth, rate
 * limits) is a real ongoing maintenance job, not a theme-file job.
 * Drop your review plugin's shortcode or embed code into the two
 * marked slots below.
 *
 * Everything else on this page (the photo marquee, the breather image,
 * the section reveals) is plain PHP/CSS/JS, no plugin needed, and
 * pulls from the same bg_gallery data as the rest of the site.
 */

// Pull real gallery photos for the scrolling marquee — reuses the same
// data source as the homepage and gallery pages, no new assets needed.
$marquee_items = function_exists( 'bg_get_portfolio_items' ) ? bg_get_portfolio_items( 'all', 'all' ) : array();
$marquee_items = array_filter( $marquee_items, function ( $item ) {
	return ! empty( $item->bg_img_url );
} );
$marquee_items = array_slice( $marquee_items, 0, 12 );

// One recent piece for the breather image between the two review sections.
$breather_items = function_exists( 'bg_get_recent_gallery_items' ) ? bg_get_recent_gallery_items( 1 ) : array();
$breather_item  = ! empty( $breather_items ) ? $breather_items[0] : null;
?>
<style> 
    /* ==========================================================================
   Block & Grain — Reviews page styles
   Enqueue conditionally in functions.php with is_page_template('reviews-content.php')
   Typography (display-lg, headline-lg, label-md, body-text,
   section-eyebrow, bg-container, btn-primary) assumed already global —
   only layout/component/animation styles for this page live here.
   ========================================================================== */

#bg-rv-main{ background: #fcf9f2; overflow-x: hidden; }

/* ---------- Hero ---------- */
.bg-rv-hero{
  background: #4a0e0e;
  padding: clamp(48px, 8vw, 88px) 24px clamp(48px, 7vw, 72px);
}
.bg-rv-hero .section-eyebrow{ color: #d9b8b8; margin: 0 0 14px; }
.bg-rv-hero h1{ color: #fcf9f2; margin: 0 0 16px; }
.bg-rv-hero-desc{ color: #e6d3d3; max-width: 46ch; margin: 0; }

/* ---------- Scroll reveal (matches the rest of the site) ---------- */
.reveal{ opacity: 0; transform: translateY(18px); transition: opacity 0.6s ease, transform 0.6s ease; }
.reveal.is-visible{ opacity: 1; transform: translateY(0); }
@media (prefers-reduced-motion: reduce){
  .reveal{ opacity: 1; transform: none; transition: none; }
}

/* ---------- Photo marquee ---------- */
.bg-rv-marquee-section{
  background: #f6f3ec;
  padding: 20px 0;
  overflow: hidden;
}
.bg-rv-marquee-track{
  display: flex;
  width: max-content;
  animation: bg-rv-marquee-scroll 42s linear infinite;
}
.bg-rv-marquee-section:hover .bg-rv-marquee-track{ animation-play-state: paused; }
.bg-rv-marquee-group{
  display: flex;
  gap: 12px;
  padding-right: 12px;
}
.bg-rv-marquee-item{
  flex: 0 0 auto;
  width: 160px;
  height: 110px;
  border-radius: 8px;
  overflow: hidden;
}
.bg-rv-marquee-item img{
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
@keyframes bg-rv-marquee-scroll{
  from{ transform: translateX(0); }
  to{ transform: translateX(-50%); }
}
@media (prefers-reduced-motion: reduce){
  .bg-rv-marquee-track{ animation: none; }
}

/* ---------- Review platform sections ---------- */
.bg-rv-platform{ padding: clamp(48px, 7vw, 80px) 24px; }
.bg-rv-platform:nth-of-type(even){ background: #f6f3ec; }
.bg-rv-platform h2{ color: #2a0002; margin: 20px 0 32px; }
.bg-rv-platform .section-eyebrow{ color: #877270; }

.bg-rv-plugin-slot{ min-height: 120px; }
.bg-rv-plugin-placeholder{
  background: #ffffff;
  border-radius: 12px;
  padding: 48px 24px;
  text-align: center;
  color: #877270;
}
.bg-rv-plugin-placeholder i{
  font-size: 28px;
  color: #dac1bf;
  margin-bottom: 14px;
  display: block;
}
.bg-rv-plugin-placeholder p{ margin: 0; }

/* ---------- Breather image band ---------- */
.bg-rv-breather{
  position: relative;
  color: #fcf9f2;
}
.bg-rv-breather-figure{
  position: relative;
  height: clamp(260px, 40vw, 420px);
  overflow: hidden;
}
.bg-rv-breather-figure img{
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 8s ease;
}
.bg-rv-breather.is-visible .bg-rv-breather-figure img,
.bg-rv-breather:hover .bg-rv-breather-figure img{ transform: scale(1.06); }
.bg-rv-breather-figure::after{
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(28,28,24,0) 40%, rgba(28,28,24,0.55) 100%);
}
.bg-rv-breather-line{
  position: absolute;
  bottom: 28px;
  left: 24px;
  right: 24px;
  max-width: 46ch;
  font-family: 'Newsreader', serif;
  font-style: italic;
  font-size: clamp(1.1rem, 2.4vw, 1.5rem);
  line-height: 1.35;
  margin: 0;
}

/* ---------- CTA ---------- */
.bg-rv-cta{
  background: #2a0002;
  padding: clamp(48px, 8vw, 88px) 24px;
  text-align: center;
}
.bg-rv-cta h2{ margin: 0 0 16px; }
.bg-rv-cta p{ margin: 0 0 28px; max-width: 46ch; margin-left: auto; margin-right: auto; }
.bg-rv-cta-btn{ display: inline-flex; align-items: center; gap: 10px; }

/* ---------- Responsive ---------- */
@media (max-width: 640px){
  .bg-rv-marquee-item{ width: 120px; height: 84px; }
  .bg-rv-breather-line{ position: static; padding: 20px 0 0; color: #2a0002; }
  .bg-rv-breather-figure::after{ display: none; }
}
</style>

<main id="bg-rv-main">

  <section class="bg-rv-hero">
    <div class="bg-container">
      <p class="section-eyebrow label-md">What People Are Saying</p>
      <h1 class="display-lg">The Reviews,<br><em>In Their Words.</em></h1>
      <p class="body-text bg-rv-hero-desc">
        Real feedback from real projects. Pulled straight from Google and Facebook, no editing.
      </p>
    </div>
  </section>

  <?php if ( ! empty( $marquee_items ) ) : ?>
  <section class="bg-rv-marquee-section reveal">
    <div class="bg-rv-marquee-track">
      <div class="bg-rv-marquee-group">
        <?php foreach ( $marquee_items as $item ) : ?>
          <div class="bg-rv-marquee-item">
            <img src="<?php echo esc_url( $item->bg_img_url ); ?>" alt="<?php echo esc_attr( $item->bg_img_alt ); ?>" loading="lazy">
          </div>
        <?php endforeach; ?>
      </div>
      <div class="bg-rv-marquee-group" aria-hidden="true">
        <?php foreach ( $marquee_items as $item ) : ?>
          <div class="bg-rv-marquee-item">
            <img src="<?php echo esc_url( $item->bg_img_url ); ?>" alt="" loading="lazy">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <section class="bg-rv-platform reveal" id="google-reviews">
    <div class="bg-container">
      <p class="section-eyebrow label-md">Google Reviews</p>
      <h2 class="headline-lg">From the <em>Google Business Profile.</em></h2>

      <div class="bg-rv-plugin-slot" id="bg-rv-google-slot">
        <!--
          PLUGIN SLOT — GOOGLE REVIEWS
          Paste your chosen plugin's shortcode, block, or embed code
          directly inside this div, replacing the placeholder markup below.
        -->
        <div class="bg-rv-plugin-placeholder">
          <i class="fas fa-star" aria-hidden="true"></i>
          <p class="body-text">Google reviews will appear here once the plugin is connected.</p>
        </div>
      </div>
    </div>
  </section>

  <?php if ( $breather_item && ! empty( $breather_item->bg_img_url ) ) : ?>
  <section class="bg-rv-breather reveal">
    <div class="bg-rv-breather-figure">
      <img src="<?php echo esc_url( $breather_item->bg_img_url ); ?>" alt="<?php echo esc_attr( $breather_item->post_title ); ?>">
    </div>
    <div class="bg-container">
      <p class="bg-rv-breather-line">Every review below is about a piece that looked something like this.</p>
    </div>
  </section>
  <?php endif; ?>

  <section class="bg-rv-platform reveal" id="facebook-reviews">
    <div class="bg-container">
      <p class="section-eyebrow label-md">Facebook Reviews</p>
      <h2 class="headline-lg">From the <em>Facebook Page.</em></h2>

      <div class="bg-rv-plugin-slot" id="bg-rv-facebook-slot">
        <!--
          PLUGIN SLOT — FACEBOOK REVIEWS
          Paste your chosen plugin's shortcode, block, or embed code
          directly inside this div, replacing the placeholder markup below.
        -->
        <div class="bg-rv-plugin-placeholder">
          <i class="fas fa-thumbs-up" aria-hidden="true"></i>
          <p class="body-text">Facebook reviews will appear here once the plugin is connected.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-rv-cta reveal">
    <div class="bg-container">
      <h2 class="headline-lg" style="color:#fcf9f2;">Ready to be the <em>next one?</em></h2>
      <p class="body-text" style="color:rgba(252,249,242,.75);">Tell him what you're picturing and he'll tell you straight if it'll work.</p>
      <a href="tel:+13215433132" class="btn-primary bg-rv-cta-btn">
        <i class="fas fa-phone" aria-hidden="true"></i>
        Call — (321) 543-3132
      </a>
    </div>
  </section>

</main>

<script>
  (function () {
    var revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            io.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15 });
      revealEls.forEach(function (el) { io.observe(el); });
    } else {
      revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    }
  })();
</script>