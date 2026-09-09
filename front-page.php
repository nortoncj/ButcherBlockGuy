<?php
/**
 * front-page.php
 * Block & Grain — homepage.
 *
 * Pulls from the same bg_gallery post type used elsewhere on the site:
 *   - bg_get_portfolio_items( 'all', 'all' )  → main gallery grid (from inc/cpt-gallery.php)
 *   - bg_get_recent_gallery_items( 3 )        → recent builds strip (appended to inc/cpt-gallery.php)
 *
 * Kept self-contained (own <head>/<body>, not get_header()/get_footer())
 * since I haven't seen your header.php/footer.php and didn't want to risk
 * stacking a second nav on top of whatever's already in there. If you'd
 * rather fold this into the shared header/footer, happy to do that once
 * I can see those files.
 *
 * Styles: enqueued separately via bg_enqueue_front_page_styles() in
 * functions.php — see assets/css/front-page.css. Fonts and Font Awesome
 * are already loaded site-wide by bbg_enqueue_assets(), not repeated here.
 */

/**
 * This page only shows 3 filter tabs (Tables / Kitchens / Custom), but
 * the CPT supports 6 product types. This maps the extra ones
 * (cutting-board, sink, shelving) into the Custom tab for this page.
 * Your dedicated gallery page can keep showing all 6 categories as-is.
 */
function bg_map_product_type_to_tab( $product_type ) {
	switch ( $product_type ) {
		case 'table':
			return 'table';
		case 'countertop':
			return 'countertop';
		default:
			return 'custom';
	}
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<svg class="visually-hidden" aria-hidden="true">
  <symbol id="i-home" viewBox="0 0 24 24"><path d="M3 11.5 12 4l9 7.5"/><path d="M5.5 10v9a1 1 0 0 0 1 1H10v-6h4v6h3.5a1 1 0 0 0 1-1v-9"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.5"/><path d="M4.5 20c1.4-4 4-5.5 7.5-5.5S18.1 16 19.5 20"/></symbol>
  <symbol id="i-tool" viewBox="0 0 24 24"><path d="M14.7 6.3a4 4 0 0 0-5.6 5l-6 6 2.6 2.6 6-6a4 4 0 0 0 5-5.6l-2.5 2.5-2-2z"/></symbol>
  <symbol id="i-image" viewBox="0 0 24 24"><rect x="3.5" y="4.5" width="17" height="15" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="M20 16.5 15 11l-8.5 8.5"/></symbol>
  <symbol id="i-star" viewBox="0 0 24 24"><path d="M12 3.5l2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.1-5.4 3.1 1.3-6-4.6-4.1 6.1-.6z"/></symbol>
  <symbol id="i-phone" viewBox="0 0 24 24"><path d="M6 3.5h3l1.4 4-2 1.6a12 12 0 0 0 5.5 5.5l1.6-2 4 1.4v3a1.5 1.5 0 0 1-1.6 1.5A16.5 16.5 0 0 1 4.5 5.1 1.5 1.5 0 0 1 6 3.5z"/></symbol>
  <symbol id="i-mail" viewBox="0 0 24 24"><rect x="3.5" y="5.5" width="17" height="13" rx="2"/><path d="M4 6.5 12 13l8-6.5"/></symbol>
  <symbol id="i-at" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0V12a9 9 0 1 0-4 7.5"/></symbol>
</svg>

<nav class="site-nav" aria-label="Primary">
  <div class="nav-inner">
    <a class="nav-item is-active" href="<?php echo esc_url( home_url( '/' ) ); ?>#top"><svg class="icon"><use href="#i-home"/></svg><span>Home</span></a>
    <a class="nav-item" href="#about"><svg class="icon"><use href="#i-user"/></svg><span>About</span></a>
    <a class="nav-item" href="#services"><svg class="icon"><use href="#i-tool"/></svg><span>Services</span></a>
    <a class="nav-item" href="#gallery"><svg class="icon"><use href="#i-image"/></svg><span>Gallery</span></a>
    <a class="nav-item" href="#reviews"><svg class="icon"><use href="#i-star"/></svg><span>Reviews</span></a>
    <a class="nav-item" href="#contact"><svg class="icon"><use href="#i-phone"/></svg><span>Contact</span></a>
  </div>
</nav>

<header class="hero" id="top">
  <div class="hero-inner">
    <div>
      <p class="hero-eyebrow">Butcher Block Group</p>
      <h1>Heirloom furniture, built by hand.</h1>
      <p>Custom tables, furniture, countertops, and more. Every piece cut, shaped, and finished in one shop by one guy who really likes wood grain.</p>
      <div class="hero-actions">
        <button class="btn btn-primary" onclick="document.getElementById('gallery').scrollIntoView()">See the work</button>
        <a class="btn btn-ghost" href="#contact">Get a quote</a>
      </div>
    </div>
    <div class="hero-figure">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Butcher_Block_Guy.webp' ); ?>" alt="Butcher Block Group">
    </div>
  </div>
</header>

<section class="strip reveal">
  <div class="section-inner">
    <p class="eyebrow">Recent builds</p>
    <div class="strip-grid">
      <?php
      $recent_builds = function_exists( 'bg_get_recent_gallery_items' ) ? bg_get_recent_gallery_items( 3 ) : array();

      if ( $recent_builds ) :
        foreach ( $recent_builds as $build ) :
      ?>
        <div class="strip-card">
          <?php if ( ! empty( $build->bg_img_url ) ) : ?>
            <img src="<?php echo esc_url( $build->bg_img_url ); ?>" alt="<?php echo esc_attr( $build->post_title ); ?>">
          <?php else : ?>
            <div class="strip-placeholder"><svg class="icon"><use href="#i-image"/></svg></div>
          <?php endif; ?>
        </div>
      <?php
        endforeach;
      else :
      ?>
        <p style="color:var(--outline);font-size:13px;grid-column:1/-1;">
          Add a few pieces to Portfolio Gallery and they'll show up here automatically, newest first.
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="gallery reveal" id="gallery">
  <div class="section-inner">
    <div class="gallery-head">
      <h2>A look at the work</h2>
      <div class="filters" role="tablist" aria-label="Filter gallery by type">
        <button class="filter-btn is-active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="table">Tables</button>
        <button class="filter-btn" data-filter="countertop">Kitchens</button>
        <button class="filter-btn" data-filter="custom">Custom</button>
      </div>
    </div>
    <div class="gallery-grid" id="galleryGrid">
      <?php
      $gallery_items = function_exists( 'bg_get_portfolio_items' ) ? bg_get_portfolio_items( 'all', 'all' ) : array();

      if ( $gallery_items ) :
        foreach ( $gallery_items as $item ) :
          $tab = bg_map_product_type_to_tab( $item->bg_product_type );
      ?>
        <div class="gallery-item" data-category="<?php echo esc_attr( $tab ); ?>">
          <?php if ( ! empty( $item->bg_img_url ) ) : ?>
            <img src="<?php echo esc_url( $item->bg_img_url ); ?>" alt="<?php echo esc_attr( $item->post_title ); ?>">
          <?php else : ?>
            <div class="gallery-placeholder"><svg class="icon"><use href="#i-image"/></svg></div>
          <?php endif; ?>
          <?php if ( ! empty( $item->bg_wood_label ) ) : ?>
            <span class="wood-badge"><?php echo esc_html( $item->bg_wood_label ); ?></span>
          <?php endif; ?>
        </div>
      <?php
        endforeach;
      else :
      ?>
        <p style="color:var(--outline);font-size:13px;grid-column:1/-1;">
          No gallery items yet — add some from Portfolio Gallery → Add New Photo in the admin.
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="wood-section reveal">
  <div class="section-inner">
    <p class="eyebrow">The wood he works with</p>
    <h2>Every species has its own grain, weight, and personality.</h2>
    <div class="wood-grid">
      <div class="wood-card">
        <div class="wood-photo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/IMG_6710.PNG' ); ?>" alt="Acacia wood grain close-up"></div>
        <span class="wood-name">Acacia</span>
        <p class="wood-note">Dense, dramatic grain. The house favorite for tables.</p>
      </div>
      <div class="wood-card">
        <div class="wood-photo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/IMG_8397.jpg' ); ?>" alt="Shortleaf acacia wood grain close-up"></div>
        <span class="wood-name">Shortleaf Acacia</span>
        <p class="wood-note">Tighter grain, lighter tone. A little more reserved.</p>
      </div>
      <div class="wood-card">
        <div class="wood-photo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/IMG_9325.webp' ); ?>" alt="Hevea wood grain close-up"></div>
        <span class="wood-name">Hevea</span>
        <p class="wood-note">Rubberwood. Sustainable, workable, and surprisingly tough.</p>
      </div>
      <div class="wood-card">
        <div class="wood-photo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/IMG_1743.jpg' ); ?>" alt="Chevron pattern wood close-up"></div>
        <span class="wood-name">Chevron</span>
        <p class="wood-note">Angled joints, herringbone energy. Not for the faint of heart.</p>
      </div>
      <div class="wood-card is-wide">
        <div class="wood-photo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/att.ZJP2C_vHao1bs9Y9FxBzVBhN6DPy0-PNknuB6D_cioQ.jpg' ); ?>" alt="Assorted custom wood species"></div>
        <span class="wood-name">Custom species, on request</span>
        <p class="wood-note">Got a specific slab in mind? Bring it up and he'll tell you if it's a good idea (or talk you out of it).</p>
      </div>
    </div>
  </div>
</section>

<section class="cta-band reveal">
  <div class="section-inner">
    <p class="cta-band-eyebrow">Got a project in mind?</p>
    <h2>Let's build something that outlasts all of us.</h2>
    <p>Tables, countertops, custom builds, whatever you're picturing, tell him about it and he'll shoot you straight on whether it'll work.</p>
    <a class="btn btn-invert btn-lg" href="mailto:hello@blockandgrain.com">Get a quote</a>
  </div>
</section>

<footer class="bg-footer" id="contact">
  <div class="footer-cta">
    <p class="footer-cta-eyebrow">Ready when you are</p>
    <h2>Let's talk about your project.</h2>
    <div class="footer-cta-actions">
      <!-- <a class="btn btn-invert" href="mailto:hello@blockandgrain.com">Get a quote</a> -->
      <a class="btn btn-ghost" href="tel:+13215433132">Call the shop</a>
    </div>
  </div>
  <div class="footer-inner">
    <div>
      <p class="footer-brand">Butcher Block Group</p>
      <p class="footer-tag">Custom woodwork, built to last generations.</p>
    </div>
    <div class="footer-social">
      <a href="#" aria-label="Instagram"><svg class="icon" style="width:16px;height:16px"><use href="#i-at"/></svg></a>
      <a href="#" aria-label="Email"><svg class="icon" style="width:16px;height:16px"><use href="#i-mail"/></svg></a>
      <a href="#" aria-label="Phone"><svg class="icon" style="width:16px;height:16px"><use href="#i-phone"/></svg></a>
    </div>
  </div>
  <p class="footer-bottom">© <?php echo esc_html( date( 'Y' ) ); ?> Butcher Block Group. All rights reserved.</p>
</footer>

<script>
  (function () {
    // Gallery filtering
    var filterBtns = document.querySelectorAll('.filter-btn');
    var galleryItems = document.querySelectorAll('.gallery-item');
    filterBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        filterBtns.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');
        var filter = btn.dataset.filter;
        galleryItems.forEach(function (item) {
          var match = filter === 'all' || item.dataset.category === filter;
          item.classList.toggle('is-hidden', !match);
        });
      });
    });

    // Scroll reveal
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

<?php wp_footer(); ?>
</body>
</html>