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
woocommerce_subcats_from_parentcat_by_ID(28);






if (is_product_category()) {
        global $wp_query;
        $q_obj = $wp_query->get_queried_object();
        $cat_id = $q_obj->term_id;

        $descendant = get_term_by("id", $cat_id, "product_cat");
        $descendant_id = $descendant->term_id;

        $ancestors = get_ancestors($cat_id, 'product_cat');
        $ancestors = array_reverse($ancestors);

        $origin_ancestor = get_term_by("id", $ancestors[0], "product_cat");
        $origin_ancestor_id = $origin_ancestor->term_id;

        $ac = count($ancestors);

    } else if ( is_product() ) {

        $descendant = get_the_terms( $post->ID, 'product_cat' );
        $descendant = array_reverse($descendant);
        $descendant = $descendant[0];
        $descendant_id = $descendant->term_id;

        $ancestors = array_reverse(get_ancestors($descendant_id, 'product_cat'));
        $ac = count($ancestors);        
    }


    $c = 1;
    if( $trail == false ){

        $origin_ancestor_term = get_term_by("id", $ancestors[0], "product_cat");
        $origin_ancestor_link = get_term_link( $origin_ancestor_term->slug, $origin_ancestor_term->taxonomy );

        if($link == true) 
            echo '<li><a href="'. $origin_ancestor_link .'">';
        

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




global $wp_query;
        $q_obj = $wp_query->get_queried_object();
        $cat_id = $q_obj->term_id;

        $descendant = get_term_by("id", $cat_id, "product_cat");
        $descendant_id = $descendant->term_id;

        $ancestors = get_ancestors($cat_id, 'product_cat');
        $ancestors = array_reverse($ancestors);

        $origin_ancestor = get_term_by("id", $ancestors[0], "product_cat");
        $origin_ancestor_id = $origin_ancestor->term_id;

        echo $descendant_id;





 global $post;
// get categories
$terms = wp_get_post_terms( $post->ID, 'product_cat' ); 
echo $terms;







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
