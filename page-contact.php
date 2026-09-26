<?php
/**
 * Template Name: Contact
 *
 * Converted from the static contact.html prototype.
 * Header and footer now come from header.php / footer.php.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<style data-purpose="page-styling">
body { background-color: #1c1108; color: #16110b; font-family: 'Manrope', sans-serif; }
    .font-headline { font-family: 'Oswald', sans-serif; letter-spacing: 0.03em; }

    /* Form controls */
    .fld {
      width: 100%; background: #140c06; border: 1px solid #44403c; border-radius: 0.25rem;
      color: #e7e5e4; font-size: 0.875rem; padding: 0.85rem 1rem; transition: border-color .2s;
    }
    .fld::placeholder { color: #78716c; }
    .fld:focus { outline: none; border-color: #a8752e; box-shadow: none; }
    .fld.has-error { border-color: #b45309; }
    .err { display: none; color: #d97706; font-size: 0.75rem; margin-top: 0.35rem; }
    .err.show { display: block; }

    /* Honeypot — invisible to humans, irresistible to bots. Never display:none;
       some bots skip hidden fields, so it stays technically visible but off-screen. */
    .hp-wrap {
      position: absolute !important; left: -9999px !important; top: auto !important;
      width: 1px !important; height: 1px !important; overflow: hidden !important;
    }

    /* Service-area radius rings */
    @keyframes bbg-pulse { 0% { transform: scale(.85); opacity: .55; } 70% { transform: scale(1.35); opacity: 0; } 100% { opacity: 0; } }
    .ring { animation: bbg-pulse 3.2s ease-out infinite; transform-origin: center; }
    .ring:nth-child(2) { animation-delay: 1.05s; }
    .ring:nth-child(3) { animation-delay: 2.1s; }
    @media (prefers-reduced-motion: reduce) { .ring { animation: none; opacity: .3; } }
</style>
<!-- BEGIN: ContactHero -->
<section class="relative h-[52vh] min-h-[380px] w-full overflow-hidden">
<img alt="Handcrafted end-grain butcher block in the workshop" class="absolute inset-0 w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"/>
<div class="absolute inset-0 bg-gradient-to-r from-espresso via-espresso/85 to-espresso/25"></div>
<div class="absolute inset-0 bg-gradient-to-t from-espresso via-transparent to-transparent"></div>
<div class="relative z-10 h-full max-w-7xl mx-auto px-6 lg:px-12 flex flex-col justify-center">
<p class="font-headline text-gold text-xs sm:text-sm tracking-[0.25em] uppercase mb-3">
      Built by hand. Meant to last.
    </p>
<h1 class="font-headline font-bold text-ivory uppercase leading-[0.95] text-4xl sm:text-5xl lg:text-6xl mb-5 max-w-2xl">
      Let's talk about your project
    </h1>
<p class="text-stone-300 text-sm sm:text-base max-w-md leading-relaxed mb-6">
      Tell us about your vision and we'll craft something exceptional—just for you.
    </p>
<span class="block h-0.5 w-16 bg-gold"></span>
</div>
</section>
<!-- END: ContactHero -->

<!-- BEGIN: ContactForm -->
<section class="bg-[#150d07] px-4 lg:px-12 py-12 lg:py-16" id="contact-form">
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[1.1fr_auto_0.85fr] gap-10 lg:gap-14">

<!-- Form -->
<div>
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-6">Contact form</p>
<form id="bbg-contact" novalidate="">

<div class="mb-5">
<label class="block text-stone-200 text-sm font-medium mb-2" for="cf-name">Name <span class="text-gold">*</span></label>
<input class="fld" id="cf-name" name="name" placeholder="Your name" type="text"/>
<span class="err" id="cf-name-err">Please enter your name.</span>
</div>

<div class="mb-5">
<label class="block text-stone-200 text-sm font-medium mb-2" for="cf-email">Email <span class="text-gold">*</span></label>
<input class="fld" id="cf-email" name="email" placeholder="name@email.com" type="email"/>
<span class="err" id="cf-email-err">Please enter a valid email address.</span>
</div>

<div class="mb-5">
<label class="block text-stone-200 text-sm font-medium mb-2" for="cf-phone">Phone <span class="text-gold">*</span></label>
<input class="fld" id="cf-phone" name="phone" placeholder="(555) 555-5555" type="tel"/>
<span class="err" id="cf-phone-err">Please enter a phone number we can reach you at.</span>
</div>

<div class="mb-5">
<label class="block text-stone-200 text-sm font-medium mb-2" for="cf-details">What are you looking to build? <span class="text-gold">*</span></label>
<textarea class="fld resize-y" id="cf-details" name="details" placeholder="Tell us about your project, materials, style, and any must-haves." rows="4"></textarea>
<span class="err" id="cf-details-err">Tell us a little about the project so we can help.</span>
</div>

<div class="mb-6">
<label class="block text-stone-200 text-sm font-medium mb-2" for="cf-budget">What's your budget range?</label>
<div class="relative">
<select class="fld appearance-none pr-10 cursor-pointer" id="cf-budget" name="budget">
<option value="">Select a range</option>
<option value="unsure">Not sure yet</option>
<option value="lt1k">Under $1,000</option>
<option value="1k-5k">$1,000 – $5,000</option>
<option value="5k-10k">$5,000 – $10,000</option>
<option value="10k+">$10,000+</option>
</select>
<svg class="w-4 h-4 text-stone-400 stroke-current fill-none absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" stroke-width="2" viewbox="0 0 24 24"><path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</div>
</div>

<!-- Honeypot: off-screen, not display:none. Bots fill it, humans never see it. -->
<div aria-hidden="true" class="hp-wrap">
<label for="cf-company">Company (leave this field empty)</label>
<input autocomplete="off" id="cf-company" name="company" tabindex="-1" type="text"/>
</div>

<div class="flex items-start gap-3.5 mb-6">
<svg class="w-9 h-9 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24">
<path d="M12 3l7 3v5.5c0 4.3-2.9 7.9-7 9.5-4.1-1.6-7-5.2-7-9.5V6l7-3z" stroke-linejoin="round"></path>
<path d="M9.2 12.2l1.9 1.9 3.7-3.9" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
<div>
<p class="text-ivory text-sm font-semibold mb-1">We keep spam out.</p>
<p class="text-stone-400 text-xs leading-relaxed">This form is protected by advanced spam filtering so real messages always get through.</p>
</div>
</div>

<button class="w-full flex items-center justify-center gap-3 bg-gold-light hover:bg-gold-hover text-stone-900 font-headline font-bold text-sm uppercase tracking-wider px-8 py-4 rounded transition" id="cf-submit" type="submit">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.8" viewbox="0 0 24 24"><rect height="13" rx="2" width="17" x="3.5" y="5.5"></rect><path d="M4 6.5L12 13l8-6.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            Send message
          </button>

<p class="text-stone-400 text-xs mt-3">We typically respond within 1 business day.</p>

<div class="hidden mt-5 rounded border border-gold/40 bg-gold/10 px-5 py-4" id="cf-success">
<p class="text-ivory text-sm font-semibold mb-1">Thanks — your message is on its way.</p>
<p class="text-stone-300 text-xs">We'll get back to you within 1 business day.</p>
</div>
</form>
</div>

<!-- Divider -->
<div aria-hidden="true" class="hidden lg:block w-px bg-foundry"></div>

<!-- Value props -->
<div class="space-y-8">
<div class="flex items-start gap-4">
<svg class="w-10 h-10 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24">
<circle cx="12" cy="9" r="5.5"></circle>
<path d="M9.4 9.2l1.7 1.7 3.5-3.6" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M8.6 14.2L7 21.5l5-2.4 5 2.4-1.6-7.3" stroke-linejoin="round"></path>
</svg>
<div>
<h3 class="font-headline text-gold text-sm font-semibold uppercase tracking-wider mb-1.5">Quality craftsmanship</h3>
<p class="text-stone-400 text-sm leading-relaxed">Every piece is built with precision and premium materials.</p>
</div>
</div>

<div class="flex items-start gap-4">
<svg class="w-10 h-10 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24">
<circle cx="12" cy="12" r="8.5"></circle>
<path d="M12 7v5.2l3.4 2" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
<div>
<h3 class="font-headline text-gold text-sm font-semibold uppercase tracking-wider mb-1.5">Built to last</h3>
<p class="text-stone-400 text-sm leading-relaxed">Timeless designs made to be used and loved for generations.</p>
</div>
</div>

<div class="flex items-start gap-4">
<svg class="w-10 h-10 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24">
<path d="M4 20l1.2-4.2L15.6 5.4a2 2 0 012.8 0l1.2 1.2a2 2 0 010 2.8L9.2 19.8 4 20z" stroke-linejoin="round"></path>
<path d="M14.4 6.6l3 3" stroke-linecap="round"></path>
</svg>
<div>
<h3 class="font-headline text-gold text-sm font-semibold uppercase tracking-wider mb-1.5">Custom solutions</h3>
<p class="text-stone-400 text-sm leading-relaxed">No templates. Just custom work tailored to you.</p>
</div>
</div>

<div class="flex items-start gap-4">
<svg class="w-10 h-10 text-gold stroke-current fill-none shrink-0" stroke-width="1.3" viewbox="0 0 24 24">
<path d="M20 14.5a2 2 0 01-2 2H8l-4 3.5v-14a2 2 0 012-2h12a2 2 0 012 2v8.5z" stroke-linejoin="round"></path>
<circle cx="9" cy="10" r=".9"></circle><circle cx="12.5" cy="10" r=".9"></circle><circle cx="16" cy="10" r=".9"></circle>
</svg>
<div>
<h3 class="font-headline text-gold text-sm font-semibold uppercase tracking-wider mb-1.5">Personal service</h3>
<p class="text-stone-400 text-sm leading-relaxed">You'll work directly with our team from start to finish.</p>
</div>
</div>
</div>

</div>
</section>
<!-- END: ContactForm -->

<!-- BEGIN: ServiceArea -->
<section class="bg-ivory px-4 lg:px-12 py-12 lg:py-16">
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

<div>
<div class="flex items-center gap-3 mb-5">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase">Our service area</p>
<span class="h-px w-10 bg-gold/50"></span>
</div>
<h2 class="font-headline font-bold text-espresso uppercase leading-[0.98] text-3xl sm:text-4xl mb-5">
        Proudly serving<br/>Central Florida
      </h2>
<p class="text-stone-600 text-sm leading-relaxed max-w-sm mb-7">
        Based in the heart of Central Florida, we serve clients throughout the state and beyond. Local craftsmanship, personalized service.
      </p>
<div class="flex items-start gap-3">
<svg class="w-5 h-5 text-gold stroke-current fill-none shrink-0 mt-0.5" stroke-width="1.6" viewbox="0 0 24 24">
<path d="M12 21s7-5.7 7-11a7 7 0 10-14 0c0 5.3 7 11 7 11z" stroke-linejoin="round"></path>
<circle cx="12" cy="10" r="2.5"></circle>
</svg>
<div>
<p class="text-espresso text-sm font-semibold mb-1">Brandon, Florida</p>
<p class="text-stone-600 text-xs mb-1">Tampa • Orlando • Lakeland • Daytona Beach</p>
<p class="flex items-center gap-2 text-stone-500 text-xs"><span class="h-px w-5 bg-stone-400"></span>And surrounding areas</p>
</div>
</div>
</div>

<!-- Service-radius graphic (see note: this is a designed stand-in, not a geographic map) -->
<div class="relative aspect-[4/3] rounded-lg bg-ivory-low overflow-hidden flex items-center justify-center">
<iframe class="absolute inset-0 w-full h-full opacity-[0.55]" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3526.198110269763!2d-82.29578672369398!3d27.895893217148817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c2d32023f38cdb%3A0xb1bb15b46aace2c8!2sButcher%20Block%20Group!5e0!3m2!1sen!2sus!4v1789855131359!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
<!-- <svg class="relative w-56 h-56" viewbox="0 0 200 200" aria-hidden="true">
<circle class="ring" cx="100" cy="100" fill="none" r="70" stroke="#a8752e" stroke-width="1.5"></circle>
<circle class="ring" cx="100" cy="100" fill="none" r="70" stroke="#a8752e" stroke-width="1.5"></circle>
<circle class="ring" cx="100" cy="100" fill="none" r="70" stroke="#a8752e" stroke-width="1.5"></circle>
<circle cx="100" cy="100" fill="none" r="44" stroke="#a8752e" stroke-opacity=".3" stroke-width="1"></circle>
<circle cx="100" cy="100" fill="none" r="66" stroke="#a8752e" stroke-opacity=".2" stroke-width="1"></circle>
<path d="M100 88a9 9 0 00-9 9c0 6.8 9 15 9 15s9-8.2 9-15a9 9 0 00-9-9z" fill="#a8752e"></path>
<circle cx="100" cy="97" fill="#f4e7d3" r="3.2"></circle>
</svg> -->
<p class="absolute bottom-5 left-0 right-0 text-center font-headline text-espresso/70 text-[11px] tracking-[0.2em] uppercase">
        Central Florida service radius
      </p>
</div>

</div>
</section>
<!-- END: ServiceArea -->

<!-- BEGIN: ClosingCTA -->
 <?php
$bbg_page_id  = get_queried_object_id();
              $extra_image  = $bbg_page_id ? get_post_meta( $bbg_page_id, '_frontpage_image', true ) : '';
?>
<section class="relative py-16 lg:py-20 px-4 overflow-hidden">
<img alt="Finished wood table in a styled room" class="absolute inset-0 w-full h-full object-cover" src="<?php echo $extra_image ?>"/>
<div class="absolute inset-0 bg-espresso/85"></div>
<div class="relative z-10 max-w-3xl mx-auto text-center">
<p class="font-headline text-gold text-[11px] tracking-[0.2em] uppercase mb-4">Ready to get started?</p>
<h2 class="font-headline font-bold text-ivory uppercase text-3xl sm:text-4xl lg:text-5xl mb-8">
      We're ready when you are
    </h2>
<div class="flex flex-col sm:flex-row gap-4 justify-center">
<a class="inline-flex items-center justify-center gap-3 border border-stone-500 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-sm uppercase tracking-wider px-8 py-4 rounded backdrop-blur transition" href="tel:<?php echo esc_attr( bbg_phone_digits() ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><path d="M6 3.5h3l1.4 4-2 1.6a12 12 0 005.5 5.5l1.6-2 4 1.4v3a1.5 1.5 0 01-1.6 1.5A16.5 16.5 0 014.5 5.1 1.5 1.5 0 016 3.5z" stroke-linejoin="round"></path></svg>
        Click to call
      </a>
<a class="inline-flex items-center justify-center gap-3 border border-stone-500 hover:border-gold text-ivory hover:text-gold font-headline font-semibold text-sm uppercase tracking-wider px-8 py-4 rounded backdrop-blur transition" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>">
<svg class="w-5 h-5 stroke-current fill-none" stroke-width="1.7" viewbox="0 0 24 24"><rect height="16" rx="1" width="16" x="4" y="5"></rect><path d="M8 2v4M16 2v4M8 11h8M8 15h4" stroke-linecap="round"></path></svg>
        Pricing calculator
      </a>
</div>
</div>
</section>
<!-- END: ClosingCTA -->



<script>
(function () {
  'use strict';

  var form = document.getElementById('bbg-contact');
  var success = document.getElementById('cf-success');
  var submitBtn = document.getElementById('cf-submit');
  var loadedAt = Date.now();

  function setError(inputId, errId, valid) {
    document.getElementById(inputId).classList.toggle('has-error', !valid);
    document.getElementById(errId).classList.toggle('show', !valid);
    return valid;
  }

  function validEmail(v) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v);
  }

  function digitsOnly(v) {
    return v.replace(/\D/g, '');
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    /* --- Spam checks (client side is a speed bump, not a wall — see note) --- */
    // 1. Honeypot: only a bot fills a field it can't see.
    if (document.getElementById('cf-company').value !== '') return;
    // 2. Time trap: humans don't complete a form in under 3 seconds.
    if (Date.now() - loadedAt < 3000) return;

    var okName    = setError('cf-name', 'cf-name-err', document.getElementById('cf-name').value.trim().length > 1);
    var okEmail   = setError('cf-email', 'cf-email-err', validEmail(document.getElementById('cf-email').value.trim()));
    var okPhone   = setError('cf-phone', 'cf-phone-err', digitsOnly(document.getElementById('cf-phone').value).length >= 10);
    var okDetails = setError('cf-details', 'cf-details-err', document.getElementById('cf-details').value.trim().length > 9);

    if (!(okName && okEmail && okPhone && okDetails)) {
      success.classList.add('hidden');
      var firstBad = form.querySelector('.has-error');
      if (firstBad) firstBad.focus();
      return;
    }

    /* No backend wired yet — this is where the POST goes. */
    success.classList.remove('hidden');
    submitBtn.disabled = true;
    submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
    form.querySelectorAll('.fld').forEach(function (f) { f.value = ''; });
  });

  /* Clear an error as soon as the visitor starts fixing it */
  form.querySelectorAll('.fld').forEach(function (f) {
    f.addEventListener('input', function () {
      f.classList.remove('has-error');
      var err = document.getElementById(f.id + '-err');
      if (err) err.classList.remove('show');
    });
  });
})();
</script>

<?php get_footer();