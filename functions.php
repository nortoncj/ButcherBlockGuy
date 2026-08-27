<?php
// Theme setup and asset enqueueing for Butcher Block Group

	add_action( 'wp_enqueue_scripts', 'bg_enqueue_services_styles' );
function bg_enqueue_services_styles() {

    $is_services_page = is_page_template( 'page-services.php' ) || is_page( 'services' ) || is_page( 'service' );

    if ( ! $is_services_page ) {
        return;
    }

    $css_file = get_stylesheet_directory() . '/assets/css/services-page.css';
    $css_uri  = get_stylesheet_directory_uri() . '/assets/css/services-page.css';

    if ( ! file_exists( $css_file ) ) {
        add_action( 'admin_notices', function() use ( $css_file ) {
            echo '<div class="notice notice-warning"><p>';
            echo '<strong>Block &amp; Grain:</strong> Services stylesheet not found at <code>' . esc_html( $css_file ) . '</code>.';
            echo '</p></div>';
        });
        return;
    }

    wp_enqueue_style( 'bg-services-page', $css_uri, array( 'bbg-style' ), filemtime( $css_file ) );

    wp_enqueue_style( 'bg-glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', array(), '3.2.0' );
    wp_enqueue_script( 'bg-glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', array(), '3.2.0', true );
    wp_add_inline_script( 'bg-glightbox', "
        document.addEventListener('DOMContentLoaded', function () {
            const lightbox = GLightbox({
                selector: '.bg-glightbox',
                openEffect: 'fade',
                closeEffect: 'fade',
                touchNavigation: true,
                keyboardNavigation: true,
                closeOnOutsideClick: true,
            });

            const tabs = document.querySelectorAll('.bg-portfolio-tab');
            const items = document.querySelectorAll('.bg-portfolio-item');

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function () {
                    const filter = tab.dataset.filter;

                    tabs.forEach(function(t) { t.classList.remove('active'); });
                    tab.classList.add('active');

                    items.forEach(function(item) {
                        const match = filter === 'all' || item.dataset.product === filter;
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

    $css_file = get_stylesheet_directory() . '/assets/css/reviews-content.css';
    $css_uri  = get_stylesheet_directory_uri() . '/assets/css/reviews-content.css';

    if ( ! file_exists( $css_file ) ) {
        add_action( 'admin_notices', function() use ( $css_file ) {
            echo '<div class="notice notice-warning"><p>';
            echo '<strong>Block &amp; Grain:</strong> Reviews stylesheet not found at <code>' . esc_html( $css_file ) . '</code>.';
            echo '</p></div>';
        });
        return;
    }

    wp_enqueue_style( 'bg-reviews-content', $css_uri, array(), filemtime( $css_file ) );
}

add_action( 'wp_enqueue_scripts', 'bg_enqueue_front_page_styles' );
function bg_enqueue_front_page_styles() {

    if ( ! is_front_page() ) return;

    $css_file = get_stylesheet_directory() . '/css/front-page.css';
    $css_uri  = get_stylesheet_directory_uri() . '/css/front-page.css';

    if ( ! file_exists( $css_file ) ) {
        $fallback_css_file = get_stylesheet_directory() . '/assets/css/front-page.css';
        $fallback_css_uri  = get_stylesheet_directory_uri() . '/assets/css/front-page.css';

        if ( file_exists( $fallback_css_file ) ) {
            $css_file = $fallback_css_file;
            $css_uri  = $fallback_css_uri;
        } else {
            add_action( 'admin_notices', function() use ( $css_file ) {
                echo '<div class="notice notice-warning"><p>';
                echo '<strong>Block &amp; Grain:</strong> Front page stylesheet not found at <code>' . esc_html( $css_file ) . '</code>.';
                echo '</p></div>';
            });
            return;
        }
    }

    wp_enqueue_style( 'bg-front-page', $css_uri, array(), filemtime( $css_file ) );
}


add_action( 'after_setup_theme', function() {
    add_theme_support( 'post-thumbnails' );
    // Only add these sizes if they haven't been registered already
    if ( ! has_image_size( 'bg-gallery-large' ) ) {
        add_image_size( 'bg-gallery-large', 1400, 1050, false );
    }
    if ( ! has_image_size( 'bg-gallery-thumb' ) ) {
        add_image_size( 'bg-gallery-thumb', 600, 450, true );
    }
} );

require_once get_template_directory() . '/inc/cpt-gallery.php';
add_action( 'after_switch_theme', function() {
    if ( function_exists( 'bg_register_gallery_cpt' ) ) {
        bg_register_gallery_cpt();
    }
    flush_rewrite_rules();
} );


function bbg_enqueue_assets() {
	// Google Fonts
	wp_enqueue_style('bbg-fonts', 'https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300;0,6..72,400;0,6..72,600;0,6..72,700;1,6..72,300;1,6..72,400;1,6..72,600&family=Manrope:wght@300;400;500;600;700&family=Work+Sans:wght@400;500;600&display=swap', array(), null);
	// Font Awesome
	wp_enqueue_style('bbg-fontawesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css', array(), '6.4.0');

	// Main theme stylesheet (style.css in theme root)
	wp_enqueue_style('bbg-style', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'));

	// Additional compiled CSS (the site's original css/style.css)
	if ( file_exists( get_template_directory() . '/css/style.css' ) ) {
		wp_enqueue_style('bbg-main-css', get_template_directory_uri() . '/css/style.css', array('bbg-style'), filemtime( get_template_directory() . '/css/style.css'));
	}

	// Main JS
	if ( file_exists( get_template_directory() . '/js/main.js' ) ) {
		wp_enqueue_script('bbg-main-js', get_template_directory_uri() . '/js/main.js', array(), filemtime( get_template_directory() . '/js/main.js' ), true);
	}
}
add_action('wp_enqueue_scripts', 'bbg_enqueue_assets');

function bbg_theme_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo');
	add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption'));

	register_nav_menus(array(
		'primary' => __('Primary Menu', 'butcher-block-guy'),
	));
}
add_action('after_setup_theme', 'bbg_theme_setup');

function bbg_widgets_init() {
	register_sidebar(array(
		'name' => __('Sidebar', 'butcher-block-guy'),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
add_action('widgets_init', 'bbg_widgets_init');

