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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*if(is_single()) {
    $terms = get_the_terms( $post->ID, 'product_cat' );
    $i=0; //Variable for dummy condition
    foreach ( $terms as $term ){
        if($i==0): //Dummy Condition
            $category_name = $term->name;
            //$banner_id = $term_meta['banner_url_id'];
            $url = wp_get_attachment_url( $term_options['banner_url_id'] ); 
            $category_thumbnail = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
            //$image = wp_get_attachment_url($banner_id);
            echo '<img class="absolute '.$category_name.' category-image" src="'.$url.'">';
            $i++; //Increment it to make condition false
        endif;
    }
}*/

$termArray =  array();
 $terms = get_the_terms($post->ID, "product_cat");

 //insert id's in to array
 foreach ($terms as $id) {
    $termArray[] = $id->term_id;
 }

//get random id
$randomId = array_rand($termArray);

 //final ID
$cat_id = $termArray[$randomId];

$term_options = get_option( "taxonomy_term_$cat_id" );

$url = wp_get_attachment_url( $term_options['banner_url_id'] );


   echo "<img src='" . $url . "' class='category_banner_image' />";

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

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
