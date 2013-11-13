<?php
/*
Plugin Name: Keyboard Saves
Plugin URI: http://dev.leapxl.com/wordpress
Description: Allows to save with CTRL-S in WordPress
Author: Perceval FARAMAZ
Version: 1.1
Author URI: http://me.leapxl.com
*/
?>
<?php
if( is_admin() ) {
	// array of admin pages and buttons to "click" with Ctrl+S in those pages
	$button_to_click = array(
		'post.php' => 'publish',
		'post-new.php' => 'save-post',
		'theme-editor.php' => 'submit',
		'plugin-editor.php' => 'submit'
	);
	
	foreach($button_to_click as $page => $button_id) {
		add_action( 'admin_footer-'.$page, 'lpx_add_script' );
	}
}

function lpx_add_script() {
	global $pagenow, $button_to_click;
	?>
	<script>
		var button_id = "<?php echo $button_to_click[$pagenow]; ?>";
		
		jQuery('#'+button_id).attr('title', 'Ctrl+S or Cmd+S to save');
		
		jQuery(document).keydown( function(e) {
			if( (e.keyCode || e.which) == 83 && (e.ctrlKey || e.metaKey) ) {
				jQuery('#'+button_id).click();
				return false;
			}
		});
	</script>
<?php
}
?>
