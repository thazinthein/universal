<?php
/*
Template Name: Eurocryor
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
        <div class="col-md-12">
			
					
				
										

					<div class="entry">

						<?php 

						echo do_shortcode ("[restabs alignment=osc-tabs-left responsive=false]
							[restab title=Tab number 1 active=active][product_category category=Eurocryor][/restab]
							[restab title=Tab number 2][product_categories columns=3 ids=13][/restab]
							[restab title=Tab number 3][product_categories columns=3 ids=12][/restab]
							[restab title=Tab number 4][product_categories columns=3 ids=11][/restab][/restabs]");

						?>						

					</div>

					<?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>

					
				

			
		</div>
</div>



<?php get_footer(); ?>
