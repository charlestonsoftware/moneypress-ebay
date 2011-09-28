<?php
/****************************************************************************
 ** file: templates/navbar.php
 **
 ** The top navigation bar.
 ***************************************************************************/
 
 global $MP_ebay_plugin;
?>

<ul>
    <li class='like-a-button'><a href="/wp-admin/options-general.php?page=csl-mp-ebay-options">Settings: General</a></li>    
    <?php 
    //--------------------------------
    // Plus Version : Show Plus Settings Tab
    //
    if (!$MP_ebay_plugin->license->packages['Plus Pack']->isenabled) {
        print '<li class="like-a-button"><a href="'.MP_EBAY_ADMINPAGE.'settings_plus.php">Settings: Plus</a></li>';
    }
    ?>    
</ul>


