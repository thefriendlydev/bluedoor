<?php

class HomeHelpers {
  public static function nav_tagline() {
    $nav_tagline = the_field("nav_tagline");
    return $nav_tagline;
  }

  public static function hero_background() {
    $hero_background = the_field("hero_background");
    return $hero_background;
  }


  // public static function end_date() {
  //   $value = DateTime::createFromFormat('Ymd', get_field('event_end_date'));
  //   return $value->format('d');
  // }

  // public static function start_date() {
  //   $value = DateTime::createFromFormat('Ymd', get_field('event_start_date'));
  //   return $value->format('d');
  // }

  // public static function hero_image() {
  //   $hero_image = get_field('hero_image');
  //   return $hero_image['url'];
  // }

  // public static function province() {
  //   $province = the_field("province");
  //   return ucfirst($province);
  // }

  // public static function town_name() {
  //   $town_name = the_field('town_name');
  //   return $town_name;
  // }

}