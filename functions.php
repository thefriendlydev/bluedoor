<?php

//-- Plugins --------------------------------------------------------------
include_once 'plugins/advanced-custom-fields/acf.php';
include_once 'plugins/acf-repeater/acf-repeater.php';
include_once 'plugins/acf-flexible-content/acf-flexible-content.php';
include_once 'plugins/wp-stage-switcher/wp-stage-switcher.php';
include_once 'plugins/acf-options-page/acf-options-page.php';



//-- Utils ----------------------------------------------------------------


//-- Custom Post Types ----------------------------------------------------

//-- Helpers --------------------------------------------------------------
require_once 'includes/helpers/home.php';

//-- WordPress Functuons --------------------------------------------------
require_once 'includes/wordpress_functions/image_overrides.php';
require_once 'includes/wordpress_functions/menus.php';
require_once 'includes/wordpress_functions/featured_image.php';
require_once 'includes/wordpress_functions/sidebars.php';

//-- Static Pages ---------------------------------------------------------

add_action( 'wp_enqueue_script', 'load_jquery' );
function load_jquery() {
    wp_enqueue_script( 'jquery' );
}


//-- Custom Fields Definitions --------------------------------------------
require_once 'includes/custom_fields/home.php';
require_once 'includes/custom_fields/options.php';
require_once 'includes/custom_fields/post_single.php';
require_once 'includes/custom_fields/service_page.php';
require_once 'includes/custom_fields/white_paper_page.php';