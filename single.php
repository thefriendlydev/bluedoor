<?php get_header(); ?>
<div class="primaryNav-small"></div>
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="section single-header">
      <?php if (  has_post_thumbnail() ) : ?>
        <div class="container">
          <div class="grid">
            <div class="grid__item">
              <div class="user-featured-image">
                <?php the_post_thumbnail(); ?>
              </div>
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
                      $args = array(
                    'show_option_all'    => '',
                    'orderby'            => 'name',
                    'order'              => 'ASC',
                    'style'              => 'list',
                    'show_count'         => 0,
                    'hide_empty'         => 1,
                    'use_desc_for_title' => 1,
                    'child_of'           => 0,
                    'feed'               => '',
                    'feed_type'          => '',
                    'feed_image'         => '',
                    'exclude'            => '',
                    'exclude_tree'       => '',
                    'include'            => '',
                    'hierarchical'       => 1,
                    'title_li'           => __( '' ),
                    'show_option_none'   => __( 'No categories' ),
                    'number'             => null,
                    'echo'               => 1,
                    'depth'              => 0,
                    'current_category'   => 0,
                    'pad_counts'         => 0,
                    'taxonomy'           => 'category',
                    'walker'             => null
                      );
                      wp_list_categories( $args );
                  ?>
                </ul>
              </div>
              <div class="single-comments">
                <?php if (comments_open()) : ?>
                  <div id="disqus_thread"></div>
                  <script type="text/javascript">
                      /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                      var disqus_shortname = '<example>'; // Required - Replace example with your forum shortname

                      /* * * DON'T EDIT BELOW THIS LINE * * */
                      (function() {
                          var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                          dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                      })();
                  </script>
                  <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                  <a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
                <?php endif; // comments_open ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>