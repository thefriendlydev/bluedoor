<?php get_header(); ?>
<div class="primaryNav-small"></div>
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="section single-header">
      <div class="container">
        <div class="grid">
          <div class="grid__item">
            <div class="user-content">
              <?php the_title(); ?>
              <?php the_content(); ?>
            </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>