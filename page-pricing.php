<?php
/**
 * Template Name: Pricing Calculator
 *
 * Converted from the static pricing.html prototype.
 * Header and footer now come from header.php / footer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$bbg_price = bbg_pricing_data();
?>

<script id="bbg-pricing-data" type="application/json"><?php
	echo wp_json_encode( $bbg_price );
?></script>

<style data-purpose="page-styling">
body { background-color: #1c1108; color: #16110b; font-family: 'Manrope', sans-serif; }
    .font-headline { font-family: 'Oswald', sans-serif; letter-spacing: 0.03em; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    @keyframes bbg-bob { 0%,100% { transform: translateY(0); } 50% { transform: translateY(6px); } }
    .bbg-bob { animation: bbg-bob 2.4s ease-in-out infinite; }
    @media (prefers-reduced-motion: reduce) { .bbg-bob { animation: none; } }

    /* Wood swatches — CSS only, no image requests */
    .swatch { width: 2.5rem; height: 2.5rem; border-radius: 9999px; flex-shrink: 0; }
    .swatch-acacia { background: repeating-linear-gradient(115deg,#6b3f1d,#6b3f1d 3px,#8a5426 3px,#8a5426 6px); }
    .swatch-hevea  { background: repeating-linear-gradient(115deg,#c69963,#c69963 3px,#d8b183 3px,#d8b183 6px); }
    .swatch-walnut { background: repeating-linear-gradient(115deg,#3f2416,#3f2416 3px,#5a3623 3px,#5a3623 6px); }
    .swatch-custom { background: conic-gradient(#6b3f1d,#c69963,#3f2416,#8a5426,#6b3f1d); }

    /* Range input styled for the dark UI */
    input[type=range].bbg-range { -webkit-appearance: none; appearance: none; height: 4px; border-radius: 999px; background: #3a2415; outline: none; }
    input[type=range].bbg-range::-webkit-slider-thumb { -webkit-appearance: none; appearance: none; width: 20px; height: 20px; border-radius: 999px; background: #c89548; cursor: pointer; border: none; }
    input[type=range].bbg-range::-moz-range-thumb { width: 20px; height: 20px; border-radius: 999px; background: #c89548; cursor: pointer; border: none; }
</style>
<!-- BEGIN: PricingHero -->
  <?php $video = get_post_meta(get_the_ID(), '_featured_video', true);
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<section class="relative h-[62vh] min-h-[420px] w-full overflow-hidden" id="pricing-hero">
<video autoplay="" class="absolute inset-0 w-full h-full object-cover" loop="" muted="" playsinline="" poster="<?php echo $image ?>">
<source src="<?php echo $video ?>" type="video/mp4"/>
</video>
<div class="absolute inset-0 bg-gradient-to-r from-espresso via-espresso/80 to-espresso/30"></div>
<div class="absolute inset-0 bg-gradient-to-t from-espresso via-transparent to-transparent"></div>
<div class="relative z-10 h-full max-w-7xl mx-auto px-6 lg:px-12 flex flex-col justify-center">
<p class="font-headline text-gold text-xs sm:text-sm tracking-[0.25em] uppercase mb-3">
      Built by hand. Meant to last.
    </p>
<h1 class="font-headline font-bold text-ivory uppercase leading-[0.95] text-4xl sm:text-5xl lg:text-6xl mb-5">
      Get an instant price
    </h1>
<p class="text-stone-300 text-sm sm:text-base max-w-md leading-relaxed">
      Customize your piece and get a real-time estimate.<br class="hidden sm:block"/>
      Simple, transparent, and built for you.
    </p>
</div>
<a class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-stone-400 hover:text-gold transition" href="#calculator">
<svg class="w-5 h-5 bbg-bob" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24"><path d="M12 5v14m0 0l-6-6m6 6l6-6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
<span class="font-headline text-[10px] tracking-[0.25em] uppercase">Build your estimate</span>
</a>
</section>
<!-- END: PricingHero -->

<!-- BEGIN: Calculator -->
<section class="bg-espresso px-4 lg:px-12 py-10 lg:py-14" id="calculator">
<div class="max-w-4xl mx-auto">

<!-- Tool switch -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
<button class="tool-tab is-active inline-flex items-center justify-center gap-2.5 font-headline text-xs sm:text-sm font-semibold uppercase tracking-wider px-5 py-4 rounded border transition bg-gold-light border-gold-light text-stone-900" data-tool="pieces" type="button">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.8" viewbox="0 0 24 24"><path d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3z" stroke-linejoin="round"></path><path d="M12 12l8-4.5M12 12v9M12 12L4 7.5" stroke-linejoin="round"></path></svg>
        Ready-Made Pieces
      </button>
<button class="tool-tab inline-flex items-center justify-center gap-2.5 font-headline text-xs sm:text-sm font-semibold uppercase tracking-wider px-5 py-4 rounded border transition bg-transparent border-stone-700 text-stone-300 hover:border-gold hover:text-gold" data-tool="install" type="button">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.8" viewbox="0 0 24 24"><path d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
        Full Install Estimate
      </button>
</div>
<p class="text-center text-stone-400 text-xs sm:text-sm mt-4 mb-10 max-w-2xl mx-auto leading-relaxed">
      These two tools don't share numbers on purpose — a small piece's price shouldn't imply what a full install should cost.
    </p>

<!-- ============ READY-MADE PIECES ============ -->
<div id="panel-pieces">

<p class="font-headline text-gold text-[11px] tracking-[0.18em] uppercase mb-3">1. Pick a piece</p>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-8" id="opt-item">
<?php foreach ( $bbg_price['pieces'] as $i => $pc ) : ?>
<button class="opt<?php echo 0 === $i ? ' is-active' : ''; ?>" data-key="<?php echo esc_attr( $pc['key'] ); ?>" type="button">
<?php echo bbg_service_icon( $pc['key'], 'w-6 h-6 stroke-current fill-none shrink-0' ); ?>
<span><?php echo esc_html( $pc['label'] ); ?></span><span class="tick"></span>
</button>
<?php endforeach; ?>
<?php if ( ! $bbg_price['pieces'] ) : ?>
<p class="col-span-full text-stone-500 text-sm">No piece types yet — add them under <strong>Piece Types</strong>.</p>
<?php endif; ?>
</div>

<p class="font-headline text-gold text-[11px] tracking-[0.18em] uppercase mb-3">2. Size</p>
<div class="grid grid-cols-3 gap-3 mb-8" id="opt-size">
<button class="opt flex-col" data-key="Small" type="button">
<span class="block font-medium">Small</span><span class="block text-stone-400 text-xs mt-0.5"><?php echo esc_html( $bbg_price['sizes']['Small'] ); ?></span><span class="tick"></span>
</button>
<button class="opt flex-col is-active" data-key="Medium" type="button">
<span class="block font-medium">Medium</span><span class="block text-stone-400 text-xs mt-0.5"><?php echo esc_html( $bbg_price['sizes']['Medium'] ); ?></span><span class="tick"></span>
</button>
<button class="opt flex-col" data-key="Large" type="button">
<span class="block font-medium">Large</span><span class="block text-stone-400 text-xs mt-0.5"><?php echo esc_html( $bbg_price['sizes']['Large'] ); ?></span><span class="tick"></span>
</button>
</div>

<p class="font-headline text-gold text-[11px] tracking-[0.18em] uppercase mb-3">3. Wood</p>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-8" id="opt-wood">
<?php foreach ( $bbg_price['woods'] as $i => $wd ) : ?>
<button class="opt<?php echo 0 === $i ? ' is-active' : ''; ?>"
        data-key="<?php echo esc_attr( $wd['key'] ); ?>"
        data-quote-only="<?php echo $wd['quoteOnly'] ? '1' : '0'; ?>" type="button">
<span class="swatch" style="background: repeating-linear-gradient(115deg, <?php echo esc_attr( $wd['hex'] ); ?>, <?php echo esc_attr( $wd['hex'] ); ?> 3px, rgba(255,255,255,.12) 3px, rgba(255,255,255,.12) 6px), <?php echo esc_attr( $wd['hex'] ); ?>;"></span>
<span><?php echo esc_html( $wd['label'] ); ?></span><span class="tick"></span>
</button>
<?php endforeach; ?>
<?php if ( ! $bbg_price['woods'] ) : ?>
<p class="col-span-full text-stone-500 text-sm">No woods yet — add them under <strong>Woods</strong>.</p>
<?php endif; ?>
</div>

<p class="font-headline text-gold text-[11px] tracking-[0.18em] uppercase mb-3">4. Finish</p>
<div class="relative mb-8">
<svg class="w-5 h-5 text-gold stroke-current fill-none absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" stroke-width="1.6" viewbox="0 0 24 24"><path d="M12 3s6 6.5 6 10a6 6 0 01-12 0c0-3.5 6-10 6-10z" stroke-linejoin="round"></path></svg>
<select class="w-full bg-[#140c06] border border-stone-700 focus:border-gold focus:ring-0 rounded text-stone-200 text-sm pl-12 pr-10 py-4 appearance-none cursor-pointer" id="finish-select">
<?php foreach ( $bbg_price['finishes'] as $fn ) : ?>
<option value="<?php echo esc_attr( $fn['key'] ); ?>"><?php echo esc_html( $fn['label'] ); ?></option>
<?php endforeach; ?>
</select>
<svg class="w-4 h-4 text-stone-400 stroke-current fill-none absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" stroke-width="2" viewbox="0 0 24 24"><path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</div>

<p class="font-headline text-gold text-[11px] tracking-[0.18em] uppercase mb-3">5. Date needed</p>
<div class="relative mb-3">
<svg class="w-5 h-5 text-gold stroke-current fill-none absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" stroke-width="1.6" viewbox="0 0 24 24"><rect height="16" rx="2" width="18" x="3" y="5"></rect><path d="M3 10h18M8 3v4M16 3v4" stroke-linecap="round"></path></svg>
<input class="w-full bg-[#140c06] border border-stone-700 focus:border-gold focus:ring-0 rounded text-stone-200 text-sm pl-12 pr-4 py-4" id="date-needed" type="date"/>
</div>
<p class="flex items-center gap-2 text-stone-400 text-xs mb-9">
<svg class="w-4 h-4 text-gold stroke-current fill-none shrink-0" stroke-width="1.6" viewbox="0 0 24 24"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2" stroke-linecap="round"></path></svg>
        <?php echo esc_html( bbg_opt( 'rush_note', 'Rush timelines may add a fee, confirmed with Troy directly.' ) ); ?>
      </p>

<!-- Price panel -->
<div class="rounded-lg border border-foundry bg-gradient-to-b from-[#2a1a0e] to-[#1a1008] px-6 py-9 text-center">
<p class="font-headline text-gold text-xs tracking-[0.2em] uppercase mb-2">Your price</p>
<p class="font-headline font-bold text-ivory text-5xl sm:text-6xl leading-none" id="piece-price">$174</p>
<div class="flex items-center justify-center gap-3 my-6">
<span class="h-px w-16 bg-foundry"></span>
<svg class="w-5 h-5 text-gold fill-current" viewbox="0 0 24 24"><path d="M12 2a5 5 0 00-4.9 4A4 4 0 006 13.9V14h4v8h4v-8h4v-.1A4 4 0 0016.9 6 5 5 0 0012 2z"></path></svg>
<span class="h-px w-16 bg-foundry"></span>
</div>
<p class="text-stone-300 text-sm leading-relaxed">
          Price is confirmed when you place your order.<br class="hidden sm:block"/>
          Custom wood gets a personal quote instead of an instant price.
        </p>
</div>

<a class="mt-7 w-full sm:w-auto sm:mx-auto flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-10 py-4 rounded transition" href="<?php echo esc_url( home_url( '/#quote' ) ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.8" viewbox="0 0 24 24"><path d="M9 12h6m-6 4h4M7 3h7l5 5v11a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
        Get a detailed quote
      </a>
<p class="flex items-center justify-center gap-2 text-stone-400 text-xs mt-4">
<svg class="w-3.5 h-3.5 stroke-current fill-none" stroke-width="1.8" viewbox="0 0 24 24"><rect height="10" rx="2" width="14" x="5" y="11"></rect><path d="M8 11V8a4 4 0 018 0v3" stroke-linecap="round"></path></svg>
        No commitment. Just expert craftsmanship.
      </p>
</div>

<!-- ============ FULL INSTALL ESTIMATE ============ -->
<div class="hidden" id="panel-install">

<p class="font-headline text-gold text-[11px] tracking-[0.18em] uppercase mb-3">1. Countertop area</p>
<div class="bg-[#140c06] border border-stone-700 rounded px-5 py-6 mb-8">
<div class="flex items-center justify-between mb-4">
<span class="text-stone-300 text-sm">Approximate square footage</span>
<span class="font-headline text-ivory text-xl font-semibold" id="sqft-out">20 sq ft</span>
</div>
<input class="bbg-range w-full" id="sqft"
       max="<?php echo esc_attr( $bbg_price['install']['maxSqft'] ); ?>"
       min="<?php echo esc_attr( $bbg_price['install']['minSqft'] ); ?>"
       step="1" type="range"
       value="<?php echo esc_attr( round( ( $bbg_price['install']['minSqft'] + $bbg_price['install']['maxSqft'] ) / 3 ) ); ?>"/>
<div class="flex justify-between text-stone-500 text-[11px] mt-2">
<span><?php echo esc_html( $bbg_price['install']['minSqft'] ); ?> sq ft</span><span><?php echo esc_html( $bbg_price['install']['maxSqft'] ); ?> sq ft</span>
</div>
</div>

<p class="font-headline text-gold text-[11px] tracking-[0.18em] uppercase mb-3">2. Complexity add-ons</p>
<div class="space-y-3 mb-9" id="addons">
<?php foreach ( $bbg_price['install']['addons'] as $ad ) : ?>
<label class="flex items-center gap-3 bg-[#140c06] border border-stone-700 rounded px-5 py-4 cursor-pointer hover:border-gold/60 transition">
<input class="addon w-5 h-5 rounded bg-transparent border-stone-600 text-gold focus:ring-0 focus:ring-offset-0" type="checkbox"/>
<span class="text-stone-200 text-sm"><?php echo esc_html( $ad ); ?></span>
</label>
<?php endforeach; ?>
</div>

<div class="rounded-lg border border-foundry bg-gradient-to-b from-[#2a1a0e] to-[#1a1008] px-6 py-9 text-center">
<p class="font-headline text-gold text-xs tracking-[0.2em] uppercase mb-2">Starting estimate</p>
<p class="font-headline font-bold text-ivory text-4xl sm:text-5xl leading-none" id="install-price">$1,100</p>
<div class="flex items-center justify-center gap-3 my-6">
<span class="h-px w-16 bg-foundry"></span>
<svg class="w-5 h-5 text-gold fill-current" viewbox="0 0 24 24"><path d="M12 2a5 5 0 00-4.9 4A4 4 0 006 13.9V14h4v8h4v-8h4v-.1A4 4 0 0016.9 6 5 5 0 0012 2z"></path></svg>
<span class="h-px w-16 bg-foundry"></span>
</div>
<p class="text-stone-300 text-sm leading-relaxed">
          This is a starting range, not a quote. Final pricing is confirmed after a<br class="hidden sm:block"/>
          walkthrough or call and can move based on layout and access.
        </p>
</div>

<a class="mt-7 w-full sm:w-auto sm:mx-auto flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-10 py-4 rounded transition" href="<?php echo esc_url( home_url( '/#quote' ) ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.8" viewbox="0 0 24 24"><path d="M6 3.5h3l1.4 4-2 1.6a12 12 0 005.5 5.5l1.6-2 4 1.4v3a1.5 1.5 0 01-1.6 1.5A16.5 16.5 0 014.5 5.1 1.5 1.5 0 016 3.5z" stroke-linejoin="round"></path></svg>
        Book a walkthrough
      </a>
<p class="flex items-center justify-center gap-2 text-stone-400 text-xs mt-4">
<svg class="w-3.5 h-3.5 stroke-current fill-none" stroke-width="1.8" viewbox="0 0 24 24"><rect height="10" rx="2" width="14" x="5" y="11"></rect><path d="M8 11V8a4 4 0 018 0v3" stroke-linecap="round"></path></svg>
        No commitment. Just expert craftsmanship.
      </p>
</div>

</div>
</section>
<!-- END: Calculator -->



<style>
  /* Option button styling — shared by piece / size / wood selectors */
  .opt {
    position: relative;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    width: 100%;
    text-align: left;
    padding: 1rem 1.15rem;
    border-radius: 0.25rem;
    border: 1px solid #44403c;
    background: #140c06;
    color: #e7e5e4;
    font-size: 0.875rem;
    cursor: pointer;
    transition: border-color .2s, background .2s;
  }
  .opt.flex-col { flex-direction: column; align-items: flex-start; gap: 0; }
  .opt:hover { border-color: rgba(168,117,46,.6); }
  .opt.is-active { border-color: #a8752e; background: #1a1008; }
  .opt .tick {
    position: absolute; top: 50%; right: 1rem; transform: translateY(-50%);
    width: 1.1rem; height: 1.1rem; border-radius: 999px;
    border: 1px solid #57534e; background: transparent;
  }
  .opt.is-active .tick {
    border-color: #a8752e; background: #a8752e;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%231c1108' stroke-width='3.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");
    background-size: 0.7rem; background-position: center; background-repeat: no-repeat;
  }
  .opt.flex-col .tick { top: 1rem; transform: none; }
</style>

<script>
(function () {
  'use strict';

  /* ---------------------------------------------------------------
     All rates come from wp-admin (Woods, Piece Types, Finishes and
     Site Settings -> Pricing Calculator). Nothing is hardcoded here.
     --------------------------------------------------------------- */
  var CFG;
  try {
    CFG = JSON.parse( document.getElementById('bbg-pricing-data').textContent );
  } catch ( err ) {
    return; // no data: leave the markup inert rather than throwing
  }

  var PIECES = {};
  CFG.pieces.forEach(function (p) { PIECES[p.key] = { boardFeet: p.bf, labor: p.labor }; });

  var WOOD = {};
  CFG.woods.forEach(function (w) { WOOD[w.key] = w; });

  var FINISH_ADD = {};
  CFG.finishes.forEach(function (f) { FINISH_ADD[f.key] = f.add; });

  var INSTALL_PER_SQFT = CFG.install.perSqft;
  var ADDON_LOW  = CFG.install.addonLow;
  var ADDON_HIGH = CFG.install.addonHigh;

  var state = {
    item:   CFG.pieces.length   ? CFG.pieces[0].key   : '',
    size:   'Medium',
    wood:   CFG.woods.length    ? CFG.woods[0].key    : '',
    finish: CFG.finishes.length ? CFG.finishes[0].key : ''
  };

  function money(n) { return '$' + Math.round(n).toLocaleString(); }

  /* ---------- Option group wiring ---------- */
  function wireGroup(containerId, stateKey) {
    var container = document.getElementById(containerId);
    container.addEventListener('click', function (e) {
      var btn = e.target.closest('.opt');
      if (!btn) return;
      container.querySelectorAll('.opt').forEach(function (b) { b.classList.remove('is-active'); });
      btn.classList.add('is-active');
      state[stateKey] = btn.dataset.key;
      recalcPiece();
    });
  }
  wireGroup('opt-item', 'item');
  wireGroup('opt-size', 'size');
  wireGroup('opt-wood', 'wood');

  document.getElementById('finish-select').addEventListener('change', function (e) {
    state.finish = e.target.value;
    recalcPiece();
  });

  /* ---------- Ready-made piece price ---------- */
  var priceEl = document.getElementById('piece-price');
  function recalcPiece() {
    var wood = WOOD[state.wood];

    // A wood flagged "Quote Only" in the admin shows no number at all.
    if ( ! wood || wood.quoteOnly ) {
      priceEl.textContent = 'Custom quote';
      priceEl.classList.remove('text-5xl', 'sm:text-6xl');
      priceEl.classList.add('text-3xl', 'sm:text-4xl');
      return;
    }
    priceEl.classList.add('text-5xl', 'sm:text-6xl');
    priceEl.classList.remove('text-3xl', 'sm:text-4xl');

    var piece = PIECES[state.item];
    if ( ! piece ) { priceEl.textContent = 'Custom quote'; return; }

    var bf     = piece.boardFeet[state.size] || 0;
    var finish = FINISH_ADD[state.finish] || 0;
    var total  = bf * wood.rate + piece.labor + finish;

    priceEl.textContent = money(total);
  }

  /* ---------- Full install estimate ---------- */
  var sqft = document.getElementById('sqft');
  var sqftOut = document.getElementById('sqft-out');
  var installEl = document.getElementById('install-price');
  var addons = document.querySelectorAll('.addon');

  function recalcInstall() {
    sqftOut.textContent = sqft.value + ' sq ft';
    var base = Number(sqft.value) * INSTALL_PER_SQFT;
    var checked = 0;
    addons.forEach(function (c) { if (c.checked) checked++; });
    var low = base + checked * ADDON_LOW;
    var high = base + checked * ADDON_HIGH;
    installEl.textContent = checked === 0 ? money(low) : money(low) + ' – ' + money(high);
  }
  sqft.addEventListener('input', recalcInstall);
  addons.forEach(function (c) { c.addEventListener('change', recalcInstall); });

  /* ---------- Tool switch ---------- */
  var tabs = document.querySelectorAll('.tool-tab');
  var ACTIVE = ['bg-gold-light', 'border-gold-light', 'text-stone-900'];
  var IDLE = ['bg-transparent', 'border-stone-700', 'text-stone-300', 'hover:border-gold', 'hover:text-gold'];

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (t) {
        var on = t === tab;
        ACTIVE.forEach(function (c) { t.classList.toggle(c, on); });
        IDLE.forEach(function (c) { t.classList.toggle(c, !on); });
      });
      var pieces = tab.dataset.tool === 'pieces';
      document.getElementById('panel-pieces').classList.toggle('hidden', !pieces);
      document.getElementById('panel-install').classList.toggle('hidden', pieces);
    });
  });

  /* ---------- Date input: block past dates ---------- */
  var dateInput = document.getElementById('date-needed');
  dateInput.min = new Date().toISOString().split('T')[0];

  recalcPiece();
  recalcInstall();
})();
</script>

<?php get_footer();