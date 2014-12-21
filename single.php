<?php get_header(); ?>
<div class="primaryNav-small"></div>
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="section single-header">
      <div class="container">
        <div class="grid">
          <div class="grid__item two-thirds palm--one-whole">
            <?php if (  has_post_thumbnail() ) : ?>
              <div class="grid">
                <div class="grid__item">
                  <div class="user-featured-image">
                    <?php the_post_thumbnail(); ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <div class="container container--narrow">
              <div class="grid">
                <div class="grid__item">
                  <div class="user-content">
                    <div class="single-title"><?php the_title(); ?></div>
                    <div class="single-date"><?php the_date('M d, Y'); ?></div>
                    <div class="single-content"><?php the_content(); ?></div>
                    <div class="single-categories">
                      <ul>
                                          <?php
                        foreach((get_the_category()) as $category) {
                            echo '<li>' . $category->cat_name . ' </li>';
                          // echo '<li>' . '<a href="' . get_category_link( $category->cat_ID) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->cat_name.'</a> </li>' ;
                        }
                        ?>
                      </ul>
                    </div>
                    <div class="mobile-only">
                      <?php include( TEMPLATEPATH . '/sidebar.php'); ?>
                    </div>
                    <?php comments_template(); ?>
                    <?php if ( function_exists( 'floating_social_bar' ) ) floating_social_bar( array( 'facebook' => true, 'twitter' => true, 'google' => true, 'linkedin' => true, 'pinterest' => true, 'static' => true ) ); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="grid__item one-third palm--one-whole not-mobile">
            <div class="user-content">
              <?php include( TEMPLATEPATH . '/sidebar.php'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>