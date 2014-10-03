<div class="grid__item one-third lap--one-whole palm--one-whole wow bounceInUp" id="serviceThree" data-wow-delay="0.1s" data-wow-duration="1.3s">
  <div class="service-card third">
    <div class="hexagon">
      <div class="icon"><i class="icon-consulting"></i></div>
    </div>
    <div class="service-card-title"><?= HomeHelpers::service_title_3(); ?></div>
    <p><?= HomeHelpers::service_short_description_3(); ?></p>
    <div class="button" id="serviceThreeButton">Learn More</div>
  </div>
</div>

<div class="grid__item hide service-expanded no-flicker" id="serviceThreeExpanded">
  <div class="combo">
    <div class="combo-first">
      <div class="hexagon">
        <div class="icon"><i class="icon-consulting"></i></div>
      </div>
    </div>
    <div class="combo-last">
      <h3><?= HomeHelpers::service_title_3(); ?></h3>
      <div class="content-block"><?= HomeHelpers::service_expanded_info_3(); ?></div>
    </div>
  </div>
</div>