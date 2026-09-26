<?php
/**
 * Butcher Block Group — functions.php
 *
 * Load order matters: cpt-gallery.php registers bg_gallery, and
 * pods-config.php attaches a field group to it, so the CPT must be
 * defined first.
 */

require_once get_template_directory() . '/inc/cpt-gallery.php';
require_once get_template_directory() . '/inc/theme-core.php';
require_once get_template_directory() . '/inc/pods-config.php';
require_once get_template_directory() . '/inc/rewrites.php';

/*----------------------------------------------------------------------
*
* RUN ONCE!!!!
* 
* THEN DELETE!!
*---------------------------------------------------------------------- */
// add_action( 'admin_init', 'bbg_migrate_meta_keys' );
// function bbg_migrate_meta_keys() {
// 	if ( get_option( 'bbg_meta_keys_migrated' ) ) return;

// 	$map = array(
// 		'_bg_product_type' => 'bg_product_type',
// 		'_bg_wood_type'    => 'bg_wood_type',
// 		'_bg_size'         => 'bg_size',
// 		'_bg_order'        => 'bg_order',
// 	);

// 	$ids = get_posts( array(
// 		'post_type'      => 'bg_gallery',
// 		'post_status'    => 'any',
// 		'posts_per_page' => -1,
// 		'fields'         => 'ids',
// 	) );

// 	foreach ( $ids as $pid ) {
// 		foreach ( $map as $old => $new ) {
// 			$val = get_post_meta( $pid, $old, true );
// 			if ( '' !== $val && '' === get_post_meta( $pid, $new, true ) ) {
// 				update_post_meta( $pid, $new, $val );
// 			}
// 		}
// 	}

// 	update_option( 'bbg_meta_keys_migrated', 1 );
// }

/* ---------------------------------------------------------------------
 * Theme setup
 *
 * Fonts, the primary menu and post-thumbnails are handled in
 * inc/theme-core.php. Only theme-specific extras live here.
 * ------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'bbg_theme_setup' );
function bbg_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	if ( ! has_image_size( 'bg-gallery-large' ) ) {
		add_image_size( 'bg-gallery-large', 1400, 1050, false );
	}
	if ( ! has_image_size( 'bg-gallery-thumb' ) ) {
		add_image_size( 'bg-gallery-thumb', 600, 450, true );
	}
}

/** Flush rewrite rules once, on theme activation, so CPT URLs resolve. */
add_action( 'after_switch_theme', 'bbg_flush_rewrites' );

function bbg_flush_rewrites() {
	flush_rewrite_rules();
}


/* ---------------------------------------------------------------------
 * Base stylesheets
 *
 * Fonts are NOT loaded here — inc/theme-core.php owns the 'bbg-fonts'
 * handle. Registering it twice means WordPress silently drops the second
 * one, which previously killed Newsreader and Work Sans site-wide.
 * ------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'bbg_enqueue_assets' );
function bbg_enqueue_assets() {

	// Font Awesome — still used by the services page markup.
	wp_enqueue_style( 'bbg-fontawesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css', array(), '6.4.0' );

	// Theme stylesheet. filemtime() is guarded: on PHP 8 a missing file
	// raises a warning and returns false rather than failing quietly.
	$style_path = get_template_directory() . '/style.css';
	wp_enqueue_style(
		'bbg-style',
		get_stylesheet_uri(),
		array( 'bbg-fonts' ),
		file_exists( $style_path ) ? filemtime( $style_path ) : null
	);

	$main_css = get_template_directory() . '/css/style.css';
	if ( file_exists( $main_css ) ) {
		wp_enqueue_style( 'bbg-main-css', get_template_directory_uri() . '/css/style.css', array( 'bbg-style' ), filemtime( $main_css ) );
	}

	$main_js = get_template_directory() . '/js/main.js';
	if ( file_exists( $main_js ) ) {
		wp_enqueue_script( 'bbg-main-js', get_template_directory_uri() . '/js/main.js', array(), filemtime( $main_js ), true );
	}
}


/* ---------------------------------------------------------------------
 * Per-template stylesheets
 * ------------------------------------------------------------------- */

/** Shared helper: enqueue a template stylesheet, or warn in admin if missing. */
function bbg_enqueue_template_style( $handle, $relative_path, $deps = array( 'bbg-style' ) ) {
	$css_file = get_stylesheet_directory() . $relative_path;
	$css_uri  = get_stylesheet_directory_uri() . $relative_path;

	if ( ! file_exists( $css_file ) ) {
		add_action( 'admin_notices', function () use ( $css_file ) {
			echo '<div class="notice notice-warning"><p><strong>Butcher Block Group:</strong> stylesheet not found at <code>'
			   . esc_html( $css_file ) . '</code>.</p></div>';
		} );
		return false;
	}

	wp_enqueue_style( $handle, $css_uri, $deps, filemtime( $css_file ) );
	return true;
}

add_action( 'wp_enqueue_scripts', 'bg_enqueue_services_styles' );
function bg_enqueue_services_styles() {

	if ( ! is_page_template( 'page-services.php' ) && ! is_page( 'services' ) && ! is_page( 'service' ) ) {
		return;
	}

	if ( ! bbg_enqueue_template_style( 'bg-services-page', '/assets/css/services-page.css' ) ) {
		return;
	}

	wp_enqueue_style( 'bg-glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', array(), '3.2.0' );
	wp_enqueue_script( 'bg-glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', array(), '3.2.0', true );
	wp_add_inline_script( 'bg-glightbox', "
		document.addEventListener('DOMContentLoaded', function () {
			GLightbox({
				selector: '.bg-glightbox',
				openEffect: 'fade',
				closeEffect: 'fade',
				touchNavigation: true,
				keyboardNavigation: true,
				closeOnOutsideClick: true
			});

			var tabs  = document.querySelectorAll('.bg-portfolio-tab');
			var items = document.querySelectorAll('.bg-portfolio-item');

			tabs.forEach(function (tab) {
				tab.addEventListener('click', function () {
					var filter = tab.dataset.filter;
					tabs.forEach(function (t) { t.classList.remove('active'); });
					tab.classList.add('active');
					items.forEach(function (item) {
						var match = filter === 'all' || item.dataset.product === filter;
						item.style.display = match ? '' : 'none';
					});
				});
			});
		});
	" );
}

add_action( 'wp_enqueue_scripts', 'bg_enqueue_reviews_content_styles' );
function bg_enqueue_reviews_content_styles() {
	if ( ! is_page_template( 'reviews-content.php' ) ) return;
	bbg_enqueue_template_style( 'bg-reviews-content', '/assets/css/reviews-content.css' );
}

add_action( 'wp_enqueue_scripts', 'bg_enqueue_front_page_styles' );
function bg_enqueue_front_page_styles() {
	if ( ! is_front_page() ) return;

	// Historically this file lived in /css/, later in /assets/css/. Try both.
	if ( file_exists( get_stylesheet_directory() . '/css/front-page.css' ) ) {
		bbg_enqueue_template_style( 'bg-front-page', '/css/front-page.css' );
	} else {
		bbg_enqueue_template_style( 'bg-front-page', '/assets/css/front-page.css' );
	}
}


/* ---------------------------------------------------------------------
 * Widgets
 * ------------------------------------------------------------------- */
add_action( 'widgets_init', 'bbg_widgets_init' );
function bbg_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'butcher-block-group' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

/*----------------------------------------------------------
* Extra Fields
*----------------------------------------------------------*/
include get_template_directory() . '/inc/extra-fields.php';