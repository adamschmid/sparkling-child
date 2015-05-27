<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */
?>
<div id="content" class="site-content container">
	<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">
			<div class="post-inner-content">
					<article id="post-367" class="post-367 page type-page status-publish hentry">
						<div class="entry-content">
							<div id="content" class="site-content">
<div class="containers">
<div class="row cont_box">
<div class="shipping-note-sm">
<p class="shipping-title blink">Free Shipping!</p>
<p class="shipping-text">on domestic orders over $75</p>
</div>
<div class="col-md-3"><i class="fa fa-phone"></i><a href="tel:16123337799">(612) 333-7799</a></div>
<div class="col-md-3"><i class="fa fa-envelope-o"></i><a href="mailto:info@foxtonemusic.com">info@foxtonemusic.com</a></div>
<div class="col-md-3"><i class="fa fa-clock-o"></i>M-F 10:30am to 6pm</div>
<div class="map"><i class="fa fa-map-marker"></i><a href="https://goo.gl/maps/5evcd" target="_blank">114 N 3rd Street (Downstairs)</a></div>
</div>
</div>
</div>

<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo esc_html( $crumb[0] );
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo $delimiter;
		}

	}

	echo $wrap_after;

}