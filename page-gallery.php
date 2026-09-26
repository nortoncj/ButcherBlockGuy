<?php
/**
 * Template Name: Gallery
 *
 * Converted from the static gallery.html prototype.
 * Header and footer now come from header.php / footer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<style data-purpose="page-styling">
body {
      background-color: #1c1108;
      color: #16110b;
      font-family: 'Manrope', sans-serif;
    }
    .font-headline {
      font-family: 'Oswald', sans-serif;
      letter-spacing: 0.03em;
    }
    /* Hide scrollbar on the horizontally scrolling filter bar */
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    /* Scroll cue */
    @keyframes bbg-bob { 0%,100% { transform: translateY(0); } 50% { transform: translateY(6px); } }
    .bbg-bob { animation: bbg-bob 2.4s ease-in-out infinite; }
    @media (prefers-reduced-motion: reduce) { .bbg-bob { animation: none; } }
    /* Explicit fallback so the hover panel truncates even if the CDN build lacks line-clamp */
    .line-clamp-3 {
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
</style>
<!-- BEGIN: VideoHero -->
 <?php $video = get_post_meta(get_the_ID(), '_featured_video', true);
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<section class="relative h-[82vh] min-h-[520px] w-full overflow-hidden" id="gallery-hero">
<video autoplay="" class="absolute inset-0 w-full h-full object-cover" id="hero-video" loop="" muted="" playsinline="" poster="<?php echo $image ?>">
<source
 src="<?php echo $video ?>" type="video/mp4"/>
</video>
<div class="absolute inset-0 bg-gradient-to-b from-espresso/80 via-espresso/55 to-espresso"></div>
<div class="relative z-10 h-full max-w-5xl mx-auto px-6 flex flex-col items-center justify-center text-center">
<p class="font-headline text-gold text-xs sm:text-sm tracking-[0.3em] uppercase mb-4">
      Built by hand. Meant to last.
    </p>
<h1 class="font-headline font-bold text-ivory uppercase leading-[0.95] text-5xl sm:text-6xl lg:text-7xl mb-5">
      Crafted with purpose.
    </h1>
<p class="text-stone-300 text-sm sm:text-base max-w-xl mb-9">
      Timeless woodwork, custom built for your home and your life.
    </p>
<button class="group flex flex-col items-center gap-2.5" id="watch-craft-btn" type="button">
<span class="w-14 h-14 rounded-full border border-gold/70 group-hover:border-gold flex items-center justify-center transition">
<svg class="w-5 h-5 text-gold fill-current ml-0.5" id="watch-icon-play" viewbox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
<svg class="w-5 h-5 text-gold fill-current hidden" id="watch-icon-mute" viewbox="0 0 24 24"><path d="M16.5 12A4.5 4.5 0 0014 7.97v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.8 8.8 0 0021 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.9 8.9 0 003.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"></path></svg>
</span>
<span class="font-headline text-[10px] sm:text-xs tracking-[0.25em] uppercase text-stone-300 group-hover:text-gold transition" id="watch-craft-label">Watch the craft</span>
</button>
</div>
<a class="absolute bottom-7 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-stone-400 hover:text-gold transition" href="#gallery-grid">
<svg class="w-5 h-5 bbg-bob" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24"><path d="M12 5v14m0 0l-6-6m6 6l6-6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<span class="font-headline text-[10px] tracking-[0.25em] uppercase">Scroll to explore the gallery</span>
</a>
</section>
<!-- END: VideoHero -->

<!-- BEGIN: FilterBar -->
<div class="sticky top-[68px] lg:top-[76px] z-40 bg-[#140c06]/95 backdrop-blur border-y border-[#3a2415]/80" id="filter-bar">
<div class="max-w-7xl mx-auto px-3 lg:px-12 py-3 lg:py-3.5 flex items-center gap-4">
<div class="flex flex-wrap lg:flex-nowrap items-center justify-center lg:justify-start gap-1.5 lg:gap-2.5 lg:overflow-x-auto no-scrollbar flex-1" id="filter-group">
<button class="filter-btn is-active shrink-0 inline-flex items-center gap-1.5 lg:gap-2 font-headline text-[10px] lg:text-xs font-semibold uppercase tracking-wider px-2.5 py-2 lg:px-4 lg:py-2.5 rounded border transition bg-gold-light border-gold-light text-stone-900" data-filter="all" type="button">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><rect height="7" rx="1" width="7" x="3" y="3"></rect><rect height="7" rx="1" width="7" x="14" y="3"></rect><rect height="7" rx="1" width="7" x="3" y="14"></rect><rect height="7" rx="1" width="7" x="14" y="14"></rect></svg>
          All Work
        </button>
<button class="filter-btn shrink-0 inline-flex items-center gap-1.5 lg:gap-2 font-headline text-[10px] lg:text-xs font-semibold uppercase tracking-wider px-2.5 py-2 lg:px-4 lg:py-2.5 rounded border transition bg-transparent border-stone-600 text-stone-300 hover:border-gold hover:text-gold" data-filter="table" type="button">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M3 7h18M6 7v12M18 7v12" stroke-linecap="round"></path></svg>
          Tables
        </button>
<button class="filter-btn shrink-0 inline-flex items-center gap-1.5 lg:gap-2 font-headline text-[10px] lg:text-xs font-semibold uppercase tracking-wider px-2.5 py-2 lg:px-4 lg:py-2.5 rounded border transition bg-transparent border-stone-600 text-stone-300 hover:border-gold hover:text-gold" data-filter="countertop" type="button">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><rect height="14" rx="2" width="18" x="3" y="5"></rect><path d="M3 10h18" stroke-linecap="round"></path></svg>
          Countertops
        </button>
<button class="filter-btn shrink-0 inline-flex items-center gap-1.5 lg:gap-2 font-headline text-[10px] lg:text-xs font-semibold uppercase tracking-wider px-2.5 py-2 lg:px-4 lg:py-2.5 rounded border transition bg-transparent border-stone-600 text-stone-300 hover:border-gold hover:text-gold" data-filter="sink" type="button">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M4 12h16v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5z"></path><path d="M12 12V6a2 2 0 012-2" stroke-linecap="round"></path></svg>
          Kitchen Sinks
        </button>
<button class="filter-btn shrink-0 inline-flex items-center gap-1.5 lg:gap-2 font-headline text-[10px] lg:text-xs font-semibold uppercase tracking-wider px-2.5 py-2 lg:px-4 lg:py-2.5 rounded border transition bg-transparent border-stone-600 text-stone-300 hover:border-gold hover:text-gold" data-filter="custom" type="button">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
          Custom Work
        </button>
</div>
<div class="hidden md:flex items-center gap-2.5 shrink-0">
<span class="font-headline text-[10px] tracking-[0.2em] uppercase text-stone-500">Sort by</span>
<select class="bg-transparent border-0 focus:ring-0 font-headline text-xs font-semibold uppercase tracking-wider text-stone-200 cursor-pointer pr-7" id="sort-select">
<option class="bg-espresso" value="featured">Featured</option>
<option class="bg-espresso" value="newest">Newest</option>
<option class="bg-espresso" value="az">A – Z</option>
</select>
</div>
</div>
</div>
<!-- END: FilterBar -->

<!-- BEGIN: GalleryGrid -->
<section class="bg-espresso py-8 lg:py-10 px-4 lg:px-12" id="gallery-grid">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5" id="grid">

<?php
      /**
       * Cards come from the bg_gallery CPT via bg_get_portfolio_items()
       * (inc/cpt-gallery.php). The data-* attributes feed both the hover
       * panel and the lightbox, so the JS below needs no changes.
       */
      $bbg_items = function_exists( 'bg_get_portfolio_items' ) ? bg_get_portfolio_items( 'all', 'all' ) : array();

      foreach ( $bbg_items as $bbg_i => $bbg_item ) :

        if ( empty( $bbg_item->bg_img_url ) ) { continue; }

        $bbg_title  = get_the_title( $bbg_item->ID );
        $bbg_extra  = get_post_meta( $bbg_item->ID, 'bg_description', true );
        $bbg_dims   = get_post_meta( $bbg_item->ID, 'bg_dimensions', true );
        $bbg_style  = get_post_meta( $bbg_item->ID, 'bg_style', true );

        // bg_finish is a relationship to the Finishes CPT, so the stored
        // value is a post ID — resolve it to the finish name.
        $bbg_finish_id = get_post_meta( $bbg_item->ID, 'bg_finish', true );
        $bbg_finish    = $bbg_finish_id ? get_the_title( (int) $bbg_finish_id ) : '';

        // Lightbox thumbnails: featured image first, then any attached images.
        $bbg_gallery_ids = array( get_post_thumbnail_id( $bbg_item->ID ) );
        $bbg_attached = get_attached_media( 'image', $bbg_item->ID );
        foreach ( $bbg_attached as $bbg_att ) {
          if ( ! in_array( $bbg_att->ID, $bbg_gallery_ids, true ) ) { $bbg_gallery_ids[] = $bbg_att->ID; }
        }
        $bbg_urls = array();
        foreach ( array_filter( $bbg_gallery_ids ) as $bbg_id ) {
          $bbg_u = wp_get_attachment_image_url( $bbg_id, 'bg-gallery-large' );
          if ( $bbg_u ) { $bbg_urls[] = $bbg_u; }
        }
      ?>
      <button
        class="gallery-card group relative overflow-hidden rounded bg-foundry text-left aspect-[4/3]"
        type="button"
        data-category="<?php echo esc_attr( $bbg_item->bg_product_type ); ?>"
        data-title="<?php echo esc_attr( $bbg_title ); ?>"
        data-wood="<?php echo esc_attr( $bbg_item->bg_wood_label ); ?>"
        data-desc="<?php echo esc_attr( $bbg_extra ); ?>"
        data-dims="<?php echo esc_attr( $bbg_dims ); ?>"
        data-finish="<?php echo esc_attr( $bbg_finish ); ?>"
        data-style="<?php echo esc_attr( $bbg_style ); ?>"
        data-order="<?php echo esc_attr( $bbg_i ); ?>"
        data-images="<?php echo esc_attr( implode( ',', $bbg_urls ) ); ?>"
      >
        <img alt="<?php echo esc_attr( $bbg_item->bg_img_alt ? $bbg_item->bg_img_alt : $bbg_title ); ?>"
             class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-105"
             loading="lazy"
             src="<?php echo esc_url( $bbg_item->bg_img_url ); ?>">
        <div class="absolute inset-0 bg-gradient-to-t from-espresso/90 via-espresso/10 to-transparent transition group-hover:opacity-0"></div>
        <div class="absolute inset-x-0 bottom-0 p-4 flex items-end justify-between gap-3 transition group-hover:opacity-0">
          <span class="font-headline text-sm font-semibold uppercase tracking-wide text-ivory leading-tight"><?php echo esc_html( $bbg_title ); ?></span>
          <svg class="w-5 h-5 text-ivory stroke-current fill-none shrink-0" stroke-width="2" viewbox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
        </div>
        <div class="card-detail absolute inset-0 bg-espresso/95 ring-2 ring-gold rounded p-4 flex flex-col opacity-0 transition duration-300 group-hover:opacity-100 pointer-events-none"></div>
      </button>
      <?php endforeach; ?>

      </div>

<p class="hidden text-center text-stone-400 text-sm py-16" id="empty-state">
      No pieces in this category yet.
    </p>
</div>
</section>
<!-- END: GalleryGrid -->

<!-- BEGIN: Lightbox -->
<div aria-modal="true" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/85 backdrop-blur-sm p-4 sm:p-8" id="lightbox" role="dialog">
<button aria-label="Previous piece" class="hidden sm:flex absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full border border-stone-600 hover:border-gold text-stone-300 hover:text-gold items-center justify-center transition" id="lb-prev" type="button">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M15 6l-6 6 6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</button>
<button aria-label="Next piece" class="hidden sm:flex absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full border border-stone-600 hover:border-gold text-stone-300 hover:text-gold items-center justify-center transition" id="lb-next" type="button">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M9 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</button>

<div class="relative w-full max-w-6xl max-h-full overflow-y-auto bg-espresso rounded-lg ring-1 ring-foundry">
<button aria-label="Close" class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-espresso/80 text-stone-300 hover:text-gold flex items-center justify-center transition" id="lb-close" type="button">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</button>

<div class="grid grid-cols-1 lg:grid-cols-[1.25fr_1fr] gap-0">
<div class="p-4 sm:p-6">
<div class="rounded overflow-hidden bg-foundry aspect-[4/3]">
<img alt="" class="w-full h-full object-cover" id="lb-main-img" src=""/>
</div>
<div class="flex gap-2.5 mt-3 overflow-x-auto no-scrollbar" id="lb-thumbs"></div>
</div>

<div class="p-5 sm:p-7 lg:pl-2 flex flex-col">
<span class="self-start font-headline text-[10px] font-semibold uppercase tracking-[0.2em] text-gold border border-gold/50 rounded px-2.5 py-1 mb-4" id="lb-badge"></span>
<h2 class="font-headline text-2xl sm:text-3xl font-bold uppercase text-ivory leading-tight mb-3.5" id="lb-title"></h2>
<p class="text-stone-300 text-sm leading-relaxed mb-6" id="lb-desc"></p>

<dl class="space-y-3 mb-7">
<div class="flex items-baseline gap-4">
<dt class="font-headline text-[10px] font-semibold uppercase tracking-[0.18em] text-gold w-28 shrink-0">Wood Type</dt>
<dd class="text-stone-200 text-sm" id="lb-wood"></dd>
</div>
<div class="flex items-baseline gap-4">
<dt class="font-headline text-[10px] font-semibold uppercase tracking-[0.18em] text-gold w-28 shrink-0">Dimensions</dt>
<dd class="text-stone-200 text-sm" id="lb-dims"></dd>
</div>
<div class="flex items-baseline gap-4">
<dt class="font-headline text-[10px] font-semibold uppercase tracking-[0.18em] text-gold w-28 shrink-0">Finish</dt>
<dd class="text-stone-200 text-sm" id="lb-finish"></dd>
</div>
<div class="flex items-baseline gap-4">
<dt class="font-headline text-[10px] font-semibold uppercase tracking-[0.18em] text-gold w-28 shrink-0">Style</dt>
<dd class="text-stone-200 text-sm" id="lb-style"></dd>
</div>
</dl>

<a class="inline-flex items-center justify-center gap-2.5 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-xs uppercase tracking-wider px-6 py-3.5 rounded transition mb-3" href="#quote" id="lb-quote">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M9 12h6m-6 4h4M7 3h7l5 5v11a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            Request a Quote
          </a>

<button class="inline-flex items-center justify-center gap-2.5 text-gold hover:text-gold-light font-headline text-xs uppercase tracking-wider py-2 transition" id="lb-view-room" type="button">
<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewbox="0 0 24 24"><path d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3z" stroke-linejoin="round"></path><path d="M12 12l8-4.5M12 12v9M12 12L4 7.5" stroke-linejoin="round"></path></svg>
<span id="lb-view-room-label">View in Room</span>
</button>
<p class="hidden text-stone-500 text-xs text-center mt-1" id="lb-view-room-note">3D room preview isn't live yet.</p>
</div>
</div>
</div>
</div>
<!-- END: Lightbox -->



<script>
(function () {
  'use strict';

    /* ---------- Pin the filter bar directly under the real header ----------
     The header is taller on mobile (it carries the two call buttons), so
     measure it instead of hardcoding an offset. */
  var siteHeader = document.querySelector('header');
  var filterBar = document.getElementById('filter-bar');

  function syncFilterBarOffset() {
    if (!siteHeader || !filterBar) return;
    filterBar.style.top = siteHeader.offsetHeight + 'px';
  }
  syncFilterBarOffset();
  window.addEventListener('resize', syncFilterBarOffset);
  window.addEventListener('load', syncFilterBarOffset);

  /* ---------- Hero: unmute / mute the looping video ---------- */
  var video = document.getElementById('hero-video');
  var watchBtn = document.getElementById('watch-craft-btn');
  var watchLabel = document.getElementById('watch-craft-label');
  var iconPlay = document.getElementById('watch-icon-play');
  var iconMute = document.getElementById('watch-icon-mute');

  watchBtn.addEventListener('click', function () {
    video.muted = !video.muted;
    var muted = video.muted;
    watchLabel.textContent = muted ? 'Watch the craft' : 'Mute';
    iconPlay.classList.toggle('hidden', !muted);
    iconMute.classList.toggle('hidden', muted);
    if (!muted && video.paused) { video.play(); }
  });

  /* ---------- Build each card's hover-detail panel from its data ---------- */
  var cards = Array.prototype.slice.call(document.querySelectorAll('.gallery-card'));

  cards.forEach(function (card) {
    var d = card.dataset;
    var panel = card.querySelector('.card-detail');
    panel.innerHTML =
      '<span class="self-start font-headline text-[9px] font-semibold uppercase tracking-[0.18em] text-gold border border-gold/50 rounded px-2 py-0.5 mb-3">' + escapeHtml(d.wood) + '</span>' +
      '<span class="font-headline text-sm font-bold uppercase text-ivory leading-tight mb-2">' + escapeHtml(d.title) + '</span>' +
      '<span class="text-stone-400 text-xs leading-snug mb-3 line-clamp-3">' + escapeHtml(d.desc) + '</span>' +
      '<span class="font-headline text-[9px] font-semibold uppercase tracking-[0.18em] text-gold">Dimensions</span>' +
      '<span class="text-stone-300 text-xs mb-auto">' + escapeHtml(d.dims) + '</span>' +
      '<span class="font-headline text-[10px] font-semibold uppercase tracking-wider text-gold inline-flex items-center gap-1.5 mt-3">View Details ' +
        '<svg class="w-3.5 h-3.5 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>' +
      '</span>';
  });

  function escapeHtml(str) {
    return String(str).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  /* ---------- Filtering ---------- */
  var filterBtns = Array.prototype.slice.call(document.querySelectorAll('.filter-btn'));
  var emptyState = document.getElementById('empty-state');
  var activeFilter = 'all';

  var ACTIVE_CLASSES = ['bg-gold-light', 'border-gold-light', 'text-stone-900'];
  var IDLE_CLASSES = ['bg-transparent', 'border-stone-600', 'text-stone-300', 'hover:border-gold', 'hover:text-gold'];

  function setFilterActive(btn) {
    filterBtns.forEach(function (b) {
      var on = b === btn;
      b.classList.toggle('is-active', on);
      ACTIVE_CLASSES.forEach(function (c) { b.classList.toggle(c, on); });
      IDLE_CLASSES.forEach(function (c) { b.classList.toggle(c, !on); });
    });
  }

  function applyFilter() {
    var visible = 0;
    cards.forEach(function (card) {
      var match = activeFilter === 'all' || card.dataset.category === activeFilter;
      card.classList.toggle('hidden', !match);
      if (match) visible++;
    });
    emptyState.classList.toggle('hidden', visible > 0);
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      activeFilter = btn.dataset.filter;
      setFilterActive(btn);
      applyFilter();
    });
  });

  /* ---------- Sorting ---------- */
  var grid = document.getElementById('grid');
  document.getElementById('sort-select').addEventListener('change', function (e) {
    var mode = e.target.value;
    var sorted = cards.slice().sort(function (a, b) {
      if (mode === 'az') return a.dataset.title.localeCompare(b.dataset.title);
      if (mode === 'newest') return Number(b.dataset.order) - Number(a.dataset.order);
      return Number(a.dataset.order) - Number(b.dataset.order);
    });
    sorted.forEach(function (card) { grid.appendChild(card); });
  });

  /* ---------- Lightbox ---------- */
  var lightbox = document.getElementById('lightbox');
  var lbMain = document.getElementById('lb-main-img');
  var lbThumbs = document.getElementById('lb-thumbs');
  var lbRoomNote = document.getElementById('lb-view-room-note');
  var currentIndex = -1;
  var lastFocused = null;

  function visibleCards() {
    return cards.filter(function (c) { return !c.classList.contains('hidden'); });
  }

  function openLightbox(card) {
    var d = card.dataset;
    document.getElementById('lb-badge').textContent = d.wood;
    document.getElementById('lb-title').textContent = d.title;
    document.getElementById('lb-desc').textContent = d.desc;
    document.getElementById('lb-wood').textContent = d.wood;
    document.getElementById('lb-dims').textContent = d.dims;
    document.getElementById('lb-finish').textContent = d.finish;
    document.getElementById('lb-style').textContent = d.style;
    lbRoomNote.classList.add('hidden');

    var seeds = d.images.split(',');
    lbMain.src = seeds[0];
    lbMain.alt = d.title;

    lbThumbs.innerHTML = '';
    seeds.forEach(function (seed, i) {
      var t = document.createElement('button');
      t.type = 'button';
      t.className = 'shrink-0 w-20 h-16 rounded overflow-hidden ring-1 transition ' +
        (i === 0 ? 'ring-gold' : 'ring-foundry hover:ring-stone-500');
      t.innerHTML = '<img src="' + seed + '" alt="" class="w-full h-full object-cover">';
      t.addEventListener('click', function () {
        lbMain.src = seed;
        Array.prototype.forEach.call(lbThumbs.children, function (child, ci) {
          child.classList.toggle('ring-gold', ci === i);
          child.classList.toggle('ring-foundry', ci !== i);
        });
      });
      lbThumbs.appendChild(t);
    });

    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
    document.getElementById('lb-close').focus();
  }

  function closeLightbox() {
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
    document.body.style.overflow = '';
    if (lastFocused) lastFocused.focus();
  }

  function step(dir) {
    var list = visibleCards();
    if (!list.length) return;
    currentIndex = (currentIndex + dir + list.length) % list.length;
    openLightbox(list[currentIndex]);
  }

  cards.forEach(function (card) {
    card.addEventListener('click', function () {
      lastFocused = card;
      currentIndex = visibleCards().indexOf(card);
      openLightbox(card);
    });
  });

  document.getElementById('lb-close').addEventListener('click', closeLightbox);
  document.getElementById('lb-prev').addEventListener('click', function () { step(-1); });
  document.getElementById('lb-next').addEventListener('click', function () { step(1); });

  lightbox.addEventListener('click', function (e) {
    if (e.target === lightbox) closeLightbox();
  });

  document.getElementById('lb-view-room').addEventListener('click', function () {
    lbRoomNote.classList.remove('hidden');
  });

  document.addEventListener('keydown', function (e) {
    if (lightbox.classList.contains('hidden')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') step(-1);
    if (e.key === 'ArrowRight') step(1);
  });
})();
</script>

<?php get_footer();