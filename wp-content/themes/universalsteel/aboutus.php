<?php //This part is required for WordPress to recognize it as a page template
/*
Template Name: About Us
*/
?>
<?php get_header();  ?>
<div class="pagehead">
  <div class="container">
    
    <div class="row">
          <div class="col-xs-12 pagehead-title-bg">
        <img src="<?php bloginfo('template_directory');?>/images/pagehead_about_bg-right.png" class="img-responsive">
        <div class="pagehead-title">
          
            <h2>
              <?php
                $parent_title = get_the_title($post->post_parent);
                echo $parent_title;
                ?>
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
        <div class="col-xs-10">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          
        <article class="post" id="post-<?php the_ID(); ?>">

                    

          <div class="entry aboutus">

            <?php $id =9; $page_data = get_page($id);?>   
            <h2>Company Profile</h2>                                               
            <?php $post = get_page($id); $content = apply_filters('the_content', $post->post_content); echo $content; ?>           

          </div>

          <?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>

        </article>        
        

      <?php endwhile; endif; ?>
    </div>
  
    <div class="col-xs-2">
        <div id="sidebar" class="">
              <div class="rightcol">              

                <div id="recent-posts-3" class="widget widget_recent_entries">    
                  
                    <nav class="rightnav" role="navigation">
                      <?php //echo do_shortcode('[accordionmenu id="uniqued1c3833" accordionmenu="225"]'); ?>    
                      <?php wp_nav_menu(array('menu'=> 'Aboutus Submenu categories'));?> 
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
 
 
 