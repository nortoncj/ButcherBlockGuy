    <footer class="site-footer">
      <div class="footer-layout">
        <div class="footer-brand">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>#hero" class="footer-logo">
            <span class="logo-mark">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo/11-removebg-preview.png" alt="<?php bloginfo( 'name' ); ?> logo" class="logo-mark-img" />
            </span>
            <span class="logo-text"><?php bloginfo( 'name' ); ?></span>
          </a>
          <p class="footer-tagline body-text">
            <em>Handcrafted heirloom woodwork,<br />built for the serious kitchen.</em>
          </p>
          <a href="tel:+13215433132" class="btn-call-sm">
            <i class="fas fa-phone-alt"></i> (321) 543-3132
          </a>
        </div>

        <div class="footer-links-group">
          <p class="footer-group-label label-sm">Navigate</p>
          <ul class="footer-links">
            <li><a href="/about" class="footer-link">About</a></li>
            <li><a href="/services" class="footer-link">Services</a></li>
            <li><a href="#process" class="footer-link">Process</a></li>
            <li><a href="#testimonials" class="footer-link">Stories</a></li>
            <li><a href="/contact" class="footer-link">Contact</a></li>
          </ul>
        </div>

        <div class="footer-links-group">
          <p class="footer-group-label label-sm">Wood Species</p>
          <ul class="footer-links">
            <li><span class="footer-link">Acacia</span></li>
            <li><span class="footer-link">Shortleaf Acacia</span></li>
            <li><span class="footer-link">Heavea</span></li>
            <li><span class="footer-link">Chevron</span></li>
          </ul>
        </div>

        <div class="footer-contact-col">
          <p class="footer-group-label label-sm">Contact</p>
          <div class="footer-contact-list">
            <a href="tel:+13215433132" class="footer-contact-item">
              <i class="fas fa-phone-alt"></i>
              <span>(321) 543-3132</span>
            </a>
            <a href="sms:++13215433132" class="footer-contact-item">
              <i class="fas fa-comment-sms"></i>
              <span>Text us anytime</span>
            </a>
            <div class="footer-contact-item">
              <i class="fas fa-map-marker-alt"></i>
              <span>Brandon, FL · Ships Nationwide</span>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p class="footer-legal label-sm">© <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved. Handcrafted with intention.</p>
        <p class="footer-legal label-sm">Designed in the spirit of the workshop.</p>
      </div>
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>
