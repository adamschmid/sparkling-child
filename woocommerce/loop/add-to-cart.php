<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product,$post;

?>
<div class="loop-description">
<?php
	echo substr(apply_filters( 'woocommerce_short_description', $post->post_content ),0,130).' ...'."<br>";
?>
</div>
<?php
/* End Code For Short Description at product list page*/

/* Code For to print Categories at product list Page*/
$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
echo $product->get_categories( ', ', '<p class="posted_in">' . _n( 'Category:', 'Listed In:', $cat_count, 'woocommerce' ) . ' ', '.</p>' );

/*End Code For to print Categories at product list Page*/

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
		esc_html( $product->add_to_cart_text() )
	),
$product );
/* Add to WhisList option at product list page */
//echo do_shortcode('[yith_wcwl_add_to_wishlist]');

