<?php
/*
Plugin Name: WooTabs
Plugin URI: http://www.wootabs.com
Description: WooTabs, allows you to add extra tabs (as many as you want) to the WooCommerce Product Details page.
Author: WPCream.com
Version: 1.2.1
Author URI: http://wpcream.com
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

register_activation_hook( __FILE__, array( 'Woocommerce_Wootabs', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Woocommerce_Wootabs', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Woocommerce_Wootabs', 'get_instance' ) );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-woocommerce-wootabs.php' );
require_once( plugin_dir_path( __FILE__ ) . 'public/class-wootabs_wp_editor.php' );


/**
 * Action hook - Execute on plugin loaded
 *
 * @since    1.0.0
 */

function on_woocommerce_wootabs_loaded(){

	$canView_settings = false;

	if( is_user_logged_in() ){

		global $current_user, $wpdb;

		$allowed_settings_role = array( "administrator" );

		$wootabs_enable_shop_manager_settings = get_option('wootabs-enable-shop-manager-settings') && get_option('wootabs-enable-shop-manager-settings') == "on" ? true : false;

		if( $wootabs_enable_shop_manager_settings ){

			$allowed_settings_role[] = "shop_manager";
		}

		$user = get_userdata( $current_user->ID );

		$capabilities = $user->{$wpdb->prefix . 'capabilities'};

		if ( !isset( $wp_roles ) ){
		
			$wp_roles = new WP_Roles();
		}

		foreach ( $wp_roles->role_names as $role => $name ){

			if ( array_key_exists( $role, $capabilities ) ){

				if( !$canView_settings && in_array( $role, $allowed_settings_role ) ){

					$canView_settings = true;
				}

			}
	
		}
	
	}

	if( $canView_settings ){
		
		Woocommerce_Wootabs_Admin::get_instance();
	}
}

if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-woocommerce-wootabs-admin.php' );
	add_action( 'plugins_loaded', 'on_woocommerce_wootabs_loaded' );
}
