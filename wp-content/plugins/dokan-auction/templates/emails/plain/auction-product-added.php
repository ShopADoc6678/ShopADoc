<?php
/**
 * New Auction Product Email. ( plain text )
 *
 * An email sent to the admin when a new Product is created by vendor.
 *
 * @class       Dokan_Auction_Email
 * @version     2.7.1
 * 
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
echo "= " . $email_heading . " =\n\n";
?>

<?php _e( 'Hello there,', 'dokan-auction' );  echo " \n\n";?>

<?php _e( 'A new product is submitted to your site.', 'dokan-auction' ); echo " \n\n"; ?>

<?php _e( 'Summary of the product:', 'dokan-auction' );  ?>

<?php echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n"; ?>

<?php _e( 'Title: '. $data['title'], 'dokan-auction' ); echo " \n"; ?> 
<?php _e( 'Selling Price: '. wc_price( $data['price'] ), 'dokan-auction' ); echo " \n"; ?>
<?php _e( 'Vendor: '. $data['seller_name'], 'dokan-auction' ); echo " \n"; ?>
<?php _e( 'Category: '. $data['category'], 'dokan-auction' ); echo " \n"; ?>

<?php _e( 'The product is currently in "publish" state. So everyone can view the product.', 'dokan-auction' ); echo " \n";?>

<?php echo sprintf( __( 'In case it needs to be moderated  <a href="%s"> click here </a>', 'dokan-auction' ), $data['product_link'] ); ?>

<?php

echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
