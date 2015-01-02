<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

  register_sidebar( array(
    'name' => 'Right Blog Sidebar',
    'id' => 'right_sidebar',
    'before_widget' => '<div class="sidebar-widget">',
    'after_widget' => '</div>',
    'before_title' => '<div class="sidebar-title">',
    'after_title' => '</div>',
  ) );

  // register_sidebar( array(
  //   'name' => 'Right Services Sidebar',
  //   'id' => 'right_services_sidebar',
  //   'before_widget' => '<div class="sidebar-widget">',
  //   'after_widget' => '</div>',
  //   'before_title' => '<div class="sidebar-title">',
  //   'after_title' => '</div>',
  // ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );
?>