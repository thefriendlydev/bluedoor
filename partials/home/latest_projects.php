<?php if( get_field('display_latest_projects') ): ?>
  <div class="section blog">
    <div class="light-blue-cover">
      <div class="container">
        <div class="grid">
          <div class="grid__item center">
            <?php
              echo do_shortcode('[viba_portfolio]');
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>