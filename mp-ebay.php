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
define('CJPLUGINURL', plugins_url('',__FILE__));

require_once('include/config.php');

if (class_exists('eBayPanhandler') === false) {
    try {
        require_once('Panhandler/Panhandler.php');
        require_once('Panhandler/Drivers/eBay.php');
    }
    catch (PanhandlerMissingRequirement $exception) {
        add_action('admin_notices', array($exception, 'getMessage'));
        exit(1);
    }
}

add_filter('wp_print_styles', 'MP_ebay_user_css');

/**
 * Add the [ebay_show_items] short code.  The code requires the
 * attribute 'keywords', which is a list of product keywords to search
 * for.  The keywords should be separated by white-space.
 *
 * The shortcode optionally accepts an attribute 'products_to_show'
 * which takes a number and controls how many products should be
 * displayed on the page.
 */
add_shortcode('ebay_show_items', 'MP_ebay_show_items');

//// FUNCTIONS ///////////////////////////////////////////////////////

/**
 * Adds our user CSS to the page.
 */
function MP_ebay_user_css() {
    wp_enqueue_style('mp_ebay_css', plugins_url('css/mp-ebay.css', __FILE__));
}

/**
 * Processes our short code.
 */
function MP_ebay_show_items($attributes, $content = null) {
    global $current_user;
    get_currentuserinfo();

    // Make sure the user is either an admin, in which case he
    // gets to view the results of the plugin, or otherwise
    // make sure the license has been purchased.
    if (($current_user->wp_capabilities['administrator'] == false) &&
        ($current_user->user_level != '10') &&
        (get_option('csl-mp-ebay-purchased') == false)) {
        return;
    }

    extract(
        shortcode_atts(
            array(
                'keywords' => null,
                'products_to_show' => null
            ),
            $attributes
        )
    );

    // If we have no keywords then we just bail without showing any
    // content to the user.
    if ($keywords === null) {
        return;
    }

    $ebay = new eBayPanhandler("CyberSpr-e973-4a45-ad8b-430a8ee3b190");

    if ($attributes['products_to_show']) {
        $product_count = $attributes['products_to_show'];
    }
    else {
        $product_count = get_option('csl-mp-ebay-product-count');
    }

    if ($product_count) {
        $ebay->set_maximum_product_count($product_count);
    }

    return MP_ebay_format_all_products(
        $ebay->get_products_by_keywords(array($keywords))
    );
}

/**
 * This is our HTML template for display products, which we use as an
 * argument to sprintf() in the MB_ebay_format_product() function just
 * below.  Eventually this will get factored out elsewhere.  Or that's
 * on the todo list anyways.  We'll see.  For all I know, a ravaging
 * yeti could attack the office and kill us all before we have a
 * chance to get around to it.
 */
$MB_ebay_product_template = '<div class="csl-ebay-product">
  <!-- Product Name -->
  <h3><a href="%s">%s</a></h3>
  <div class="csl-ebay-product-image">
    <!-- Image URL and Link -->
    <a href="%s" target="_new">
      <img src="%s" alt="%s"/>
    </a>
  </div>
  <!-- Description -->
  <p>%s</p>
  <!-- Price and Purchase URL -->
  <p>
    <a href="%s" target="_new">
      Purchase for %s
    </a>
  </p>
  <div style="clear: both;"></div>
</div>';

/**
 * Takes an PanhandlerProduct object and returns a string of HTML
 * suitabale for displaying that product.
 */
function MB_ebay_format_product($product) {
    global $MB_ebay_product_template;
    return sprintf(
        $MB_ebay_product_template,
        $product->web_urls[0],
        $product->name,
        $product->web_urls[0],
        $product->image_urls[0],
        $product->name,
        $product->description,
        $product->web_urls[0],
        money_format('$%i', $product->price)
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
