<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;
?>
<div class="productcatego-wrap">
	<li class="product-category product<?php
	    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 )
	        echo ' first';
		if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
			echo ' last';
		?>">

		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>

			<h2>

				<?php
				global $wp_query;
				$category_name = $category->name;

				if( $category_name ) {
				$category_object = get_term_by('name', $category_name, 'product_cat');
				$category_id = $category_object->term_id;
				}
					
					echo $category->name;	
							

					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', '', $category );
				?>
			</h2>

			<?php $wcatTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'parent' =>$category_id, )); 
        	foreach($wcatTerms as $wcatTerm) : 
        		$wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
        	?>

    		<div class="shop-subcat">
    			
    			<h3 class="text-center"><a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy, $wcatTerm->count ); ?>"><?php echo $wcatTerm->name;//echo $wcatTerm->count; ?></a>

    			</h3>
    		</div>

    <?php endforeach; ?>


   
    	


			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>

		</a>

		<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

	</li>
</div>