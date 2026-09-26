<?php
/**
 * "Front Page Extra Image" — an image URL stored on the page in _frontpage_image.
 * Read by front-page.php for the workshop photo in the Quality Standard section.
 *
 * Registered for REST as well as the classic form so it saves from the block
 * editor: a metabox field on its own never marks the post dirty there, so
 * Update stays inert and the metabox form is never submitted.
 */

/**
 * Deliberately NOT registered with show_in_rest.
 *
 * The block editor sends every REST-exposed meta key on each save using the
 * value it loaded the page with. Since this field is edited in a metabox and
 * not through the editor store, that copy is always stale, and its REST save
 * lands after the metabox form POST and overwrites the value with ''. The
 * metabox form is the single writer instead; the script only has to mark the
 * post dirty so the editor actually submits that form.
 */

function add_frontpage_image_metabox() {
    add_meta_box(
        'frontpage_image',
        'Front Page Extra Image',
        'frontpage_image_metabox_callback',
        ['page'], // or ['post', 'page', 'your_cpt_slug']
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_frontpage_image_metabox');

// The media modal (wp.media) isn't on the classic edit screen unless we ask,
// and the metabox script needs wp.media/wp.data guaranteed to load first.
function frontpage_image_enqueue_media($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'], true)) {
        return;
    }

    $screen = get_current_screen();
    if (!$screen || 'page' !== $screen->post_type) {
        return;
    }

    wp_enqueue_media();

    $rel = '/assets/js/frontpage-image.js';
    wp_enqueue_script(
        'bbg-frontpage-image',
        get_template_directory_uri() . $rel,
        array('media-editor', 'wp-data'),
        filemtime(get_template_directory() . $rel),
        true
    );
}
add_action('admin_enqueue_scripts', 'frontpage_image_enqueue_media');

function frontpage_image_metabox_callback($post) {
    $image_url = get_post_meta($post->ID, '_frontpage_image', true);
    wp_nonce_field('frontpage_image_nonce', 'frontpage_image_nonce_field');
    ?>
    <p>
        <input type="text" id="bbg_frontpage_image_field" name="frontpage_image"
               value="<?php echo esc_attr($image_url); ?>"
               style="width:100%;" placeholder="Image URL">
    </p>
    <p>
        <button type="button" class="button upload-image">Upload/Select Image</button>
        <button type="button" class="button remove-image">Remove</button>
    </p>
    <p id="frontpage_image_preview">
        <?php if ($image_url) : ?>
            <img src="<?php echo esc_url($image_url); ?>" style="max-width:100%;height:auto;">
        <?php endif; ?>
    </p>

    <?php
}

// Classic editor path. The block editor saves through REST via the meta
// registration above, so this is a no-op there.
function save_frontpage_image($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!isset($_POST['frontpage_image_nonce_field']) ||
        !wp_verify_nonce($_POST['frontpage_image_nonce_field'], 'frontpage_image_nonce')) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['frontpage_image'])) {
        $url = esc_url_raw(trim(wp_unslash($_POST['frontpage_image'])));
        if ($url === '') {
            delete_post_meta($post_id, '_frontpage_image');
        } else {
            update_post_meta($post_id, '_frontpage_image', $url);
        }
    }
}
add_action('save_post', 'save_frontpage_image');


/*----------------------------
* Featured Video
-----------------------------*/
function add_featured_video_metabox() {
    add_meta_box(
        'featured_video',
        'Featured Video',
        'featured_video_metabox_callback',
        ['post', 'page'], // add CPTs if needed
        'side',
        'low'
    );
}
add_action('add_meta_boxes', 'add_featured_video_metabox');

function featured_video_metabox_callback($post) {
    $video_url = get_post_meta($post->ID, '_featured_video', true);
    wp_nonce_field('featured_video_nonce', 'featured_video_nonce_field');
    ?>
    <p>
        <input type="text" id="bbg_featured_video_field" name="featured_video"
               value="<?php echo esc_attr($video_url); ?>"
               style="width:100%;" placeholder="Video URL">
    </p>
    <p>
        <button class="button upload-featured-video">Upload/Select Video</button>
    </p>

    <script>
    jQuery(document).ready(function($){
        var frame;
        $('.upload-featured-video').on('click', function(e){
            e.preventDefault();
            if (frame) { frame.open(); return; }

            frame = wp.media({
                title: 'Select or Upload Video',
                button: { text: 'Use this video' },
                library: { type: 'video' }
            });

            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                $('#bbg_featured_video_field').val(attachment.url);
            });

            frame.open();
        });
    });
    </script>
    <?php
}

function save_featured_video($post_id) {
    if (!isset($_POST['featured_video_nonce_field']) ||
        !wp_verify_nonce($_POST['featured_video_nonce_field'], 'featured_video_nonce')) {
        return;
    }

    if (isset($_POST['featured_video'])) {
        update_post_meta($post_id, '_featured_video', sanitize_text_field($_POST['featured_video']));
    }
}
add_action('save_post', 'save_featured_video');
