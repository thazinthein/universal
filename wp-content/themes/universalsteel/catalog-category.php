<?php //This part is required for WordPress to recognize it as a page template
/*
Template Name: Catalog-Category
*/
?>
<?php get_header();  ?>
<div class="pagehead">
  <div class="container">
    
    <div class="row">
          <div class="col-md-12 pagehead-title-bg">
        <img src="<?php bloginfo('template_directory');?>/images/pagehead_download_bg-right.png" class="img-responsive">
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
        <div class="col-md-10">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          
        <article class="post" id="post-<?php the_ID(); ?>">

                    

          <div class="entry">

     <!--       <?php $id =900; $page_data = get_page($id);?>   
            <h2><?php the_title(); ?></h2>                                                    
            <?php $post = get_page($id); $content = apply_filters('the_content', $post->post_content); echo $content; ?>         -->  

          </div>

          <div class="row">
                <div class="col-md-4">
                  <a href="../catalog-retigo/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>RETIGO Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-retigo.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>

                <div class="col-md-4">
                  <a href="../catalog-turbo/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>TURBO FLAME Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-turbo.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>

               <div class="col-md-4">
                  <a href="../catalog-tonon/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>TONON Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-tonon.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>

                <div class="col-md-4">
                  <a href="../catalog-turboair/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>TURBO AIR Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-turboair.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>

               <div class="col-md-4">
                  <a href="../catalog-iarp/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>IARP Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-iarp.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>

               <div class="col-md-4">
                  <a href="../catalog-anets/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>ANETS Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-anets.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>

                <div class="col-md-4">
                  <a href="../catalog-radiance/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>RADIANCE Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-radiance.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>

                <div class="col-md-4">
                  <a href="../catalog-icetro/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>ICETRO Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-icetro.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>

                <div class="col-md-4">
                  <a href="../catalog-modular/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>MODULAR Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-modular.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>   

                <div class="col-md-4">
                  <a href="../catalog-hobart/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>HOBART Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-hobart.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>  

                <div class="col-md-4">
                  <a href="../catalog-kolb/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>KOLB Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-kolb.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>  

                <div class="col-md-4">
                  <a href="../catalog-cvap/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>CVAP Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-cvap.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>     

                <div class="col-md-4">
                  <a href="../catalog-powerline/"><div class="catlog-category">
                      <div class="col-md-8">
                        <h2>POWER LINE LAUNDRY Catalogues</h2>
                        <div class="catedown">See All</div>
                      </div>
                      <div class="col-md-4">
                        <img src="<?php bloginfo('template_directory');?>/images/catalog-thum-power-line.png" class="img-responsive">
                      </div>
                  </div></a>
                </div>  


          </div>


          <?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>

        </article>        
        

      <?php endwhile; endif; ?>
    </div>
  
    <div class="col-md-2">
        <div id="sidebar" class="">
              <div class="rightcol">              

                <div id="recent-posts-3" class="widget widget_recent_entries">                  
                    <nav class="rightnav" role="navigation">
                      <?php wp_nav_menu(array('menu'=> 'Download Submenu'));?>     
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
 
 
 