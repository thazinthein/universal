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
	        <div class="col-md-12 pagehead-title-bg">
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
			<h2><?php _e('Error 404 - Page Not Found','html5reset'); ?></h2>
	</div>
</div>	

<?php //get_sidebar(); ?>

<?php get_footer(); ?>