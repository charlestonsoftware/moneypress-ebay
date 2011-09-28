<?php

/**
 * We need the generic WPCSL plugin class, since that is the
 * foundation of much of our plugin.  So here we make sure that it has
 * not already been loaded by another plugin that may also be
 * installed, and if not then we load it.
 */
if (defined('MP_EBAY_PLUGINDIR')) {
    if (class_exists('wpCSL_plugin__mpebay') === false) {
        require_once(MP_EBAY_PLUGINDIR.'WPCSL-generic/classes/CSL-plugin.php');
    }
    
    /**
     * This section defines the settings for the admin menu.
     */    
    global $MP_ebay_plugin; 
    $MP_ebay_plugin = new wpCSL_plugin__mpebay(
        array(
            'prefix'                 => MP_EBAY_PREFIX,
            'name'                   => 'MoneyPress : eBay Edition',
            'url'                    => 'http://cybersprocket.com/products/moneypress-ebay/',
            'support_url'            => 'http://redmine.cybersprocket.com/projects/mpress-ebay',
            'purchase_url'           => 'http://cybersprocket.com/products/moneypress-ebay-edition/',
            'cache_path'             => MP_EBAY_PLUGINDIR,
            'plugin_url'             => MP_EBAY_PLUGINURL,
            'plugin_path'            => MP_EBAY_PLUGINDIR,
            'basefile'               => MP_EBAY_BASENAME,
            'has_packages'           => true,
            
            'helper_obj_name'        => 'default',
            'notifications_obj_name' => 'default',
            'settings_obj_name'      => 'default',
            'license_obj_name'       => 'default',
            'themes_obj_name'        => 'default',
            
            'driver_name'            => 'eBay',
            'driver_type'            => 'Panhandler',
            'driver_defaults' => array(
                    'keywords' => 'keywords',
                    'sellers' => 'sellers',
                    'category_id' => 'category_id',
                    'sort_order' => 'sort_order',
                    'product_count' => 'product_count',
                    'affiliate_info' => array('network_id', 'tracking_id')
                ),
            'driver_args'            => array(
                'app_id' => "CyberSpr-e973-4a45-ad8b-430a8ee3b190"
            ),
            'shortcodes'             => array('ebay_show_items'),
            
        )
    );
}
