<?php //This part is required for WordPress to recognize it as a page template
/*
Template Name: Bags
*/
?>
<?php get_header();  ?>
    <main id="content">
        
          <div class="body container">
              <div class="col-md-12 leftnopadding">  
                  <div class="col-md-9">  

                      <div id="post-<?php the_ID(); ?>">
                        <h1><?php the_title(); ?></h1>
                    
                        <?php echo do_shortcode('[product_categories number="" ids="8,9,10,11,12,13,14,15,16,17,18,19,20,21,22" columns="3"]');  ?>
             
                      </div>
                  </div>


            <div class="col-md-3">
              <h3>Products Categories</h3>
              <nav>               
                <?php wp_nav_menu(array('menu'=> 'right_nav'));?>                               
              </nav>

              <div class="rightblog">  
                            <div class="rightblog-content">  
                              <?php
                                                        $temp = $wp_query;
                                                        $wp_query= null;
                                                        $wp_query = new WP_Query();     
                                                        $wp_query->query('showposts=1'.'&paged='.$paged.'&category_name=blog');
                                                        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                                                            <div class="twentyten-latest-post"> 
                                                                    <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail(array(210,210), array ('class' => 'alignleft')); ?></a>       
                                                                    <i class="blog-icon"><img src="<?php bloginfo('template_directory');?>/images/blog-icon.png"></i><h3 class="blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                                                                    <p class="post-info">by&nbsp;<?php the_author(); ?>&nbsp;on&nbsp;<?php the_time('jS F Y') ?></p>
                                                                  <p><?php echo excerpt(35); ?></p>   
                                                                    <div class="clear"></div>
                                                                  
                                                            </div>

                                                    <?php endwhile; ?>   
                                                 
                                                 
                                            
                            </div>             
                        </div>      
                    
            </div>
          </div>
        </div>
      
    </main>

<?php get_footer(); ?>
 
 
 