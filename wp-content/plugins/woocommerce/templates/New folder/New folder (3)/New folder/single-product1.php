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
<?php  
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('woo-catego') ) :
				    endif; 
				?>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
<?php /*

$wcatTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'parent' => $category->term_id, )); 
        foreach($wcatTerms as $wcatTerm) : 
        $wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
        $wimage = wp_get_attachment_url( $wthumbnail_id );
    ?>
    <div><a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>">
    <?php if($wimage!=""):?><img src="<?php echo $wimage?>" class="aligncenter"><?php endif;?></a>
    <h3 class="text-center"><a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ); ?>"><?php echo $wcatTerm->name; ?></a></h3>
    </div>



    <?php endforeach; ?> 
		<?php /*

						echo do_shortcode ("[restabs alignment=osc-tabs-left responsive=false]
							[restab title=Tab number 1 active=active][product_category category=Eurocryor][/restab]
							[restab title=Tab number 2][product_categories columns=3 ids=<?php echo $subcat->slug; ?>][/restab]
							[restab title=Tab number 2][product_categories number=12 parent=0][/restab]
							[restab title=Tab number 3][product_category category=Radiance][/restab]
							[restab title=Tab number 4][product_category columns=3 category=under-counter-type][/restab][/restabs]"); */

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

<?php get_footer( 'shop' ); ?>
