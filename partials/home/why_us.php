<div class="section why-us">
  <div class="blue-geometric">
    <div class="container">
      <div class="grid">
        <div class="grid__item center">
          <div class="taglines">
            <h2><?= HomeHelpers::why_us_main_tagline(); ?></h2>
            <?php if(get_field('why_us_sub_tagline')): ?>
              <h4><?= HomeHelpers::why_us_sub_tagline(); ?></h4>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="grid why-us-points">
        <?php if (get_field('why_us_point_1_title')  && get_field('why_us_point_1_content')): ?>
          <div class="grid__item one-third palm--one-whole">
            <div class="why-us-point">
              <div class="why-us-point-title"><?= the_field('why_us_point_1_title')  ?></div>
              <div class="why-us-point-content"><?= the_field('why_us_point_1_content')  ?></div>
            </div>
        <?php endif; ?>
        </div>
        <?php if (get_field('why_us_point_2_title')  && get_field('why_us_point_2_content')): ?>
          <div class="grid__item one-third palm--one-whole">
            <div class="why-us-point">
              <div class="why-us-point-title"><?= the_field('why_us_point_2_title')  ?></div>
              <div class="why-us-point-content"><?= the_field('why_us_point_2_content')  ?></div>
            </div>
          </div>
        <?php endif; ?>
        <?php if (get_field('why_us_point_3_title')  && get_field('why_us_point_3_content')): ?>
          <div class="grid__item one-third palm--one-whole">
            <div class="why-us-point">
              <div class="why-us-point-title"><?= the_field('why_us_point_3_title')  ?></div>
              <div class="why-us-point-content"><?= the_field('why_us_point_3_content')  ?></div>
            </div>
          </div>
        <?php endif; ?>
        <?php if (get_field('why_us_point_4_title')  && get_field('why_us_point_4_content')): ?>
          <div class="grid__item one-third palm--one-whole">
            <div class="why-us-point">
              <div class="why-us-point-title"><?= the_field('why_us_point_4_title')  ?></div>
              <div class="why-us-point-content"><?= the_field('why_us_point_4_content')  ?></div>
            </div>
          </div>
        <?php endif; ?>
        <?php if (get_field('why_us_point_5_title')  && get_field('why_us_point_5_content')): ?>
          <div class="grid__item one-third palm--one-whole">
            <div class="why-us-point">
              <div class="why-us-point-title"><?= the_field('why_us_point_5_title')  ?></div>
              <div class="why-us-point-content"><?= the_field('why_us_point_5_content')  ?></div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>