<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defisomedia
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <div class="front-page-jumbotron" <?php if ( get_field('jumbotron_background') ): ?> style="background-image: url('<?php echo get_field('jumbotron_background') ?>')" <?php endif; ?>>
        <div class="inner">
          <div class="content">
            <?php
              the_title('<h1 class="entry-title">','</h1>');
    					if ( get_field('jumbotron_description') ) {
    						echo '<p>' . get_field('jumbotron_description') . '</p>';
    					}
              /**
               * @hooked seotool
               */
              do_action( 'seotool' );
            ?>
          </div>
        </div>
      </div>

      <div class="promo-boxes">
        <div class="left">
          <div class="content">
            <div class="header">
              <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/seo.svg" alt="Sökmotoroptimering">
              <h2><?php echo the_field('promo_title_left'); ?></h2>
            </div>
            <?php echo the_field('promo_text_left') ?>
          </div>
        </div>
        <div class="right">
          <div class="content">
            <div class="header">
              <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/landing-page.svg" alt="Landningssidor">
              <h2><?php echo the_field('promo_title_right'); ?></h2>
            </div>
            <?php echo the_field('promo_text_right'); ?>
          </div>
        </div>
      </div>

      <div class="testomonials">
        <div class="inner">
          <h2 class="base-weight-header"><?php echo the_field('cases_title'); ?></h2>
          <div class="clients">

            <?php if( have_rows('cases') ): ?>

            <?php
              // loop through the rows of data
              while ( have_rows('cases') ) : the_row();

                $image = get_sub_field('case_img');
                $alt = $image['alt'];
                $url = $image['url'];

                // thumbnail
                $size = 'frontpage-case-logo';
                $thumb = $image['sizes'][ $size ];

                ?>

                <div class="client">
                  <?php if( !empty($image) ): ?> <img src="<?php echo $thumb; ?>" alt="<?php echo $alt ?>;"><?php endif; ?>
                </div>

              <?php endwhile; ?>

            <?php endif; ?>

          </div>
        </div>
      </div>

      <div class="three-columns gray-bg">
        <div class="content">
          <div class="header">
            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/search.svg" alt="Sökmotoroptimering">
            <h2><?php echo the_field('seo_info_title'); ?></h2>
          </div>
          <div class="columns">
            <div class="column">
              <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/telescope.svg" alt="Teleskop">
              <?php echo the_field('seo_info_first_column'); ?>
            </div>
            <div class="column">
              <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/rocket.svg" alt="Raket">
              <?php echo the_field('seo_info_second_column'); ?>
            </div>
            <div class="column">
              <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/moon-landing.svg" alt="Månlandning">
              <?php echo the_field('seo_info_third_column'); ?>
            </div>
          </div>
        </div>
      </div>

      <div class="reporting">
        <div class="reporting-header">
          <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/reports.svg" alt="Månadsrapportering">
          <h2><?php echo the_field('reporting_title'); ?></h2>
        </div>
        <div class="reporting-content-container">
          <div class="reporting-image">
            <img src="<?php echo the_field('reporting_image'); ?>" alt="<?php echo the_field('reporting_title'); ?>">
          </div>
          <div class="reporting-text">
            <?php echo the_field('reporting_text'); ?>
          </div>
        </div>
      </div>

      <div class="contact">
        <div class="google-maps" id="map"></div>
        <div class="inner">
          <div class="contact-card">
            <div class="contact-header">
              <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/location.svg" alt="Kontorets placering">
              <h2><?php echo the_field('contact_title'); ?></h2>
            </div>
            <div class="contact-information">
              <?php echo the_field('contact_text'); ?>
            </div>
            <div class="contact-form">
              <?php echo do_shortcode('[contact-form-7 id="193" title="Kontaktformulär"]'); ?>
            </div>
          </div>
        </div>
      </div>


    </main><!-- #main -->

  <?php
  get_footer(); ?>

  </div><!-- #primary -->
