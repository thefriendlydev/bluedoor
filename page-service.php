<?php
/*
 Template Name: Bluedoor Service Page
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
    <div class="overlay"></div>
    <div class="modal">
      <div class="servicePage-modalTagline"><?php the_field('service_page_cta_form_title'); ?></div>
      <div class="servicePage-modalSubTagline"><?php the_field('service_page_cta_form_sub_title'); ?></div>
      <div class="icon-close"></div>
      <?php
        $service_contact_form_shortcode = get_field('servicepage_contact_form_contact_code');
        echo do_shortcode($service_contact_form_shortcode);
      ?>
    </div>
    <div class="section single-header">
      <div class="container">
        <div class="grid">
          <div class="grid__item">
            <div class="user-content">
              <div class="servicePage-title"><?php the_title(); ?></div>
              <?php if( get_field('servicepage_secondary_title') ): ?>
                <div class="servicePage-secondaryTitle"><?php the_field('servicepage_secondary_title'); ?></div>
              <?php endif; ?>
              <?php if( get_field('servicepage_featured_image') ): ?>
                <img class="servicePage-featuredImage" src="<?php the_field('servicepage_featured_image'); ?>">
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="container container--narrow">
        <div class="grid">
          <div class="grid__item">
            <div class="user-content">
              <div class="servicePage-content"><?php the_field('servicepage_content'); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="grid">
          <div class="grid__item">
            <div class="servicePage-cta">
              <div class="combo">
                <div class="combo-first">
                  <span class="ribbon ribbon--primary ribbon--large">
                    <span class="ribbon-label"></span>
                  </span>
                  <div class="servicePage-cta-ribbon"><?php the_field('servicepage_cta_ribbon_text'); ?></div>
                </div>
                <div class="combo-last">
                  <div class="servicePage-cta-textTitle"><?php the_field('servicepage_cta_text_title'); ?></div>
                  <div class="servicePage-cta-text"><?php the_field('servicepage_cta_text'); ?></div>
                  <div class="servicePage-cta-button button"><?php the_field('servicepage_cta_button_text'); ?></div>
                </div>
              </div>
            </div>
            <?php if ( function_exists( 'floating_social_bar' ) ) floating_social_bar( array( 'facebook' => true, 'twitter' => true, 'google' => true, 'linkedin' => true, 'pinterest' => true, 'static' => true ) ); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>