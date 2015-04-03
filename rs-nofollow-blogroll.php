<?php
/*
Plugin Name: RS Nofollow Blogroll
Plugin URI: http://www.redsandmarketing.com/plugins/rs-nofollow-blogroll/
Description: A simple plugin that adds rel="nofollow" attribute to Blogroll Links on interior pages of your site. Helps SEO while still providing some link love to your favorite sites.
Author: Scott Allen
Version: 1.0.1
Author URI: http://www.redsandmarketing.com/
Text Domain: rs-nofollow-blogroll
License: GPLv2
*/

/*  Copyright 2014    Scott Allen  (email : plugins [at] redsandmarketing [dot] com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/* PLUGIN - BEGIN */

/***
* Note to any other PHP developers reading this:
* My use of the closing curly braces "}" is a little funky in that I indent them, I know. IMO it's easier to debug. Just know that it's on purpose even though it's not standard. One of my programming quirks, and just how I roll. :)
***/

// Make sure plugin remains secure if called directly
if ( !defined( 'ABSPATH' ) ) {
	if ( !headers_sent() ) { header('HTTP/1.1 403 Forbidden'); }
	die( 'ERROR: This plugin requires WordPress and will not function if called directly.' );
	}

define( 'RSNFB_VERSION', '1.0.1' );
define( 'RSNFB_REQUIRED_WP_VERSION', '3.8' );

if ( !defined( 'RSNFB_DEBUG' ) ) 				{ define( 'RSNFB_DEBUG', false ); } // Do not change value unless developer asks you to - for debugging only. Change in wp-config.php.
if ( !defined( 'RSNFB_PLUGIN_BASENAME' ) ) 		{ define( 'RSNFB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );	}
if ( !defined( 'RSNFB_PLUGIN_FILE_BASENAME' ) ) { define( 'RSNFB_PLUGIN_FILE_BASENAME', trim( basename( __FILE__ ), '/' ) ); }
if ( !defined( 'RSNFB_PLUGIN_NAME' ) ) 			{ define( 'RSNFB_PLUGIN_NAME', trim( dirname( RSNFB_PLUGIN_BASENAME ), '/' ) ); }

// Constants prefixed with 'RSMP_' are shared with other RSM Plugins for efficiency. Any of these values can be changed in wp-config.php:
if ( !defined( 'RSMP_SITE_URL' ) ) 				{ define( 'RSMP_SITE_URL', untrailingslashit( site_url() ) ); }
if ( !defined( 'RSMP_SITE_DOMAIN' ) ) 			{ define( 'RSMP_SITE_DOMAIN', rsnfb_get_domain( RSMP_SITE_URL ) ); }
if ( !defined( 'RSMP_SERVER_ADDR' ) ) 			{ define( 'RSMP_SERVER_ADDR', rsnfb_get_server_addr() ); }
if ( !defined( 'RSMP_SERVER_NAME' ) ) 			{ define( 'RSMP_SERVER_NAME', rsnfb_get_server_name() ); }
if ( !defined( 'RSMP_SERVER_NAME_REV' ) ) 		{ define( 'RSMP_SERVER_NAME_REV', strrev( RSMP_SERVER_NAME ) ); }
if ( !defined( 'RSMP_DEBUG_SERVER_NAME' ) ) 	{ define( 'RSMP_DEBUG_SERVER_NAME', '.redsandmarketing.com' ); }
if ( !defined( 'RSMP_DEBUG_SERVER_NAME_REV' ) )	{ define( 'RSMP_DEBUG_SERVER_NAME_REV', strrev( RSMP_DEBUG_SERVER_NAME ) ); }

if ( strpos( RSMP_SERVER_NAME_REV, RSMP_DEBUG_SERVER_NAME_REV ) !== 0 && RSMP_SERVER_ADDR != '127.0.0.1' && RSNFB_DEBUG != true  && WP_DEBUG != true ) {
	error_reporting(0); // Prevents error display on production sites, but testing on 127.0.0.1 will display errors, or if debug mode turned on
	}

function rs_nofollow_blogroll( $content ) {
	if ( !is_front_page() && !is_home() ) {
		foreach ( $content as $link ) { 
			$old_link_rel = $link->link_rel;
			$new_link_rel = trim('nofollow '.$old_link_rel);
			$link->link_rel = $new_link_rel;
			}
		}
	return $content;
	}
add_filter('get_bookmarks', 'rs_nofollow_blogroll');

// Standard Functions - BEGIN
function rsnfb_get_server_addr() {
	if ( !empty( $_SERVER['SERVER_ADDR'] ) ) { $server_addr = $_SERVER['SERVER_ADDR']; } else { $server_addr = getenv('SERVER_ADDR'); }
	return $server_addr;
	}
function rsnfb_get_server_name() {
	$wpss_site_domain 	= $server_name = RSMP_SITE_DOMAIN;
	$wpss_env_http_host	= getenv('HTTP_HOST');
	$wpss_env_srvr_name	= getenv('SERVER_NAME');
	if 		( !empty( $_SERVER['HTTP_HOST'] ) 	&& strpos( $wpss_site_domain, $_SERVER['HTTP_HOST'] ) 	!== FALSE ) { $server_name = $_SERVER['HTTP_HOST']; }
	elseif 	( !empty( $wpss_env_http_host ) 	&& strpos( $wpss_site_domain, $wpss_env_http_host ) 	!== FALSE ) { $server_name = $wpss_env_http_host; }
	elseif 	( !empty( $_SERVER['SERVER_NAME'] ) && strpos( $wpss_site_domain, $_SERVER['SERVER_NAME'] ) !== FALSE ) { $server_name = $_SERVER['SERVER_NAME']; }
	elseif 	( !empty( $wpss_env_srvr_name ) 	&& strpos( $wpss_site_domain, $wpss_env_srvr_name ) 	!== FALSE ) { $server_name = $wpss_env_srvr_name; }
	return rsnfb_casetrans( 'lower', $server_name );
	}
function rsnfb_casetrans( $type, $string ) {
	/***
	* Convert case using multibyte version if available, if not, use defaults
	***/
	switch ($type) {
		case 'upper':
			if ( function_exists( 'mb_strtoupper' ) ) { return mb_strtoupper($string, 'UTF-8'); } else { return strtoupper($string); }
		case 'lower':
			if ( function_exists( 'mb_strtolower' ) ) { return mb_strtolower($string, 'UTF-8'); } else { return strtolower($string); }
		case 'ucfirst':
			if ( function_exists( 'mb_strtoupper' ) && function_exists( 'mb_substr' ) ) { return mb_strtoupper(mb_substr($string, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($string, 1, NULL, 'UTF-8'); } else { return ucfirst($string); }
		case 'ucwords':
			if ( function_exists( 'mb_convert_case' ) ) { return mb_convert_case($string, MB_CASE_TITLE, 'UTF-8'); } else { return ucwords($string); }
			/***
			* Note differences in results between ucwords() and this. 
			* ucwords() will capitalize first characters without altering other characters, whereas this will lowercase everything, but capitalize the first character of each word.
			* This works better for our purposes, but be aware of differences.
			***/
		default:
			return $string;
		}
	}
function rsnfb_fix_url( $url, $rem_frag = FALSE, $rem_query = FALSE, $rev = FALSE ) {
	// Fix poorly formed URLs so as not to throw errors or cause problems
	// Too many forward slashes or colons after http
	$url = preg_replace( "~^(https?)\:+/+~i", "$1://", $url);
	// Too many dots
	$url = preg_replace( "~\.+~i", ".", $url);
	// Too many slashes after the domain
	$url = preg_replace( "~([a-z0-9]+)/+([a-z0-9]+)~i", "$1/$2", $url);
	// Remove fragments
	if ( !empty( $rem_frag ) && strpos( $url, '#' ) !== FALSE ) { $url_arr = explode( '#', $url ); $url = $url_arr[0]; }
	// Remove query string completely
	if ( !empty( $rem_query ) && strpos( $url, '?' ) !== FALSE ) { $url_arr = explode( '?', $url ); $url = $url_arr[0]; }
	// Reverse
	if ( !empty( $rev ) ) { $url = strrev($url); }
	return $url;
	}
function rsnfb_get_domain($url) {
	// Get domain from URL
	// Filter URLs with nothing after http
	if ( empty( $url ) || preg_match( "~^https?\:*/*$~i", $url ) ) { return ''; }
	// Fix poorly formed URLs so as not to throw errors when parsing
	$url = rsnfb_fix_url($url);
	// NOW start parsing
	$parsed = parse_url($url);
	// Filter URLs with no domain
	if ( empty( $parsed['host'] ) ) { return ''; }
	return rsnfb_casetrans('lower',$parsed['host']);
	}
// Standard Functions - END

// Admin Functions - BEGIN
register_activation_hook( __FILE__, 'rsnfb_install_on_first_activation' );
function rsnfb_install_on_first_activation() {
	$installed_ver = get_option('rs_nofollow_blogroll_version');
	if ( empty( $installed_ver ) || $installed_ver != RSNFB_VERSION ) {
		update_option('rs_nofollow_blogroll_version', RSNFB_VERSION);
		}
	}
add_action( 'admin_init', 'rsnfb_check_version' );
function rsnfb_check_version() {
	// Make sure user has minimum required WordPress version, in order to prevent issues
	global $wp_version;
	$rsnfb_wp_version = $wp_version;
	if ( version_compare( $rsnfb_wp_version, RSNFB_REQUIRED_WP_VERSION, '<' ) ) {
		deactivate_plugins( RSNFB_PLUGIN_BASENAME );
		$notice_text = sprintf( __( 'Plugin deactivated. WordPress Version %s required. Please upgrade WordPress to the latest version.', RSNFB_PLUGIN_NAME ), RSNFB_REQUIRED_WP_VERSION );
		$new_admin_notice = array( 'style' => 'error', 'notice' => $notice_text );
		update_option( 'rsnfb_admin_notices', $new_admin_notice );
		add_action( 'admin_notices', 'rsnfb_admin_notices' );
		return false;
		}
	add_action( 'admin_notices', 'rsnfb_admin_notices' );
	}
function rsnfb_admin_notices() {
	$admin_notices = get_option('rsnfb_admin_notices');
	if ( !empty( $admin_notices ) ) {
		$style 	= $admin_notices['style']; // 'error'  or 'updated'
		$notice	= $admin_notices['notice'];
		echo '<div class="'.$style.'"><p>'.$notice.'</p></div>';
		}
	delete_option('rsnfb_admin_notices');
	}
// Admin Functions - END

/* PLUGIN - END */
