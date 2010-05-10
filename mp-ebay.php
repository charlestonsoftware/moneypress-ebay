<?php
/*
  Plugin Name: Moneypress eBay Edition
  Plugin URI: http://www.cybersprocket.com/products/moneypress-ebay/
  Description: Our Moneypress eBay plugin allows you to display products from eBay on your web site.
  Version: 1.0
  Author: Cyber Sprocket Labs
  Author URI: http://www.cybersprocket.com
  License: GPL3
*/

/* mp-ebay.php --- Moneypress eBay Edition                              */

/* Copyright (C) 2010 Cyber Sprocket Labs <info@cybersprocket.com>      */

/* Authors: Eric James Michael Ritz <Eric@cybersprocket.com>            */

/* This program is free software; you can redistribute it and/or        */
/* modify it under the terms of the GNU General Public License          */
/* as published by the Free Software Foundation; either version 3       */
/* of the License, or (at your option) any later version.               */

/* This program is distributed in the hope that it will be useful,      */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of       */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        */
/* GNU General Public License for more details.                         */

/* You should have received a copy of the GNU General Public License    */
/* along with this program. If not, see <http://www.gnu.org/licenses/>. */

define('CJPLUGINDIR', plugin_dir_path(__FILE__));

require_once('include/config.php');
require_once('Panhandler/Panhandler.php');
require_once('Panhandler/Drivers/eBay.php');

/**
 * Add the [ebay_show_items] short code.  The code requires the
 * attribute 'keywords', which is a list of product keywords to search
 * for.  The keywords should be separated by white-space.
 */
add_shortcode('ebay_show_items', 'MP_ebay_show_items');

//// FUNCTIONS ///////////////////////////////////////////////////////

/**
 * Processes our short code.
 */
function MP_ebay_show_items($attributes, $content = null) {
    extract(
        shortcode_atts(
            array('keywords' => ''),
            $attributes
        )
    );

    // If we have no keywords then we just bail without showing any
    // content to the user.
    if ($keywords === '') {
        return;
    }

    $app_id = get_option('csl-mp-ebay-app-id');
    $ebay   = new eBayPanhandler($app_id);

    return MP_ebay_format_all_products(
        $ebay->get_products_by_keywords(array($keywords))
    );
}

/**
 * Takes an PanhandlerProduct object and returns a string of HTML
 * suitabale for displaying that product.
 */
function MB_ebay_format_product($product) {
    return sprintf(
        '<p><a href="%s">%s</a></p>',
        $product->web_urls[0],
        $product->name
    );
}

/**
 * Takes an array of PanhandlerProduct objects and returns all of the
 * HTML for displaying them on the page.
 */
function MP_ebay_format_all_products($products) {
    return implode('', array_map('MB_ebay_format_product', $products));
}

?>