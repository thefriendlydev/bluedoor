<?php
/*
 Template Name: Bluedoor Homepage
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

<?php get_template_part('partials/home/hero'); ?>
<div id="services">
  <?php get_template_part('partials/home/services'); ?>
</div>
<div id="why-us">
  <?php get_template_part('partials/home/why_us'); ?>
</div>
<div id="clients">
  <?php get_template_part('partials/home/clients'); ?>
</div>
<div id="blog">
  <?php get_template_part('partials/home/blog'); ?>
</div>
<div id="contact">
  <?php get_footer(); ?>
</div>