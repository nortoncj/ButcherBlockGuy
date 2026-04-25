/* ====================================================
   BLOCK & GRAIN — Main JavaScript
   ==================================================== */

'use strict';

/* ---- Glassmorphism Nav on Scroll ---- */
(function initScrollHeader() {
  const header = document.getElementById('site-header');
  if (!header) return;

  const handler = () => {
    if (window.scrollY > 40) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  };

  window.addEventListener('scroll', handler, { passive: true });
  handler(); // run once on load
})();

/* ---- Mobile Menu ---- */
(function initMobileMenu() {
  const hamburger  = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobile-menu');
  const overlay    = document.getElementById('mobile-overlay');
  const closeBtn   = document.getElementById('mobile-close');
  const mobileLinks = document.querySelectorAll('.mobile-nav-link');

  if (!hamburger || !mobileMenu) return;

  function openMenu() {
    mobileMenu.classList.add('open');
    mobileMenu.setAttribute('aria-hidden', 'false');
    overlay.classList.add('active');
    hamburger.classList.add('active');
    hamburger.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    mobileMenu.classList.remove('open');
    mobileMenu.setAttribute('aria-hidden', 'true');
    overlay.classList.remove('active');
    hamburger.classList.remove('active');
    hamburger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  hamburger.addEventListener('click', openMenu);
  if (closeBtn) closeBtn.addEventListener('click', closeMenu);
  overlay.addEventListener('click', closeMenu);

  mobileLinks.forEach(link => {
    link.addEventListener('click', closeMenu);
  });

  // ESC key closes menu
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
      closeMenu();
    }
  });
})();

/* ---- Smooth Active Nav Link Highlighting ---- */
(function initActiveNavHighlight() {
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');

  if (!sections.length || !navLinks.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute('id');
        navLinks.forEach(link => {
          link.classList.toggle('active', link.getAttribute('href') === `#${id}`);
        });
      }
    });
  }, { threshold: 0.35, rootMargin: '-10% 0px -60% 0px' });

  sections.forEach(section => observer.observe(section));
})();

/* ---- Scroll Reveal — classes added first, then observer wired up ---- */
(function initScrollReveal() {
  const delayClasses = ['reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3', 'reveal-delay-4'];

  // Step 1: stamp .reveal onto elements (process-step excluded — always visible)
  const revealTargets = [
    { selector: '.craft-section-header',  delay: '' },
    { selector: '.service-row',           delay: '' },
    { selector: '.craft-cta-bar',         delay: '' },
    { selector: '.collection-header',     delay: '' },
    { selector: '.product-card',          delay: 'stagger' },
    { selector: '.process-pull-quote',    delay: '' },
    { selector: '.testimonial-card',      delay: 'stagger' },
    { selector: '.contact-form-card',     delay: '' },
    { selector: '.contact-text-col > *',  delay: 'stagger' },
  ];

  revealTargets.forEach(({ selector, delay }) => {
    document.querySelectorAll(selector).forEach((el, i) => {
      el.classList.add('reveal');
      if (delay === 'stagger') el.classList.add(delayClasses[i % 4]);
    });
  });

  // Step 2: wire up observer AFTER classes are assigned
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
})();

/* ---- Contact Form Handler ---- */
(function initContactForm() {
  const form       = document.getElementById('contact-form');
  const successMsg = document.getElementById('form-success');
  const errorMsg   = document.getElementById('form-error');

  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Basic validation
    const name    = form.name.value.trim();
    const phone   = form.phone.value.trim();
    const message = form.message.value.trim();

    if (!name || !phone) {
      shakeField(!name ? 'name' : 'phone');
      return;
    }

    // Hide any previous messages
    successMsg.hidden = true;
    errorMsg.hidden   = true;

    const submitBtn = form.querySelector('.form-submit');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

    try {
      // Save inquiry to RESTful table
      const payload = {
        name:    name,
        phone:   phone,
        project: form.project.value || 'Not specified',
        message: message || 'No message provided'
      };

      const res = await fetch('tables/contact_inquiries', {
        method:  'POST',
        headers: { 'Content-Type': 'application/json' },
        body:    JSON.stringify(payload)
      });

      if (res.ok || res.status === 201) {
        successMsg.hidden = false;
        form.reset();
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Sent!';
        setTimeout(() => {
          submitBtn.disabled = false;
          submitBtn.innerHTML = 'Send Message <i class="fas fa-arrow-right"></i>';
        }, 4000);
      } else {
        throw new Error('Server error');
      }
    } catch (err) {
      console.error('Form error:', err);
      errorMsg.hidden = false;
      submitBtn.disabled = false;
      submitBtn.innerHTML = 'Send Message <i class="fas fa-arrow-right"></i>';
    }
  });

  function shakeField(fieldName) {
    const input = form[fieldName];
    if (!input) return;
    input.style.borderBottomColor = 'var(--primary-container)';
    input.focus();
    input.animate([
      { transform: 'translateX(0)' },
      { transform: 'translateX(-6px)' },
      { transform: 'translateX(6px)' },
      { transform: 'translateX(-4px)' },
      { transform: 'translateX(4px)' },
      { transform: 'translateX(0)' },
    ], { duration: 400, easing: 'ease-out' });

    setTimeout(() => {
      input.style.borderBottomColor = '';
    }, 1500);
  }
})();

/* ---- Stats counter animation ---- */
(function initCounters() {
  const statNums = document.querySelectorAll('.stat-num');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;

      const el  = entry.target;
      const raw = el.textContent.trim();

      // Only animate purely numeric values
      if (!/^\d+\+?$/.test(raw)) { observer.unobserve(el); return; }

      const isPlus  = raw.endsWith('+');
      const target  = parseInt(raw, 10);
      const duration = 1200;
      const start    = performance.now();

      function step(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased    = 1 - Math.pow(1 - progress, 3);
        const current  = Math.round(eased * target);
        el.textContent = current + (isPlus ? '+' : '');
        if (progress < 1) requestAnimationFrame(step);
      }

      el.textContent = '0' + (isPlus ? '+' : '');
      requestAnimationFrame(step);
      observer.unobserve(el);
    });
  }, { threshold: 0.7 });

  statNums.forEach(el => observer.observe(el));
})();

/* ---- Smooth anchor scroll with nav offset ---- */
(function initAnchorScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (!target) return;
      e.preventDefault();

      const headerHeight = document.getElementById('site-header')?.offsetHeight ?? 80;
      const top = target.getBoundingClientRect().top + window.scrollY - headerHeight;

      window.scrollTo({ top, behavior: 'smooth' });
    });
  });
})();

/* ---- Gallery Lightbox ---- */
(function initLightbox() {
  const galleryItems  = document.querySelectorAll('.gallery-item');
  const lightbox      = document.getElementById('lightbox');
  const backdrop      = document.getElementById('lightbox-backdrop');
  const lightboxImg   = document.getElementById('lightbox-img');
  const lightboxCap   = document.getElementById('lightbox-caption');
  const lightboxDots  = document.getElementById('lightbox-dots');
  const closeBtn      = document.getElementById('lightbox-close');
  const prevBtn       = document.getElementById('lightbox-prev');
  const nextBtn       = document.getElementById('lightbox-next');

  if (!lightbox || !galleryItems.length) return;

  // Build data array from gallery items
  const images = Array.from(galleryItems).map(item => ({
    src:     item.querySelector('.gallery-img').src,
    alt:     item.querySelector('.gallery-img').alt,
    caption: item.dataset.caption || ''
  }));

  let currentIndex = 0;

  // Build dots
  images.forEach((_, i) => {
    const dot = document.createElement('button');
    dot.className = 'lightbox-dot';
    dot.setAttribute('aria-label', `Go to image ${i + 1}`);
    dot.addEventListener('click', () => goTo(i));
    lightboxDots.appendChild(dot);
  });

  function updateDots() {
    lightboxDots.querySelectorAll('.lightbox-dot').forEach((dot, i) => {
      dot.classList.toggle('active', i === currentIndex);
    });
  }

  function goTo(index) {
    currentIndex = (index + images.length) % images.length;
    lightboxImg.classList.add('switching');
    setTimeout(() => {
      lightboxImg.src     = images[currentIndex].src;
      lightboxImg.alt     = images[currentIndex].alt;
      lightboxCap.textContent = images[currentIndex].caption;
      lightboxImg.classList.remove('switching');
      updateDots();
    }, 200);
  }

  function openLightbox(index) {
    currentIndex = index;
    lightboxImg.src          = images[index].src;
    lightboxImg.alt          = images[index].alt;
    lightboxCap.textContent  = images[index].caption;
    lightbox.hidden          = false;
    backdrop.classList.add('active');
    document.body.style.overflow = 'hidden';
    updateDots();
    // Focus the close button for accessibility
    setTimeout(() => closeBtn.focus(), 50);
  }

  function closeLightbox() {
    lightbox.hidden = true;
    backdrop.classList.remove('active');
    document.body.style.overflow = '';
    // Return focus to the triggering gallery item
    galleryItems[currentIndex]?.focus();
  }

  // Open on click
  galleryItems.forEach((item, i) => {
    item.addEventListener('click', () => openLightbox(i));
  });

  // Controls
  closeBtn.addEventListener('click', closeLightbox);
  backdrop.addEventListener('click', closeLightbox);
  prevBtn.addEventListener('click', () => goTo(currentIndex - 1));
  nextBtn.addEventListener('click', () => goTo(currentIndex + 1));

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (lightbox.hidden) return;
    if (e.key === 'Escape')      closeLightbox();
    if (e.key === 'ArrowLeft')   goTo(currentIndex - 1);
    if (e.key === 'ArrowRight')  goTo(currentIndex + 1);
  });

  // Touch swipe support
  let touchStartX = 0;
  lightbox.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
  lightbox.addEventListener('touchend', e => {
    const diff = touchStartX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) goTo(currentIndex + (diff > 0 ? 1 : -1));
  });
})();

/* ---- Hero parallax (subtle) ---- */
(function initParallax() {
  const heroImage = document.querySelector('.hero-image');
  if (!heroImage || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  let ticking = false;

  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(() => {
        const scrollY = window.scrollY;
        if (scrollY < window.innerHeight) {
          heroImage.style.transform = `rotate(1.5deg) translateY(${scrollY * 0.06}px)`;
        }
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
})();
