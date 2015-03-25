//Retreives and print the category banner
<?php 

global $woocommerce;
global $wp_query;

// Make sure this is a product category page
if ( is_product_category() ) {

    $cat_id = $wp_query->queried_object->term_id;
    $term_options = get_option( "taxonomy_term_$cat_id" ); 

    // Ge the banner image id
    if ( $term_options['banner_url_id'] != '' )
        $url = wp_get_attachment_url( $term_options['banner_url_id'] ); 

    // Exit if the image url doesn't exist
    if ( !isset( $url ) or $url == false )
        return;

    // Get the banner link if it exists
    if ( $term_options['banner_link'] != '' )
        $link = $term_options['banner_link'];

    // Print Output
    if ( isset( $link ) )
        echo "<a href='" . $link . "'>"; 

    if ( $url != false ) 
        echo "<img src='" . $url . "' class='category_banner_image' />";

    if ( isset( $link ) )
        echo "</a>";
}


elseif ( is_product() ) {
    $terms = get_the_terms( $post->ID, 'product_cat' );
    foreach ( $terms as $term ){
        $category_name = $term->name;
        $category_thumbnail = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
        $image = wp_get_attachment_url($category_thumbnail);
        echo '<img class="category_banner_image" src="'.$image.'">';
}