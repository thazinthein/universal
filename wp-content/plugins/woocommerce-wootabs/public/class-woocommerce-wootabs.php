<?php
/**
 * Plugin Name.
 *
 * @package   Woocommerce_Wootabs
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

class Woocommerce_Wootabs {	

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.1.4';

	/**
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'woocommerce-wootabs';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		if ( current_user_can( 'manage_options' ) || current_user_can( 'manage_woocommerce' ) ){

			add_action( 'save_post', array( $this, 'wootabs_on_product_save' ) );

			add_action( 'wp_ajax_wootabs_save_global_tabs', array( $this, 'wootabs_save_global_tabs' ) );
			add_action( 'wp_ajax_nopriv_wootabs_save_global_tabs', array( $this, 'wootabs_save_global_tabs' ) );
			
			add_action( 'wp_ajax_wootabs_save_product_tabs', array( $this, 'wootabs_save_product_tabs' ) );
			add_action( 'wp_ajax_nopriv_wootabs_save_product_tabs', array( $this, 'wootabs_save_product_tabs' ) );

			add_action( 'wp_ajax_wootabs_get_new_tab_asynch', 'wootabs_wp_editor::editor_html' );
			add_action( 'wp_ajax_nopriv_wootabs_get_new_tab_asynch', 'wootabs_wp_editor::editor_html' );

			add_filter( 'tiny_mce_before_init', 'wootabs_wp_editor::tiny_mce_before_init', 10, 2 );
			add_filter( 'quicktags_settings', 'wootabs_wp_editor::quicktags_settings', 10, 2 );
		}

		add_filter( 'woocommerce_product_tabs', array( $this, 'wootabs_product_front_tabs' ) );
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {

		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {

			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );
	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		

		if ( get_bloginfo( 'text_direction' ) == 'ltr' ) {
			
			wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
		}
		else{

			wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public-rtl.css', __FILE__ ), array(), self::VERSION );
		}
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
	}

	/**
	 * Register and enqueue admin-facing style sheet.
	 *
	 * @since    1.1.4
	 */
	public function admin_enqueue_styles() {
		
		if ( current_user_can( 'manage_options' ) || current_user_can( 'manage_woocommerce' ) ){

			if( strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php?post_type=product') ) {

				if ( get_bloginfo( 'text_direction' ) == 'ltr' ) {

					wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( $this->plugin_slug . '/admin/assets/css/admin.css' ), array(), Woocommerce_Wootabs::VERSION );
				}
				else{

					wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( $this->plugin_slug . '/admin/assets/css/admin-rtl.css' ), array(), Woocommerce_Wootabs::VERSION );
				
				}

			}
		}
	}

	/**
	 * Register and enqueues admin-facing JavaScript files.
	 *
	 * @since    1.1.4
	 */
	public function admin_enqueue_scripts() {
		
		if ( current_user_can( 'manage_options' ) || current_user_can( 'manage_woocommerce' ) ){

			if( strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php?post_type=product') ) {

				wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( $this->plugin_slug . '/admin/assets/js/admin.js' ), array( 'jquery' ), Woocommerce_Wootabs::VERSION );
				
				$admin_jsobject = array(
									'remove_tab_confirm_msg'	=>	__( 'Are you sure you want to remove this tab?', $this->plugin_slug ),
									'ajax_url' 	=> admin_url( 'admin-ajax.php' ),
									'texts'		=> array(
														'remove' => __( 'Remove', $this->plugin_slug ),
														'enabled' => __( 'Enabled', $this->plugin_slug ),
														'disabled' => __( 'Disabled', $this->plugin_slug ),
														'tab_title'	=> __( 'Tab title', $this->plugin_slug ),
														'global_tab_no'	=> __( 'Global tab no.', $this->plugin_slug ),
														'product_tab_no' => __( 'Tab no.', $this->plugin_slug ),
														'unsaved_tabs_msg' => __( 'You have un-saved tabs.', $this->plugin_slug )
													)
								);

				wp_localize_script( $this->plugin_slug . '-admin-script', 'wtAdminJsObj', $admin_jsobject );
				
				wp_enqueue_script( 'wootabs-jquery-ui', plugins_url( $this->plugin_slug . '/admin/assets/js/jquery-ui-1.10.4.custom.min.js' ), array( 'jquery' ), Woocommerce_Wootabs::VERSION );
			}
		}
	}

	/**
	 * Hook - Add WooTabs (tabs) in products pages
	 *
	 * @since    1.0.0
	 */
	public function wootabs_product_front_tabs( $tabs ){
		
		global $post;

		$post_categories_obj = wp_get_post_terms( $post->ID, 'product_cat' );
		
		$post_categories = array();

		foreach ( $post_categories_obj as $key => $value) {
			
			$post_categories[] = $value->term_id;
		}

		$counter = 0;

		$wootabs_use_global_tabs = get_option('wootabs-use-global-tabs') && get_option('wootabs-use-global-tabs') == "on" ? true : false;

		$wootabs_global_tabs = get_option('wootabs-global-tabs') ? unserialize( base64_decode( get_option('wootabs-global-tabs') ) ) : false;		

		$wootabs_global_tabs_pos = get_option('wootabs-global-tabs-position') && get_option('wootabs-global-tabs-position') == "begin" ? "begin" : "end";

		$product_additional_tabs = get_post_meta( $post->ID, 'wootabs-product-tabs' );

		if( $product_additional_tabs && isset( $product_additional_tabs[0]) ) {

			$product_additional_tabs = unserialize( base64_decode( $product_additional_tabs[0] ) );
		}

		$wootabs_before_default_tabs = get_option('wootabs-before_default_tabs') ? get_option('wootabs-before_default_tabs') : 'no';

		if( $wootabs_before_default_tabs == 'yes' ){

			$counter_pre = 0;
		}
		else{

			$counter_pre = 300;
		}		

		if( $wootabs_use_global_tabs && $wootabs_global_tabs && $wootabs_global_tabs_pos == "begin" ){

			foreach ( $wootabs_global_tabs as $key => $value) {			

				$pass_lang = true;

				if( has_filter( 'wootabs_check_global_tabs_lang' ) && isset( $value['lang'] ) && trim( $value['lang'] ) != 'all' ){

					$pass_lang = apply_filters('wootabs_check_global_tabs_lang', trim( $value['lang'] ), $pass_lang );
				}

				if( $pass_lang && intval( $value['enabled'] ) ){

					$display_tab = false;
					$selected_categories = explode( ',', $value['categories'] );

					if( in_array( 'all', $selected_categories) || ( count($selected_categories) == 1 && $selected_categories[0] == '' ) ){

						$display_tab = true;
					}
					else{

						foreach ( $selected_categories as $k => $v) {
							
							if( $display_tab == false ){

								if( in_array( intval( $v ), $post_categories ) ){

									$display_tab = true;
								}

							}

						}
					}

					if( $display_tab ){

						$tabs[ 'wootab_' + $counter ] = array(
							'title' 	=> $value['title'],
							'priority' 	=> $counter_pre + $counter,
							'callback' 	=> array( $this, 'woo_new_product_tab_content' ),
							'content'	=> $value['content'],
							'categories'=> $selected_categories
						);

						$counter++;

					}

				}
			}
		}
		
		if( $product_additional_tabs ){
			
			foreach ( $product_additional_tabs as $key => $value) {

				if( intval($value['enabled']) || ( count($selected_categories) == 1 && $selected_categories[0] == '' ) ){

					$selected_categories = explode( ',', $value['categories'] );

					$tabs[ 'wootab_' + $counter ] = array(
						'title' 	=> $value['title'],
						'priority' 	=> $counter_pre + $counter,
						'callback' 	=> array( $this, 'woo_new_product_tab_content' ),
						'content'	=> $value['content']
					);

					$counter++;

				}
			}
		
		}
		
		if( $wootabs_use_global_tabs && $wootabs_global_tabs && $wootabs_global_tabs_pos == "end" ){

			foreach ( $wootabs_global_tabs as $key => $value) {	

				$pass_lang = true;

				if( has_filter( 'wootabs_check_global_tabs_lang' ) && isset( $value['lang'] ) && trim( $value['lang'] ) != 'all' ){
					
					$pass_lang = apply_filters('wootabs_check_global_tabs_lang', trim( $value['lang'] ), $pass_lang );
				}

				if( $pass_lang && intval( $value['enabled'] ) ){

					$display_tab = false;
					$selected_categories = explode( ',', $value['categories'] );

					if( in_array( 'all', $selected_categories) ){

						$display_tab = true;
					}
					else{

						foreach ( $selected_categories as $k => $v) {
							
							if( $display_tab == false ){

								if( in_array( intval( $v ), $post_categories ) ){

									$display_tab = true;
								}

							}

						}
					}

					if( $display_tab ){

						$tabs[ 'wootab_' + $counter ] = array(
							'title' 	=> $value['title'],
							'priority' 	=> $counter_pre + $counter,
							'callback' 	=> array( $this, 'woo_new_product_tab_content' ),
							'content'	=> $value['content'],
							'categories'=> $selected_categories
						);

						$counter++;

					}

				}
			}
		}

		return $tabs;
	}

	/**
	 * Display front-end WooTabs content.
	 *
	 * @since     1.0.0
	 */
	public function woo_new_product_tab_content( $key, $tab ) {

		$content = apply_filters( 'the_content', $tab['content'] );
		
		$content = htmlentities( $content );

		$content = html_entity_decode( $content );

		print_r($content);
	}

	/**
	 * Save global tabs - Ajax call
	 *
	 * @since     1.0.0
	 */
	public function wootabs_save_global_tabs(){

		if( isset( $_POST['d'] ) ){

			$tabs_data = wp_unslash( $_POST['d'] );

			if( $tabs_data == "no_tabs" ){

				$saveTabs = "";
			}
			else{

				$saveTabs = base64_encode( serialize( $tabs_data ) );
			}

			update_option( 'wootabs-global-tabs', $saveTabs );
			
		}

		die();
	}

	/**
	 * Save single product tabs - Ajax call
	 *
	 * @since     1.0.0
	 */
	public function wootabs_save_product_tabs(){

		$ret = array();
		$ret['new_value'] = '';
		$ret['errors'] = 0;

		if( isset( $_POST['d'] ) && isset( $_POST['id'] ) ){

			$product_id = intval( $_POST['id'] );

			if( $product_id ){
				
				$tabs_data = wp_unslash( $_POST['d'] );

				if( $tabs_data == "no_tabs" ){

					$saveTabs = "";
				}
				else{

					$saveTabs = base64_encode( serialize( $tabs_data ) );
				}

				update_post_meta( $product_id, 'wootabs-product-tabs', $saveTabs );

				$ret['new_value'] = get_post_meta( $product_id, 'wootabs-product-tabs', true );
				
			}
		}

		die( json_encode($ret) );
	}

	/**
	 * Save product tabs on updating product post - Hook
	 *
	 * @since     1.0.0
	 */
	public function wootabs_on_product_save( $post_id ){
		
		if ( wp_is_post_revision( $post_id ) ){

			return;
		}

		$postType = get_post_type( $post_id );

		if( $postType == 'product' ){

			if( isset( $_POST['wootabs_product_tab_value'] ) ){

				update_post_meta( $post_id, 'wootabs-product-tabs', $_POST['wootabs_product_tab_value'] );
			}
			
		}
	}
}