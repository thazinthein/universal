<?php
/**
 * Woocommerce WooTabs Admin.
 *
 * @package   Woocommerce_Wootabs_Admin
 * @author    Makis Mourelatos <info@wpcream.com>
 * @license   GPL-2.0+
 * @link      http://wpcream.com
 * @copyright 2014 WPCream.com
 */

class Woocommerce_Wootabs_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Set plugin actions message
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	public $plugin_has_msg = null;

	/**
	 * Set plugin actions error flag
	 *
	 * @since    1.0.0
	 *
	 * @var      boolean
	 */
	public $plugin_error_flag = false;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/*
		 * Call $plugin_slug from public plugin class.
		 */
		$plugin = Woocommerce_Wootabs::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		add_action( 'add_meta_boxes', array( $this, 'wootabs_products_meta_boxes' ), 10 );
		add_action( 'wp_loaded', array( $this, 'execute_before_wp_header' ) );
	}

	/**
	 * Retrieve messages info
	 *
	 * @since    1.0.0
	 *
	 */

	public function get_plugin_msg() {

		$msg = $this->plugin_has_msg;
		$error = $this->plugin_error_flag;

		$ret = array();
		$ret["message"] = $msg;
		$ret["error"] = $error;

		return $ret;
	}

	/**
	 * Set messages info
	 *
	 * @since    1.0.0
	 *
	 */

	public function set_plugin_msg( $d, $er ) {

		$this->plugin_has_msg = $d;
		$this->plugin_error_flag = $er;
	}

	/**
	 * Init products meta boxes
	 *
	 * @since    1.0.0
	 *
	 */

	public function wootabs_products_meta_boxes(){

		add_meta_box( 'wootabs_single_product_tabs', __( 'WooTabs', $this->plugin_slug ) , array( $this, 'wootabs_single_product_tabs_callback'), 'product' );
	}

	/**
	 * Return products WooTabs meta box html content
	 *
	 * @since     1.0.0
	 *
	 * @return    html
	 */

	public function wootabs_single_product_tabs_callback(){
			
		global $post;

		$plugin_slug = $this->plugin_slug;

		?>

		<div class="tabs-creation-form single_product">

			<input type="hidden" name="wootabs_are_global" id="wootabs_are_global" value="0">
			<input type="hidden" name="wootabs_product_id" id="wootabs_product_id" value="<?php echo $post->ID; ?>">

			<?php

			$wootabs_product_tabs_pre = get_post_meta( $post->ID, 'wootabs-product-tabs', true ) ;

			?>

			<input type="hidden" name="wootabs_product_tab_value" id="wootabs_product_tab_value" value="<?php echo esc_attr( $wootabs_product_tabs_pre ); ?>">

			<?php
			
			$wootabs_product_tabs = false;

			if( !$wootabs_product_tabs ){

				$wootabs_product_tabs = unserialize( base64_decode( $wootabs_product_tabs_pre ) );
			}

			if( !$wootabs_product_tabs ){
				?>

				<div id="wtabs-temp-editor">
					<?php wp_editor( "", "wttemp", array( 'editor_class' => 'wtab-textarea_pre' ) ); ?>
				</div>

				<?php
			}

			?>

			<ul id="wt-tab-wrapper">
				<?php

				if( $wootabs_product_tabs ){

					for( $i = 0; $i < count( $wootabs_product_tabs ); $i++ ){
						
						$title = esc_html( $wootabs_product_tabs[$i]['title'] );

						$tab_title = $title ? $title : "<i>" . __( "Tab no.", $plugin_slug ) . ( $i + 1 ) . "</i>";

						$enabled_tabs = intval( $wootabs_product_tabs[$i]['enabled'] ) == 0 ? 0 : 1;

						$content = $wootabs_product_tabs[$i]['content'] ;
						
						?>
						
						<li class="wt-tab">
							
							<h4 class="wt-tabs-title"><?php echo $tab_title; ?><div class="wootabs-handlediv"><br></div></h4>
							
							<input type="button" class="button remove-tab-button" value="<?php _e('Remove', $plugin_slug) ?>" />

							<select class="enabled-global-tab" name="enabled-global-tab_<?php echo $i; ?>">
								<option value="1" <?php echo $enabled_tabs ? 'selected="selected"' : ''; ?>><?php _e( "Enabled", $plugin_slug ); ?></option>
								<option value="0" <?php echo !$enabled_tabs ? 'selected="selected"' : ''; ?>><?php _e( "Disabled", $plugin_slug ); ?></option>
							</select>

							<div class="wt-tab-content">

								<label for="inpt_<?php echo $i; ?>" class="wtab-label"><?php _e('Tab title', $plugin_slug) ?></label>
								<input type="text" name="inpt_<?php echo $i; ?>" id="inpt_<?php echo $i; ?>" value="<?php echo $title; ?>" class="wtab-inputt">

								<?php wp_editor( $content, "tarea_" . $i, $settings = array( 'editor_class' => 'wtab-textarea' ) ); ?>
							</div>

						</li>
						
						<?php
					}

				}
				
				?>
			</ul>
			
			<div class="submit wootabs-add-tab">
				
				<input type="button" class="button-primary add-tab-button" value="<?php _e('Add Tab', $plugin_slug) ?>" />
				<img src="<?php echo admin_url() . 'images/spinner.gif' ;?>" alt="<?php _e( 'loading', $plugin_slug ); ?>" class="loading-add-tab" />

				<input type="button" class="button save-tab-button <?php if( !$wootabs_product_tabs ){ echo 'hidden'; } ?>" value="<?php _e('Save Tabs', $plugin_slug) ?>" />
				<img src="<?php echo admin_url() . 'images/spinner.gif' ;?>" alt="<?php _e( 'loading', $plugin_slug ); ?>" class="loading-save-tabs" />
				
				<div class="wootabs-clearfix"></div>

			</div>

			<div class="wootabs-clearfix"></div>
		</div>

		<?php
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
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {

			if ( get_bloginfo( 'text_direction' ) == 'ltr' ) {

				wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( $this->plugin_slug . '/admin/assets/css/admin.css' ), array(), Woocommerce_Wootabs::VERSION );
			}
			else{

				wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( $this->plugin_slug . '/admin/assets/css/admin-rtl.css' ), array(), Woocommerce_Wootabs::VERSION );
			}
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();		

		if ( $this->plugin_screen_hook_suffix == $screen->id ) {

			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Woocommerce_Wootabs::VERSION );
			
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
			
			wp_enqueue_script( 'wootabs-jquery-ui', plugins_url( 'assets/js/jquery-ui-1.10.4.custom.min.js', __FILE__ ), array( 'jquery' ), Woocommerce_Wootabs::VERSION );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		if (!current_user_can( 'manage_options' )){
			
			$editor = get_role('shop_manager');
			$editor->remove_cap('manage_options');

			$admin_capability = "manage_woocommerce";
		}
		else{

			$admin_capability = "manage_options";
		}

		$this->plugin_screen_hook_suffix = add_menu_page(
											__( 'WooTabs Settings', $this->plugin_slug ), 
											__( 'WooTabs', $this->plugin_slug ), 
											$admin_capability,
											$this->plugin_slug, 
											array( $this, 'display_plugin_admin_page' ),
											'', 
											39
										);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);
	}

	/**
	 * Hook - Execute before wp_header()
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	public function execute_before_wp_header(){
		
		if( isset( $_POST['action'] ) ){

			switch( $_POST['action'] ){
				case "update_wootabs_settings":

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

						$canView_settings = false;

						foreach ( $wp_roles->role_names as $role => $name ){

							if ( array_key_exists( $role, $capabilities ) ){

								if( !$canView_settings && in_array( $role, $allowed_settings_role ) ){

									$canView_settings = true;
								}

							}
						}

						if( $canView_settings ){

							if( current_user_can( "manage_options" ) ){	// Not allow shop manager to save specific setting
								
								if( isset( $_POST['wootabs-enable-shop-manager-settings'] )  ){

									$shop_manager_settings = wp_unslash( $_POST['wootabs-enable-shop-manager-settings'] ) == "on" ? "on" : "";
								}
								else{

									$shop_manager_settings = "";						
								}

								$a = update_option( 'wootabs-enable-shop-manager-settings', $shop_manager_settings );
								
								if( isset( $_POST['wootabs-remove-data-on-uninstall'] )  ){

									$remove_onUninstall = wp_unslash( $_POST['wootabs-remove-data-on-uninstall'] ) == "on" ? "on" : "";
								}
								else{

									$remove_onUninstall = "";						
								}
							}

							$b = update_option( 'wootabs-remove-data-on-uninstall', $remove_onUninstall );

							if( isset( $_POST['wootabs-use-global-tabs'] )  ){

								$use_globalTabs = wp_unslash( $_POST['wootabs-use-global-tabs'] ) == "on" ? "on" : "";
							}
							else{

								$use_globalTabs = "";						
							}

							$c = update_option( 'wootabs-use-global-tabs', $use_globalTabs );

							if( isset( $_POST['wootabs-global-tabs-position'] )  ){

								$globalTabs_pos = wp_unslash( $_POST['wootabs-global-tabs-position'] ) == "begin" ? "begin" : "end";
							}
							else{

								$globalTabs_pos = "";						
							}

							$d = update_option( 'wootabs-global-tabs-position', $globalTabs_pos );

							if( isset( $_POST['wootabs-before_default_tabs'] )  ){

								$wootbas_before_default = wp_unslash( $_POST['wootabs-before_default_tabs'] ) == "yes" ? "yes" : "no";
							}
							else{

								$wootbas_before_default = "no";
							}

							$e = update_option( 'wootabs-before_default_tabs', $wootbas_before_default );

							$success_message = __( "Settings saved successful.", $this->plugin_slug );
							$this->set_plugin_msg( $success_message, 0 );
						}

					}
				break;
			}
		}

	}

}