<?php
/*
Plugin Name: Account Page
Plugin URI: http://www.imran1.com/
Description: Account New Page with End Point.
Version: 1.0
Author: Imran Khan
Author URI: http://www.imran1.com/
*/


/**
 * Insert the new endpoint into the My Account menu.
 *
 * @param array $items
 * @return array
 */
function my_custom_my_account_menu_items( $items ) {
    // Remove the logout menu item.
    $logout = $items['customer-logout'];
    unset( $items['customer-logout'] );

    // Insert your custom endpoint.
    $items['my-custom-endpoint'] = __( 'My Custom Endpoint', 'woocommerce' );

    // Insert back the logout item.
    $items['customer-logout'] = $logout;

    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'my_custom_my_account_menu_items' );


function flush_rules(){
  add_rewrite_endpoint( 'my-custom-endpoint', EP_ROOT | EP_PAGES );
    flush_rewrite_rules();
}
add_action('init','flush_rules');


/**
 * Endpoint HTML content.
 */
function my_custom_endpoint_content() {
    echo '<p>Hello World!</p>';
    //include WP_PLUGIN_DIR . '\woocommerce/templates/myaccount/my-custom-endpoint.php';
    
     include 'my-custom-endpoint.php';
}

add_action( 'woocommerce_account_my-custom-endpoint_endpoint', 'my_custom_endpoint_content' );