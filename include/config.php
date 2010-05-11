<?php

/**
 * We need both of the WPCSL-generic and WPCSL-license sub-modules to
 * be available for the plugin to work.  Otherwise we die immediately
 * with a cryptic message to the user, which means we haven't done our
 * job very well---we should never be releasing the plugin without
 * these sub-modules.
 */

if (class_exists('wpCSL_Settings') === false) {
    require_once(CJPLUGINDIR.'/WPCSL-generic/CSL-generic.php');
}

if (function_exists('wpCSL_check_license_key') === false) {
    require_once(CJPLUGINDIR.'/WPCSL-license/CSL-license.php');
}

//// SETTINGS ////////////////////////////////////////////////////////

/**
 * This section defines the settings for the admin menu.
 */

$MP_ebay_settings = new wpCSL_Settings(
    array(
        'prefix'           => 'csl-mp-ebay',
        'name'             => 'Moneypress eBay Edition',
        'url'              => 'http://cybersprocket.com/products/moneypress-ebay/',
        'paypal_button_id' => 'LJHLF4BHYMZMQ'
    )
);

$MP_ebay_settings->add_section(
    array(
        'name'        => 'Primary Settings',
        'description' => '<p>You will need an <a href="https://developer.ebay.com/join/Default.aspx" target="_new">eBay developer account</a> to fill in these fields.</p>'
    )
);

$MP_ebay_settings->add_item('Primary Settings', 'eBay App ID', 'csl-mp-ebay-app-id', 'text', false,
                           'Your eBay developer App ID.  You must enter this before the plugin is able to fetch products. ' .
                           'If you do not have one then <a href="https://developer.ebay.com/join/Default.aspx" target="_new">you can sign-up</a> ' .
                           'for a such an account at eBay.');
$MP_ebay_settings->add_item('Primary Settings', 'Number of Products', 'csl-mp-ebay-product-count', 'text', false,
                           'The number of products to show on your site.');

?>