<?php

if ( is_product() ) {

        $descendant = get_the_terms( $post->ID, 'product_cat' );
        $descendant = array_reverse($descendant);
        $descendant = $descendant[0];
        $descendant_id = $descendant->term_id;
        $descendant_name = $descendant->term_name;
        $ancestors = array_reverse(get_ancestors($descendant_id, 'product_cat'));
        $ac = count($ancestors);   
        $name =  $descendant_name;
    }


    $c = 1;
    if( $trail == false ){

        $origin_ancestor_term = get_term_by("id", $ancestors[0], "product_cat");
        $origin_ancestor_link = get_term_link( $origin_ancestor_term->slug, $origin_ancestor_term->taxonomy );

        if($link == true) 
            echo '<li><a href="'. $origin_ancestor_link .'">';
        
        $name = $origin_ancestor_term->name;
        echo $origin_ancestor_term->name;
        echo $origin_ancestor_term->id;
        if($link == true) 
            echo '</a></li>';

    }else{

        foreach ($ancestors as $ancestor) {
            $ancestor_term = get_term_by("id", $ancestor, "product_cat");
            $ancestor_link = get_term_link( $ancestor_term->slug, $ancestor_term->taxonomy );

            if($c++ == 1) 
                echo '<li class="parent-categ"> '; 
            else if($c++ != 1 || $c++ != $ac) 
                echo ' </li> ';

            if($link == true) 
                echo '<a href="'. $ancestor_link .'">';
            $name =  $ancestor_term->name;
            echo  $ancestor_term->name;
            if($link == true) 
                echo '</a>';

        }

        $descendant_term = get_term_by("id", $descendant_id, "product_cat");
        $descendant_link = get_term_link( $descendant_term->slug, $descendant_term->taxonomy );

        echo ' <li class="sub-categ current-categ"> ';
        if($link == true) 
            echo '<a href="'. $descendant_link .'">';
        echo $descendant->name;
        if($link == true) 
            echo '</a>';
    }  
$cat = get_the_terms( $product->ID, 'product_cat' );

foreach ($cat as $categoria) {
if($categoria->parent == 0){
  // echo '<h1 itemprop="name" class="product_title entry-title">'.$categoria->name.'</h1>';
	$name = $categoria->name;
	$catid = $categoria->id;
	echo $catid;
}

}
?>
<h1 itemprop="name" class="product_title entry-title"><?php echo $name; //echo the_title(); ?></h1>

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
	
	/*$terms = get_terms( 'product_cat');
// DEBUG
// var_dump( $terms ); 
foreach( $terms as $term ) 
{
    echo 'Product Category: '
        . $term->name
        . ' - Count: '
        . $term->count;
} */
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

<?php //do_action( 'woocommerce_after_single_product' ); ?>
