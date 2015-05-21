<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>

<div class="pagehead">
	<div class="container">
		
		<div class="row">
	        <div class="col-xs-12 pagehead-title-bg">
				<img src="<?php bloginfo('template_directory');?>/images/pagehead_news_bg-right.png" class="img-responsive">
				<div class="pagehead-title">
					
						<h2><?php the_title(); ?></h2>
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

				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
					
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
						
						<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail();
											} 
											the_content();
						?>
						<?php if(function_exists('the_views')) { the_views(); } ?>
						<?php wp_link_pages(array('before' => __('Pages: ','html5reset'), 'next_or_number' => 'number')); ?>
						
						<?php the_tags( __('Tags: ','html5reset'), ', ', ''); ?>
					
						<?php posted_on(); ?>

					</div>
					
					<?php edit_post_link(__('Edit this entry','html5reset'),'','.'); ?>
					
				</article>

			<?php comments_template(); ?>

			<?php endwhile; endif; ?>

		</div>

		<div class="col-xs-2">      

		        <div id="sidebar" class="">
		              <div class="rightcol">              

		                <div id="recent-posts-3" class="widget widget_recent_entries">    
		                  
		                    <nav class="rightnav" role="navigation">
		                      <?php //echo do_shortcode('[accordionmenu id="uniqued1c3833" accordionmenu="225"]'); ?>     
		                      <?php wp_nav_menu(array('menu'=> 'products categories'));?>
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

		<?php //post_navigation(); ?>
			
		<?php //get_sidebar(); ?>

<?php get_footer(); ?>