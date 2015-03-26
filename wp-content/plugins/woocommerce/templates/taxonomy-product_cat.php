<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/woocommerce/taxonomy-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//wc_get_template( 'archive-product.php' );


// We need to get the top-level category so we know which template to load.
$get_cat = $wp_query->query['product_cat'];

// Split
$all_the_cats = explode('/', $get_cat);

// How many categories are there?
$cat_count = count($all_the_cats);

//
// All the cats say meow!
//

// Define the parent
$parent_cat = $all_the_cats[0];

// In-house classes
if ( $parent_cat == 'classes' ) woocommerce_get_template( 'archive-product.php' );

// Online courses (videos) -- "top-level" categories
elseif ( $cat_count >= 1 ) woocommerce_get_template( 'eurocryor.php' );


// Online courses (videos) -- sub-categories
//		elseif ( $parent_cat == 'eurocryor' && $cat_count > 1 ) woocommerce_get_template( 'eurocryor.php' );