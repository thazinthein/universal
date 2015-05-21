<?php //This part is required for WordPress to recognize it as a page template
/*
Template Name: Contact Us
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
            <img src="<?php bloginfo('template_directory');?>/images/pagehead_contact_bg-right.png" class="img-responsive">
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

                    

          <div class="entry contactus">
            
            <!--    <?php $id =15; $page_data = get_page($id);?>   
                <h2><?php the_title(); ?></h2>                                                    
                <?php $post = get_page($id); $content = apply_filters('the_content', $post->post_content); echo $content; ?>      -->
              <div class="map-frame">     
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.6658661571996!2d103.8701815!3d1.3771567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da1658d8273e99%3A0xdcb47416e0241107!2s20+Ang+Mo+Kio+Industrial+Park+2A%2C+Singapore+567761!5e0!3m2!1sen!2ssg!4v1430169664551" width="100%" height="450" frameborder="0" style="border:0"></iframe>
              </div>

          </div>

          <div class="row">
                        <div class="col-xs-4"> 
                            <div class="address"> 
                                <h2>Address</h2>
                                <?php $id =15; $page_data = get_page($id);?>                                                              
                                <?php $post = get_page($id); $content = apply_filters('the_content', $post->post_content); echo $content; ?>
                            </div>
                        </div>
                        
                        <div class="col-xs-8"> 
                            <div class="contactform">
                                <h2>Feedback Form</h2>
                                <?php echo do_shortcode('[contact-form-7 id="449" title="Contact form 1"]')  ?>
                            </div>
                        </div>
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
                      <?php wp_nav_menu(array('menu'=> 'Contact Us'));?>     
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
 
 
 