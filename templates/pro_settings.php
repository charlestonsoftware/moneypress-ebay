<?php
global $MP_ebay_plugin;

// Instantiate the form rendering object
//
global $ebPlusSettings;
$ebPlusSettings = new wpCSL_settings__mpebay(
    array(
            'no_license'        => true,
            'prefix'            => MP_EBAY_PREFIX,
            'url'               => $MP_ebay_plugin->url,
            'name'              => $MP_ebay_plugin->name . ' - Pro Pack Settings',
            'plugin_url'        => $MP_ebay_plugin->plugin_url,
            'form_action'       => MP_EBAY_ADMINPAGE . 'settings_plus.php',
            'themes_enabled'    => true,
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



// Pro Pack Only
//
if ($MP_ebay_plugin->license->packages['Pro Pack']->isenabled_after_forcing_recheck()) {

    //---------------
    // Update Options
    //---------------
    if ($_POST) {
        update_option(MP_EBAY_PREFIX.'-theme',$_POST[MP_EBAY_PREFIX.'-theme']);
    }

    //-------------------------
    // Display Settings Section
    //-------------------------
    //
    $ebPlusSettings->add_section(
        array(
            'name' => __('Display Settings',MP_EBAY_PREFIX),
            'description' => ''
        )
    );
    $MP_ebay_plugin->themes->add_admin_settings($ebPlusSettings);

} else {

    //-------------------------
    // Info Panel
    //-------------------------
    //
    $ebPlusSettings->add_section(
        array(
            'name' => __('Pro Pack',MP_EBAY_PREFIX),
            'description' =>
                __('The Pro Pack extends the features and settings of this plugin.', MP_EBAY_PREFIX) .
                '<br/>'.
                sprintf(__('Visit <a href="%s">%s</a> to learn more.', MP_EBAY_PREFIX), $MP_ebay_plugin->purchase_url, $MP_ebay_plugin->purchase_url) .
                '<div style="clear:both;">' . $MP_ebay_plugin->settings->ListThePackages(false) . '</div>'
        )
    );
}


$ebPlusSettings->render_settings_page();


?>

