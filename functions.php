<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

// Display XX products per page.
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

// Disable WooCommerce's Default Stylesheets
add_action('woocommerce_enqueue_styles', 'disable_woocommerce_default_css');
function disable_woocommerce_default_css( $styles ) {

	// Disable the stylesheets below via unset():
	unset( $styles['woocommerce-general'] );  // Styling of buttons, dropdowns, etc.
	unset( $styles['woocommerce-layout'] );        // Layout for columns, positioning.
	//unset( $styles['woocommerce-smallscreen'] );        // Layout for columns, positioning.
	// unset( $styles['woocommerce-smallscreen'] );   // Responsive design for mobile devices.

	return $styles;
}

// Add custom WooCommerce's Stylesheets from child theme
add_action('wp_enqueue_scripts', 'use_woocommerce_custom_css');
// Add a custom stylesheet to replace woocommerce.css
function use_woocommerce_custom_css() {
	wp_enqueue_style(
			'woocommerce-custom',
			get_stylesheet_directory_uri() . '/woocommerce/woocommerce.css'
	);
	wp_enqueue_style(
			'woocommerce-custom-layout',
			get_stylesheet_directory_uri() . '/woocommerce/woocommerce-layout.css'
	);
	// wp_enqueue_style(
	// 		'woocommerce-custom-smallscreen',
	// 		get_stylesheet_directory_uri() . '/woocommerce/woocommerce-smallscreen.css'
	// );
}

//dequeue Sparkling Bootstrap css from theme
add_action('wp_print_styles', 'mytheme_dequeue_css_from_plugins', 100);
function mytheme_dequeue_css_from_plugins()  {
	wp_dequeue_style( "sparkling-bootstrap" );
}

//enqueue CUSTOM Sparkling Bootstrap css from child theme
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'bootstrap-custom', get_stylesheet_directory_uri() . '/bootstrap.min.css' );
	 // Add Modernizr for better HTML5 and CSS3 support
  wp_enqueue_script('sparkling-modernizr', get_template_directory_uri().'/inc/js/modernizr.min.js', array('jquery') );

  // Add Bootstrap default JS
	wp_enqueue_script('sparkling-bootstrapjs', get_template_directory_uri().'/inc/js/bootstrap.min.js', array('jquery') );

  // Add slider JS only if is front page ans slider is enabled
	if( ( is_home() || is_front_page() ) && of_get_option('sparkling_slider_checkbox') == 1 ) {
		wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/inc/js/flexslider.min.js', array('jquery'), '20140222', true );
	}

  // Flexslider customization
  if( ( is_home() || is_front_page() ) && of_get_option('sparkling_slider_checkbox') == 1 ) {
    wp_enqueue_script( 'flexslider-customization', get_template_directory_uri() . '/inc/js/flexslider-custom.js', array('jquery', 'flexslider-js'), '20140716', true );
  }

  // Main theme related functions
	wp_enqueue_script( 'sparkling-functions', get_template_directory_uri() . '/inc/js/functions.min.js', array('jquery') );

	// This one is for accessibility
  wp_enqueue_script( 'sparkling-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20140222', true );

}

//Remove Sparkling theme default post search
function unhook_thematic_functions() {
	remove_filter( 'get_search_form', 'sparkling_wpsearch' );
}
add_action( 'init', 'unhook_thematic_functions' );

//add Woocommerce search in place of Sparkling default post search
add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
	if( $args->theme_location == 'primary' )
			return $items.get_search_form();
	return $items;
}

//$product->get_stock_quantity()

// function get_stock_quantity() {
// 	return $this->managing_stock() ? apply_filters( 'woocommerce_stock_amount', $this->stock ) : '';
// }




// add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' ); // < 2.1
// add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text' ); // 2.1 +
// function woo_custom_cart_button_text() {
// return __( 'My Button Text', 'woocommerce' );
// }


// function add_to_cart_text() {
// 	$text = $this->is_purchasable() && $this->is_in_stock() ? __( 'Add to cart', 'woocommerce' ) : __( 'Notify Me', 'woocommerce' );

// 	return apply_filters( 'woocommerce_product_add_to_cart_text', $text, $this );
// }

/*
* replace read more buttons for out of stock items
**/


// if (!function_exists('woocommerce_template_loop_add_to_cart')) {
// 	function woocommerce_template_loop_add_to_cart() {
// 	global $product;
// 		if (!$product->is_in_stock()) {
// 		echo '<a href="'.get_permalink().'" rel="nofollow" class="button add_to_cart_button more_info_button out_stock_button">Notify Me</a>';
// 		}
// 		else{
// 			woocommerce_get_template('loop/add-to-cart.php');
// 		}
// 	}
// }





?>
