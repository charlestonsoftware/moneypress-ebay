<?php

if (class_exists('wpCSL_Settings') === false) {
    require_once(CJPLUGINDIR.'/WPCSL-generic/CSL-generic.php');
}

if (function_exists('wpCSL_check_license_key') === false) {
    require_once(CJPLUGINDIR.'/WPCSL-license/CSL-license.php');
}

?>