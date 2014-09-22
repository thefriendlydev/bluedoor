<div class="section hero">
  <div class="bg-image" style="background-image: url(<?= HomeHelpers::hero_background(); ?>)">
    <div class="blue-cover">
      <div class="container">
        <div class="grid">
          <div class="grid__item one-half palm--one-whole">
            <h1><?= HomeHelpers::hero_large(); ?></h1>
            <div class="hero-regular"><?= HomeHelpers::hero_regular(); ?></div>
            <div class="hero-small"><?= HomeHelpers::hero_small_bold(); ?></div>
          </div>
          <div class="grid__item one-half palm--one-whole">
            <div class="hero-form">
              <div class="hero-form-main-tagline"><?= HomeHelpers::hero_form_main_tagline(); ?></div>
              <div class="hero-form-sub-tagline"><?= HomeHelpers::hero_form_sub_tagline(); ?></div>
              <span class="ribbon ribbon--primary">
                <span class="ribbon-label"><span class="ribbon-label-small">VALUED AT</span><span class="ribbon-label-amount"><sup>$</sup><?= HomeHelpers::assessment_price(); ?>!</span></span>
              </span>
              <?php echo do_shortcode( '[contact-form-7 id="19" title="Hero Contact Form"]' ); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>