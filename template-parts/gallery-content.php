<?php
/**
 * Template Name: Full Gallery
 *
 * Block & Grain — Full Portfolio Gallery
 * Heirloom Contrast Design System
 *
 * The "see everything" view of the same bg_gallery data used on the
 * homepage teaser and the Services page. Adds two things neither of
 * those have: filtering by wood species (not just product type) with
 * both filters combinable, and a masonry layout driven by the bg_size
 * field (tall / wide pieces actually break the grid).
 *
 * Nothing new needed in wp-admin — this reads the same Title,
 * Featured Image, Product Type, and Wood Type fields you already fill
 * in under Portfolio Gallery.
 *
 * NOTE: the lightbox groups ALL portfolio items together for
 * next/prev navigation, not just the currently-filtered subset — once
 * someone opens a piece they can keep arrowing through everything,
 * not only what matched their filters. That's a GLightbox limitation,
 * not a bug; flag it if you'd rather it respect the active filter.
 */

// Enqueue GLightbox (same library/version as the Services page — a second
// page load enqueues it fresh, no conflict with that page's copy)
wp_enqueue_style( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', array(), '3.2.0' );
wp_enqueue_script( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', array(), '3.2.0', true );

wp_add_inline_script( 'glightbox', "
document.addEventListener('DOMContentLoaded', function () {
    GLightbox({
        selector: '.bg-fg-glightbox',
        openEffect: 'fade',
        closeEffect: 'fade',
        touchNavigation: true,
        keyboardNavigation: true,
        closeOnOutsideClick: true,
    });

    var productBtns = document.querySelectorAll('.bg-fg-filter-product');
    var woodBtns    = document.querySelectorAll('.bg-fg-filter-wood');
    var items       = document.querySelectorAll('.bg-fg-item');
    var countEl     = document.getElementById('bg-fg-count');
    var emptyEl     = document.getElementById('bg-fg-empty');
    var clearBtn    = document.getElementById('bg-fg-clear');
    var total       = items.length;

    var activeProduct = 'all';
    var activeWood    = 'all';

    function applyFilters() {
        var visible = 0;

        items.forEach(function (item) {
            var matchesProduct = activeProduct === 'all' || item.dataset.product === activeProduct;
            var matchesWood    = activeWood === 'all' || item.dataset.wood === activeWood;
            var show = matchesProduct && matchesWood;
            item.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        if (countEl) {
            countEl.textContent = 'Showing ' + visible + ' of ' + total + ' pieces';
        }
        if (emptyEl) {
            emptyEl.style.display = visible === 0 ? '' : 'none';
        }
        if (clearBtn) {
            clearBtn.style.display = (activeProduct === 'all' && activeWood === 'all') ? 'none' : '';
        }
    }

    productBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            productBtns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            activeProduct = btn.dataset.filter;
            applyFilters();
        });
    });

    woodBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            woodBtns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            activeWood = btn.dataset.filter;
            applyFilters();
        });
    });

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            activeProduct = 'all';
            activeWood = 'all';
            productBtns.forEach(function (b) { b.classList.toggle('active', b.dataset.filter === 'all'); });
            woodBtns.forEach(function (b) { b.classList.toggle('active', b.dataset.filter === 'all'); });
            applyFilters();
        });
    }

    applyFilters();
});
" );

// Same data source as the homepage teaser and the Services page — one
// source of truth, three different front-end views.
$all_items = function_exists( 'bg_get_portfolio_items' ) ? bg_get_portfolio_items( 'all', 'all' ) : array();

// Unique product types present, in a sensible fixed order.
$product_order = array( 'countertop', 'table', 'cutting-board', 'sink', 'shelving', 'custom' );
$product_types = array_unique( wp_list_pluck( $all_items, 'bg_product_type' ) );
usort( $product_types, function ( $a, $b ) use ( $product_order ) {
	return array_search( $a, $product_order ) - array_search( $b, $product_order );
} );

// Unique wood types present, with their display labels already computed
// on each item by bg_get_portfolio_items() — no need to touch cpt-gallery.php.
$wood_order  = array( 'acacia', 'hevea', 'walnut', 'maple', 'chevron', 'other' );
$wood_labels = array();
foreach ( $all_items as $item ) {
	$wood_labels[ $item->bg_wood_type ] = $item->bg_wood_label;
}
uksort( $wood_labels, function ( $a, $b ) use ( $wood_order ) {
	return array_search( $a, $wood_order ) - array_search( $b, $wood_order );
} );
?>

<style> 
    /* ==========================================================================
   Block & Grain — Full Gallery page styles
   Enqueue conditionally in functions.php with is_page_template('gallery-content.php')
   Typography (display-lg, headline-lg, label-md, label-sm, body-text,
   section-eyebrow, bg-container) is assumed already defined globally —
   only layout/component styles for this page live here.
   Colors are hardcoded to the Heirloom Contrast values rather than
   assumed CSS custom properties, since I don't know your global
   stylesheet's variable names.
   ========================================================================== */

#bg-fg-main{ background: #fcf9f2; }

/* ---------- Hero ---------- */
.bg-fg-hero{
  background: #4a0e0e;
  padding: clamp(48px, 8vw, 88px) 24px clamp(56px, 9vw, 96px);
}
.bg-fg-hero .section-eyebrow{ color: #d9b8b8; margin: 0 0 14px; }
.bg-fg-hero h1{ color: #fcf9f2; margin: 0 0 16px; }
.bg-fg-hero-desc{ color: #e6d3d3; max-width: 46ch; margin: 0; }

/* ---------- Filters ---------- */
.bg-fg-filters{
  background: #f6f3ec;
  padding: 28px 24px;
  position: sticky;
  top: 0;
  z-index: 20;
}
.bg-fg-filter-row{
  display: flex;
  align-items: center;
  gap: 18px;
  flex-wrap: wrap;
  margin-bottom: 12px;
}
.bg-fg-filter-row:last-of-type{ margin-bottom: 0; }
.bg-fg-filter-label{
  color: #877270;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  flex: 0 0 auto;
  width: 52px;
}
.bg-fg-filter-group{
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}
.bg-fg-filter-group button{
  background: #ffffff;
  border: none;
  cursor: pointer;
  padding: 7px 16px;
  border-radius: 999px;
  font-family: 'Work Sans', sans-serif;
  font-weight: 600;
  font-size: 11px;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: #877270;
  transition: background 0.2s ease, color 0.2s ease;
}
.bg-fg-filter-group button:hover{ color: #2a0002; }
.bg-fg-filter-group button.active{ background: #2a0002; color: #fff; }

.bg-fg-filter-meta{
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 18px;
  padding-top: 14px;
}
.bg-fg-filter-meta #bg-fg-count{ color: #877270; text-transform: uppercase; letter-spacing: 0.06em; }
.bg-fg-clear-btn{
  background: none;
  border: none;
  cursor: pointer;
  color: #2a0002;
  text-decoration: underline;
  text-underline-offset: 3px;
  padding: 0;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  font-family: 'Work Sans', sans-serif;
  font-weight: 600;
}

/* ---------- Masonry grid ---------- */
.bg-fg-grid-section{ padding: 40px 24px 72px; }
.bg-fg-grid{
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-auto-rows: 200px;
  grid-auto-flow: dense;
  gap: 12px;
}
.bg-fg-item{
  position: relative;
  display: block;
  border-radius: 8px;
  overflow: hidden;
  background: #ebe8e1;
}
.bg-fg-item--tall{ grid-row: span 2; }
.bg-fg-item--wide{ grid-column: span 2; }
.bg-fg-item img{
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.5s ease;
}
.bg-fg-item:hover img{ transform: scale(1.06); }

.bg-fg-item-overlay{
  position: absolute;
  inset: 0;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 14px;
  background: linear-gradient(180deg, rgba(28,28,24,0) 40%, rgba(28,28,24,0.75) 100%);
  opacity: 0;
  transition: opacity 0.25s ease;
}
.bg-fg-item:hover .bg-fg-item-overlay{ opacity: 1; }

.bg-fg-item-tags{
  display: flex;
  gap: 6px;
  margin-bottom: 6px;
  flex-wrap: wrap;
}
.bg-fg-item-wood,
.bg-fg-item-product{
  font-family: 'Work Sans', sans-serif;
  font-weight: 600;
  font-size: 9px;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  padding: 3px 8px;
  border-radius: 3px;
}
.bg-fg-item-wood{ background: rgba(42,0,2,0.85); color: #fff; }
.bg-fg-item-product{ background: rgba(255,255,255,0.9); color: #2a0002; }
.bg-fg-item-title{
  font-family: 'Newsreader', serif;
  font-style: italic;
  font-size: 14px;
  color: #fff;
  line-height: 1.3;
}

/* ---------- Empty state ---------- */
.bg-fg-empty-state{
  grid-column: 1 / -1;
  text-align: center;
  padding: 64px 24px;
  color: #877270;
}
.bg-fg-clear-inline{
  background: none;
  border: none;
  cursor: pointer;
  color: #2a0002;
  text-decoration: underline;
  text-underline-offset: 3px;
  font: inherit;
  padding: 0;
}

/* ---------- Responsive ---------- */
@media (max-width: 900px){
  .bg-fg-grid{ grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 640px){
  .bg-fg-grid{ grid-template-columns: repeat(2, 1fr); grid-auto-rows: 160px; }
  .bg-fg-item--wide{ grid-column: span 2; }
  .bg-fg-filter-row{ align-items: flex-start; }
  .bg-fg-filter-label{ width: auto; margin-bottom: 4px; }
  .bg-fg-filter-row{ flex-direction: column; align-items: flex-start; gap: 8px; }
  .bg-fg-filters{ position: static; }
}
</style>

<main id="bg-fg-main">

  <section class="bg-fg-hero">
    <div class="bg-container">
      <p class="section-eyebrow label-md">The Full Portfolio</p>
      <h1 class="display-lg">Every Piece,<br><em>All in One Place.</em></h1>
      <p class="body-text bg-fg-hero-desc">
        Filter by what it is, filter by what it's made of, or just scroll. Click anything to see it full size.
      </p>
    </div>
  </section>

  <section class="bg-fg-filters">
    <div class="bg-container">

      <div class="bg-fg-filter-row">
        <span class="bg-fg-filter-label label-sm">Type</span>
        <div class="bg-fg-filter-group">
          <button class="bg-fg-filter-product active" data-filter="all">All</button>
          <?php foreach ( $product_types as $type ) : ?>
            <button class="bg-fg-filter-product" data-filter="<?php echo esc_attr( $type ); ?>">
              <?php echo esc_html( function_exists( 'bg_get_product_label' ) ? bg_get_product_label( $type ) : $type ); ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="bg-fg-filter-row">
        <span class="bg-fg-filter-label label-sm">Wood</span>
        <div class="bg-fg-filter-group">
          <button class="bg-fg-filter-wood active" data-filter="all">All</button>
          <?php foreach ( $wood_labels as $wood_key => $wood_label ) : ?>
            <button class="bg-fg-filter-wood" data-filter="<?php echo esc_attr( $wood_key ); ?>">
              <?php echo esc_html( $wood_label ); ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="bg-fg-filter-meta">
        <span id="bg-fg-count" class="label-sm"><?php echo count( $all_items ); ?> pieces</span>
        <button id="bg-fg-clear" class="bg-fg-clear-btn label-sm" style="display:none;">Clear filters</button>
      </div>

    </div>
  </section>

  <section class="bg-fg-grid-section">
    <div class="bg-container">

      <div class="bg-fg-grid">
        <?php
        if ( ! empty( $all_items ) ) :
          foreach ( $all_items as $item ) :
            if ( empty( $item->bg_img_url ) ) continue;

            $size_class = '';
            if ( 'tall' === $item->bg_size ) {
              $size_class = 'bg-fg-item--tall';
            } elseif ( 'wide' === $item->bg_size ) {
              $size_class = 'bg-fg-item--wide';
            }
        ?>
          <a
            href="<?php echo esc_url( $item->bg_img_url ); ?>"
            class="bg-fg-item <?php echo esc_attr( $size_class ); ?> bg-fg-glightbox"
            data-gallery="full-portfolio"
            data-product="<?php echo esc_attr( $item->bg_product_type ); ?>"
            data-wood="<?php echo esc_attr( $item->bg_wood_type ); ?>"
            data-title="<?php echo esc_attr( get_the_title( $item->ID ) ); ?>"
          >
            <img
              src="<?php echo esc_url( $item->bg_img_url ); ?>"
              alt="<?php echo esc_attr( $item->bg_img_alt ); ?>"
              loading="lazy"
            >
            <span class="bg-fg-item-overlay">
              <span class="bg-fg-item-tags">
                <span class="bg-fg-item-wood"><?php echo esc_html( $item->bg_wood_label ); ?></span>
                <span class="bg-fg-item-product"><?php echo esc_html( function_exists( 'bg_get_product_label' ) ? bg_get_product_label( $item->bg_product_type ) : $item->bg_product_type ); ?></span>
              </span>
              <span class="bg-fg-item-title"><?php echo esc_html( get_the_title( $item->ID ) ); ?></span>
            </span>
          </a>
        <?php
          endforeach;
        else :
        ?>
          <div class="bg-fg-empty-state">
            <p class="body-text">No gallery items yet — add some from Portfolio Gallery in the admin.</p>
          </div>
        <?php endif; ?>
      </div>

      <div id="bg-fg-empty" class="bg-fg-empty-state" style="display:none;">
        <p class="body-text">Nothing matches that combination. <button id="bg-fg-clear-2" class="bg-fg-clear-inline" onclick="document.getElementById('bg-fg-clear').click();">Clear filters</button> and try again.</p>
      </div>

    </div>
  </section>

</main>