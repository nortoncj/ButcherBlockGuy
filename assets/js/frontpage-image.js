/**
 * "Front Page Extra Image" metabox (inc/extra-fields.php).
 *
 * Enqueued with explicit deps rather than inlined in the metabox: in the block
 * editor wp.media and wp.data are printed in the footer, so an inline script in
 * the metabox body can run before they exist and die on the first reference.
 */
( function () {
	function init() {
		// NOT 'frontpage_image': add_meta_box() gives the wrapping .postbox div
		// that id, and it wins getElementById, so writes never reached the input.
		var field = document.getElementById( 'bbg_frontpage_image_field' );
		if ( ! field ) {
			return;
		}

		var preview = document.getElementById( 'frontpage_image_preview' );
		var box = document.getElementById( 'frontpage_image' ) || document;
		var pickBtn = box.querySelector( '.upload-image' );
		var dropBtn = box.querySelector( '.remove-image' );
		if ( ! pickBtn || ! dropBtn ) {
			return;
		}
		var frame;

		function setValue( url ) {
			field.value = url;

			preview.innerHTML = '';
			if ( url ) {
				var img = document.createElement( 'img' );
				img.src = url;
				img.style.maxWidth = '100%';
				img.style.height = 'auto';
				preview.appendChild( img );
			}

			// The block editor only submits the metabox form when the post is
			// dirty, and touching a metabox field does not dirty it on its own.
			// Mark it dirty with a throwaway key: it is not registered for REST,
			// so the endpoint ignores it and nothing can overwrite the real meta,
			// which the metabox form POST writes.
			if ( window.wp && wp.data && wp.data.dispatch( 'core/editor' ) ) {
				wp.data.dispatch( 'core/editor' ).editPost( {
					meta: { _frontpage_image_touched: Date.now() }
				} );
			}
		}

		field.addEventListener( 'change', function () {
			setValue( field.value );
		} );

		pickBtn.addEventListener( 'click', function ( e ) {
			e.preventDefault();

			if ( ! window.wp || ! wp.media ) {
				window.console && console.error( 'frontpage-image: wp.media unavailable' );
				return;
			}

			if ( frame ) {
				frame.open();
				return;
			}

			frame = wp.media( {
				title: 'Select or Upload Image',
				button: { text: 'Use this image' },
				library: { type: 'image' },
				multiple: false
			} );

			frame.on( 'select', function () {
				var attachment = frame.state().get( 'selection' ).first().toJSON();
				setValue( attachment.url );
			} );

			frame.open();
		} );

		dropBtn.addEventListener( 'click', function ( e ) {
			e.preventDefault();
			setValue( '' );
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
