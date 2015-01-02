<?php
/*
 Template Name: Bluedoor White Paper Page
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>
<div class="primaryNav-small"></div>
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="section single-header">
      <div class="container container--narrow">
        <div class="grid">
          <div class="grid__item">
            <div class="user-content">
              <div class="wpPage-title"><?php the_title(); ?></div>
              <?php if( get_field('wp_secondary_title') ): ?>
                <div class="servicePage-secondaryTitle"><?php the_field('wp_secondary_title'); ?></div>
              <?php endif; ?>
              <?php if( get_field('wp_featured_image') ): ?>
                <img class="servicePage-featuredImage" src="<?php the_field('wp_featured_image'); ?>">
              <?php endif; ?>
            </div>
            <div class="user-content">
              <div class="wpPage-content"><?php the_field('wp_content'); ?></div>
            </div>
            <div class="wpPage-cta-title"><?php the_field('wp_form_title'); ?></div>
            <div class="wpPage-cta-secondaryTitle"><?php the_field('wp_form_secondary_title'); ?></div>
            <div class="wpPage-form">
              <?php
                $form_contact_shortcode = get_field('form_contact_shortcode');
                echo do_shortcode($form_contact_shortcode);
              ?>
            </div>
            <?php if ( function_exists( 'floating_social_bar' ) ) floating_social_bar( array( 'facebook' => true, 'twitter' => true, 'google' => true, 'linkedin' => true, 'pinterest' => true, 'static' => true ) ); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>