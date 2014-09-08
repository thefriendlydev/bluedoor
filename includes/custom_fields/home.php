<?php

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_bluedoor-homepage',
    'title' => 'Bluedoor Homepage',
    'fields' => array (
      array (
        'key' => 'field_54050c730d220',
        'label' => 'Nav Tagline',
        'name' => 'nav_tagline',
        'type' => 'text',
        'instructions' => 'Text in top right of nav.',
        'default_value' => 'A Social Media Company',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5405116996d9c',
        'label' => 'Logo',
        'name' => 'logo',
        'type' => 'image',
        'instructions' => 'Your logo for the top nav.',
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
      array (
        'key' => 'field_5405128267d41',
        'label' => 'Hero Background',
        'name' => 'hero_background',
        'type' => 'image',
        'instructions' => 'The background image for your hero section.',
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
      array (
        'key' => 'field_540ca012d0765',
        'label' => 'Hero Contact Form',
        'name' => 'hero_contact_form',
        'type' => 'acf_cf7',
        'instructions' => 'Select the desired contact form.',
        'disable' => array (
          0 => 1,
        ),
        'allow_null' => 0,
        'multiple' => 0,
        'hide_disabled' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page',
          'operator' => '==',
          'value' => '11',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}
