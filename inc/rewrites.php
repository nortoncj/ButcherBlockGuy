<?php
/**
 * Butcher Block Group — URL rules for the service × location matrix
 * Load from functions.php AFTER pods-config.php:
 *   require_once get_template_directory() . '/inc/rewrites.php';
 *
 * Pods can produce /services/countertops/ for bg_service, but it cannot
 * produce the three-segment /services/countertops/tampa/ that the service
 * area pages need. That is why bg_service_area is registered with
 * 'rewrite' => '0' — the URL is handled entirely here.
 *
 * How it works:
 *   - Each bg_service_area post gets an internal slug "{service}-{city}"
 *     (e.g. countertops-tampa). That is unique, which "tampa" alone would
 *     not be — six cities across seven services would collide and
 *     WordPress would silently append -2, -3, -4.
 *   - A rewrite rule maps the pretty 3-segment URL onto that slug.
 *   - post_type_link rebuilds the pretty URL so get_permalink() and every
 *     menu, sitemap and canonical tag agree with it.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/** Slug for a related service post. */
function bbg_service_slug( $service_id ) {
	$post = get_post( (int) $service_id );
	return $post ? $post->post_name : '';
}

/** Slug for a related city post — its city_slug field, else its post slug. */
function bbg_city_slug( $city_id ) {
	$city_id = (int) $city_id;
	if ( ! $city_id ) return '';
	$slug = get_post_meta( $city_id, 'city_slug', true );
	if ( $slug ) return sanitize_title( $slug );
	$post = get_post( $city_id );
	return $post ? $post->post_name : '';
}

/** Both slugs for a service area, or empty strings if either side is unset. */
function bbg_area_slugs( $area_id ) {
	return array(
		bbg_service_slug( get_post_meta( $area_id, 'service', true ) ),
		bbg_city_slug( get_post_meta( $area_id, 'city', true ) ),
	);
}

/* ---------------------------------------------------------------------
 * 1. Rewrite rule — pretty URL in, internal slug out
 * ------------------------------------------------------------------- */
add_action( 'init', 'bbg_add_service_area_rewrite', 12 );
function bbg_add_service_area_rewrite() {
	// Three segments only. Two segments (/services/countertops/) still belong
	// to bg_service, so these rules never overlap.
	add_rewrite_rule(
		'^services/([^/]+)/([^/]+)/?$',
		'index.php?bg_service_area=$matches[1]-$matches[2]',
		'top'
	);
}

/* ---------------------------------------------------------------------
 * 2. Keep the internal slug in sync with the chosen service + city
 * ------------------------------------------------------------------- */
add_action( 'save_post_bg_service_area', 'bbg_sync_service_area_slug', 20, 3 );
function bbg_sync_service_area_slug( $post_id, $post, $update ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( wp_is_post_revision( $post_id ) ) return;

	list( $service, $city ) = bbg_area_slugs( $post_id );
	if ( ! $service || ! $city ) return; // incomplete — leave the slug alone

	$desired = sanitize_title( $service . '-' . $city );
	if ( $post->post_name === $desired ) return;

	// Unhook before updating or this fires again on the nested save.
	remove_action( 'save_post_bg_service_area', 'bbg_sync_service_area_slug', 20 );
	wp_update_post( array( 'ID' => $post_id, 'post_name' => $desired ) );
	add_action( 'save_post_bg_service_area', 'bbg_sync_service_area_slug', 20, 3 );

	// New slug means the rule cache is stale.
	update_option( 'bbg_flush_rewrites_pending', 1 );
}

/* ---------------------------------------------------------------------
 * 3. Generate the pretty permalink
 * ------------------------------------------------------------------- */
add_filter( 'post_type_link', 'bbg_service_area_permalink', 10, 2 );
function bbg_service_area_permalink( $link, $post ) {
	if ( 'bg_service_area' !== $post->post_type ) return $link;

	list( $service, $city ) = bbg_area_slugs( $post->ID );
	if ( ! $service || ! $city ) return $link;

	return user_trailingslashit( home_url( "/services/{$service}/{$city}/" ) );
}

/* ---------------------------------------------------------------------
 * 4. Flush rules only when something actually changed
 *    (flush_rewrite_rules on every load is a well-known performance sin)
 * ------------------------------------------------------------------- */
add_action( 'wp_loaded', 'bbg_maybe_flush_rewrites' );
function bbg_maybe_flush_rewrites() {
	if ( get_option( 'bbg_flush_rewrites_pending' ) ) {
		flush_rewrite_rules( false );
		delete_option( 'bbg_flush_rewrites_pending' );
	}
}

// A new service or city can change the URL shape too.
add_action( 'save_post_bg_service', function () { update_option( 'bbg_flush_rewrites_pending', 1 ); } );
add_action( 'save_post_bg_city',    function () { update_option( 'bbg_flush_rewrites_pending', 1 ); } );

/* ---------------------------------------------------------------------
 * 5. Query helpers used by the templates
 * ------------------------------------------------------------------- */

/** All published service areas for one service, ordered by city name. */
function bbg_areas_for_service( $service_id, $limit = -1 ) {
	return get_posts( array(
		'post_type'      => 'bg_service_area',
		'post_status'    => 'publish',
		'posts_per_page' => $limit,
		'meta_query'     => array(
			array( 'key' => 'service', 'value' => (int) $service_id ),
		),
		'orderby'        => 'title',
		'order'          => 'ASC',
	) );
}

/** Sibling cities for the same service — the "also serving nearby" block. */
function bbg_sibling_areas( $area_id, $limit = 5 ) {
	$service_id = get_post_meta( $area_id, 'service', true );
	if ( ! $service_id ) return array();

	$siblings = bbg_areas_for_service( $service_id );
	return array_slice( array_filter( $siblings, function ( $p ) use ( $area_id ) {
		return (int) $p->ID !== (int) $area_id;
	} ), 0, $limit );
}

/** Split a newline-delimited textarea into a clean array. */
function bbg_lines( $value ) {
	if ( ! $value ) return array();
	$lines = preg_split( '/\r\n|\r|\n/', (string) $value );
	return array_values( array_filter( array_map( 'trim', $lines ), 'strlen' ) );
}
