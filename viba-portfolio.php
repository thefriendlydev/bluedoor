<?php
/**
 * The template for displaying Viba Portfolio for Bluedoor
 */
get_header(); ?>
<div class="primaryNav-small"></div>
  <div class="section single-header">
    <div class="container">
      <div class="grid">
        <div class="grid__item two-thirds palm--one-whole">
          <div class="container container--narrow">
            <div class="grid">
              <div class="grid__item">
                <div class="user-content">
                  <?php viba_portfolio_content(); ?>
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
          <div class="user-content">
            <?php include( TEMPLATEPATH . '/sidebar.php'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php get_footer(); ?>