<div class="grid__item one-third lap--one-half palm--one-whole wow bounceInUp no-flicker" id="serviceOne" data-wow-delay="0.1s" data-wow-duration="1.3s">
  <div class="service-card first">
    <div class="hexagon">
      <div class="icon"><i class="icon-strategy"></i></div>
    </div>
    <div class="service-card-title"><?= HomeHelpers::service_title_1(); ?></div>
    <p><?= HomeHelpers::service_short_description_1(); ?></p>
    <div class="button" id="serviceOneButton">Learn More</div>
  </div>
</div>

<div class="grid__item hide service-expanded no-flicker relative" id="serviceOneExpanded">
  <div class="combo">
    <div class="combo-first">
      <div class="hexagon">
        <div class="icon"><i class="icon-strategy"></i></div>
      </div>
    </div>
    <div class="combo-last">
      <h3><?= HomeHelpers::service_title_1(); ?></h3>
      <div class="content-block"><?= HomeHelpers::service_expanded_info_1(); ?></div>
    </div>
  </div>
</div>