<?php

/**
 * We need both of the WPCSL-generic and WPCSL-license sub-modules to
 * be available for the plugin to work.  Otherwise we die immediately
 * with a cryptic message to the user, which means we haven't done our
 * job very well---we should never be releasing the plugin without
 * these sub-modules.
 */

if (class_exists('wpCSL_Settings') === false) {
    require_once(CJPLUGINDIR.'/WPCSL-generic/CSL-generic.php');
}
else {
    die('Missing WPCSL-generic sub-module.');
}

if (function_exists('wpCSL_check_license_key') === false) {
    require_once(CJPLUGINDIR.'/WPCSL-license/CSL-license.php');
}
else {
    die('Missing WPCSL-license sub-module.');
}

?>