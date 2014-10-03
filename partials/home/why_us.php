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
    </div>
  </div>
</div>