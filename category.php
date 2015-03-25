<?php get_header(); ?>
<div class="primaryNav-small"></div>
<?php if ( have_posts() ) : ?>
  <div class="section single-header">
    <div class="container">
      <div class="grid">
        <div class="grid__item two-thirds palm--one-whole">
          <div class="container container--narrow">
            <div class="grid">
              <div class="grid__item">
                <div class="user-content">
                  <div class="category-title "><?php single_cat_title('Category: '); ?></div>

                  <?php while ( have_posts() ) : the_post(); ?>
                    <div class="category-post">
                      <h4 class=""><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                      <div class="single-date">  <?php the_time('F jS, Y') ?> by <?php the_author() ?></div>
                      <?php the_excerpt(); ?>
                    </div>
                  <?php endwhile; ?>

                  <div class="mobile-only">
                    <?php include( TEMPLATEPATH . '/sidebar.php'); ?>
                  </div>
                  <?php if ( function_exists( 'floating_social_bar' ) ) floating_social_bar( array( 'facebook' => true, 'twitter' => true, 'google' => true, 'linkedin' => true, 'pinterest' => true, 'static' => true ) ); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid__item one-third palm--one-whole not-mobile">
          <div class="user-content sidebar">
            <?php include( TEMPLATEPATH . '/sidebar.php'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php else: ?>
  <p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>

<?php get_footer(); ?>