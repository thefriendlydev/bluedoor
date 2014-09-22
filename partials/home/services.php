<div class="section services">
  <div class="light-blue-cover">
    <div class="container">
      <div class="grid">
        <div class="grid__item center">
          <h2><?= HomeHelpers::services_main_tagline(); ?></h2>
          <h4><?= HomeHelpers::services_sub_tagline(); ?></h4>
        </div>
      </div>
    </div>
    <div class="services-back-container hide" id="serviceOneBack"><div class="services-back"><i class="icon-arrow-left"></i></div></div>
    <div class="services-back-container hide" id="serviceTwoBack"><div class="services-back"><i class="icon-arrow-left"></i></div></div>
    <div class="services-back-container hide" id="serviceThreeBack"><div class="services-back"><i class="icon-arrow-left"></i></div></div>
    <div class="container">
      <div class="grid">
        <?php get_template_part('partials/services/service1'); ?>
        <?php get_template_part('partials/services/service2'); ?>
        <?php get_template_part('partials/services/service3'); ?>
      </div>
    </div>
  </div>
</div>