<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <header id="site-header" class="site-header">
      <nav class="nav-container">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#hero" class="nav-logo">
          <span class="logo-mark">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo/11-removebg-preview.png" alt="<?php bloginfo( 'name' ); ?> logo" class="logo-mark-img" />
          </span>
          <span class="logo-text"><?php bloginfo( 'name' ); ?></span>
        </a>

        <?php
        if ( has_nav_menu( 'primary' ) ) {
          wp_nav_menu( array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'nav-links',
            'items_wrap' => '<ul id="nav-links" class="nav-links">%3$s</ul>',
          ) );
        } else {
          // Fallback: simple anchor list
          echo '<ul class="nav-links" id="nav-links"><li><a href="#craft" class="nav-link">The Craft</a></li><li><a href="#species" class="nav-link">Species</a></li><li><a href="#process" class="nav-link">Process</a></li><li><a href="#testimonials" class="nav-link">Stories</a></li><li><a href="#contact" class="nav-link">Contact</a></li></ul>';
        }
        ?>

        <a href="tel:+13215433132" class="btn-primary nav-cta" aria-label="Call us to order">
          <i class="fas fa-phone"></i>
          <span>Order Now</span>
        </a>

        <button class="hamburger" id="hamburger" aria-label="Open menu" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </nav>

      <!-- Mobile drawer -->
      <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <button class="mobile-close" id="mobile-close" aria-label="Close menu">
          <i class="fas fa-times"></i>
        </button>
        <ul class="mobile-nav-links">
          <li><a href="/about" class="mobile-nav-link">About</a></li>
          <li><a href="/services" class="mobile-nav-link">Services</a></li>
          <!-- <li><a href="#craft" class="mobile-nav-link">The Craft</a></li>
          <li><a href="#species" class="mobile-nav-link">Species</a></li> -->
          <li><a href="#process" class="mobile-nav-link">Process</a></li>
          <!-- <li><a href="#testimonials" class="mobile-nav-link">Stories</a></li> -->
          <li><a href="/contact" class="mobile-nav-link">Contact</a></li>
        </ul>
        <a href="tel:+13215433132" class="btn-primary mobile-cta">
          <i class="fas fa-phone"></i> Call to Order
        </a>
      </div>
      <div class="mobile-overlay" id="mobile-overlay"></div>
    </header>
