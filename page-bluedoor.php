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

  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <div class="section hero event-page">
      <div class="bg-image" style="background-image: url(<?= HomeHelpers::hero_background(); ?>)">
        <div class="container">
          <div class="grid">
            <div class="grid__item one-half lap--two-fifths palm--one-whole">

            </div>
            <div class="grid__item one-half lap--three-fifths palm--one-whole">

            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; endif; ?>

<?php get_footer(); ?>