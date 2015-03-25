<?php //This part is required for WordPress to recognize it as a page template
/*
Template Name: Shop page
*/
?>
<?php get_header();  ?>

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

                            <?php echo do_shortcode('[product_categories number="" columns="4" ids="13,12,14"]') ?>                    

                        </div>

                        <?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>

                                
                    

                
            </div>
    </div>

<?php get_footer(); ?>