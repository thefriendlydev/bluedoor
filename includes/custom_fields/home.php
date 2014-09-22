<?php

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_hero-background-image',
    'title' => 'Hero Background Image',
    'fields' => array (
      array (
        'key' => 'field_540cbe61e97eb',
        'label' => 'Hero Background',
        'name' => 'hero_background',
        'type' => 'image',
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array (
    'id' => 'acf_primary-nav',
    'title' => 'Primary Nav',
    'fields' => array (
      array (
        'key' => 'field_540cbcc784b7d',
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
        'key' => 'field_540cbcee84b7e',
        'label' => 'Logo',
        'name' => 'logo',
        'type' => 'image',
        'instructions' => 'Your logo for the primary nav.',
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 1,
  ));
  register_field_group(array (
    'id' => 'acf_hero-taglines',
    'title' => 'Hero Taglines',
    'fields' => array (
      array (
        'key' => 'field_540cbb1b65f6d',
        'label' => 'Hero Large',
        'name' => 'hero_large',
        'type' => 'text',
        'default_value' => 'Tired of social not helping your bottom line?',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cbb5165f6e',
        'label' => 'Hero Regular',
        'name' => 'hero_regular',
        'type' => 'text',
        'default_value' => 'Unlock your full social marketing power with a focused strategy and execution',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cbb7565f6f',
        'label' => 'Hero Small Bold',
        'name' => 'hero_small_bold',
        'type' => 'text',
        'default_value' => 'The only partner focused entirely on your ROI',
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
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 2,
  ));
  register_field_group(array (
    'id' => 'acf_hero-form',
    'title' => 'Hero Form',
    'fields' => array (
      array (
        'key' => 'field_540cc29f4d929',
        'label' => 'Hero Form Main Tagline',
        'name' => 'hero_form_main_tagline',
        'type' => 'text',
        'default_value' => 'Stop losing time and money with social.',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cc3074d92a',
        'label' => 'Hero Form Sub Tagline',
        'name' => 'hero_form_sub_tagline',
        'type' => 'text',
        'default_value' => 'Get an initial assessment <span class="orange-underline">free.</span>',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_540cc3434d92b',
        'label' => 'Assessment Price',
        'name' => 'assessment_price',
        'type' => 'text',
        'default_value' => 299,
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
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 3,
  ));
  register_field_group(array (
    'id' => 'acf_services-taglines',
    'title' => 'Services Taglines',
    'fields' => array (
      array (
        'key' => 'field_541f9d604e6e5',
        'label' => 'Main Tagline',
        'name' => 'services_main_tagline',
        'type' => 'text',
        'default_value' => 'What We Offer',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541f9d964e6e6',
        'label' => 'Sub Tagline',
        'name' => 'services_sub_tagline',
        'type' => 'text',
        'default_value' => 'In a nutshell, we use social media to deliver real business results and drive your bottom line. ROI is King.',
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
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 4,
  ));
  register_field_group(array (
    'id' => 'acf_service-1',
    'title' => 'Service 1',
    'fields' => array (
      array (
        'key' => 'field_541fa3fe4e697',
        'label' => 'Service Title',
        'name' => 'service_title_1',
        'type' => 'text',
        'default_value' => 'Strategy Development & Execution',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541fa4344e698',
        'label' => 'Service Short Description',
        'name' => 'service_short_description_1',
        'type' => 'text',
        'default_value' => 'We develop and present a complete strategy tailored to your business objectives. This is a one of a kind Expect a thorough competitive analysis, content marketing plan, audience research, advertising campaign proposals, ROI tracking and detailed execution plan. This one of a kind document is designed in such a way that you can easily hand it off to your internal marketing team for execution, or let us manage it entirely on your behalf.',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_541fa45e4e699',
        'label' => 'Service Expanded Info',
        'name' => 'service_expanded_info',
        'type' => 'wysiwyg',
        'default_value' => '<p>Before you start doing social, you need to know what you should be doing. Do you know where you stand among your competitors? What are the industry leaders doing? What are you immediate opportunities? How many resources will you require to get where you need to be? How will you measure results? We will answer these and many other questions in this all-inclusive document. </p>

  <p>Check out this short video to learn more about our approach to social media strategy development</p>

  [youtube_video id="VkxYGJk9pwE"]',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-bluedoor.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 5,
  ));
}
