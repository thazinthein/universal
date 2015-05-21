<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
?><!doctype html>


	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">

	<!--Google will often use this as its description of your page/site. Make it good.-->
	<meta name="description" content="<?php bloginfo('description'); ?>" />

	
	<!-- concatenate and minify for production -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/reset.css" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">     -->
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.png">   
    <link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700|Noto+Sans:400,700|Oxygen:400,700|Fjalla+One|Cabin:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Fjalla+One|Anton|Exo+2:400,800,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" /> 
<!--   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
   	
   	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/tab/jquery-ui.css" type="text/css" /> 
 	<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.11.0.min.js"></script>


   	<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>

   	<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  
<!--	<script src="<?php bloginfo('template_url'); ?>/js/modernizr.custom.js"></script>-->
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

	
	<div>

		<header>
	
	      <div class="container">
	        <div class="row">
				
		        <div class="col-xs-10">
		        	<div class="row">
		        		<div class="col-xs-10">
		        			<div class="homemenu">
		        				<a href="<?php echo get_option('home'); ?>" class="tophome">Home</a>
		        				<a href="<?php echo get_option('home'); ?>/contact-us" class="topcontact">Contact Us</a>
		        			</div>
		        			
		        		</div>
		        		<div class="col-xs-2">
		        			<div class="cartmenu">
		        				<?php echo do_shortcode('[WooCommerceWooCartPro]'); ?>
		        			</div>
		        		</div>
		        	</div>
		            	
					<div class="row">
						<div class="col-xs-12">
		            	<!--	<div class="navbar navbar-default topnav" role="navigation">
				                <div class="navbar-header">
				                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				                    <span class="sr-only">Toggle navigation</span>
				                    <span class="icon-bar"></span>
				                    <span class="icon-bar"></span>
				                    <span class="icon-bar"></span>
				                  </button>
				                  <a class="navbar-brand" href="#">Menu</a>
				                </div>
				                <ul class="nav navbar-nav navbar-right">
					                <div class="navbar-collapse collapse" role="navigation">
					                   	<?php
								            wp_nav_menu( array(
								                'menu'              => 'topmenu',
								                'theme_location'    => 'primary',
								                'depth'             => 2,
								                'container'         => 'div',
								                'container_class'   => 'collapse navbar-collapse',
								        		'container_id'      => 'bs-example-navbar-collapse-1',
								                'menu_class'        => 'nav navbar-nav',
								                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								                'walker'            => new wp_bootstrap_navwalker())
								            );
								        ?>	 
					                </div>
					            </ul>
				            </div>  -->
							
							<div class="topnav" role="navigation">
				               
				                <ul class="nav">
					                <div class="" role="navigation">
					                   	<?php
								            wp_nav_menu( array(
								                'menu'              => 'topmenu',
								                'theme_location'    => 'primary',
								                'depth'             => 2,
								                'container'         => 'div',
								                'container_class'   => 'collapse navbar-collapse',
								        		'container_id'      => 'bs-example-navbar-collapse-1',
								                'menu_class'        => 'nav navbar-nav',
								                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								                'walker'            => new wp_bootstrap_navwalker())
								            );
								        ?>	 
					                </div>
					            </ul>
				            </div>


				     


				        </div>
				    </div>

		        </div>

	          <div class="col-xs-2 1logowrapper">
	          	
		             <div class="logo"> 
		             	<a href="<?php echo get_option('home'); ?>/">              
		                	<img src="<?php bloginfo('template_directory');?>/images/logo.png" class="img-responsive">
		                </a>
		             </div>
		        
	          </div>

	        </div>
	      </div>


	    </header>	
	  
         
          			
    			

	    	
	    
		

			
		

