<?php //This part is required for WordPress to recognize it as a page template
/*
Template Name: Products
*/
?>
<?php
          setPostViews(get_the_ID());
?>
<?php get_header();  ?>
<div class="pagehead">
  <div class="container">
    
    <div class="row">
          <div class="col-xs-12 pagehead-title-bg">
        <img src="<?php bloginfo('template_directory');?>/images/pagehead_title_bg-right.png" class="img-responsive">
        <div class="pagehead-title">          
            <h2>
              Products
            </h2>
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

    <div class="col-xs-10 products-page">
      
      <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

          <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

      <?php endif; ?>   
      
      <?php
        /**
         * woocommerce_before_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         */
        do_action( 'woocommerce_before_main_content' );
      ?>
      <div class="categ-menu">
        <?php  
          if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('woo-catego') ) :
            endif; 
        echo $category->name;

        if ( $category->count > 0 )
          echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
        ?>
      </div>
        
        

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

            <?php woocommerce_product_subcategories(array('force_display' => true)); ?>

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
        //do_action( 'woocommerce_sidebar' );
      ?>

  </div>
  <div class="col-xs-2">
        <div id="sidebar" class="">
              <div class="rightcol">              

                <div id="recent-posts-3" class="widget widget_recent_entries">    
                  <h3 class="widgettitle">Products</h3>   
                    <nav class="rightnav" role="navigation">
                      <?php echo do_shortcode('[accordionmenu id="uniqued1c3833" accordionmenu="225"]'); ?>     
                    </nav>
                </div> <!-- end .widget --><!-- end .widget -->             

              </div>

              <div class="rightcol">              

                <div class="contact-box">   
                  <h3>Contact Us</h3>
                  <div class="ph-no">Sales : (65) 6253-6001<br> Services : (65) 6280-7333</div>
                </div> <!-- end .widget --><!-- end .widget -->             

              </div>
        </div>
  </div>
  
    
  </div>
</div>


<?php get_footer(); ?>
 
 
 