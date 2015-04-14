<div class="section services">
  <div class="light-blue-cover light-blue-cover--less">
    <div class="container">
      <div class="grid">
        <div class="grid__item center">
          <h2><?= HomeHelpers::services_main_tagline(); ?></h2>
          <h4><?= HomeHelpers::services_sub_tagline(); ?></h4>
        </div>
      </div>
    </div>
    <div id="servicesAnchor"></div>
    <div class="services-back-container hide" id="serviceBack"><div class="services-back"><i class="icon-arrow-left"></i></div></div>
    <div class="container">
      <div class="grid">
        <?php if( have_rows('modular_services') ): $service_counter = 0; ?>
          <?php while ( have_rows('modular_services') ) : the_row(); ?>
              <?php if( get_row_layout() == 'service' ): $service_counter++; ?>


                <div class="grid__item one-third lap--one-half palm--one-whole wow bounceInUp no-flicker" id="serviceShort<?php echo $service_counter ?>" data-wow-delay="0.1s" data-wow-duration="1.3s">
                  <?php if( $service_counter <= 3 ): ?>
                    <div class="service-card">
                  <?php else: ?>
                    <div class="service-card service-card--spacing">
                  <?php endif; ?>
                    <div class="hexagon">
                      <div class="iconBlock">
                        <?php if( get_sub_field('service_icon_image') ): ?>
                          <img src="<?= the_sub_field('service_icon_image'); ?>">
                        <?php else: ?>
                          <i class="icon icon-<?= the_sub_field('service_icon'); ?>"></i>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="service-card-title" id="serviceTitle<?php echo $service_counter ?>"><?= the_sub_field('service_title'); ?></div>
                    <p><?= the_sub_field('service_short_description'); ?></p>
                    <div class="button" id="serviceButton<?php echo $service_counter ?>">Learn More</div>
                  </div>
                </div>

                <div class="grid__item hide service-expanded no-flicker relative" id="serviceExpanded<?php echo $service_counter ?>">
                  <div class="combo">
                    <div class="combo-first">
                      <div class="hexagon">
                        <div class="iconBlock">
                          <?php if( get_sub_field('service_icon_image') ): ?>
                            <img src="<?= the_sub_field('service_icon_image'); ?>">
                          <?php else: ?>
                            <i class="icon icon-<?= the_sub_field('service_icon'); ?>"></i>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <div class="combo-last">
                      <h3><?= the_sub_field('service_title'); ?></h3>
                      <div class="content-block"><?= the_sub_field('service_expanded_info'); ?></div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>