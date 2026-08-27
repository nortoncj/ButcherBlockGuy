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