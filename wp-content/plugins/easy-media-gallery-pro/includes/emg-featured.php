<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function emg_featured_init() {
    $emg_featured_init = add_submenu_page('edit.php?post_type=easymediagallery', 'Premium Plugins', __('Premium Plugins', 'easmedia'), 'edit_posts', 'emg_featured_plugins', 'emg_featured_page');
}

function emg_featured_page() {
	ob_start(); ?>
	<div class="wrap" id="ghozy-featured">
		<h2>
			<?php _e( 'GhozyLab Featured Plugins', 'easmedia' ); ?>
		</h2>
		<p><?php _e( 'These plugins available on Lite and Pro version.', 'easmedia' ); ?></p>
		<?php echo emg_get_feed(); ?>
	</div>
	<?php
	echo ob_get_clean();
}


function emg_get_feed() {
	if ( false === ( $cache = get_transient( 'easymediapro_featured_feed' ) ) ) {
		$feed = wp_remote_get( 'http://content.ghozylab.com/feed.php?c=featuredplugins', array( 'sslverify' => false ) );
		if ( ! is_wp_error( $feed ) ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( 'easymediapro_featured_feed', $cache, 3600 );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the list from the server. Please try again later.', 'easmedia' ) . '</div>';
		}
	}
	return $cache;
}