<div class="section contact-us">
  <div class="blue-gradient">
    <div class="container">
      <div class="grid">
        <div class="grid__item center">
          <div class="taglines">
            <h2><?= HomeHelpers::contact_us_main_tagline(); ?></h2>
            <?php if(get_field('contact_us_sub_tagline')): ?>
              <h4><?= HomeHelpers::contact_us_sub_tagline(); ?></h4>
            <?php endif; ?>
          </div>
        </div>
        <div class="grid__item">
          <?php
            $contact_shortcode = get_field('contact_shortcode');
            echo do_shortcode($contact_shortcode);
          ?>
        </div>
        <div class="grid__item">
          <div class="copyright">© Copyright 2014 Blue Door Inc. All Rights Reserved.</div>
        </div>
      </div>
    </div>
  </div>
</div>