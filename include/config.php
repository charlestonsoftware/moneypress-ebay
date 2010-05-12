<?php

/**
 * We need the generic WPCSL plugin class, since that is the
 * foundation of much of our plugin.  So here we make sure that it has
 * not already been loaded by another plugin that may also be
 * installed, and if not then we load it.
 */
if (class_exists('wpCSL_plugin') === false) {
    require_once(CJPLUGINDIR.'WPCSL-generic/CSL-plugin.php');
}

//// SETTINGS ////////////////////////////////////////////////////////

/**
 * This section defines the settings for the admin menu.
 */

$MP_ebay_plugin = new wpCSL_plugin(
    array(
        'self'             => 'MP_ebay_plugin',
        'prefix'           => 'csl-mp-ebay',
        'name'             => 'Moneypress eBay Edition',
        'url'              => 'http://cybersprocket.com/products/moneypress-ebay/',
        'paypal_button_id' => 'LJHLF4BHYMZMQ'
    )
);

$MP_ebay_plugin->settings->add_section(
    array(
        'name'        => 'Primary Settings',
        'description' => '<p>You will need an <a href="https://developer.ebay.com/join/Default.aspx" target="_new">eBay developer account</a> to fill in these fields.</p>'
    )
);

$MP_ebay_plugin->settings->add_item('Primary Settings', 'eBay App ID', 'csl-mp-ebay-app-id', 'text', false,
                           'Your eBay developer App ID.  You must enter this before the plugin is able to fetch products. ' .
                           'If you do not have one then <a href="https://developer.ebay.com/join/Default.aspx" target="_new">you can sign-up</a> ' .
                           'for a such an account at eBay.');
$MP_ebay_plugin->settings->add_item('Primary Settings', 'Number of Products', 'csl-mp-ebay-product-count', 'text', false,
                           'The number of products to show on your site.');

?>