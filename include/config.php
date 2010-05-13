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
        'name' => 'How to Use',
        'description' =>
        '<p>To use the Moneypress eBay plugin you only need to add a simple '                   .
        'shortcode to any page where you want to show eBay products.  An example '              .
        'of the shortcode is <code>[ebay_show_items keywords="kitchen furniture"]</code>. '     .
        'Putting this code on a page would show ten products from eBay matching those '         .
        'keywords, along with links to each item and their current price.  If you want '        .
        'to change how many products are shown, you can either change the default value below ' .
        'or you can change it in the shortcode itself, e.g. <code>[ebay_show_items '            .
        'keywords="kitchen furniture" products_to_show=5]</code>, which would only show '       .
        'five items.</p>'
    )
);

$MP_ebay_plugin->settings->add_section(
    array(
        'name'        => 'Primary Settings',
        'description' => '<p>You will need an <a href="https://developer.ebay.com/join/Default.aspx" target="_new">eBay developer account</a> to fill in these fields.</p>'
    )
);

$MP_ebay_plugin->settings->add_item('Primary Settings', 'eBay App ID', 'csl-mp-ebay-app-id', 'text', true,
                           'Your eBay developer App ID.  You must enter this before the plugin is able to fetch products. ' .
                           'If you do not have one then <a href="https://developer.ebay.com/join/Default.aspx" target="_new">you can sign-up</a> ' .
                           'for a such an account at eBay.');
$MP_ebay_plugin->settings->add_item('Primary Settings', 'Number of Products', 'csl-mp-ebay-product-count', 'text', false,
                           'The number of products to show on your site.');

?>