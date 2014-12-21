<?php
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_post-single',
    'title' => 'Post Single',
    'fields' => array (
      array (
        'key' => 'field_5496534df95f0',
        'label' => 'Post Thumbnail',
        'name' => 'post_thumbnail',
        'type' => 'image',
        'instructions' => 'Add post thumbnail for related posts.',
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}
