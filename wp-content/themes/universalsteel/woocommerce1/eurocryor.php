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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<!--<div class="container">
        <div class="col-md-12">
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


					<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>

			
				

				<?php endif; ?>

			
	</div>
</div>-->

 <div class="nav" id="tabs">
                    <?php
                    /*$args = array(

                        'number' => $number,
                        'orderby' => $orderby,
                        'order' => $order,
                        'hide_empty' => $hide_empty,
                        'include' => $ids
                    );*/
 					//woocommerce product category
                   
   /* $args = array(
     'parent' => $post->ID // id of the direct parent
);

$cats = get_terms( 'product_cat', $args );

foreach( $cats as $cat ) {
  echo $cat->name;
}*/

                    //$product_category = wp_get_post_terms( $post->ID, 'product_cat');
                    //global $post;
                    //$terms = get_the_terms( $post->ID, 'product_cat', 'hide_empty=0'  );
                    $args = array(
                            'hierarchical' => 1,
                           'show_option_none' => '',
                           'hide_empty' => 0,
                           'parent' => $product_cat_ID,
                           'taxonomy' => 'product_cat'
                        );
                    $subcats = get_categories($args);
                    //$subcats = get_the_terms( $post->ID, 'product_cat', 'hide_empty=0');

                    /*$product_category = wp_get_post_terms( $post->ID, 'product_cat');
                    global $post;
                    $terms = get_the_terms( $post->ID, 'product_cat', 'hide_empty=0'  );*/


                    //$wsubcats = get_categories($wsubargs);
                   // $product_categories = get_terms('product_cat', $args);
                    ?>
                    <ul>
                      
 
                        <?php
                            $i = 0;
                               foreach ($subcats as $subcat) {
                                    ?>
                                    <li>
         
         
                                        <a id="<?php echo $subcat->slug; ?>"
                                           class="product-<?php echo $subcat->slug; ?><?php if ($i == 0) {
                                               echo " active";
                                           } ?>"
                                           data-name="<?php echo $subcat->name; ?>"
                                           href="#"><?php echo $subcat->name; ?></a>
                                    </li>
                                    <?php
                                    $i++;
                                }
                        ?>
                    </ul>
                </div>

<div class="product_content" id="tabs_container">
                <?php
                $i = 0;
                foreach ($subcats as $cat) {
                    ?>
                    <div class="each_cat<?php if ($i == 0) {
                        echo " active";
                    } ?>" id="product-<?php echo $cat->slug; ?>">
                        <?php
                        echo do_shortcode('[product_category category="' . $cat->name . '" per_page="12" columns="4" orderby="date" order="desc"]');
                        ?></div>
                    <?php $i++;
                } ?>
 
                <?php //echo do_shortcode('[recent_products per_page="8" columns="4" orderby="date" order="desc"]'); ?>
            </div>


		<?php get_footer( 'shop' ); ?>

