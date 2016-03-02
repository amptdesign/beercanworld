<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

global $post, $woocommerce_loop;

$type = (isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != '') ? $woocommerce_loop['columns'] : jwOpt::get_option('woo_type', 0);
if(!in_array($type, array(0,1,2,10,11,20))){
    $type = 0;
}
echo jaw_get_template_part('content-product-' . $type, 'woocommerce');
