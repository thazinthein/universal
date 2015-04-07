<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */


//OLD STUFF BELOW


	// Load jQuery
	if ( !function_exists( 'core_mods' ) ) {
		function core_mods() {
			if ( !is_admin() ) {
				wp_deregister_script( 'jquery' );
				wp_register_script( 'jquery', ( "" ), false);
				wp_enqueue_script( 'jquery' );
			}
		}
		add_action( 'wp_enqueue_scripts', 'core_mods' );
	}

	// Clean up the <head>, if you so desire.
	//	function removeHeadLinks() {
	//    	remove_action('wp_head', 'rsd_link');
	//    	remove_action('wp_head', 'wlwmanifest_link');
	//    }
	//    add_action('init', 'removeHeadLinks');

	// Custom Menu
	register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );

	// Widgets
	if ( function_exists('register_sidebar' )) {
		function html5reset_widgets_init() {
			register_sidebar( array(
				'name'          => __( 'Sidebar Widgets', 'html5reset' ),
				'id'            => 'sidebar-primary',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
		add_action( 'widgets_init', 'html5reset_widgets_init' );
	}

	// Navigation - update coming from twentythirteen
	function post_navigation() {
		echo '<div class="navigation">';
		echo '	<div class="next-posts">'.get_next_posts_link('&laquo; Older Entries').'</div>';
		echo '	<div class="prev-posts">'.get_previous_posts_link('Newer Entries &raquo;').'</div>';
		echo '</div>';
	}

	// Posted On
	function posted_on() {
		printf( __( '<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_author() )
		);
	}


	  function register_my_menu() {
      register_nav_menu('header-menu',__( 'Header Menu' ));
    }
    add_action( 'init', 'register_my_menu' );
    
    function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
         )
      );
    }
    add_action( 'init', 'register_my_menus' );


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
} 

/**
 * Hides Woocommerce breadcrumb
 */
//remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

/**
 * Hides Woocommerce breadcrumb ********Imporant***********
 */
add_action( 'init', 'jk_remove_wc_breadcrumbs' );
function jk_remove_wc_breadcrumbs() {
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
} 


/**
 * Change Woocommerce breadcrumb Seperator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
  // Change the breadcrumb delimeter from '/' to '>'
  $defaults['delimiter'] = '';
  return $defaults;
}


add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(            
            'delimiter'   => '<span class="breadcrumb-bg">&nbsp;</span>',
            'wrap_before' => '<nav id="crumbs" class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '<a class="current" id="crumbs">',
            'after'       => '</a>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

//Remove <del> tag from price

    

function custom_get_price_html_from_to( $price, $product ) {
            $from = $product->regular_price;
            $to = $product->get_price();
           
            if ( $product->is_on_sale() )
            return 'RP: ' . ( ( is_numeric( $from ) ) ? woocommerce_price( $from ) : $from ) .'<span> | SP: ' . ( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) . '</span>';
           
            return '<del>' . ( ( is_numeric( $from ) ) ? woocommerce_price( $from ) : $from ) . '</del> <span>' . ( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) . '</span>';
        
    }
     
    add_filter( 'woocommerce_free_sale_price_html', 'custom_get_price_html_from_to', 10, 2 );
    add_filter( 'woocommerce_sale_price_html', 'custom_get_price_html_from_to', 10, 2 );
    add_filter( 'woocommerce_variable_free_sale_price_html', 'custom_get_price_html_from_to', 10, 2 );
    add_filter( 'woocommerce_variable_sale_price_html', 'custom_get_price_html_from_to', 10, 2 );



//Remove <del> tag from price


// Single Product
add_filter( 'single_add_to_cart_text', 'custom_single_add_to_cart_text' );
function custom_single_add_to_cart_text() {
    return 'Add to Quote'; // Change this to change the text on the Single Product Add to cart button.
}

// Product Page
add_filter( 'add_to_cart_text', 'custom_add_to_cart_text' );
function custom_add_to_cart_text() {
    return 'Add to Quote'; // Change this to change the text on the Single Product Add to cart button.
}

// Redefine woocommerce_output_related_products()
// display upsells and related products within dedicated div with different column and number of products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_output_related_products() {
    $output = null;

    ob_start();
    woocommerce_related_products(3,3); 
    $content = ob_get_clean();
    if($content) { $output .= $content; }

    echo '<div class="clear"></div>' . $output;
}


add_filter( 'woocommerce_variable_free_price_html',  'hide_free_price_notice' );
 
add_filter( 'woocommerce_free_price_html',           'hide_free_price_notice' );
 
add_filter( 'woocommerce_variation_free_price_html', 'hide_free_price_notice' );
 
 
 
/**
 * Hides the 'Free!' price notice
 */
function hide_free_price_notice( $price ) {
 
  return '';
} 


/**
 * Registers our main widget area and the front page widget areas.
*/
/*function guardian_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'guardian' ),
        'id' => 'sidebar-1',
        'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'guardian' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'First Front Page Widget Area', 'guardian' ),
        'id' => 'sidebar-2',
        'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'guardian' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Second Front Page Widget Area', 'guardian' ),
        'id' => 'sidebar-3',
        'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'guardian' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'guardian_widgets_init' );*/

// define woocommerce_category_products()
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Woo Catego',
'id' => 'woo-catego',
'description' => 'Appears as the sidebar on the custom homepage',
'before_widget' => '<div style="height:5px"></div><li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h2 class="widgettitle">',
'after_title' => '</h2>',
));
}   

// define woocommerce_accordin_categories()
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Woo Accordin',
'id' => 'woo-accordin',
'description' => 'Appears as the sidebar on the custom homepage',
'before_widget' => '<div style="height:5px"></div><li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h2 class="widgettitle">',
'after_title' => '</h2>',
));
}   

// define woocommerce_search_products()
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Woo Search',
'id' => 'homepage-sidebar',
'description' => 'Appears as the sidebar on the custom homepage',
'before_widget' => '<div style="height:5px"></div><li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h2 class="widgettitle">',
'after_title' => '</h2>',
));
}   


// define woocommerce_random_products()
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Woo Random',
'id' => 'homepage-random',
'description' => 'Appears as the sidebar on the custom homepage',
'before_widget' => '<div style="height:5px"></div><li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widgettitle">',
'after_title' => '</h3>',
));
}

// define social media
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Social Media',
'id' => 'social',
'description' => 'Appears as the sidebar on the custom homepage',
'before_widget' => '<div style="height:5px"></div><li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h2 class="widgettitle">',
'after_title' => '</h2>',
));
}


// this read more script 

function new_excerpt_more( $more ) 
    {
    return '</br><a class="read-more btn btn-3 btn-3a update-btn" href="'. get_permalink( get_the_ID() ) . '">Read More</a>';
    }
    add_filter( 'excerpt_more', 'new_excerpt_more' );
    function get_cat_slug($cat_id) 
    {
    $cat_id = (int) $cat_id;
    $category = the_content($cat_id);
    return $category->slug;
    }
    // enable wordpress to trim rea more the_content or the_excerpt
    function new_excerpt_length($length) {
      return 70;
    }
    add_filter('excerpt_length', 'new_excerpt_length');






function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt . '</br><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More...</a>');
      return $excerpt;
      
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content );
      return $content;
     
    }



// Change number or products per row to 3
// Override theme default specification for product # per row
function loop_columns() {
return 4; // 5 products per row
}
add_filter('loop_shop_columns', 'loop_columns', 999);


function mystile_featured_products() {
  global $woo_options;
  if (class_exists('woocommerce') && $woo_options[ 'woo_homepage_featured_products' ] == "true" ) {
    echo '<h1>'.__('Featured Products', 'woothemes').'</h1>';
    $featuredproductsperpage = $woo_options['woo_homepage_featured_products_perpage'];
    echo do_shortcode('[featured_products per_page="'.$featuredproductsperpage.'"]');
  } // End query to see if products should be displayed
}


function bp_remove_gravatar ($image, $params, $item_id, $avatar_dir, $css_id, $html_width, $html_height, $avatar_folder_url, $avatar_folder_dir) {

$default = 'http://yoursite.net/wp-content/plugins/buddypress/bp-core/images/mystery-man.jpg';

if( $image && strpos( $image, "gravatar.com" ) ){

return 'avatar';
}else
return $image;

}
add_filter('bp_core_fetch_avatar', 'bp_remove_gravatar', 1, 9 );

function remove_gravatar ($avatar, $id_or_email, $size, $default, $alt) {

$default = 'http://yoursite.net/wp-content/plugins/buddypress/bp-core/images/mystery-man.jpg';
return "{$alt}";
}

add_filter('get_avatar', 'remove_gravatar', 1, 5);




add_filter('gettext', 'rename_admin_menu_items');
add_filter('ngettext', 'rename_admin_menu_items');
/**
 * Replaces wp-admin menu item names
 * 
 * @author Daan Kortenbach
 * 
 * @param array $menu The menu array.
 *
 * @return $menu Menu array with replaced items.
 */
function rename_admin_menu_items( $menu ) {
  
  // $menu = str_ireplace( 'original name', 'new name', $menu );
  $menu = str_ireplace( 'Woocommerce', 'Enquiry Setting', $menu );
  
  // return $menu array
  return $menu;
}



add_action( 'init', 'remove_taxonomy_menu_pages', 999 );
function remove_taxonomy_menu_pages() {
    
    // remove products->tags
    register_taxonomy('product_tag', 
        'woocommerce_taxonomy_objects_product_tag', array('show_ui' => false)
    );
    // remove products->shipping classes
    register_taxonomy('product_shipping_class', 
        'woocommerce_taxonomy_objects_product_shipping_class', array('show_ui' => false)
    );

   register_taxonomy('product_page_product_attributes', 
        'woocommerce_taxonomy_objects_product_attributes', array('show_ui' => false)
    );
}

/*function my_woocommerce_continue_shopping_redirect( $return_to ) {
  return get_permalink( woocommerce_get_page_id( 'shop' ) );
}
add_filter( 'woocommerce_continue_shopping_redirect', 'my_woocommerce_continue_shopping_redirect', 20 );*/



function woocommerce_subcats_from_parentcat_by_ID($product_cat_id) {
 
   $args = array(
 
       'hierarchical' => 1,
 
       'show_option_none' => '',
 
       'hide_empty' => 0,
 
       'parent' => $product_cat_id,
       
     'taxonomy' => 'product_cat'
 
   );
 
$subcats = get_categories($args);

echo '<ul class="wooc_sclist">';
 
foreach ($subcats as $sc) {
 
       $link = get_term_link( $sc->slug, $sc->taxonomy );
 
echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
 
     }
 
echo '</ul>';
 
}

function woocommerce_subcats_from_parentcat_by_NAME($parent_cat_NAME) {
 
$IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');
 
$product_cat_ID = $IDbyNAME->term_id;
 
   $args = array(
 
       'hierarchical' => 1,
 
       'show_option_none' => '',
 
       'hide_empty' => 0,
 
       'parent' => $product_cat_ID,
 
       'taxonomy' => 'product_cat'
 
   );
 
$subcats = get_categories($args);
 
echo '<ul class="wooc_sclist">';
 
foreach ($subcats as $sc) {
 
       $link = get_term_link( $sc->slug, $sc->taxonomy );
 
echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
 
     }
 
echo '</ul>';
 
}

/*	add_action( 'wp_enqueue_scripts', 'include_waypoints' );
	function include_waypoints() {
	 
	  if ( !is_front_page() )
	    return;
	 
	  wp_enqueue_script( 'waypoints', get_stylesheet_directory_uri() . '/js/waypoints.min.js', array( 'jquery' ), '1.0.0' );
	  wp_enqueue_script( 'waypoints-init', get_stylesheet_directory_uri() .'/js/waypoints-init.js' , array( 'jquery', 'waypoints' ), '1.0.0' );
	 
	}*/

	add_action( 'admin_menu', 'remove_submenu_pages', 999 );
	function remove_submenu_pages() {
	    // remove products->attributes
	    remove_submenu_page( 'edit.php?post_type=product&page=woocommerce_attributes', 'woocommerce_attributes');
	}


	add_action( 'admin_menu', 'my_remove_menus', 999 );

	function my_remove_menus() {
	  remove_submenu_page( 'woocommerce' ,'product_attributes');
	}

add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );
function wc_wc20_variation_price_format( $price, $product ) {
// Main Price
$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
$price = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
// Sale Price
$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
sort( $prices );
$saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
if ( $price !== $saleprice ) {
$price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
}
return $price;
}


class ik_walker extends Walker_Nav_Menu{    
  //start of the sub menu wrap
  function start_lvl(&$output, $depth) {
    $output .= '<div class="drop">
            <div class="holder">
              <div class="container">
                <ul class="list">';
  }
 
  //end of the sub menu wrap
  function end_lvl(&$output, $depth) {
    $output .= '
          </ul>
        </div>
      </div>
      <div class="bottom"></div>
    </div>';
  }
 
  //add the description to the menu item output
  function start_el(&$output, $item, $depth, $args) {
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
    $class_names = $value = '';
 
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    $class_names = ' class="' . esc_attr( $class_names ) . '"';
 
    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
 
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    if(strlen($item->description)>2){ $item_output .= '<br/><span class="sub">' . $item->description . '</span>'; }
    $item_output .= '</a>';
    $item_output .= $args->after;
 
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}


//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'universalsteel' ),
) );

// Disable WooCommerce's Default Stylesheets
function wc_origin_trail_ancestor( $link = false, $trail = false ) {

    if (is_product_category()) {
        global $wp_query;
        $q_obj = $wp_query->get_queried_object();
        $cat_id = $q_obj->term_id;

        $descendant = get_term_by("id", $cat_id, "product_cat");
        $descendant_id = $descendant->term_id;

        $ancestors = get_ancestors($cat_id, 'product_cat');
        $ancestors = array_reverse($ancestors);

        $origin_ancestor = get_term_by("id", $ancestors[0], "product_cat");
        $origin_ancestor_id = $origin_ancestor->term_id;

        $ac = count($ancestors);

    } else if ( is_product() ) {

        $descendant = get_the_terms( $post->ID, 'product_cat' );
        $descendant = array_reverse($descendant);
        $descendant = $descendant[0];
        $descendant_id = $descendant->term_id;

        $ancestors = array_reverse(get_ancestors($descendant_id, 'product_cat'));
        $ac = count($ancestors);

    }


    $c = 1;
    if( $trail == false ){

        $origin_ancestor_term = get_term_by("id", $ancestors[0], "product_cat");
        $origin_ancestor_link = get_term_link( $origin_ancestor_term->slug, $origin_ancestor_term->taxonomy );


        if($link == true) 
            echo '<ul class="tab-ul"><li class="tab-li"><a href="'. $origin_ancestor_link .'">';
        echo 'All';
        if($link == true) 
            echo '</a></li></ul>';

    }else{

        foreach ($ancestors as $ancestor) {
            $ancestor_term = get_term_by("id", $ancestor, "product_cat");
            $ancestor_link = get_term_link( $ancestor_term->slug, $ancestor_term->taxonomy );

            if($c++ == 1) 
                echo '» '; 
            else if($c++ != 1 || $c++ != $ac) 
                echo ' » ';

            if($link == true) 
                echo '<a href="'. $ancestor_link .'">';
            echo  $ancestor_term->name;
            if($link == true) 
                echo '</a>';

        }

        $descendant_term = get_term_by("id", $descendant_id, "product_cat");
        $descendant_link = get_term_link( $descendant_term->slug, $descendant_term->taxonomy );

        echo ' » ';
        if($link == true) 
            echo '<a href="'. $descendant_link .'">';
        echo $descendant->name;
        if($link == true) 
            echo '</a>';

    }

}


// post views
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 

?>
