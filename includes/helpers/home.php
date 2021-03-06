<?php

class HomeHelpers {
  // HERO SECTION
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

  // SERVICES SECTION
  public static function services_main_tagline() {
    $services_main_tagline = the_field("services_main_tagline");
    return $services_main_tagline;
  }

  public static function services_sub_tagline() {
    $services_sub_tagline = the_field("services_sub_tagline");
    return $services_sub_tagline;
  }

  public static function service_title_1() {
    $service_title_1 = the_field("service_title_1");
    return $service_title_1;
  }

  public static function service_short_description_1() {
    $service_short_description_1 = the_field("service_short_description_1");
    return $service_short_description_1;
  }

  public static function service_expanded_info_1() {
    $service_expanded_info_1 = the_field("service_expanded_info_1");
    return $service_expanded_info_1;
  }

  public static function service_title_2() {
    $service_title_2 = the_field("service_title_2");
    return $service_title_2;
  }

  public static function service_short_description_2() {
    $service_short_description_2 = the_field("service_short_description_2");
    return $service_short_description_2;
  }

  public static function service_expanded_info_2() {
    $service_expanded_info_2 = the_field("service_expanded_info_2");
    return $service_expanded_info_2;
  }

  public static function service_title_3() {
    $service_title_3 = the_field("service_title_3");
    return $service_title_3;
  }

  public static function service_short_description_3() {
    $service_short_description_3 = the_field("service_short_description_3");
    return $service_short_description_3;
  }

  public static function service_expanded_info_3() {
    $service_expanded_info_3 = the_field("service_expanded_info_3");
    return $service_expanded_info_3;
  }

  //WHY US SECTION
  public static function why_us_main_tagline() {
    $why_us_main_tagline = the_field("why_us_main_tagline");
    return $why_us_main_tagline;
  }

  public static function why_us_sub_tagline() {
    $why_us_sub_tagline = the_field("why_us_sub_tagline");
    return $why_us_sub_tagline;
  }

  //CLIENTS SECTION
  public static function clients_main_tagline() {
    $clients_main_tagline = the_field("clients_main_tagline");
    return $clients_main_tagline;
  }

  public static function clients_sub_tagline() {
    $clients_sub_tagline = the_field("clients_sub_tagline");
    return $clients_sub_tagline;
  }

  //BLOG
  public static function blog_main_tagline() {
    $blog_main_tagline = the_field("blog_main_tagline");
    return $blog_main_tagline;
  }

  public static function blog_sub_tagline() {
    $blog_sub_tagline = the_field("blog_sub_tagline");
    return $blog_sub_tagline;
  }

  public static function essential_grid_shortcode() {
    $essential_grid_shortcode = the_field("essential_grid_shortcode");
    return $essential_grid_shortcode;
  }

  //CONTACT US SECTION
  public static function contact_us_main_tagline() {
    $contact_us_main_tagline = the_field("contact_us_main_tagline");
    return $contact_us_main_tagline;
  }

  public static function contact_us_sub_tagline() {
    $contact_us_sub_tagline = the_field("contact_us_sub_tagline");
    return $contact_us_sub_tagline;
  }
}