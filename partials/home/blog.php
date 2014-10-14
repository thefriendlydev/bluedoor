<?php if(get_field('essential_grid_shortcode')): ?>
  <div class="section blog">
    <div class="light-blue-cover">
      <div class="container">
        <div class="grid">
          <div class="grid__item center">
            <div class="taglines">
              <h2><?= HomeHelpers::blog_main_tagline(); ?></h2>
              <?php if(get_field('blog_sub_tagline')): ?>
                <h4><?= HomeHelpers::blog_sub_tagline(); ?></h4>
              <?php endif; ?>
            </div>
          </div>
          <div class="grid__item">
            <?php
              $essential_grid_shortcode = get_field('essential_grid_shortcode');
              echo do_shortcode($essential_grid_shortcode);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>