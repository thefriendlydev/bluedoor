<?php
add_action( 'init', 'highline_menus' );
function highline_menus() {
    register_nav_menus(
        array(
            'hidden-nav' =>  'Hidden Navigation'
        )
    );
}