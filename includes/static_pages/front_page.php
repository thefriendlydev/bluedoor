<?php

class FrontPage {

  function __construct() {
    add_action('wp', [$this, 'determine_route']);
  }

  function determine_route($wp) {
    if(is_front_page()) {

    }
  }

}

$FrontPage = new FrontPage();