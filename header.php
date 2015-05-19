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
    <meta name="description" content="Social media strategy development and execution, advertising campaigns, training and consulting. We equip your marketing team with knowledge and tools to deliver real business results through social media.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php bloginfo('template_url'); ?>/dist/css/vendor.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/dist/css/application.css" rel="stylesheet">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- Typekit Fonts -->
    <script type="text/javascript" src="//use.typekit.net/giy3kov.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-49353238-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>

    <?php wp_head(); ?>
  </head>
    <body <?php body_class(); ?>>
      <?php wp_nav_menu( array( 'theme_location' => 'hidden-nav', 'container_class' => 'primaryNav', 'menu_class' => 'navigation-list' ) ); ?>
      <div class="siteWrapper">

        <!--[if lt IE 7]>
          <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <a class="offscreen" href="https://plus.google.com/118325535108985218675" rel="publisher">Google+</a>
        <div class='primary-nav'>
          <div class="primary-nav--left">
            <div class="logo-section">
              <a href="/"><img class="logo" src="<?php the_field('header_logo', 'option'); ?>"></a>
              <div class="tagline"><?php the_field('main_tagline', 'option'); ?></div>
            </div>
          </div>

          <div class="primary-nav--right">
            <?php wp_nav_menu( array( 'theme_location' => 'hidden-nav', 'container_class' => 'fullNav--container', 'menu_class' => 'fullNav' ) ); ?>
            <div class="links">
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

          <div class="siteHeader-navWrapper">
            <div class="siteHeader-navTrigger">
              <div class="siteHeader-navTriggerTop"></div>
              <div class="siteHeader-navTriggerMiddle"></div>
              <div class="siteHeader-navTriggerBottom"></div>
            </div>
          </div>

        </div>

