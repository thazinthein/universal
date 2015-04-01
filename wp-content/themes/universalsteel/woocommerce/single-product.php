<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly


}

get_header( 'shop' ); ?>
<div class="pagehead">
	<div class="container">
		
		<div class="row">
	        <div class="col-md-12 pagehead-title-bg">
				<img src="<?php bloginfo('template_directory');?>/images/pagehead_title_bg-right.png" class="img-responsive">
				<div class="pagehead-title">
					
						<h2><?php woocommerce_page_title(); ?></h2>
						<?php do_action( 'woocommerce_archive_description' ); ?>
				</div>
			</div>
			
		</div>
		
		<div class="row breadcurmb">
			<div class="" id="breadcrumb">
					<?php woocommerce_breadcrumb(); ?>
				</div>
		</div>

	</div>
</div>
<div class="container">
	<div class="row">

		<div class="col-md-10">			
			<?php
			//$cats = get_terms( 'product_cat');
			/*$args = array(
                            'hierarchical' => 1,
                           'show_option_none' => '',
                           'hide_empty' => 0,
                           'parent' => $product_cat_ID,
                           'taxonomy' => 'product_cat'
                        );
            $subcats = get_categories($args);*/
           
            /*$product_category = wp_get_post_terms( $post->ID, 'product_cat');
            global $post;*/
            //$terms = get_the_terms( $post->ID, 'product_cat', 'hide_empty=0');
			//echo $terms;
			/*$args = array(
                            'hierarchical' => 1,
                           'show_option_none' => '',
                           'hide_empty' => 0,
                           'parent' => $product_cat_ID,
                           'taxonomy' => 'product_cat'
                        );
                    $subcats = get_categories($args);
                    echo $subcat->name;*/

           /* $prod_cat_args = array(
  'taxonomy'     => 'product_cat', //woocommerce
  'orderby'      => 'name',
  'empty'        => 0
);

/*$woo_categories = get_categories( $prod_cat_args );
$woo_cat_id = $woo_categories->term_id;
echo $woo_cat_id;
/*foreach ( $woo_categories as $woo_cat ) {
    $woo_cat_id = $woo_cat->term_id; //category ID
    $woo_cat_name = $woo_cat->name; //category name
    $woo_cat_slug = $woo_cat->slug; //category slu


    //$return .= '<a href="' . get_term_link( $woo_cat_slug, 'product_cat' ) . '">' . $woo_cat_name . '</a>';
}//end of $woo_categories foreach  */
                    

			//woocommerce_subcats_from_parentcat_by_ID('28');
		

			
			//the_widget('WC_Widget_Product_Categories'); 
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */

			//$categ=get_term_link( $woo_cat_id, 'product_cat' );

	/**********Use**************/			
			global $post;
			$terms = get_the_terms( $post->ID, 'product_cat' );
			foreach ($terms as $term) {
    $product_cat_id = $term->term_id;
    echo $product_cat_id;
    
    break;
}
  /**********Use**************/	         
//echo $product_cat_id;
//woocommerce_subcats_from_parentcat_by_ID(28);
wc_origin_trail_ancestor(true,true);
				do_action( 'woocommerce_before_main_content' );

			?>
			
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

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
				//do_action( 'woocommerce_sidebar' );
			?>
		</div>
		<div class="col-md-2">			

				<div id="sidebar" class="">
							<div class="rightcol">			 				

								<div id="recent-posts-3" class="widget widget_recent_entries">		
									<h3 class="widgettitle">Products</h3>		
										<nav class="rightnav" role="navigation">
											<?php echo do_shortcode('[accordionmenu id="uniqued1c3833" accordionmenu="225"]'); ?>			
										</nav>
								</div> <!-- end .widget --><!-- end .widget -->							

							</div>
				</div>
		</div>
			
	</div>
</div>
<?php get_footer( 'shop' ); ?>
