<?php
/*
Plugin Name: BEA Count Post Characters (Fork)
Description: Counts characters in real time while you are writing your content. Works for any kind of "post type" out of the box.
Author: o----o, Florian TIAR
Version: 1.1
Author URI: http://beapi.fr
*/

add_action('plugins_loaded', 'CHAR_COUNT_INIT');
function CHAR_COUNT_INIT() {
	load_plugin_textdomain( 'CHAR_COUNT', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

// Update the char count : Use word count function of WP Core
add_action( 'admin_print_footer_scripts', 'check_textarea_length' );
function check_textarea_length() {
	?>
	<script type="text/javascript">
		( function( $, counter ) {
			$("#wp-word-count").after("<td id=\"wp-char-count\"><?php _e ('Sum of characters:', 'CHAR_COUNT'); ?> <span id=\"char-count\">0</span></td>");
			$( function() {
				var $content = $( '#content' ),
					$count = $('#wp-char-count').find( '#char-count' ),
					prevCount = 0,
					contentEditor;

				function update() {
					var text, count;

					if ( ! contentEditor || contentEditor.isHidden() ) {
						text = $content.val();
					} else {
						text = contentEditor.getContent( { format: 'raw' } );
					}

					count = counter.count( text, 'characters_including_spaces' );

					if ( count !== prevCount ) {
						$count.text( count );
					}

					prevCount = count;
				}

				$( document ).on( 'tinymce-editor-init', function( event, editor ) {
					if ( editor.id !== 'content' ) {
						return;
					}

					contentEditor = editor;

					editor.on( 'nodechange keyup', _.debounce( update, 1000 ) );
				} );

				$content.on( 'input keyup', _.debounce( update, 1000 ) );

				update();
			} );
		} )( jQuery, new wp.utils.WordCounter() );

	</script>
	<?php
}
