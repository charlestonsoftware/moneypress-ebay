<?php
/****************************************************************************
 ** file: settings_plus.php
 **
 ** Settings available in the plus edition.
 ***************************************************************************/

// Instantiate the form rendering object
//
global $MP_ebay_plugin;
global $ebPlusSettings;
$ebPlusSettings = new wpCSL_settings__mpebay(
    array(
            'no_license'        => true,
            'prefix'            => $MP_ebay_plugin->prefix,
            'url'               => $MP_ebay_plugin->url,
            'name'              => $MP_ebay_plugin->name . ' - Plus Pack Settings',
            'plugin_url'        => $MP_ebay_plugin->plugin_url,
            'render_csl_blocks' => false,
            'settings_obj_name' => 'default'            
        )
 ); 


//-------------------------
// Navbar Section
//-------------------------
//    
$ebPlusSettings->add_section(
    array(
        'name' => 'Navigation',
        'div_id' => 'mp_ebay_navbar',
        'description' => $MP_ebay_plugin->helper->get_string_from_phpexec(MP_EBAY_PLUGINDIR.'/templates/navbar.php'),
        'is_topmenu' => true,
        'auto' => false
    )
);


$ebPlusSettings->render_settings_page();

