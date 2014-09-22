<?php

class HomeHelpers {
  public static function hero_background() {
    $hero_background = the_field("hero_background");
    return $hero_background;
  }

  public static function nav_tagline() {
    $nav_tagline = the_field("nav_tagline");
    return $nav_tagline;
  }

  public static function logo() {
    $logo = the_field("logo");
    return $logo;
  }

  public static function hero_large() {
    $hero_large = the_field("hero_large");
    return $hero_large;
  }

  public static function hero_regular() {
    $hero_regular = the_field("hero_regular");
    return $hero_regular;
  }

  public static function hero_small_bold() {
    $hero_small_bold = the_field("hero_small_bold");
    return $hero_small_bold;
  }

  public static function hero_form_main_tagline() {
    $hero_form_main_tagline = the_field("hero_form_main_tagline");
    return $hero_form_main_tagline;
  }

  public static function hero_form_sub_tagline() {
    $hero_form_sub_tagline = the_field("hero_form_sub_tagline");
    return $hero_form_sub_tagline;
  }

  public static function assessment_price() {
    $assessment_price = the_field("assessment_price");
    return $assessment_price;
  }

  public static function services_main_tagline() {
    $services_main_tagline = the_field("services_main_tagline");
    return $services_main_tagline;
  }

  public static function services_sub_tagline() {
    $services_sub_tagline = the_field("services_sub_tagline");
    return $services_sub_tagline;
  }

}