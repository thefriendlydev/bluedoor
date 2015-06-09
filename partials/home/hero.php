<style type="text/css">
  .hero-video .arve-wrapper {
    background-image: url(<?= the_field('hero_video_image'); ?>) !important;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover; }
</style>

<div class="section hero">
  <div class="bg-image" style="background-image: url(<?= HomeHelpers::hero_background(); ?>)">
    <div class="blue-cover">
      <div class="container">
        <div class="grid">
          <div class="grid__item">
            <h1><?= HomeHelpers::hero_large(); ?></h1>
            <div class="hero-video">
              <?php
                $video_shortcode = get_field('video_shortcode');
                echo do_shortcode($video_shortcode);
              ?>
            </div>
            <a href="#contact" class="button hero-ctaButton"><?= the_field('video_button_text') ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>