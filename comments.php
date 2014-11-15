<?php

// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

?>

<?php // You can start editing here. ?>

  <?php if ( have_comments() ) : ?>

    <section class="commentlist">
      <?php
        wp_list_comments( array(
          'style'             => 'div',
          'short_ping'        => true,
          'avatar_size'       => 40,
          'type'              => 'all',
          'reply_text'        => 'Reply',
          'page'              => '',
          'per_page'          => '',
          'reverse_top_level' => null,
          'reverse_children'  => ''
        ) );
      ?>
    </section>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <nav class="navigation comment-navigation" role="navigation">
        <div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'BluedoorIncTheme' ) ); ?></div>
        <div class="comment-nav-next"><?php next_comments_link( __( 'More Comments &rarr;', 'BluedoorIncTheme' ) ); ?></div>
      </nav>
    <?php endif; ?>

    <?php if ( ! comments_open() ) : ?>
      <p class="no-comments"><?php _e( 'Comments are closed.' , 'BluedoorIncTheme' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php comment_form(); ?>

