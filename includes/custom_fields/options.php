<?php

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_header',
    'title' => 'Header',
    'fields' => array (
      array (
        'key' => 'field_5449dc58fccf3',
        'label' => 'Header Logo',
        'name' => 'header_logo',
        'type' => 'image',
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
      array (
        'key' => 'field_5449dc73fccf4',
        'label' => 'Main Tagline',
        'name' => 'main_tagline',
        'type' => 'text',
        'default_value' => 'A Social Media Company',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array (
    'id' => 'acf_contact-footer',
    'title' => 'Contact Footer',
    'fields' => array (
      array (
        'key' => 'field_5449de68f5b37',
        'label' => 'Contact Main Tagline',
        'name' => 'contact_main_tagline',
        'type' => 'text',
        'default_value' => 'We\'re Here to Help',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5449de87f5b38',
        'label' => 'Contact Sub Tagline',
        'name' => 'contact_sub_tagline',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5449de9df5b39',
        'label' => 'Contact Form Shortcode',
        'name' => 'contact_form_shortcode',
        'type' => 'text',
        'required' => 1,
        'default_value' => '[contact-form-7 id="67" title="Contact Us Form"]',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5449de8rgiurwg877f5b38',
        'label' => 'Footer Copyright',
        'name' => 'footer_copyright',
        'type' => 'text',
        'default_value' => '© Copyright 2014 Blue Door Inc. All Rights Reserved.',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}
