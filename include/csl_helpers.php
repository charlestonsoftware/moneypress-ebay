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

    // First setup our optional packages
    //
    list_options_packages_for_mpebay();
    

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

    // Register CSS
    //
    wp_register_style( 'csl-mp_ebay-css', plugins_url('stylesheet.css', __FILE__) );    
    
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
 ** function: list_options_packages_for_mpebay
 **
 ** Setup the option package list.
 **/
function list_options_packages_for_mpebay() {
    global $MP_ebay_plugin;   
    $MP_ebay_plugin->license->add_licensed_package(
            array(
                'name'              => 'Plus Pack',
                'help_text'         => 'A variety of enhancements are provided with this package.  ' .
                                       'See the <a href="'.$MP_ebay_plugin->purchase_url.'" target="Cyber Sprocket">product page</a> for details.  If you purchased this add-on ' .
                                       'come back to this page to enter the license key to activate the new features.',
                'sku'               => 'MPEBY-PLUS',
                'paypal_button_id'  => 'LJHLF4BHYMZMQ'
            )            
        );
}


/**************************************
 ** function: add_plus_settings_for_mpebay()
 ** 
 ** Add the plus settings to the settings interface.
 **
 **/
function add_plus_settings_for_mpebay() {
    global $MP_ebay_plugin;         
    
    // The Themes
    // No themes? Force the default at least
    //
    $themeArray = get_option(MP_EBAY_PREFIX.'-theme_array');
    if (count($themeArray, COUNT_RECURSIVE) <= 2) {
        $themeArray = array('Off-White Single Column' => 'mp-offwhite');
    }    

    // Check for theme files
    //
    $lastNewThemeDate = get_option(MP_EBAY_PREFIX.'-theme_lastupdated');
    $newEntry = array();
    if ($dh = opendir(MP_EBAY_PLUGINDIR.'css/')) {
        while (($file = readdir($dh)) !== false) {
            
            // If not a hidden file
            //
            if (!preg_match('/^\./',$file)) {                
                $thisFileModTime = filemtime(MP_EBAY_PLUGINDIR.'css/'.$file);
                
                // We have a new theme file possibly...
                //
                if ($thisFileModTime > $lastNewThemeDate) {
                    $newEntry = GetThemeInfo(MP_EBAY_PLUGINDIR.'css/'.$file);
                    $themeArray = array_merge($themeArray, array($newEntry['label'] => $newEntry['file']));                                        
                    update_option(MP_EBAY_PREFIX.'-theme_lastupdated', $thisFileModTime);
                }
            }
        }
        closedir($dh);
    }
    
    // We added at least one new theme
    //
    if (count($newEntry, COUNT_RECURSIVE) > 1) {
        update_option(MP_EBAY_PREFIX.'-theme_array',$themeArray);
    }  
        
    $MP_ebay_plugin->settings->add_item(
        'Product Display', 
        'Select A Theme',   
        'theme',    
        'list', 
        false, 
        'How should the plugin UI elements look?',
        $themeArray
    );
}
 
/**************************************
 ** function: csl_mpcafe_configure_theme
 ** 
 ** Configure the plugin theme drivers based on the theme file meta data.
 **
 **/
 function configure_theme_for_mpebay($themeFile) {
    global $MP_ebay_plugin;
    
    $newEntry = GetThemeInfo(MP_EBAY_PLUGINDIR.$themeFile);
    $MP_ebay_plugin->products->columns = $newEntry['columns'];
 }
 
 
/**************************************
 ** function: GetThemeInfo
 ** 
 ** Extract the label & key from a CSS file header.
 **
 **/
function GetThemeInfo ($filename) {    
    $dataBack = array();
    if ($filename != '') {
       $default_headers = array(
            'label' => 'label',
            'file' => 'file',
            'columns' => 'columns'
           );
        
       $dataBack = get_file_data($filename,$default_headers,'');
       $dataBack['file'] = preg_replace('/.css$/','',$dataBack['file']);       
    }
    
    return $dataBack;
 }
 
