<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>

<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo $product->get_price_html(); ?></p>

	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
<?php
	// Availability
	//$availability = $product->get_availability();

	//if ( $availability['availability'] )
		//echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . /*esc_html( $availability['availability'] ) .*/ '</p>', $availability['availability'] );
?>

<?php //if ( $product->is_in_stock() ) : ?>

	<?php //do_action( 'woocommerce_before_add_to_cart_form' ); ?>



	<?php //do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php //endif; ?>
<?php //echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
<div class="comp_btm">
 <?php echo do_shortcode('[yith_compare_button]'); ?>
</div>
<?php if ( function_exists('woo_add_compare_button' ) ) echo woo_add_compare_button(); ?>

<?php
if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;

$count   = $product->get_rating_count();
$average = $product->get_average_rating();

if ( $count > 0 ) : ?>

	<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?>
			</span>
		</div>
		<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $count, 'woocommerce' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?>)</a>
	</div>

<?php endif; ?>
<!-- This is For Meta -->
<?php
$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<!-- <span class="sku_wrapper"><?php //_e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php //echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span>.</span> -->

	<?php endif; ?>

	<?php //echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '.</span>' ); ?>
	<?php echo $product->get_categories( ', ', '<div class="posted_in">' . _n( 'Category:', 'Listed In:', $cat_count, 'woocommerce' ) . ' ', '.</div>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>


</div>


