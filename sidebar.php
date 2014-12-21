<?php if ( is_active_sidebar( 'right_sidebar' ) ) : ?>
  <?php dynamic_sidebar( 'right_sidebar' ); ?>
<?php else : ?>
  <div class="no-widgets">
    <p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'bonestheme' );  ?></p>
  </div>
<?php endif; ?>