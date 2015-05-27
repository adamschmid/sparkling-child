<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );

			$tabs = apply_filters( 'woocommerce_product_tabs', array() );
			if ( ! empty( $tabs ) ) : ?>

				<div class="woocommerce-tabs">
					<ul class="tabs">
						<?php foreach ( $tabs as $key => $tab ) : ?>

							<li class="<?php echo $key ?>_tab">
								<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
							</li>

						<?php endforeach; ?>
					</ul>
					<?php foreach ( $tabs as $key => $tab ) : ?>

						<div class="panel entry-content" id="tab-<?php echo $key ?>">
							<?php call_user_func( $tab['callback'], $key, $tab ) ?>
						</div>

					<?php endforeach; ?>
				</div>
			<?php endif; ?><?php ?>

			<?php

			global $woocommerce, $product;

			if ( ! defined( 'ABSPATH' ) )
				exit; // Exit if accessed directly

			if ( ! comments_open() )
				return;
			?>

			<div id="reviews">
				<div id="comments">
					<h2><?php
						if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) )
							printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );
						else
							_e( 'Reviews', 'woocommerce' );
					?></h2>

					<?php if ( have_comments() ) : ?>

						<ol class="commentlist">
							<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
						</ol>

						<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
							echo '<nav class="woocommerce-pagination">';
							paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
								'prev_text' => '&larr;',
								'next_text' => '&rarr;',
								'type'      => 'list',
							) ) );
							echo '</nav>';
						endif; ?>

					<?php else : ?>

						<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

					<?php endif; ?>
				</div>

				<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

					<div id="review_form_wrapper">
						<div id="review_form">
							<?php
								$commenter = wp_get_current_commenter();

								$comment_form = array(
									'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : __( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
									'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
									'comment_notes_before' => '',
									'comment_notes_after'  => '',
									'fields'               => array(
										'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . ' <span class="required">*</span></label> ' .
										            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
										'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . ' <span class="required">*</span></label> ' .
										            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
									),
									'label_submit'  => __( 'Submit', 'woocommerce' ),
									'logged_in_as'  => '',
									'comment_field' => ''
								);

								if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
									$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', 'woocommerce' ) .'</label><select name="rating" id="rating">
										<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>
										<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>
										<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>
										<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>
										<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>
										<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>
									</select></p>';
								}

								$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

								comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
							?>
						</div>
					</div>

				<?php else : ?>

					<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

				<?php endif; ?>

				<div class="clear"></div>



	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 *
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div><!-- .summary -->
	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
<!-- <div class="product_img">div in content-single-product</div> -->
</div>
</div>
</main>
</div>
</article>
</div>
</div>