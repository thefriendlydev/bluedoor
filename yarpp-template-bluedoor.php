<?php
/*
YARPP Template: Simple
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?><h3>Related Posts</h3>
<?php if (have_posts()):?>
  <div class="yarppBluedoor">
  <ul>
    <?php while (have_posts()) : the_post(); ?>
    <li>
      <div class="combo combo--middle">
        <div class="combo-first">
          <?php if( get_field('post_thumbnail') ): ?>
            <a class="yarppBluedoor-thumbnail" href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php the_field('post_thumbnail'); ?>" /></a>
          <?php endif; ?>
        </div>
        <div class="combo-last">
          <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
        </div>
      </div>
    </li>
    <?php endwhile; ?>
  </ul>
  </div>
<?php else: ?>
<p>No related posts.</p>
<?php endif; ?>
