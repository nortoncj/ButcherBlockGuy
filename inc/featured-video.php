<?php
function ck_add_featured_video_metabox() {
    add_meta_box(
        'ck_featured_video',
        'Featured Video',
        'ck_featured_video_metabox_callback',
        ['post', 'page'], // add CPTs here if needed
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'ck_add_featured_video_metabox');

function ck_featured_video_metabox_callback($post) {
    $video_url = get_post_meta($post->ID, '_ck_featured_video', true);
    wp_nonce_field('ck_featured_video_nonce', 'ck_featured_video_nonce_field');
    ?>
    <p>
        <input type="text" id="ck_featured_video" name="ck_featured_video" 
               value="<?php echo esc_attr($video_url); ?>" 
               style="width:100%;" placeholder="Video URL">
    </p>
    <p>
        <button class="button ck-upload-video">Upload/Select Video</button>
    </p>

    <script>
    jQuery(document).ready(function($){
        var frame;
        $('.ck-upload-video').on('click', function(e){
            e.preventDefault();
            if (frame) { frame.open(); return; }

            frame = wp.media({
                title: 'Select or Upload Video',
                button: { text: 'Use this video' },
                library: { type: 'video' }
            });

            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                $('#ck_featured_video').val(attachment.url);
            });

            frame.open();
        });
    });
    </script>
    <?php
}

function ck_save_featured_video($post_id) {
    if (!isset($_POST['ck_featured_video_nonce_field']) ||
        !wp_verify_nonce($_POST['ck_featured_video_nonce_field'], 'ck_featured_video_nonce')) {
        return;
    }

    if (isset($_POST['ck_featured_video'])) {
        update_post_meta($post_id, '_ck_featured_video', sanitize_text_field($_POST['ck_featured_video']));
    }
}
add_action('save_post', 'ck_save_featured_video');
