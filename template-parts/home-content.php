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
    <!-- <a class="btn btn-invert btn-lg" href="mailto:hello@blockandgrain.com">Get a quote</a> -->
  </div>
</section>