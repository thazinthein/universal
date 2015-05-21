<?php //This part is required for WordPress to recognize it as a page template
/*
Template Name: Products Page
*/
?>
<?php
          setPostViews(get_the_ID());
?>
<?php get_header();  ?>
<div class="pagehead">
  <div class="container">
    
    <div class="row">
          <div class="col-md-12 pagehead-title-bg">
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

    <div class="col-md-10 products-page">

      <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
      
      <?php //echo do_shortcode('[product_categories number="12" parent="0" columns="5"]');  ?>
      <?php //echo do_shortcode('[product_categories]');  ?>
      

      <div class="productcatego-wrap">
          <div class="productcatego-icecube-wrap">
            <h2><?php echo do_shortcode('[product_categories number="" columns="4" ids="28"]');  ?></h2>
            
          </div>
      </div>


      <div class="productcatego-wrap">
          <div class="productcatego-icecube-wrap">
            <h2><?php echo do_shortcode('[product_categories number="" columns="4" ids="53"]');  ?></h2>
            
          </div>
      </div>



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

              <div class="rightcol">              

                <div class="contact-box">   
                  <h3>Contact Us</h3>
                  <div class="salesph-no"><h5>Sales</h5>(65) 6253-6001</div>
                  <div class="services-no"><h5>Services</h5>(65) 6280-7333</div>
                </div> <!-- end .widget --><!-- end .widget -->             

              </div>
        </div>
  </div>
  
    
  </div>
</div>


<?php get_footer(); ?>
 
 
 