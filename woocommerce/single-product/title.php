
<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<h5 class="item_mfg"><?php the_field( 'mfg'); ?></h5>
<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>