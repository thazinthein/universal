<?php
/**
 * @package   Woocommerce_Wootabs
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

if( get_option('wootabs-remove-data-on-uninstall') && get_option('wootabs-remove-data-on-uninstall') == "on" ){
	
	global $wpdb;

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	$wpdb->query("DELETE FROM " . $wpdb->postmeta . " WHERE meta_key LIKE 'wootabs-%'");

	delete_option("wootabs-remove-data-on-uninstall");
	delete_option("wootabs-enable-shop-manager-settings");
	delete_option("wootabs-use-global-tabs");
	delete_option("wootabs-global-tabs");
	delete_option("wootabs-before_default_tabs");
	delete_option("wootabs-global-tabs-position");
}