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
  </body>
</html>
