<div class="section clients">
  <div class="white-cover">
    <div class="container">
      <div class="grid">
        <div class="grid__item center">
          <div class="taglines">
            <h2><?= HomeHelpers::clients_main_tagline(); ?></h2>
            <?php if(get_field('clients_sub_tagline')): ?>
              <h4><?= HomeHelpers::clients_sub_tagline(); ?></h4>
            <?php endif; ?>
          </div>
        </div>

        <?php if( have_rows('clients') ): ?>
          <div class="grid__item">
            <div class="clients-logos">
              <?php while( have_rows('clients') ): the_row();
                $link = get_sub_field('client_url');
              ?>
                <?php if( $link ): ?>
                  <div class="clients-logo">
                    <a href="<?php echo the_sub_field('client_url'); ?>" target="_blank"><img src="<?php echo the_sub_field('client_logo'); ?>" /></a>
                  </div>
                <?php else: ?>
                  <div class="clients-logo">
                    <img src="<?php echo the_sub_field('client_logo'); ?>" />
                  </div>
                <?php endif; ?>
              <?php endwhile; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

