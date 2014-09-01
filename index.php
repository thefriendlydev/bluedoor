<?php get_header(); ?>

  <?php if(have_posts()): while(have_posts()): the_post(); ?>

    <code>index.php</code>
    <?php the_title(); ?>
    <?php the_content(); ?>

  <?php endwhile; endif; ?>

<?php get_footer(); ?>