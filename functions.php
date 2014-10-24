<?php

//-- Plugins --------------------------------------------------------------
include_once 'plugins/advanced-custom-fields/acf.php';
include_once 'plugins/acf-repeater/acf-repeater.php';
include_once 'plugins/wp-stage-switcher/wp-stage-switcher.php';
include_once 'plugins/acf-options-page/acf-options-page.php';



//-- Utils ----------------------------------------------------------------


//-- Custom Post Types ----------------------------------------------------

//-- Helpers --------------------------------------------------------------
require_once 'includes/helpers/home.php';

//-- Static Pages ---------------------------------------------------------

add_action( 'wp_enqueue_script', 'load_jquery' );
function load_jquery() {
    wp_enqueue_script( 'jquery' );
}


//-- Custom Fields Definitions --------------------------------------------
require_once 'includes/custom_fields/home.php';
require_once 'includes/custom_fields/options.php';