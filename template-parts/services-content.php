<?php
/**
 * Template Name: Services Page
 *
 * Block & Grain — Portfolio Gallery (Product-Focused)
 * Heirloom Contrast Design System
 *
 * Shows finished products organized by type (Countertops, Tables, etc.)
 * and wood species (Acacia, Hevea, Walnut, etc.)
 *
 * Gallery items are added via WordPress admin:
 *   Portfolio Gallery → Add New Photo
 *   - Set featured image
 *   - Enter product name/description
 *   - Select Product Type (Countertop, Table, Cutting Board, etc.)
 *   - Select Wood Type (Acacia, Hevea, Walnut, etc.)
 *   - Publish
 */

// Enqueue GLightbox
wp_enqueue_style(  'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', array(), '3.2.0' );
wp_enqueue_script( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js',  array(), '3.2.0', true );
wp_add_inline_script( 'glightbox', "
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = GLightbox({
        selector:    '.bg-glightbox',
        openEffect:  'fade',
        closeEffect: 'fade',
        touchNavigation: true,
        keyboardNavigation: true,
        closeOnOutsideClick: true,
    });

    // Product filter tabs
    const tabs  = document.querySelectorAll('.bg-portfolio-tab');
    const items = document.querySelectorAll('.bg-portfolio-item');

    tabs.forEach(function(tab) {
        tab.addEventListener('click', function () {
            const filter = tab.dataset.filter;
            
            tabs.forEach(function(t) { t.classList.remove('active'); });
            tab.classList.add('active');

            items.forEach(function(item) {
                const match = filter === 'all' || item.dataset.product === filter;
                item.style.display = match ? '' : 'none';
            });
        });
    });
});
" );

// Get all portfolio items
$all_items = function_exists( 'bg_get_portfolio_items' ) ? bg_get_portfolio_items( 'all', 'all' ) : array();

// Get unique product types for tabs
$product_types = array_unique( array_map( function( $item ) {
    return $item->bg_product_type;
}, $all_items ) );
usort( $product_types, function( $a, $b ) {
    $order = array( 'countertop', 'table', 'cutting-board', 'sink', 'shelving', 'custom' );
    return array_search( $a, $order ) - array_search( $b, $order );
} );
?>

<main id="services-main">

  <!-- ============================================================
       HERO
  ============================================================ -->
  <section class="services-hero">
    <div class="services-hero-grain" aria-hidden="true"></div>
    <div class="services-hero-content">
      <div class="services-hero-grid">

        <div class="services-hero-text">
          <p class="bg-eyebrow label-md">The Portfolio</p>
          <h1 class="display-lg">
            Finished Works<br>
            <em>In Acacia & Beyond.</em>
          </h1>
          <p class="body-text services-hero-desc">
            From kitchen islands to custom desks, these are pieces built to last. Mostly acacia and hevea — materials we know inside and out. Browse the gallery below to see what's possible.
          </p>
        </div>

        <div class="services-hero-aside">
          <div class="services-hero-stat">
            <span class="services-hero-stat-num"><?php echo count( $all_items ); ?>+</span>
            <span class="services-hero-stat-label label-sm">Portfolio Pieces</span>
          </div>
          <div class="services-hero-stat">
            <span class="services-hero-stat-num">6</span>
            <span class="services-hero-stat-label label-sm">Wood Species</span>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ============================================================
       PHILOSOPHY
  ============================================================ -->
  <section class="bg-philosophy">
    <div class="bg-container">
      <div class="bg-philosophy-inner">
        <div class="bg-philosophy-text">
          <p class="section-eyebrow label-md">What You're Looking At</p>
          <h2 class="headline-lg">
            Each Piece Is<br><em>a Conversation.</em>
          </h2>
        </div>
        <p class="body-text bg-philosophy-body">
          The pieces below aren't catalog items. They're custom commissions built to fit your space, your wood preference, and your vision. Some are acacia — our bread-and-butter, warm and durable. Others are hevea, walnut, or mixed species. Every one went through our three-stage process: precision cuts, hand-sanding through six grits, and finish that protects without hiding the grain.
        </p>
      </div>
    </div>
  </section>


  <!-- ============================================================
       PORTFOLIO GALLERY — Tabbed by Product Type
  ============================================================ -->
  <section class="bg-portfolio-showcase">
    <div class="bg-container">

      <div class="bg-portfolio-header">
        <h2 class="headline-lg">
          What We<br><em>Actually Build.</em>
        </h2>
        <p class="body-text">
          Browse finished pieces by category. Click any image to see it in detail.
        </p>
      </div>

      <!-- Product Filter Tabs -->
      <div class="bg-portfolio-tabs">
        <button class="bg-portfolio-tab active" data-filter="all">All Work</button>
        <?php foreach ( $product_types as $type ) : ?>
          <button class="bg-portfolio-tab" data-filter="<?php echo esc_attr( $type ); ?>">
            <?php echo esc_html( bg_get_product_label( $type ) ); ?>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- Masonry Grid -->
      <div class="bg-portfolio-grid">
        <?php
        if ( ! empty( $all_items ) ) {
            foreach ( $all_items as $item ) {
                if ( empty( $item->bg_img_url ) ) continue;

                $size_class = '';
                switch ( $item->bg_size ) {
                    case 'tall':
                        $size_class = 'bg-portfolio-item--tall';
                        break;
                    case 'wide':
                        $size_class = 'bg-portfolio-item--wide';
                        break;
                }
                ?>
                <a
                  href="<?php echo esc_url( $item->bg_img_url ); ?>"
                  class="bg-portfolio-item <?php echo $size_class; ?> bg-glightbox"
                  data-product="<?php echo esc_attr( $item->bg_product_type ); ?>"
                  data-gallery="portfolio"
                  data-title="<?php echo esc_attr( get_the_title( $item->ID ) ); ?>"
                >
                  <img
                    src="<?php echo esc_url( $item->bg_img_url ); ?>"
                    alt="<?php echo esc_attr( $item->bg_img_alt ); ?>"
                    loading="lazy"
                  />
                  <div class="bg-portfolio-overlay">
                    <div class="bg-portfolio-overlay-content">
                      <span class="bg-portfolio-wood-badge">
                        <?php echo esc_html( $item->bg_wood_label ); ?>
                      </span>
                      <i class="fas fa-expand"></i>
                      <p class="bg-portfolio-title"><?php echo esc_html( get_the_title( $item->ID ) ); ?></p>
                    </div>
                  </div>
                </a>
                <?php
            }
        } else {
            echo '<div style="grid-column: 1 / -1; padding: 3rem 2rem; text-align: center; color: #877270;">';
            echo '<p class="body-text">Portfolio gallery coming soon. Add photos via <strong>Portfolio Gallery</strong> in the WordPress admin.</p>';
            echo '</div>';
        }
        ?>
      </div>

    </div>
  </section>


  <!-- ============================================================
       WOOD SPECIES REFERENCE
  ============================================================ -->
  <section class="bg-wood-section">
    <div class="bg-container">

      <div class="bg-wood-header">
        <div>
          <p class="section-eyebrow label-md" style="color:rgba(218,193,191,.6);">Materials</p>
          <h2 class="headline-lg" style="color:#fcf9f2;">
            The Wood<br><em>We Work With.</em>
          </h2>
        </div>
        <p class="body-text" style="color:rgba(252,249,242,.7);">
          Material choice matters as much as craft. Here's what we typically source and why.
        </p>
      </div>

      <div class="bg-wood-grid">

        <?php
        $woods = array(
            array(
                'name'   => 'Acacia',
                'latin'  => 'Acacia melanoxylon',
                'traits' => array( 'Dense', 'Durable', 'Rich Tone' ),
                'desc'   => 'Our workhorse. Deep warm tones, exceptional hardness, tight grain that resists warping. Perfect for countertops and cutting blocks that see daily abuse.'
            ),
            array(
                'name'   => 'Hevea (Rubberwood)',
                'latin'  => 'Hevea brasiliensis',
                'traits' => array( 'Sustainable', 'Light Blonde', 'Workable' ),
                'desc'   => 'Plantation-grown from retired rubber trees. Clean blonde grain, machines beautifully, takes finish exceptionally well. Great for contemporary aesthetics.'
            ),
            array(
                'name'   => 'Hard Maple',
                'latin'  => 'Acer saccharum',
                'traits' => array( 'Classic', 'Rock-Hard', 'Light Color' ),
                'desc'   => 'Cream-colored, nearly indestructible. The commercial kitchen standard for end-grain butcher blocks. Takes abuse without complaint.'
            ),
            array(
                'name'   => 'Walnut',
                'latin'  => 'Juglans nigra',
                'traits' => array( 'Premium', 'Dark Grain', 'Refined' ),
                'desc'   => 'The luxury option. Deep chocolate tones, dramatic grain variation. Machines and finishes like glass. Reserved for high-end custom work.'
            ),
            array(
                'name'   => 'Shortleaf Acacia',
                'latin'  => 'Acacia holosericea',
                'traits' => array( 'Fine Grain', 'Smooth', 'Stable' ),
                'desc'   => 'Lighter acacia variant with tighter grain and excellent dimensional stability. Perfect for edge-grain boards where you want consistency.'
            ),
            array(
                'name'   => 'Chevron Mix',
                'latin'  => 'Multi-species parquetry',
                'traits' => array( 'Geometric', 'Contrasting', 'Custom' ),
                'desc'   => 'Not a single species — a pattern. Combines contrasting woods in angled herringbone layouts. High labor, high visual impact.'
            ),
        );
        foreach ( $woods as $wood ) :
        ?>
        <div class="bg-wood-card">
          <h3 class="bg-wood-name"><?php echo esc_html( $wood['name'] ); ?></h3>
          <span class="bg-wood-latin"><?php echo esc_html( $wood['latin'] ); ?></span>
          <div class="bg-wood-traits">
            <?php foreach ( $wood['traits'] as $trait ) : ?>
            <span class="bg-wood-trait label-sm"><?php echo esc_html( $trait ); ?></span>
            <?php endforeach; ?>
          </div>
          <p class="bg-wood-desc body-text"><?php echo esc_html( $wood['desc'] ); ?></p>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </section>


  <!-- ============================================================
       HOW IT WORKS (The Process)
  ============================================================ -->
  <section class="bg-process-section">
    <div class="bg-container">
      
      <div class="bg-process-header">
        <p class="section-eyebrow label-md">From Concept to Home</p>
        <h2 class="headline-lg">
          The Three Stages<br><em>of Craft.</em>
        </h2>
      </div>

      <div class="bg-process-grid">

        <div class="bg-process-card">
          <div class="bg-process-num">01</div>
          <h3>Cutting</h3>
          <p class="body-text">Every joint starts with a clean, square cut. Stock is dimensioned using table saws, planers, and jointers — removing warp and twist before glue ever touches the grain. The cut pattern dictates how that board will perform for decades.</p>
        </div>

        <div class="bg-process-card">
          <div class="bg-process-num">02</div>
          <h3>Sanding</h3>
          <p class="body-text">Machine sanders are for production lines. We hand-sand through six progressive grits — 80, 120, 150, 180, 220, 320 — following the grain on every pass. The goal isn't just smoothness, it's revealing the wood's natural depth without destroying its character.</p>
        </div>

        <div class="bg-process-card">
          <div class="bg-process-num">03</div>
          <h3>Finish</h3>
          <p class="body-text">Finish is the final conversation with the grain. Clearcoat for high-traffic countertops that need hard protection. Oil for cutting boards and serving pieces where you want the wood to breathe and age. Either way, we apply it in thin, controlled coats.</p>
        </div>

      </div>

    </div>
  </section>


  <!-- ============================================================
       CTA
  ============================================================ -->
  <section class="bg-services-cta">
    <div class="bg-container">
      <div class="bg-cta-inner">
        <div class="bg-cta-text">
          <h2 class="headline-lg" style="color:#fcf9f2;">
            Ready to Commission<br><em>Your Piece?</em>
          </h2>
          <p class="body-text" style="color:rgba(252,249,242,.75);">
            Call directly. We'll talk dimensions, wood species, finish options, and timeline. Every project starts with a real conversation — not a quote form.
          </p>
        </div>
        <div class="bg-cta-actions">
          <a href="tel:+13215433132" class="btn-primary bg-cta-btn">
            <i class="fas fa-phone" aria-hidden="true"></i>
            Call — (321) 543-3132
          </a>
          <a href="<?php echo esc_url( home_url( 'sms:+13215433132' ) ); ?>" class="btn-primary bg-cta-btn-sec">
            <i class="fas fa-comment-dots" aria-hidden="true"></i>
            Send a Message
          </a>
        </div>
      </div>
    </div>
  </section>

</main>