<?php
/****************************************************************************
 ** file: csl_helpers.php
 **
 ** Helper functions for this plugin.
 ***************************************************************************/


/**************************************
 ** function: setup_admin_interface_for_mpebay
 **
 ** Builds the interface elements used by WPCSL-generic for the admin interface.
 **/
function setup_admin_interface_for_mpebay() {
    global $MP_ebay_plugin;     

    //-------------------------
    // Navbar Section
    //-------------------------
    //    
    $MP_ebay_plugin->settings->add_section(
        array(
            'name' => 'Navigation',
            'div_id' => 'mp_ebay_navbar',
            'description' => $MP_ebay_plugin->helper->get_string_from_phpexec(MP_EBAY_PLUGINDIR.'/templates/navbar.php'),
            'is_topmenu' => true,
            'auto' => false
        )
    );    
    
    // Then add our sections
    //
    $MP_ebay_plugin->settings->add_section(
        array(
            'name'              => 'How to Use',
            'description'       =>
                '<p>To use the MoneyPress eBay plugin you only need to add a simple '                   .
                'shortcode to any page where you want to show eBay products.  An example '              .
                'of the shortcode is <code>[ebay_show_items keywords="kitchen furniture"]</code>. '     .
                'Putting this code on a page would show ten products from eBay matching those '         .
                'keywords, along with links to each item and their current price.  If you want '        .
                'to change how many products are shown, you can either change the default value below ' .
                'or you can change it in the shortcode itself, e.g. <code>[ebay_show_items '            .
                'keywords="kitchen furniture" number_of_products=5]</code>, which would only show '       .
                'five items.</p>' .
                '<p>If you are an eBay merchant then you can enter your seller ID below, which will '        .
                'make the plugin only list the items you are selling.  You can do this in conjunction with ' .
                'keywords, or you can simply enter your seller ID below and use the shortcode '              .
                '<code>[ebay_show_items]</code> to list every item you are selling.</p>',
            'start_collapsed'   => true,
        )
    );
    
    $MP_ebay_plugin->settings->add_section(
        array(
            'name'        => 'Primary Settings',
            'description' => ''
        )
    );
    
    $MP_ebay_plugin->settings->add_item('Primary Settings', 'eBay Seller ID', 'sellers', 'text', false,
                                      'Your eBay seller ID.  If provided, the plugin will only shows products from you, ' .
                                      'or from whichever seller whose ID you enter.');
    
    $MP_ebay_plugin->settings->add_item('Primary Settings', 'Number of Products', 'product_count', 'text', false,
                               'The number of products to show on your site.');
    
    $MP_ebay_plugin->settings->add_item('Primary Settings',
                                      'Sort Items by Price',
                                      'sort_order',
                                      'list',
                                      false,
                                      '<p>Determines whether products are listed in order of most expensive ' .
                                      'or least expensive.  Note that the shipping cost is included in the ' .
                                      'total for the purposes of sorting.</p>',
                                      array(
                                          'No Sorting'    => 'no-sorting',
                                          'Lowest First'  => 'PricePlusShippingLowest',
                                          'Highest First' => 'PricePlusShippingHighest'
                                          )
        );
    
    $MP_ebay_plugin->settings->add_section(
        array(
            'name'        => 'Affiliate Settings',
            'description' =>
            '<p>Here you can provide your affiliate information, which will automatically be ' .
            'put into the links of for the products displayed on the site.</p>'
        )
    );
    
    $MP_ebay_plugin->settings->add_item('Affiliate Settings', 'Network ID', 
                                        'affiliate_info=>network_id', 'list', false,
                                      '<p>Specificies your tracking parnter for affiliate commissions.  This field is ' .
                                      'required if you provide a tracking ID.  For example, if you sign up at the ' .
                                      '<a href="https://www.ebaypartnernetwork.com/files/hub/en-US/index.html">eBay ' .
                                      'Partner Network</a> you will receive a confirmation email in a few days with ' .
                                      'tracking ID.',
                                      array(
                                          'eBay Partner Network' => 9,
                                          'Be Free'              => 2,
                                          'Affilinet'            => 3,
                                          'TradeDoubler'         => 4,
                                          'Mediaplex'            => 5,
                                          'DoubleClick'          => 6,
                                          'Allyes'               => 7,
                                          'BJMT'                 => 8
                                      )
        );
    
    $MP_ebay_plugin->settings->add_item('Affiliate Settings', 'Tracking ID', 'affiliate_info=>tracking_id', 'text', false,
                                      'The tracking ID provided to your by your tracking partner.  For some services ' .
                                      'this may be called your campaign ID or affiliate ID.');    
}

/**************************************
 ** function: setup_stylesheet_for_mpebay
 **
 ** Setup the CSS for the product pages.
 **/
function setup_stylesheet_for_mpebay() {
    global $MP_ebay_plugin;
    $MP_ebay_plugin->themes->assign_user_stylesheet();    
}

/**************************************
 ** function: setup_ADMIN_stylesheet_for_mpebay
 **
 ** Setup the CSS for the admin page.
 **/
function setup_ADMIN_stylesheet_for_mpebay() {            
    if ( file_exists(MP_EBAY_PLUGINDIR.'css/admin.css')) {
        wp_register_style('csl_mpebay_admin_css', MP_EBAY_PLUGINURL .'/css/admin.css'); 
        wp_enqueue_style ('csl_mpebay_admin_css');
    }      
}


/**************************************
 ** function: setup_admin_option_pages_for_mpebay
 **
 ** Setup the option pages for the admin interface.
 **/
function setup_admin_option_pages_for_mpebay() {
    global $MP_ebay_plugin;     
    add_submenu_page(
        'csl-mp-ebay-options',
        __("Settings: Plus", MP_EBAY_PREFIX), 
        __("Settings: Plus", MP_EBAY_PREFIX), 
        'administrator', 
        MP_EBAY_PLUGINDIR.'/settings_plus.php'
    );             
 }




 

