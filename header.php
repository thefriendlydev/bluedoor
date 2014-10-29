<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title( 'Bluedoor Inc. - ', true, 'left' ); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php bloginfo('template_url'); ?>/dist/css/vendor.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/dist/css/application.css" rel="stylesheet">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- Typekit Fonts -->
    <script type="text/javascript" src="//use.typekit.net/giy3kov.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    <?php wp_head(); ?>
  </head>
    <body <?php body_class(); ?>>

      <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
      <div class='primary-nav'>
        <div class="primary-nav--left">
          <div class="logo-section">
            <a href="/"><img class="logo" src="<?php the_field('header_logo', 'option'); ?>"></a>
            <div class="tagline"><?php the_field('main_tagline', 'option'); ?></div>
          </div>
        </div>

        <div class="primary-nav--right">
          <div class="links">
            <div class="menu">
              <ul>
                <li><a href="#services">Services</a></li>
                <li><a href="#why-us">Why Us</a></li>
                <li><a href="#clients">Clients</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </div>

            <div class="social-icons">
              <?php if (get_field('twitter_link', 'option')): ?>
                <a href="<?= the_field('twitter_link', 'option')  ?>"><i class="icon icon-twitter"></i></a>
              <?php endif; ?>
              <?php if (get_field('facebook_link', 'option')): ?>
                <a href="<?= the_field('facebook_link', 'option')  ?>"><i class="icon icon-facebook"></i></a>
              <?php endif; ?>
              <?php if (get_field('youtube_link', 'option')): ?>
                <a href="<?= the_field('youtube_link', 'option')  ?>"><i class="icon icon-youtube"></i></a>
              <?php endif; ?>
              <?php if (get_field('linkedin_link', 'option')): ?>
                <a href="<?= the_field('linkedin_link', 'option')  ?>"><i class="icon icon-linkedin"></i></a>
              <?php endif; ?>
              <?php if (get_field('pinterest_link', 'option')): ?>
                <a href="<?= the_field('pinterest_link', 'option')  ?>"><i class="icon icon-pinterest"></i></a>
              <?php endif; ?>
              <?php if (get_field('instagram_link', 'option')): ?>
                <a href="<?= the_field('instagram_link', 'option')  ?>"><i class="icon icon-instagram"></i></a>
              <?php endif; ?>
              <?php if (get_field('google_plus_link', 'option')): ?>
                <a href="<?= the_field('google_plus_link', 'option')  ?>"><i class="icon icon-google-plus"></i></a>
              <?php endif; ?>
            </div>
          </div>
        </div>

      </div>

