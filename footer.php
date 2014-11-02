<div class="section contact-us">
  <div class="blue-gradient">
    <div class="container">
      <div class="grid">
        <div class="grid__item center">
          <div class="taglines">
            <h2><?php the_field('contact_main_tagline', 'option'); ?></h2>
            <?php if(get_field('contact_sub_tagline', 'option')): ?>
              <h4><?php the_field('contact_sub_tagline', 'option'); ?></h4>
            <?php endif; ?>
          </div>
        </div>
        <div class="grid__item">
          <?php
            $contact_form_shortcode = get_field('contact_form_shortcode', 'option');
            echo do_shortcode($contact_form_shortcode);
          ?>
        </div>
        <div class="grid__item">
          <div class="copyright"><?php the_field('footer_copyright', 'option'); ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- Live Reload -->
    <?php if (defined('WP_ENV') && WP_ENV !== 'production'): ?>
      <script src="http://0.0.0.0:35729/livereload.js?snipver=1"></script>
    <?php endif; ?>

    <?php wp_footer(); ?>

    <script src="<?php bloginfo('template_url'); ?>/dist/js/vendor.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/dist/js/application.js"></script>
    <script>
     new WOW().init();
    </script>
  </div>
  </body>
</html>
