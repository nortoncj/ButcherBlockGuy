<?php
/**
 * Block & Grain — Portfolio Gallery Custom Post Type (REBUILT)
 *
 * Drop this file into your theme's /inc/ folder and require it in functions.php:
 *   require_once get_template_directory() . '/inc/cpt-gallery.php';
 *
 * No ACF. No plugins. Pure WordPress meta boxes + native Media Library.
 *
 * Each "Gallery Item" post stores:
 *   - Post title          → image caption / piece name
 *   - Featured image      → the primary lightbox photo
 *   - _bg_product_type    → what it is (countertop | table | cutting-board | sink | shelving | custom)
 *   - _bg_wood_type       → what it's made from (acacia | hevea | walnut | maple | chevron | other)
 *   - _bg_size            → grid size hint: standard | tall | wide
 *   - _bg_order           → integer display order (lower = first)
 *
 * ADMIN EXPERIENCE:
 *   1. Go to Portfolio Gallery → Add New Photo
 *   2. Upload featured image
 *   3. Enter a title (e.g., "Acacia Kitchen Counter - 10ft Island")
 *   4. Select Product Type (Countertop, Table, Cutting Board, etc.)
 *   5. Select Wood Type (Acacia, Hevea, Walnut, etc.)
 *   6. Choose Grid Size (Standard, Tall, Wide)
 *   7. Set order number
 *   8. Publish
 *
 * Front-end shows tabs for each product type, with wood type badges.
 */

/* ================================================================
   REGISTER THE CUSTOM POST TYPE
   ================================================================ */
add_action( 'init', 'bg_register_gallery_cpt' );
function bg_register_gallery_cpt() {
    $labels = array(
        'name'               => 'Portfolio Gallery',
        'singular_name'      => 'Portfolio Item',
        'menu_name'          => 'Portfolio Gallery',
        'add_new'            => 'Add New Photo',
        'add_new_item'       => 'Add New Portfolio Item',
        'edit_item'          => 'Edit Portfolio Item',
        'new_item'           => 'New Portfolio Item',
        'view_item'          => 'View Portfolio Item',
        'search_items'       => 'Search Portfolio',
        'not_found'          => 'No portfolio items found',
        'not_found_in_trash' => 'No portfolio items found in trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-format-gallery',
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'supports'           => array( 'title', 'thumbnail' ),
        'has_archive'        => false,
        'rewrite'            => false,
        'show_in_rest'       => false,
    );

    register_post_type( 'bg_gallery', $args );
}


/* ================================================================
   META BOX — Product Type + Wood Type Selection
   ================================================================ */
add_action( 'add_meta_boxes', 'bg_gallery_add_meta_box' );
function bg_gallery_add_meta_box() {
    add_meta_box(
        'bg_gallery_details',
        'Portfolio Details',
        'bg_gallery_meta_box_html',
        'bg_gallery',
        'normal',
        'high'
    );
}

function bg_gallery_meta_box_html( $post ) {
    wp_nonce_field( 'bg_gallery_save_meta', 'bg_gallery_nonce' );

    $product_type = get_post_meta( $post->ID, '_bg_product_type', true ) ?: 'countertop';
    $wood_type    = get_post_meta( $post->ID, '_bg_wood_type',    true ) ?: 'acacia';
    $size         = get_post_meta( $post->ID, '_bg_size',         true ) ?: 'standard';
    $order        = get_post_meta( $post->ID, '_bg_order',        true ) ?: '0';

    // Product types — finished products, not processes
    $products = array(
        'countertop'    => 'Kitchen Countertops & Islands',
        'table'         => 'Dining & Work Tables',
        'cutting-board' => 'Cutting & Serving Boards',
        'sink'          => 'Custom Sinks & Drainboards',
        'shelving'      => 'Shelving & Storage',
        'custom'        => 'Custom / One-Off Commissions',
    );

    // Wood types — the materials
    $woods = array(
        'acacia'   => 'Acacia (deep, warm, durable)',
        'hevea'    => 'Hevea / Rubberwood (light, sustainable)',
        'walnut'   => 'Black Walnut (premium, dark grain)',
        'maple'    => 'Hard Maple (classic, light, rock-hard)',
        'chevron'  => 'Chevron Mix (contrasting, geometric)',
        'other'    => 'Other / Mixed Species',
    );

    // Grid sizes
    $sizes = array(
        'standard' => 'Standard (1×1)',
        'tall'     => 'Tall (1×2 — portrait)',
        'wide'     => 'Wide (2×1 — landscape)',
    );
    ?>
    <style>
        .bg-meta-section { margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid #ececec; }
        .bg-meta-section:last-child { border-bottom: none; }
        .bg-meta-label { display: block; font-family: -apple-system, sans-serif; font-size: 12px; text-transform: uppercase; letter-spacing: .1em; color: #646970; font-weight: 600; margin-bottom: 8px; }
        .bg-meta-select { width: 100%; max-width: 400px; padding: 8px 12px; border: 1px solid #dcdcde; border-radius: 4px; font-size: 14px; }
        .bg-meta-hint { font-size: 12px; color: #646970; margin-top: 6px; font-style: italic; }
        .bg-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .bg-thumb-note { background: #fcf9f2; border: 1px solid #dac1bf; border-radius: 4px; padding: 14px; font-size: 13px; color: #50575e; margin-top: 24px; }
        .bg-thumb-note strong { color: #2a0002; }
    </style>

    <div class="bg-meta-section">
        <label class="bg-meta-label">What Type of Product?</label>
        <select name="bg_product_type" class="bg-meta-select">
            <?php foreach ( $products as $val => $label ) : ?>
                <option value="<?php echo esc_attr( $val ); ?>" <?php selected( $product_type, $val ); ?>>
                    <?php echo esc_html( $label ); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="bg-meta-hint">This controls which gallery tab the photo appears in on the portfolio page.</p>
    </div>

    <div class="bg-meta-section">
        <label class="bg-meta-label">Wood Species</label>
        <select name="bg_wood_type" class="bg-meta-select">
            <?php foreach ( $woods as $val => $label ) : ?>
                <option value="<?php echo esc_attr( $val ); ?>" <?php selected( $wood_type, $val ); ?>>
                    <?php echo esc_html( $label ); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="bg-meta-hint">Shown as a badge on the portfolio grid. Helps customers filter by material.</p>
    </div>

    <div class="bg-meta-grid">
        <div class="bg-meta-section" style="margin-bottom: 0; padding-bottom: 0; border-bottom: none;">
            <label class="bg-meta-label">Grid Size</label>
            <select name="bg_size" class="bg-meta-select">
                <?php foreach ( $sizes as $val => $label ) : ?>
                    <option value="<?php echo esc_attr( $val ); ?>" <?php selected( $size, $val ); ?>>
                        <?php echo esc_html( $label ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="bg-meta-hint">Tall and Wide create visual rhythm — use sparingly.</p>
        </div>

        <div class="bg-meta-section" style="margin-bottom: 0; padding-bottom: 0; border-bottom: none;">
            <label class="bg-meta-label">Display Order</label>
            <input type="number" name="bg_order" value="<?php echo esc_attr( $order ); ?>" min="0" max="999" step="1" class="bg-meta-select" style="max-width: 100px;" />
            <p class="bg-meta-hint">Lower = first. Same number sorts by date.</p>
        </div>
    </div>

    <div class="bg-thumb-note">
        <strong>📷 Featured Image:</strong> Set via the Featured Image panel on the right. This is what appears in the portfolio grid and lightbox. Minimum <strong>1200×900 px</strong> recommended.
    </div>
    <?php
}


/* ================================================================
   SAVE META
   ================================================================ */
add_action( 'save_post_bg_gallery', 'bg_gallery_save_meta' );
function bg_gallery_save_meta( $post_id ) {
    if ( ! isset( $_POST['bg_gallery_nonce'] ) ||
         ! wp_verify_nonce( $_POST['bg_gallery_nonce'], 'bg_gallery_save_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = array(
        'bg_product_type' => '_bg_product_type',
        'bg_wood_type'    => '_bg_wood_type',
        'bg_size'         => '_bg_size',
        'bg_order'        => '_bg_order',
    );

    $allowed_products = array( 'countertop', 'table', 'cutting-board', 'sink', 'shelving', 'custom' );
    $allowed_woods    = array( 'acacia', 'hevea', 'walnut', 'maple', 'chevron', 'other' );
    $allowed_sizes    = array( 'standard', 'tall', 'wide' );

    foreach ( $fields as $input => $meta_key ) {
        if ( ! isset( $_POST[ $input ] ) ) continue;

        $value = sanitize_text_field( $_POST[ $input ] );

        if ( $input === 'bg_product_type' && ! in_array( $value, $allowed_products, true ) ) continue;
        if ( $input === 'bg_wood_type'    && ! in_array( $value, $allowed_woods, true ) )    continue;
        if ( $input === 'bg_size'         && ! in_array( $value, $allowed_sizes, true ) )    continue;
        if ( $input === 'bg_order'        ) $value = absint( $value );

        update_post_meta( $post_id, $meta_key, $value );
    }
}


/* ================================================================
   ADMIN LIST COLUMNS
   ================================================================ */
add_filter( 'manage_bg_gallery_posts_columns', 'bg_gallery_columns' );
function bg_gallery_columns( $cols ) {
    $new = array();
    foreach ( $cols as $key => $label ) {
        $new[ $key ] = $label;
        if ( $key === 'title' ) {
            $new['bg_thumb']    = 'Photo';
            $new['bg_product']  = 'Product';
            $new['bg_wood']     = 'Wood';
            $new['bg_order']    = 'Order';
        }
    }
    return $new;
}

add_action( 'manage_bg_gallery_posts_custom_column', 'bg_gallery_column_content', 10, 2 );
function bg_gallery_column_content( $col, $post_id ) {
    switch ( $col ) {
        case 'bg_thumb':
            $thumb = get_the_post_thumbnail( $post_id, array( 60, 60 ) );
            echo $thumb ?: '<span style="color:#aaa;font-style:italic;font-size:12px;">No image</span>';
            break;

        case 'bg_product':
            $map = array(
                'countertop'    => 'Countertops',
                'table'         => 'Tables',
                'cutting-board' => 'Cutting Boards',
                'sink'          => 'Sinks',
                'shelving'      => 'Shelving',
                'custom'        => 'Custom',
            );
            $val = get_post_meta( $post_id, '_bg_product_type', true ) ?: 'countertop';
            echo esc_html( $map[ $val ] ?? $val );
            break;

        case 'bg_wood':
            $map = array(
                'acacia'  => 'Acacia',
                'hevea'   => 'Hevea',
                'walnut'  => 'Walnut',
                'maple'   => 'Maple',
                'chevron' => 'Chevron',
                'other'   => 'Other',
            );
            $val = get_post_meta( $post_id, '_bg_wood_type', true ) ?: 'acacia';
            echo '<span style="background: #f6f3ec; padding: 4px 8px; border-radius: 3px; font-size: 12px; color: #877270;">' . esc_html( $map[ $val ] ?? $val ) . '</span>';
            break;

        case 'bg_order':
            echo esc_html( get_post_meta( $post_id, '_bg_order', true ) ?: '0' );
            break;
    }
}

add_filter( 'manage_edit-bg_gallery_sortable_columns', 'bg_gallery_sortable_columns' );
function bg_gallery_sortable_columns( $cols ) {
    $cols['bg_order'] = 'bg_order';
    return $cols;
}

add_action( 'pre_get_posts', 'bg_gallery_orderby' );
function bg_gallery_orderby( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) return;
    if ( $query->get( 'orderby' ) !== 'bg_order' ) return;
    $query->set( 'meta_key', '_bg_order' );
    $query->set( 'orderby', 'meta_value_num' );
}


/* ================================================================
   QUERY HELPER — Used by portfolio template
   
   bg_get_portfolio_items( $product_type, $wood_type )
     $product_type: 'countertop' | 'table' | 'cutting-board' | 'sink' | 'shelving' | 'custom' | 'all'
     $wood_type:    'acacia' | 'hevea' | 'walnut' | 'maple' | 'chevron' | 'other' | 'all'
   
   Returns array of WP_Post objects with enriched properties:
     ->bg_product_type, ->bg_wood_type, ->bg_size, ->bg_order
     ->bg_img_url, ->bg_img_alt, ->bg_wood_label
   ================================================================ */

function bg_get_portfolio_items( $product_type = 'all', $wood_type = 'all' ) {
    $meta_query = array( 'relation' => 'AND' );

    // Filter by product type
    if ( $product_type !== 'all' ) {
        $meta_query[] = array(
            'key'     => '_bg_product_type',
            'value'   => sanitize_key( $product_type ),
            'compare' => '=',
        );
    }

    // Filter by wood type
    if ( $wood_type !== 'all' ) {
        $meta_query[] = array(
            'key'     => '_bg_wood_type',
            'value'   => sanitize_key( $wood_type ),
            'compare' => '=',
        );
    }

    $args = array(
        'post_type'      => 'bg_gallery',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_query'     => $meta_query,
        'meta_key'       => '_bg_order',
        'orderby'        => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
    );

    $posts = get_posts( $args );

    // Enrich each post with metadata
    foreach ( $posts as &$post ) {
        $thumb_id = get_post_thumbnail_id( $post->ID );

        $post->bg_product_type = get_post_meta( $post->ID, '_bg_product_type', true ) ?: 'countertop';
        $post->bg_wood_type    = get_post_meta( $post->ID, '_bg_wood_type',    true ) ?: 'acacia';
        $post->bg_size         = get_post_meta( $post->ID, '_bg_size',         true ) ?: 'standard';
        $post->bg_order        = (int) ( get_post_meta( $post->ID, '_bg_order', true ) ?: 0 );

        // Image data
        $post->bg_img_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : '';
        $post->bg_img_alt = $thumb_id ? get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) : get_the_title( $post->ID );

        // Wood label for display
        $wood_labels = array(
            'acacia'  => 'Acacia',
            'hevea'   => 'Hevea',
            'walnut'  => 'Walnut',
            'maple'   => 'Maple',
            'chevron' => 'Chevron',
            'other'   => 'Mixed',
        );
        $post->bg_wood_label = $wood_labels[ $post->bg_wood_type ] ?? 'Custom';
    }

    return $posts;
}

/**
 * Helper to get product type display name
 */
function bg_get_product_label( $product_type ) {
    $labels = array(
        'countertop'    => 'Kitchen Countertops & Islands',
        'table'         => 'Dining & Work Tables',
        'cutting-board' => 'Cutting & Serving Boards',
        'sink'          => 'Custom Sinks & Drainboards',
        'shelving'      => 'Shelving & Storage',
        'custom'        => 'Custom Commissions',
    );
    return $labels[ $product_type ] ?? 'Portfolio';
}