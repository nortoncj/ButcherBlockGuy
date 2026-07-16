<?php
/**
 * Block & Grain — functions.php additions
 * ─────────────────────────────────────────────────────────────────────
 * PASTE THIS ENTIRE BLOCK into the BOTTOM of your functions.php,
 * just before the closing ?> tag (or at the very end if there's no ?>)
 *
 * COMMON REASONS IT WON'T WORK — read these first:
 *
 *  1. The file path is wrong.
 *     Your theme folder must contain:  /inc/cpt-gallery.php
 *     Your theme folder must contain:  /assets/css/services-page.css
 *     Not in a plugin folder. Not in wp-content/. In YOUR THEME.
 *
 *  2. The page template isn't assigned.
 *     In the WordPress editor for your Services page, open the
 *     Page Attributes panel and set Template → "Services Page".
 *     If "Services Page" doesn't appear, the file isn't named
 *     page-services.php or the Template Name comment is missing.
 *
 *  3. A PHP parse error in your functions.php is silently killing it.
 *     Enable WP_DEBUG (see below) to surface errors.
 *
 *  4. You're on a child theme.
 *     Use get_stylesheet_directory() instead of get_template_directory()
 *     for the require_once. Both versions are shown below — pick one.
 *
 *  5. Caching.
 *     If you use a caching plugin or CDN, clear ALL caches after saving.
 * ─────────────────────────────────────────────────────────────────────
 */


/* ═══════════════════════════════════════════════════════════════════
   STEP 1 — Load the Gallery CPT file
   ═══════════════════════════════════════════════════════════════════
   Use get_template_directory()  → if you're on a PARENT theme
   Use get_stylesheet_directory() → if you're on a CHILD theme
*/

$bg_cpt_file = get_template_directory() . '/inc/cpt-gallery.php';
// If using a child theme, swap the line above for:
// $bg_cpt_file = get_stylesheet_directory() . '/inc/cpt-gallery.php';

if ( file_exists( $bg_cpt_file ) ) {
    require_once $bg_cpt_file;
} else {
    // Shows a one-line admin notice so you know exactly what's missing
    add_action( 'admin_notices', function() use ( $bg_cpt_file ) {
        echo '<div class="notice notice-error"><p>';
        echo '<strong>Block &amp; Grain:</strong> Cannot find <code>' . esc_html( $bg_cpt_file ) . '</code>. ';
        echo 'Make sure <code>cpt-gallery.php</code> is inside your theme\'s <code>/inc/</code> folder.';
        echo '</p></div>';
    } );
}


/* ═══════════════════════════════════════════════════════════════════
   STEP 2 — Enqueue the Services Page stylesheet
   ═══════════════════════════════════════════════════════════════════ */

add_action( 'wp_enqueue_scripts', 'bg_enqueue_services_styles' );

function bg_enqueue_services_styles() {

    /*
     * is_page_template() checks the template assigned in Page Attributes.
     * It accepts just the filename — 'page-services.php' — which works
     * whether the file is in the theme root OR a subdirectory.
     *
     * If it still doesn't fire, temporarily replace the if() with:
     *   if ( ! is_page() ) return;
     * to confirm the stylesheet loads at all, then debug the template name.
     */
    if ( ! is_page_template( 'page-services.php' ) ) return;

    $css_file = get_template_directory() . '/assets/css/services-page.css';
    $css_uri  = get_template_directory_uri() . '/assets/css/services-page.css';
    // Child theme version:
    // $css_file = get_stylesheet_directory()     . '/assets/css/services-page.css';
    // $css_uri  = get_stylesheet_directory_uri() . '/assets/css/services-page.css';

    if ( ! file_exists( $css_file ) ) {
        // Admin notice if the CSS file is missing
        add_action( 'admin_notices', function() use ( $css_file ) {
            echo '<div class="notice notice-warning"><p>';
            echo '<strong>Block &amp; Grain:</strong> Services stylesheet not found at <code>' . esc_html( $css_file ) . '</code>.';
            echo '</p></div>';
        } );
        return;
    }

    wp_enqueue_style(
        'bg-services-page',
        $css_uri,
        array(), // If your theme has a main stylesheet handle (e.g. 'my-theme-style'), add it here
        filemtime( $css_file ) // Auto-busts cache whenever the file changes
    );
}


/* ═══════════════════════════════════════════════════════════════════
   STEP 3 — Featured image support (safe to add even if already set)
   ═══════════════════════════════════════════════════════════════════ */

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


/* ═══════════════════════════════════════════════════════════════════
   STEP 4 — Flush rewrite rules on theme switch (one-time, automatic)
   ═══════════════════════════════════════════════════════════════════
   This fires once when you activate / switch to this theme.
   After that it does nothing. Safe to leave in permanently.
*/

add_action( 'after_switch_theme', function() {
    if ( function_exists( 'bg_register_gallery_cpt' ) ) {
        bg_register_gallery_cpt();
    }
    flush_rewrite_rules();
} );


/* ═══════════════════════════════════════════════════════════════════
   DEBUGGING HELPER
   ═══════════════════════════════════════════════════════════════════
   If the Portfolio Gallery menu still doesn't appear in the admin
   after following the steps above, uncomment the block below and
   visit ANY admin page once. It will force-register the CPT and
   flush rules immediately. Re-comment it afterwards.

add_action( 'admin_init', function() {
    if ( function_exists( 'bg_register_gallery_cpt' ) ) {
        bg_register_gallery_cpt();
        flush_rewrite_rules();
    }
} );

*/


/* ═══════════════════════════════════════════════════════════════════
   ENABLE WP_DEBUG (do this in wp-config.php, NOT here)
   ═══════════════════════════════════════════════════════════════════
   If nothing is working and you see a blank page or broken admin,
   open wp-config.php and find:

     define( 'WP_DEBUG', false );

   Change it to:

     define( 'WP_DEBUG', true );
     define( 'WP_DEBUG_LOG', true );
     define( 'WP_DEBUG_DISPLAY', true );
     @ini_set( 'display_errors', 1 );

   Then reload the page. PHP errors will appear on screen and in
   wp-content/debug.log — they'll tell you exactly what's broken.
   Set WP_DEBUG back to false when you're done.
*/