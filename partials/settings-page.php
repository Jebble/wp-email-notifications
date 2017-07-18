<div class="wrap">
	<h1><?php _e( 'Email Notifications Settings', 'jb_wpen' ); ?></h1>
	<form method="post" action="options.php">
	<?php
		settings_fields( 'jb_wpen-settings' );
		do_settings_sections( 'jb_wpen_settings_sections' );
		submit_button( 'Save settings' );
	?>
	</form>
</div>