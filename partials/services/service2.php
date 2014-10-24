<div class="grid__item one-third lap--one-half palm--one-whole wow bounceInUp" id="serviceTwo" data-wow-delay="0.1s" data-wow-duration="1.3s">
  <div class="service-card second">
    <div class="hexagon">
      <div class="icon"><i class="icon-advertising"></i></div>
    </div>
    <div class="service-card-title" id="serviceTwoTitle"><?= HomeHelpers::service_title_2(); ?></div>
    <p><?= HomeHelpers::service_short_description_2(); ?></p>
    <div class="button" id="serviceTwoButton">Learn More</div>
  </div>
</div>

<div class="grid__item hide service-expanded no-flicker" id="serviceTwoExpanded">
  <div class="combo">
    <div class="combo-first">
      <div class="hexagon">
        <div class="icon"><i class="icon-advertising"></i></div>
      </div>
    </div>
    <div class="combo-last">
      <h3><?= HomeHelpers::service_title_2(); ?></h3>
      <div class="content-block"><?= HomeHelpers::service_expanded_info_2(); ?></div>
    </div>
  </div>
</div>