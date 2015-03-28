<?php
/**
 * @package   Woocommerce_Wootabs
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

$plugin_slug = 'woocommerce-wootabs';
$current_tabURL_slug = "?page=" . $plugin_slug;

$wootabs_remove_data_on_uninstall = get_option('wootabs-remove-data-on-uninstall') && get_option('wootabs-remove-data-on-uninstall') == "on" ? 'checked="checked"' : "";
$wootabs_enable_shop_manager_settings = get_option('wootabs-enable-shop-manager-settings') && get_option('wootabs-enable-shop-manager-settings') == "on" ? 'checked="checked"' : "";
$wootabs_use_global_tabs = get_option('wootabs-use-global-tabs') && get_option('wootabs-use-global-tabs') == "on" ? 'checked="checked"' : "";

$wootabs_global_tabs = get_option('wootabs-global-tabs') ? unserialize( base64_decode( get_option('wootabs-global-tabs') ) ) : false;

$wootabs_before_global = get_option('wootabs-before_default_tabs') ? get_option('wootabs-before_default_tabs') : 'no';

$wootabs_global_tabs_pos = get_option('wootabs-global-tabs-position') && get_option('wootabs-global-tabs-position') == "begin" ? "begin" : "end";

$ins = Woocommerce_Wootabs_Admin::get_instance();

$message = $ins->get_plugin_msg();
$errorMessage = $message['error'];
$message = $message['message'];

$updated_html = "";

if( $message ){

	$updated_classes = array('updated');

	if($errorMessage){

		$updated_classes[] = 'error';
	}

	$updated_html .= "<div class='" . implode( " ", $updated_classes ) . "'>";
	$updated_html .= $message;
	$updated_html .= "</div>";
}

$pcats_args = array(
	'hierarchical'	=> true,
	'hide_empty'	=> false,
	'pad_counts'	=> true
);

$product_categories = get_terms( 'product_cat', $pcats_args );

?>

<div id="wootabs-top" class="wootabs-settings-wrapper">

	<h1 class="wootabs-settings-title"><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<?php 
	
	if( $updated_html ){
		echo $updated_html; 
	}
	else{
		echo '<hr>';
	}
	
	?>
	
	<form method="post" action="<?php echo $current_tabURL_slug; ?>" class="wootabs-settings-form">

		<?php

		wp_nonce_field('wootabs-update-settings');

		if( current_user_can( "manage_options" ) ){

			?>

			<div class="wootabs-asw">
				<label for="wootabs-enable-shop-manager-settings"><?php _e( 'Enable Access to Shop Manager', $plugin_slug ); ?></label>&nbsp;
				<input type="checkbox" id="wootabs-enable-shop-manager-settings" name="wootabs-enable-shop-manager-settings" <?php echo $wootabs_enable_shop_manager_settings; ?> />
			</div>

			<hr>

			<div class="wootabs-asw">
				<label for="wootabs-remove-data-on-uninstall"><?php _e( "Remove WooTabs Data on Plugin Uninstall", $plugin_slug ); ?></label>&nbsp;
				<input type="checkbox" id="wootabs-remove-data-on-uninstall" name="wootabs-remove-data-on-uninstall" <?php echo $wootabs_remove_data_on_uninstall; ?> />
			</div>

			<hr>

		<?php
		}

		?>
		<div class="wootabs-asw">
			<label for="wootabs-use-global-tabs"><?php _e( "Use Global Tabs", $plugin_slug ); ?></label>&nbsp;
			<input type="checkbox" id="wootabs-use-global-tabs" name="wootabs-use-global-tabs" <?php echo $wootabs_use_global_tabs; ?> />
		</div>

		<hr class="wt-gpos">

		<div class="wootabs-asw wt-gpos">
			<label for="wootabs-before_default_tabs"><strong><?php _e( "WooTabs Position Display", $plugin_slug ); ?></strong></label>&nbsp;
				
			<select name="wootabs-before_default_tabs" id="wootabs-before_default_tabs">
				<option value="yes" <?php echo $wootabs_before_global == "yes" ? 'selected="selected"' : "" ?>><?php _e( "Before Default WooCommerce Tabs", $plugin_slug ); ?></option>
				<option value="no" <?php echo $wootabs_before_global == "no" ? 'selected="selected"' : "" ?>><?php _e( "After Default WooCommerce Tabs", $plugin_slug ); ?></option>
			</select>
		</div>

		<hr class="wt-gpos">

		<div class="wootabs-asw wt-gpos">
			<label for="wootabs-global-tabs-position"><strong><?php _e( "Global WooTabs Position Display", $plugin_slug ); ?></strong></label>&nbsp;
				
			<select name="wootabs-global-tabs-position" id="wootabs-global-tabs-position">
				<option value="begin" <?php echo $wootabs_global_tabs_pos == "begin" ? 'selected="selected"' : "" ?>><?php _e( "Before Product WooTabs", $plugin_slug ); ?></option>
				<option value="end" <?php echo $wootabs_global_tabs_pos == "end" ? 'selected="selected"' : "" ?>><?php _e( "After Product WooTabs", $plugin_slug ); ?></option>
			</select>
		</div>

		<input type="hidden" name="action" value="update_wootabs_settings" />
	</form>

	<div class="wootabs-asw gtabs <?php if( $wootabs_use_global_tabs == "" ){ echo 'hidden'; } ?>">

		<hr>

		<div class="wootabs-global-tabs handle-tabs open gbl">

			<form class="tabs-creation-form">

				<input type="hidden" name="wootabs_are_global" id="wootabs_are_global" value="1">

				<?php

				if( !$wootabs_global_tabs ){
					?>

					<div id="wtabs-temp-editor">
						<?php wp_editor( "", "wttemp", array( 'editor_class' => 'wtab-textarea_pre' ) ); ?>
					</div>
					
					<?php
				}

				?>

				<ul id="wt-tab-wrapper">
					<?php

					if( $wootabs_global_tabs ){

						for( $i = 0; $i < count( $wootabs_global_tabs ); $i++ ){
							
							$title = esc_html( $wootabs_global_tabs[$i]['title'] );

							$tab_title = $title ? $title : "<i>" . __( "Global tab no.", $plugin_slug ) . ( $i + 1 ) . "</i>";

							$enabled_tabs = intval( $wootabs_global_tabs[$i]['enabled'] ) == 0 ? 0 : 1;

							$content = $wootabs_global_tabs[$i]['content'] ;							

							$selected_tab_categories = explode(',',$wootabs_global_tabs[$i]['categories'] );

							if( isset( $wootabs_global_tabs[$i]['lang'] ) && trim( $wootabs_global_tabs[$i]['lang'] ) != '' ){

								$selected_lang = trim( $wootabs_global_tabs[$i]['lang'] );
							}
							else{

								$selected_lang = false;
							}

							if( !$selected_tab_categories || !is_array( $selected_tab_categories ) || empty( $selected_tab_categories ) || ( count($selected_tab_categories) == 1 && $selected_tab_categories[0] == '' ) ){
							
								$selected_tab_categories = array( 'all' );
							}

							?>
							
							<li class="wt-tab">
								
								<h4 class="wt-tabs-title"><?php echo $tab_title; ?><div class="wootabs-handlediv"><br></div></h4>
								
								<input type="button" class="button remove-tab-button" value="<?php _e('Remove', $plugin_slug) ?>" />

								<?php

								if( has_action( 'global_wootabs_lang_selections' ) ){

									do_action( "global_wootabs_lang_selections", $i, $selected_lang ); 

								}

								?> 

								<select class="enabled-global-tab" name="enabled-global-tab_<?php echo $i; ?>">
									<option value="1" <?php echo $enabled_tabs ? 'selected="selected"' : ''; ?>><?php _e( "Enabled", $plugin_slug ); ?></option>
									<option value="0" <?php echo !$enabled_tabs ? 'selected="selected"' : ''; ?>><?php _e( "Disabled", $plugin_slug ); ?></option>
								</select>

								<div class="wt-tab-content">

									<label for="inpt_<?php echo $i; ?>" class="wtab-label"><?php _e('Tab title', $plugin_slug) ?></label>
									<input type="text" name="inpt_<?php echo $i; ?>" id="inpt_<?php echo $i; ?>" value="<?php echo $title; ?>" class="wtab-inputt">

									<?php 

									if( $product_categories ){

										$pccnt = count( $product_categories );

										foreach ( $product_categories as $key => $value ){

											if( $key === 0 ){ ?>

											<label class="wtab-label"><?php _e( 'Select products categories where tab will appear', $plugin_slug ); ?></label>
											
											<div class="gtcs-wrapper">

												<label class="gwt-lbl"><input type="checkbox" name="wootabs_products_categories_<?php echo $i;?>[]" class="gt_all_cats wootabs_products_categories" value="all" <?php if( in_array( 'all', $selected_tab_categories ) ){ echo ' checked = "checked" ' ; } ?> /><?php _e( "All categories", $plugin_slug ) ?></label>

												<div class="sep-g-wootabs-cats">

													<?php
											}

														?>

														<p class="gwt-p"><label class="gwt-lbl"><input type="checkbox" name="wootabs_products_categories_<?php echo $i;?>[]" class="wootabs_products_categories" value="<?php echo $value->term_id; ?>" <?php if( in_array( $value->term_id, $selected_tab_categories ) && !in_array( 'all', $selected_tab_categories ) ){ echo ' checked = "checked" ' ; } ?>/><?php echo $value->name; ?></label></p>
														
														<?php

														if( $key + 1 == $pccnt ){ ?>

														<br/>

														<hr/>

												</div><!--/ .sep-g-wootabs-cats -->
												
											</div><!--/ .gtcs-wrapper -->
													<?php

													}
										}
									}

									wp_editor( $content, "tarea_" . $i, $settings = array( 'editor_class' => 'wtab-textarea' ) ); 
									
									?>
								</div>

							</li>
							
							<?php
						}

					}
					
					?>
				</ul>
				
				<?php

				if( has_action( 'global_wootabs_default_lang_selections' ) ){

					do_action("global_wootabs_default_lang_selections", '%__123__%' );

				}
				?>

				<div class="submit wootabs-add-tab">

					<input type="button" class="button-primary add-tab-button" value="<?php _e('Add Tab', $plugin_slug) ?>" />
					<img src="<?php echo admin_url() . 'images/spinner.gif' ;?>" alt="<?php _e( 'loading', $plugin_slug ); ?>" class="loading-add-tab" />

					<input type="button" class="button save-tab-button <?php if( !$wootabs_global_tabs ){ echo 'hidden'; } ?>" value="<?php _e('Save Tabs', $plugin_slug) ?>" />
					<img src="<?php echo admin_url() . 'images/spinner.gif' ;?>" alt="<?php _e( 'loading', $plugin_slug ); ?>" class="loading-save-tabs" />

					<div class="wootabs-clearfix"></div>

				</div>

			</form>

		</div>

	</div>

	<hr>

	<p class="submit">
		<input type="button" class="wootabs-settings-save button-primary" value="<?php _e('Save Settings', $plugin_slug) ?>" />
	</p>

</div>