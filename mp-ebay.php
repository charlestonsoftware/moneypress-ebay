<?php
/*
  Plugin Name: MoneyPress : eBay Edition
  Plugin URI: http://www.cybersprocket.com/products/moneypress-ebay/
  Description: Our MoneyPress eBay plugin allows you to display products from eBay on your web site.
  Version: 1.2.2
  Author: Cyber Sprocket Labs
  Author URI: http://www.cybersprocket.com
  License: GPL3
*/

/* mp-ebay.php --- MoneyPress : eBay Edition                              */

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

if (defined('MP_EBAY_PLUGINDIR') === false) {
    define('MP_EBAY_PLUGINDIR', plugin_dir_path(__FILE__));
}

if (defined('MP_EBAY_PLUGINURL') === false) {
    define('MP_EBAY_PLUGINURL', plugins_url('',__FILE__));
}

if (defined('MP_EBAY_BASENAME') === false) {
    define('MP_EBAY_BASENAME', plugin_basename(__FILE__));
}

require_once('include/config.php');

?>
