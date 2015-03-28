<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>
<div class="pagehead">
	<div class="container">
        <div class="col-md-7 pagehead-title-bg">
			<div class="pagehead-title">
				
					<h2><?php the_title(); ?></h2>
				
				
				<div class="breadcurmb" id="breadcrumb">
					<?php woocommerce_breadcrumb(); ?>
				</div>

			</div>
		</div>
		<div class="col-md-5 pagehead-title-bg-right"></div>
	</div>
</div>

<div class="container">
        <div class="col-md-10">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<article class="post" id="post-<?php the_ID(); ?>">

										

					<div class="entry">

						<?php the_content(); ?>						

					</div>

					<?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>

				</article>				
				

			<?php endwhile; endif; ?>
		</div>
		<div class="col-md-10">
			<div class="widget"> 
			    <?php  
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('woo-catego') ) :
				    endif; 
				?>
			</div>
		</div>
</div>



<?php get_footer(); ?>
