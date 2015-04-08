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
				<img src="<?php bloginfo('template_directory');?>/images/pagehead_title_bg-right.png" class="img-responsive">
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
				
				<article class="post" id="post-<?php the_ID(); ?>">

										

					<div class="entry">

						<?php the_content(); ?>						

					</div>

					<?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>

				</article>				
				

			<?php endwhile; endif; ?>
		</div>
	
		<div class="col-xs-2">
			<div class="widget"> 
			    
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>
