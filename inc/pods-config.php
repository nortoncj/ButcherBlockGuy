<?php
/**
 * Butcher Block Group — Pods configuration (code-registered)
 * Load from functions.php AFTER theme-core.php:
 *   require_once get_template_directory() . '/inc/pods-config.php';
 *
 * WHY CODE INSTEAD OF THE PODS ADMIN UI
 * Registered configs live in this file, not the database. That means the
 * schema is version-controlled, survives a database restore, and Troy
 * cannot delete a field group by accident. Trade-off: these pods appear
 * read-only in Pods Admin. To change the schema you edit this file.
 *
 * CRITICAL: bg_gallery is already registered by inc/cpt-gallery.php.
 * It is extended below with pods_register_group() — NOT pods_register_type() —
 * so Pods only attaches fields to the existing CPT. Registering it as a new
 * pod would collide with that file and fatal the site.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * MUST run before Pods reads its config registry.
 *
 * Pods is a plugin, so its own init callback is hooked before the theme's.
 * Registering at priority 10 or 11 lands AFTER Pods has already read the
 * registry, and nothing appears in the admin — no error, just silence.
 * Priority 1 guarantees the configs exist first.
 *
 * Attaching a group to bg_gallery this early is fine: pods_register_group()
 * only stores config keyed by pod name, and Pods resolves it later.
 */
add_action( 'init', 'bbg_register_pods_config', 1 );
function bbg_register_pods_config() {

	if ( ! function_exists( 'pods_register_type' ) ) {
		return; // Pods not active — theme still renders on bbg_opt() fallbacks
	}

	/* =================================================================
	 * 1. SITE SETTINGS  (drives header.php + footer.php)
	 * ============================================================== */
	pods_register_type( 'settings', 'site-settings', array(
		'name'            => 'site-settings',
		'label'           => 'Site Settings',
		'type'            => 'settings',
		'menu_name'       => 'Site Settings',
	) );

	pods_register_group(
		array( 'name' => 'brand', 'label' => 'Brand', 'weight' => 0 ),
		'site-settings',
		array(
			array( 'name' => 'brand_name',   'label' => 'Business Name',        'type' => 'text',  'default' => 'Butcher Block Group' ),
			array( 'name' => 'brand_line_1', 'label' => 'Logo Text — Line 1',   'type' => 'text',  'default' => 'Butcher Block', 'description' => 'Large text beside the logo.' ),
			array( 'name' => 'brand_line_2', 'label' => 'Logo Text — Line 2',   'type' => 'text',  'default' => 'Group', 'description' => 'Small gold text under line 1.' ),
			array( 'name' => 'logo',         'label' => 'Logo',                 'type' => 'file',  'file_format_type' => 'single', 'file_type' => 'images', 'description' => 'Square image. Falls back to the theme logo if empty.' ),
			array( 'name' => 'tagline',      'label' => 'Footer Tagline',       'type' => 'paragraph', 'default' => 'Timeless craftsmanship. Premium materials. Built to last for generations.' ),
		)
	);

	pods_register_group(
		array( 'name' => 'contact', 'label' => 'Contact Details', 'weight' => 1 ),
		'site-settings',
		array(
			array( 'name' => 'phone',         'label' => 'Phone Number',   'type' => 'text', 'default' => '(813) 555-0123', 'description' => 'Displayed as typed. Dialling digits are stripped out automatically.' ),
			array( 'name' => 'email',         'label' => 'Email Address',  'type' => 'email', 'default' => 'hello@butcherblockgroup.com' ),
			array( 'name' => 'city',          'label' => 'City / Region',  'type' => 'text', 'default' => 'Brandon, FL' ),
			array( 'name' => 'quote_url',     'label' => 'Quote Button Link', 'type' => 'website', 'description' => 'Where the "Get Quote" buttons point. Defaults to /contact/.' ),
			array( 'name' => 'licensed_text', 'label' => 'Licence Line',   'type' => 'text', 'description' => 'e.g. "Licensed & Insured". Hidden if empty.' ),
			array( 'name' => 'footer_note',   'label' => 'Footer Note',    'type' => 'text', 'default' => 'Handcrafted in Brandon, Florida.' ),
		)
	);

	pods_register_group(
		array( 'name' => 'pricing', 'label' => 'Pricing Calculator', 'weight' => 3 ),
		'site-settings',
		array(
			array( 'name' => 'size_small_label',  'label' => 'Size Label - Small',  'type' => 'text', 'default' => 'Up to 24"' ),
			array( 'name' => 'size_medium_label', 'label' => 'Size Label - Medium', 'type' => 'text', 'default' => '25" - 48"' ),
			array( 'name' => 'size_large_label',  'label' => 'Size Label - Large',  'type' => 'text', 'default' => '49" and up' ),
			array( 'name' => 'install_per_sqft', 'label' => 'Install Rate ($ per sq ft)', 'type' => 'number', 'number_decimals' => 2, 'default' => 55 ),
			array( 'name' => 'install_min_sqft', 'label' => 'Slider Minimum (sq ft)', 'type' => 'number', 'default' => 5 ),
			array( 'name' => 'install_max_sqft', 'label' => 'Slider Maximum (sq ft)', 'type' => 'number', 'default' => 60 ),
			array( 'name' => 'addon_low',  'label' => 'Add-on Low ($ each)',  'type' => 'number', 'number_decimals' => 2, 'default' => 125 ),
			array( 'name' => 'addon_high', 'label' => 'Add-on High ($ each)', 'type' => 'number', 'number_decimals' => 2, 'default' => 250 ),
			array( 'name' => 'addon_list', 'label' => 'Complexity Add-ons', 'type' => 'paragraph',
				'description' => 'One per line. Each adds the low-high amount above.' ),
			array( 'name' => 'rush_note', 'label' => 'Rush Timeline Note', 'type' => 'text',
				'default' => 'Rush timelines may add a fee, confirmed with Troy directly.' ),
		)
	);

	pods_register_group(
		array( 'name' => 'social', 'label' => 'Social Links', 'weight' => 2 ),
		'site-settings',
		array(
			array( 'name' => 'instagram_url', 'label' => 'Instagram URL', 'type' => 'website', 'description' => 'Leave blank to hide the icon.' ),
			array( 'name' => 'facebook_url',  'label' => 'Facebook URL',  'type' => 'website', 'description' => 'Leave blank to hide the icon.' ),
			array( 'name' => 'pinterest_url', 'label' => 'Pinterest URL', 'type' => 'website', 'description' => 'Leave blank to hide the icon.' ),
		)
	);

	/* =================================================================
	 * 2. CITIES  (service-area matrix)
	 * ============================================================== */
	pods_register_type( 'post_type', 'bg_city', array(
		'name'           => 'bg_city',
		'label'          => 'Cities',
		'label_singular' => 'City',
		'type'           => 'post_type',
		'storage'        => 'meta',
		'public'         => '0',
		'show_ui'        => '1',
		'menu_icon'      => 'dashicons-location',
		'supports_title' => '1',
		'supports_editor'=> '0',
	) );

	pods_register_group(
		array( 'name' => 'city_details', 'label' => 'City Details', 'weight' => 0 ),
		'bg_city',
		array(
			array( 'name' => 'city_slug',  'label' => 'URL Slug', 'type' => 'text', 'description' => 'Lowercase, hyphens only. e.g. st-petersburg' ),
			array( 'name' => 'why_city',   'label' => 'Why This City (paragraph)', 'type' => 'paragraph', 'description' => 'Must be genuinely different per city — this is the main thing keeping location pages out of duplicate-content territory.' ),
			array( 'name' => 'landmarks',  'label' => 'Roads & Landmarks', 'type' => 'paragraph', 'description' => 'One per line. e.g. I-275 / I-75 / Brandon Blvd (SR-60)' ),
			array( 'name' => 'hero_image', 'label' => 'City Photo', 'type' => 'file', 'file_format_type' => 'single', 'file_type' => 'images' ),
		)
	);

	/* =================================================================
	 * 3. FINISHES  (written once, related from any service)
	 * ============================================================== */
	pods_register_type( 'post_type', 'bg_finish', array(
		'name'            => 'bg_finish',
		'label'           => 'Finishes',
		'label_singular'  => 'Finish',
		'type'            => 'post_type',
		'storage'         => 'meta',
		'public'          => '0',
		'show_ui'         => '1',
		'menu_icon'       => 'dashicons-art',
		'supports_title'  => '1',
		'supports_editor' => '0',
	) );

	pods_register_group(
		array( 'name' => 'finish_details', 'label' => 'Finish Details', 'weight' => 0 ),
		'bg_finish',
		array(
			array( 'name' => 'blurb', 'label' => 'Short Description', 'type' => 'text', 'description' => 'One line. e.g. "Durable, low-maintenance, low shine"' ),
			array( 'name' => 'finish_add', 'label' => 'Price Added ($)', 'type' => 'number', 'number_decimals' => 2, 'default' => 0,
				'description' => 'Added to a ready-made piece when this finish is chosen. Use 0 if finish is already baked into your labour rate.' ),
			array( 'name' => 'show_in_calculator', 'label' => 'Show in Pricing Calculator', 'type' => 'boolean', 'default' => 1 ),
		)
	);

	/* =================================================================
	 * 3b. WOODS  (wood rates for the pricing calculator)
	 * ============================================================== */
	pods_register_type( 'post_type', 'bg_wood', array(
		'name' => 'bg_wood', 'label' => 'Woods', 'label_singular' => 'Wood',
		'type' => 'post_type', 'storage' => 'meta',
		'public' => '0', 'show_ui' => '1', 'menu_icon' => 'dashicons-forms',
		'supports_title' => '1', 'supports_editor' => '0',
	) );

	pods_register_group(
		array( 'name' => 'wood_pricing', 'label' => 'Wood Pricing', 'weight' => 0 ),
		'bg_wood',
		array(
			array( 'name' => 'wood_key', 'label' => 'Key', 'type' => 'text',
				'description' => 'Lowercase, no spaces. e.g. acacia. Do not change once live.' ),
			array( 'name' => 'wood_rate', 'label' => 'Rate ($ per board foot)', 'type' => 'number', 'number_decimals' => 2, 'default' => 0,
				'description' => 'Your cost plus margin.' ),
			array( 'name' => 'wood_quote_only', 'label' => 'Quote Only', 'type' => 'boolean', 'default' => 0,
				'description' => 'Shows "Custom quote" instead of a price. Use for exotic or one-off species.' ),
			array( 'name' => 'wood_hex', 'label' => 'Swatch Colour', 'type' => 'color', 'default' => '#6b3f1d' ),
			array( 'name' => 'wood_order', 'label' => 'Display Order', 'type' => 'number', 'default' => 0 ),
		)
	);

	/* =================================================================
	 * 3c. PIECE TYPES  (ready-made items in the calculator)
	 * ============================================================== */
	pods_register_type( 'post_type', 'bg_piece', array(
		'name' => 'bg_piece', 'label' => 'Piece Types', 'label_singular' => 'Piece Type',
		'type' => 'post_type', 'storage' => 'meta',
		'public' => '0', 'show_ui' => '1', 'menu_icon' => 'dashicons-screenoptions',
		'supports_title' => '1', 'supports_editor' => '0',
	) );

	pods_register_group(
		array( 'name' => 'piece_pricing', 'label' => 'Piece Pricing', 'weight' => 0 ),
		'bg_piece',
		array(
			array( 'name' => 'piece_key', 'label' => 'Key', 'type' => 'text',
				'description' => 'Lowercase, no spaces. e.g. cuttingboard' ),
			array( 'name' => 'bf_small',  'label' => 'Board Feet - Small',  'type' => 'number', 'number_decimals' => 2, 'default' => 0 ),
			array( 'name' => 'bf_medium', 'label' => 'Board Feet - Medium', 'type' => 'number', 'number_decimals' => 2, 'default' => 0 ),
			array( 'name' => 'bf_large',  'label' => 'Board Feet - Large',  'type' => 'number', 'number_decimals' => 2, 'default' => 0 ),
			array( 'name' => 'piece_labor', 'label' => 'Labour / Margin ($)', 'type' => 'number', 'number_decimals' => 2, 'default' => 0,
				'description' => 'Flat amount on top of wood cost.' ),
			array( 'name' => 'piece_order', 'label' => 'Display Order', 'type' => 'number', 'default' => 0 ),
		)
	);

	/* =================================================================
	 * 4. SERVICES  ->  /services/[slug]
	 * ============================================================== */
	pods_register_type( 'post_type', 'bg_service', array(
		'name'            => 'bg_service',
		'label'           => 'Services',
		'label_singular'  => 'Service',
		'type'            => 'post_type',
		'storage'         => 'meta',
		'public'          => '1',
		'show_ui'         => '1',
		'menu_icon'       => 'dashicons-hammer',
		'supports_title'  => '1',
		'supports_editor' => '1',
		'supports_thumbnail' => '1',
		'has_archive'     => '0',
		'rewrite'         => '1',
		'rewrite_custom_slug' => 'services',
	) );

	pods_register_group(
		array( 'name' => 'service_details', 'label' => 'Service Details', 'weight' => 0 ),
		'bg_service',
		array(
			array( 'name' => 'tagline', 'label' => 'Hero Tagline', 'type' => 'text', 'description' => 'e.g. "Kitchen islands, bar tops, and waterfall edges"' ),
			array( 'name' => 'card_blurb', 'label' => 'Card Blurb', 'type' => 'text', 'description' => 'Short line used on the services hub grid.' ),
			array(
				'name' => 'gallery_category', 'label' => 'Gallery Category', 'type' => 'pick',
				'pick_object' => 'custom-simple',
				'pick_custom' => "countertop|Countertops\ntable|Tables\ndesk|Desks\ncutting-board|Cutting Boards\nsink|Sinks\nshelving|Shelving\ncustom|Custom",
				'description' => 'Which bg_gallery product type to auto-pull photos from.',
			),
			array(
				'name' => 'pricing_mode', 'label' => 'Pricing Calculator Tab', 'type' => 'pick',
				'pick_object' => 'custom-simple',
				'pick_custom' => "install|Full Install Estimate\npickup|Ready-Made Pieces",
				'default' => 'install',
				'description' => 'Which calculator tab this service\'s CTA opens.',
			),
			array(
				'name' => 'finishes', 'label' => 'Recommended Finishes', 'type' => 'pick',
				'pick_object' => 'post_type', 'pick_val' => 'bg_finish',
				'pick_format_type' => 'multi', 'pick_format_multi' => 'list',
				'description' => 'Best fit first — order is preserved on the front end.',
			),
		)
	);

	/* =================================================================
	 * 5. SERVICE AREAS  ->  /services/[service]/[city]
	 *    The 42-page SEO matrix. Neighbourhood tiles intentionally cut.
	 * ============================================================== */
	pods_register_type( 'post_type', 'bg_service_area', array(
		'name'            => 'bg_service_area',
		'label'           => 'Service Areas',
		'label_singular'  => 'Service Area',
		'type'            => 'post_type',
		'storage'         => 'meta',
		'public'          => '1',
		'show_ui'         => '1',
		'menu_icon'       => 'dashicons-admin-site-alt3',
		'supports_title'  => '1',
		'supports_editor' => '1',
		'has_archive'     => '0',
		'rewrite'         => '0', // URLs handled by a custom rewrite rule
	) );

	pods_register_group(
		array( 'name' => 'area_details', 'label' => 'Service Area Details', 'weight' => 0 ),
		'bg_service_area',
		array(
			array( 'name' => 'service', 'label' => 'Service', 'type' => 'pick',
				'pick_object' => 'post_type', 'pick_val' => 'bg_service',
				'pick_format_type' => 'single', 'pick_format_single' => 'dropdown', 'required' => '1' ),
			array( 'name' => 'city', 'label' => 'City', 'type' => 'pick',
				'pick_object' => 'post_type', 'pick_val' => 'bg_city',
				'pick_format_type' => 'single', 'pick_format_single' => 'dropdown', 'required' => '1' ),
			array( 'name' => 'hero_intro', 'label' => 'Hero Paragraph', 'type' => 'paragraph',
				'description' => 'Unique per city+service. Do not reuse with the city name swapped.' ),
			array( 'name' => 'projects', 'label' => 'Local Projects', 'type' => 'pick',
				'pick_object' => 'post_type', 'pick_val' => 'bg_gallery',
				'pick_format_type' => 'multi', 'pick_format_multi' => 'list', 'pick_limit' => 4,
				'description' => 'Pick 4 real jobs from this area. Leave empty rather than showing work from another city.' ),
		)
	);

	/* =================================================================
	 * 6. EXTEND bg_gallery  (groups only — the CPT already exists)
	 * ============================================================== */

	// Lightbox detail fields. NOTE: no leading underscore. The older
	// hand-rolled fields (_bg_product_type, _bg_wood_type) keep theirs
	// because inc/cpt-gallery.php writes them directly; Pods does not
	// handle underscore-prefixed field names cleanly.
	pods_register_group(
		array( 'name' => 'piece_details', 'label' => 'Piece Details', 'weight' => 1 ),
		'bg_gallery',
		array(
			array( 'name' => 'bg_description', 'label' => 'Description', 'type' => 'paragraph',
				'description' => 'Shown on hover and in the lightbox. Two sentences is plenty.' ),
			array( 'name' => 'bg_dimensions', 'label' => 'Dimensions', 'type' => 'text',
				'description' => 'e.g. 96" L × 42" W × 30" H' ),
			array( 'name' => 'bg_finish', 'label' => 'Finish', 'type' => 'pick',
				'pick_object' => 'post_type', 'pick_val' => 'bg_finish',
				'pick_format_type' => 'single', 'pick_format_single' => 'dropdown',
				'description' => 'Pulls from Finishes, so the wording stays consistent site-wide.' ),
			array( 'name' => 'bg_style', 'label' => 'Style', 'type' => 'pick',
				'pick_object' => 'custom-simple',
				'pick_custom' => "Modern Rustic|Modern Rustic\nLive Edge|Live Edge\nClassic Kitchen|Classic Kitchen\nFarmhouse|Farmhouse\nChevron Inlay|Chevron Inlay\nMinimalist|Minimalist",
				'pick_format_type' => 'single', 'pick_format_single' => 'dropdown' ),
		)
	);

	pods_register_group(
		array( 'name' => 'gallery_location', 'label' => 'Location', 'weight' => 5, 'meta_box_context' => 'side' ),
		'bg_gallery',
		array(
			array( 'name' => 'job_city', 'label' => 'City This Was Built For', 'type' => 'pick',
				'pick_object' => 'post_type', 'pick_val' => 'bg_city',
				'pick_format_type' => 'single', 'pick_format_single' => 'dropdown',
				'description' => 'Lets location pages show genuinely local work instead of the same generic photos everywhere.' ),
		)
	);
}