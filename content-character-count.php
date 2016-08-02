<?php
/*
Plugin Name: Count Post Characters (Fork)
Plugin URI: http://beapi.fr
Description: Counts characters in real time while you are writing your content. Works for any kind of "post type" out of the box.
Author: o----o, Florian TIAR
Version: 1.0
Author URI: http://tiar-florian.fr
*/

function CHAR_COUNT_INIT() {
	load_plugin_textdomain( 'CHAR_COUNT', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('plugins_loaded', 'CHAR_COUNT_INIT');

add_action( 'admin_print_footer_scripts', 'check_textarea_length' );

function check_textarea_length() {
	?>
	<script type="text/javascript">
		// inject the html
		jQuery("#post-status-info").after("<div style='border: 1px solid #e5e5e5; border-top:0; display: block; background-color: #F7F7F7; padding: 0.3em 0.7em;'><?php _e ('Sum of characters:', 'CHAR_COUNT'); ?> <span id=\"ilc_excerpt_counter\"></span>, <?php _e ('Number of selected characters', 'CHAR_COUNT'); ?>: <span id=\"ilc_live_counter\">()</span></div>");
		// count on load
		window.onload = function () {
			setInterval(function() {
				cont = tinymce.get('content').getContent().replace(/(\s+)/ig,' ');
				jQuery("#ilc_excerpt_counter").text(cont.length);
			}, 300);
		}
	</script>
	<?php
}

// add function to the tinymce on init
add_filter( 'tiny_mce_before_init', 'my_tinymce_setup_function' );
function my_tinymce_setup_function( $initArray ) {
	$initArray['setup'] = 'function(ed) {
	    ed.on("keyup", function(e) {
	        editor_content = ed.getContent().replace(/(\s+)/ig, " ");
	        jQuery("#ilc_excerpt_counter").text(editor_content.length);
	    });
	}';
	return $initArray;
}

// add function to the tinymce on init
add_filter( 'tiny_mce_before_init', 'live_selection_char_count' );
function live_selection_char_count( $initArray ) {
	$initArray['setup'] = 'function(ed, index) {
	    ed.on("click", function(e) {
	        // get the selection, and strip html
			 var selection = ed.selection.getContent().replace(/(\s+)/ig, " ");
			// count the characters and write them in input field
	       jQuery("#ilc_live_counter").text( "("+selection.length+")");
	    });
	}';
	return $initArray;
}