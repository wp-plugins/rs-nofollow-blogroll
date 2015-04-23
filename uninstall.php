<?php
/*
RS Nofollow Blogroll - uninstall.php
Version: 1.0.1

This script uninstalls RS FeedBurner and removes all options and traces of its existence.
*/

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit(); }

function rsnfb_uninstall_plugin() {
	// Options to Delete
	$rsnfb_option_names = array( 'rs_nofollow_blogroll_version', 'rs_nofollow_blogroll_settings', 'rsnfb_admin_notices' );
	foreach( $rsnfb_option_names as $i => $rsnfb_option ) {
		delete_option( $rsnfb_option );
		}
	}

rsnfb_uninstall_plugin();

?>