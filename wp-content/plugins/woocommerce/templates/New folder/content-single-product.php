<div class="container">
		<div class="col-md-12 datapanel">
			<div class="col-md-9 leftpanel single-left">
				
				<?php
				/**
				 * The template for displaying product content in the single-product.php template
				 *
				 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
				 *
				 * @author 		WooThemes
				 * @package 	WooCommerce/Templates
				 * @version     1.6.4
				 */

				if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
				?>

				<?php
					/**
					 * woocommerce_before_single_product hook
					 *
					 * @hooked wc_print_notices - 10
					 */
					 do_action( 'woocommerce_before_single_product' );

					 if ( post_password_required() ) {
					 	echo get_the_password_form();
					 	return;
					 }
				?>

				<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="related-panel">
					<?php
						/**
						 * woocommerce_before_single_product_summary hook
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );
					?>

					<div class="summary entry-summary">

						<?php
							/**
							 * woocommerce_single_product_summary hook
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 */
							do_action( 'woocommerce_single_product_summary' );
						?>

					</div><!-- .summary -->
				</div>
					<?php
						/**
						 * woocommerce_after_single_product_summary hook
						 *
						 * @hooked woocommerce_output_product_data_tabs - 10
						 * @hooked woocommerce_output_related_products - 20
						 */
						do_action( 'woocommerce_after_single_product_summary' );
					?>

					<meta itemprop="url" content="<?php the_permalink(); ?>" />

				</div><!-- #product-<?php the_ID(); ?> -->

				<?php do_action( 'woocommerce_after_single_product' ); ?>
		</div>
			<div class="col-md-3 right curved-vt-1">
				<div class="rightpanel">
					<h3 class="services-right-header">Our Services</h3>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Flash Stream Recovery Systems</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Boiler Rental up to 8 tons (250 psi)</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Piping Works</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Hydrostatic Pressure Testing</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Boiler Repair</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Boiler Chimnery & Re-Tubing</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Boiler Cleaning & Servicing</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Fabrication & Installation Works</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Solar Panels</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Turnkey Projects</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">PE Calculation & Endorsement</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Steam Engineering Consultancy</a></span>
					<span class="btnar btn-4 btn-4b icon-arrow-right"><a href="#">Heat Pumps</a></span>
					<hr style="margin-left:-10px;padding-left:-20px;">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('homepage-random') ) : endif; ?>
				</div>
			</div>
	</div>
</div>