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

<ul class="wsubcategs">
<?php
$wsubargs = array(
'hierarchical' => 1,
'show_option_none' => '',
'hide_empty' => 0,
'parent' => $category->term_id,
'taxonomy' => 'product_cat'
);
$wsubcats = get_categories($wsubargs);
foreach ($wsubcats as $wsc):
?>
<li><a href="<?php echo get_term_link( $wsc->slug, $wsc->taxonomy );?>"><?php echo $wsc->name;?></a>

</li>
<?php
endforeach;
?>

</ul>
	<!--<?php/*

	$product_category = wp_get_post_terms( $post->ID, 'product_cat' );
	global $post;

$terms = get_the_terms( $post->ID, 'product_cat', 'hide_empty=0'  );
foreach ( $terms as $term ){
    $category_id = $term->term_id;
    $category_name = $term->name;
    $category_slug = $term->slug;

    echo '<li><a href="'. get_term_link($term->slug, 'product_cat') .'">'.$category_name.'</a></li>';


}   */
	?>-->





	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
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
	


<?php get_footer( 'shop' ); ?>
