<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
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
        <img src="<?= HomeHelpers::logo(); ?>">
        <span><?= HomeHelpers::nav_tagline(); ?></span>
      </div>

