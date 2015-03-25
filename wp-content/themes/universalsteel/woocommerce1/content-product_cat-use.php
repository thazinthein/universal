<?php //This part is required for WordPress to recognize it as a page template
/*
Template Name: Custom Products Category Tab
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
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
                    <article class="post" id="post-<?php the_ID(); ?>">

                                            

                        <div class="entry">

                            <?php $id =9; $page_data = get_page($id);?>   
                            <h3 class="heading"><?php echo get_the_title(9); ?> </h3>                                                      
                            <?php $post = get_page($id); $content = apply_filters('the_content', $post->post_content); echo $content; ?>                     

                        </div>

                        <?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>

                    </article>              
                    

                <?php endwhile; endif; ?>
            </div>
    </div>

<?php get_footer(); ?>