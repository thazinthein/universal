
<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>
<div class="container">
		<div class="col-md-12 datapanel">
			<div class="col-md-9 leftpanel product-left">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>



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

<?php get_footer( 'shop' ); ?>