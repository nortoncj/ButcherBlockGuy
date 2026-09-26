<?php
/**
 * Butcher Block Group — theme core
 * Load from functions.php:  require_once get_template_directory() . '/inc/theme-core.php';
 *
 * NOTE: bg_gallery is already registered in inc/cpt-gallery.php.
 * Do NOT create it again as a Pod — use Pods > Add New > "Extend Existing
 * Content Type" so Pods only attaches fields to the CPT that already exists.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ---------------------------------------------------------------------
 * Menus
 * ------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'bbg_register_menus' );
function bbg_register_menus() {
	register_nav_menus( array(
		'primary'        => __( 'Primary Menu', 'butcher-block-group' ),
		'footer_quick'   => __( 'Footer — Quick Links', 'butcher-block-group' ),
		'footer_service' => __( 'Footer — Services', 'butcher-block-group' ),
	) );
}

/* ---------------------------------------------------------------------
 * Global options (Pods options page: "Site Settings")
 *
 * bbg_opt() reads a Pods option with a hard fallback, so every template
 * renders correctly even before Troy fills the options page in.
 * ------------------------------------------------------------------- */
function bbg_opt( $key, $fallback = '' ) {
	static $pod = null;
	static $missing = false;

	// Instantiate the settings pod once per request, not once per field.
	if ( null === $pod && ! $missing ) {
		if ( function_exists( 'pods' ) ) {
			$pod = pods( 'site-settings' );
			if ( ! $pod || ! $pod->valid() ) { $pod = null; $missing = true; }
		} else {
			$missing = true;
		}
	}

	$val = null;
	if ( $pod ) {
		$val = $pod->field( $key );
	}

	// Settings pods write to the options table, so fall back to it directly
	// if the Pods object isn't available (plugin disabled, load-order issue).
	if ( empty( $val ) ) {
		$val = get_option( 'site-settings_' . $key );
	}
	if ( empty( $val ) ) {
		$val = get_option( 'bbg_' . $key );
	}
	if ( empty( $val ) ) {
		return $fallback;
	}

	// File/image fields come back as an array (or array of arrays).
	if ( is_array( $val ) ) {
		$first = isset( $val[0] ) && is_array( $val[0] ) ? $val[0] : $val;
		if ( ! empty( $first['ID'] ) ) {
			$url = wp_get_attachment_url( $first['ID'] );
			if ( $url ) return $url;
		}
		if ( ! empty( $first['guid'] ) ) return $first['guid'];
		return $fallback;
	}

	return $val;
}

/** Phone digits only, for tel: links. */
function bbg_phone_digits() {
	return preg_replace( '/\D/', '', bbg_opt( 'phone', '(813) 555-0123' ) );
}

/** Logo URL with a theme-file fallback so the mark never disappears. */
function bbg_logo_url() {
	return bbg_opt( 'logo', get_template_directory_uri() . '/assets/images/bbg_logo.png' );
}

/* ---------------------------------------------------------------------
 * Nav icons
 *
 * WP menus have no icon field. Rather than bolt one on, map the menu
 * item's target to an icon by slug. Unknown items get no icon and still
 * render their label — they just look plainer, they don't break.
 * ------------------------------------------------------------------- */
function bbg_nav_icon( $slug ) {
	$paths = array(
		'services' => '<path d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" stroke-linecap="round" stroke-linejoin="round"/>',
		'gallery'  => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>',
		'about'    => '<path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"/>',
		'pricing'  => '<rect x="4" y="5" width="16" height="16" rx="1"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="11" x2="16" y2="11"/><line x1="8" y1="15" x2="12" y2="15"/>',
		'contact'  => '<path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>',
		'home'     => '<path d="M3 11.5 12 4l9 7.5"/><path d="M5.5 10v9a1 1 0 001 1H10v-6h4v6h3.5a1 1 0 001-1v-9"/>',
	);

	$key = '';
	foreach ( array_keys( $paths ) as $candidate ) {
		if ( false !== strpos( $slug, $candidate ) ) { $key = $candidate; break; }
	}
	if ( ! $key ) return '';

	return '<svg class="w-4 h-4 text-gold stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">'
	     . $paths[ $key ] . '</svg>';
}

/** Best-effort slug for a menu item, used only to pick an icon. */
function bbg_menu_item_slug( $item ) {
	$url = is_object( $item ) ? $item->url : (string) $item;
	$path = trim( parse_url( $url, PHP_URL_PATH ) ?: '', '/' );
	$frag = parse_url( $url, PHP_URL_FRAGMENT );
	return strtolower( $path . ' ' . $frag . ' ' . ( is_object( $item ) ? $item->title : '' ) );
}

/* ---------------------------------------------------------------------
 * Assets
 *
 * Ships a compiled Tailwind build when one exists. Until the build step
 * is wired up it falls back to the CDN so the site still renders — but
 * the CDN recompiles CSS in the browser on every page load and must NOT
 * survive to launch, so it also raises an admin notice.
 * ------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'bbg_enqueue_core_assets' );
function bbg_enqueue_core_assets() {

	// One font request for the whole site. Oswald + Manrope are the current
	// Heritage Seal system; Newsreader + Work Sans are still referenced by the
	// older front-page / services / reviews stylesheets. Drop those two from
	// this URL once those files are migrated.
	wp_enqueue_style(
		'bbg-fonts',
		'https://fonts.googleapis.com/css2'
			. '?family=Manrope:wght@300;400;500;600;700'
			. '&family=Oswald:wght@500;600;700'
			. '&family=Newsreader:ital,opsz,wght@0,6..72,300;0,6..72,400;0,6..72,600;0,6..72,700;1,6..72,300;1,6..72,400;1,6..72,600'
			. '&family=Work+Sans:wght@400;500;600'
			. '&display=swap',
		array(),
		null
	);

	$css_file = get_template_directory() . '/assets/css/theme.css';
	$css_uri  = get_template_directory_uri() . '/assets/css/theme.css';

	if ( file_exists( $css_file ) ) {
		wp_enqueue_style( 'bbg-theme', $css_uri, array( 'bbg-fonts' ), filemtime( $css_file ) );
	} else {
		wp_enqueue_script( 'bbg-tw-cdn', 'https://cdn.tailwindcss.com', array(), null, false );
		wp_add_inline_script( 'bbg-tw-cdn', bbg_tailwind_inline_config() );
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-warning"><p><strong>Butcher Block Group:</strong> '
			   . 'running on the Tailwind CDN because <code>assets/css/theme.css</code> is missing. '
			   . 'Build the stylesheet before launch — the CDN compiles CSS in the browser on every page load.</p></div>';
		} );
	}

	$js_file = get_template_directory() . '/assets/js/theme.js';
	if ( file_exists( $js_file ) ) {
		wp_enqueue_script( 'bbg-theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), filemtime( $js_file ), true );
	}
}

/** Design tokens — keep in sync with tailwind.config.js once the build exists. */
function bbg_tailwind_inline_config() {
	return "tailwind.config = {
  theme: { extend: {
    colors: {
      espresso: '#1c1108',
      foundry:  '#3a2415',
      gold:   { DEFAULT: '#a8752e', light: '#c89548', hover: '#8c5e20' },
      ivory:  { DEFAULT: '#f4e7d3', low: '#efe0c8', high: '#e4d2b4', card: '#faede0' },
      ink: '#16110b'
    },
    fontFamily: {
      headline: ['Oswald', 'sans-serif'],
      sans: ['Manrope', 'sans-serif']
    }
  } }
};";
}

/* ---------------------------------------------------------------------
 * Service icons
 *
 * Service cards are rendered in a loop, so per-card SVGs can't be
 * hand-placed any more. Map them by the service's slug instead. An
 * unrecognised service falls back to the generic tool icon rather than
 * rendering an empty circle.
 * ------------------------------------------------------------------- */
function bbg_service_icon( $slug ) {
	$paths = array(
		'cutting-board'  => '<path d="M14 4l6 6-9 9H5v-6L14 4z"/>',
		'butcher-block'  => '<path d="M14 4l6 6-9 9H5v-6L14 4z"/>',
		'countertop'     => '<rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/>',
		'tabletop'       => '<rect x="3" y="6" width="18" height="3" rx="1"/><line x1="6" y1="9" x2="6" y2="20"/><line x1="18" y1="9" x2="18" y2="20"/>',
		'table'          => '<rect x="3" y="6" width="18" height="3" rx="1"/><line x1="6" y1="9" x2="6" y2="20"/><line x1="18" y1="9" x2="18" y2="20"/>',
		'desktop'        => '<path d="M3 9h18M6 9v10M18 9v10M6 14h12" stroke-linecap="round"/>',
		'desk'           => '<path d="M3 9h18M6 9v10M18 9v10M6 14h12" stroke-linecap="round"/>',
		'shelving'       => '<rect x="4" y="3" width="16" height="18" rx="2"/><line x1="4" y1="9" x2="20" y2="9"/><line x1="4" y1="15" x2="20" y2="15"/>',
		'built-in'       => '<rect x="4" y="3" width="16" height="18" rx="2"/><line x1="4" y1="9" x2="20" y2="9"/><line x1="4" y1="15" x2="20" y2="15"/>',
		'sink'           => '<path d="M4 12h16v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5z"/><path d="M12 12V6a2 2 0 012-2" stroke-linecap="round"/>',
		'drainboard'     => '<path d="M4 12h16v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5z"/><path d="M12 12V6a2 2 0 012-2" stroke-linecap="round"/>',
		'custom'         => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
	);

	foreach ( $paths as $needle => $path ) {
		if ( false !== strpos( $slug, $needle ) ) {
			return '<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">' . $path . '</svg>';
		}
	}

	// Generic fallback: crossed tools
	return '<svg class="w-4 h-4 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">'
	     . '<path d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

/* ---------------------------------------------------------------------
 * Pricing calculator data
 *
 * Assembles everything the calculator needs from Woods, Piece Types,
 * Finishes and the Site Settings pricing group. Nothing is hardcoded in
 * the JS any more — Troy edits posts, the calculator follows.
 *
 * NOTE: these rates end up in the page source, so anyone can read the
 * formula. That's inherent to an instant-price calculator, not a bug —
 * but it's a business decision worth Troy signing off on.
 * ------------------------------------------------------------------- */
function bbg_pricing_data() {

	$out = array(
		'pieces'   => array(),
		'woods'    => array(),
		'finishes' => array(),
		'sizes'    => array(
			'Small'  => bbg_opt( 'size_small_label',  'Up to 24"' ),
			'Medium' => bbg_opt( 'size_medium_label', '25" – 48"' ),
			'Large'  => bbg_opt( 'size_large_label',  '49" and up' ),
		),
		'install'  => array(
			'perSqft'  => (float) bbg_opt( 'install_per_sqft', 55 ),
			'minSqft'  => (int) bbg_opt( 'install_min_sqft', 5 ),
			'maxSqft'  => (int) bbg_opt( 'install_max_sqft', 60 ),
			'addonLow' => (float) bbg_opt( 'addon_low', 125 ),
			'addonHigh'=> (float) bbg_opt( 'addon_high', 250 ),
			'addons'   => bbg_lines( bbg_opt( 'addon_list', "Undermount sink cutout\nMitered corner\nWaterfall edge" ) ),
		),
	);

	foreach ( get_posts( array(
		'post_type' => 'bg_piece', 'post_status' => 'publish', 'posts_per_page' => -1,
		'meta_key' => 'piece_order', 'orderby' => 'meta_value_num title', 'order' => 'ASC',
	) ) as $p ) {
		$key = get_post_meta( $p->ID, 'piece_key', true );
		if ( ! $key ) { $key = $p->post_name; }
		$out['pieces'][] = array(
			'key'   => $key,
			'label' => get_the_title( $p ),
			'bf'    => array(
				'Small'  => (float) get_post_meta( $p->ID, 'bf_small', true ),
				'Medium' => (float) get_post_meta( $p->ID, 'bf_medium', true ),
				'Large'  => (float) get_post_meta( $p->ID, 'bf_large', true ),
			),
			'labor' => (float) get_post_meta( $p->ID, 'piece_labor', true ),
		);
	}

	foreach ( get_posts( array(
		'post_type' => 'bg_wood', 'post_status' => 'publish', 'posts_per_page' => -1,
		'meta_key' => 'wood_order', 'orderby' => 'meta_value_num title', 'order' => 'ASC',
	) ) as $w ) {
		$key = get_post_meta( $w->ID, 'wood_key', true );
		if ( ! $key ) { $key = $w->post_name; }
		$out['woods'][] = array(
			'key'       => $key,
			'label'     => get_the_title( $w ),
			'rate'      => (float) get_post_meta( $w->ID, 'wood_rate', true ),
			'quoteOnly' => (bool) get_post_meta( $w->ID, 'wood_quote_only', true ),
			'hex'       => get_post_meta( $w->ID, 'wood_hex', true ) ?: '#6b3f1d',
		);
	}

	foreach ( get_posts( array(
		'post_type' => 'bg_finish', 'post_status' => 'publish', 'posts_per_page' => -1,
		'orderby' => 'menu_order title', 'order' => 'ASC',
	) ) as $f ) {
		if ( '' !== get_post_meta( $f->ID, 'show_in_calculator', true )
			&& ! get_post_meta( $f->ID, 'show_in_calculator', true ) ) {
			continue;
		}
		$out['finishes'][] = array(
			'key'   => $f->post_name,
			'label' => get_the_title( $f ),
			'add'   => (float) get_post_meta( $f->ID, 'finish_add', true ),
		);
	}

	return $out;
}

/* ---------------------------------------------------------------------
 * bg_gallery additions the SEO matrix depends on
 * Both were flagged as gaps: no "desk" product type, no location tag.
 * ------------------------------------------------------------------- */

/** Adds "desk" so Desktops can be its own service, separate from tables. */
add_filter( 'bg_gallery_product_types', 'bbg_add_desk_product_type' );
function bbg_add_desk_product_type( $types ) {
	if ( is_array( $types ) && ! isset( $types['desk'] ) ) {
		$types['desk'] = 'Desks & Office Tops';
	}
	return $types;
}