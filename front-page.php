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

      <div class="jumbotron" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/header.jpeg')">
        <div class="inner">
          <div class="content">
            <h1>Sökmotoroptimering som ger fler affärer</h1>
            <p>Defisos unika koncept inom sökmotoroptimering (SEO) leder till fler affärer, oavsett bransch och oavsett storleken på ditt företag. Vi tar dig till toppen!</p>
            <?php
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
              <h2>Sökmotoroptimering</h2>
            </div>
            <p>Våra skräddarsydda lösningar ger ökad synlighet på konkurrensutsatta sökord, såväl lokalt som rikstäckade.  Med sökmotoroptimering från Defiso får du kontakt med potentiella kunder långt fram i köpprocessen. Vi presenterar ditt företag som det självklaret svaret på sökningar i er bransch.</p>
            <a href="#" class="button">Läs mer</a>
          </div>
        </div>
        <div class="right">
          <div class="content">
            <div class="header">
              <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/landing-page.svg" alt="Landningssidor">
              <h2>Landningssidor</h2>
            </div>
            <p>Vi är Nordens ledande leverantör av landningssidor och erbjuder flera features som vi är ensamma om på marknaden. Våra landningssidor är extremt effektiva och når snabbt höga rankingar. Ett perfekt alternativ om ni kört fast med den officiella hemsidan, om ni vill nischa er inom något område eller om ni vill bredda er träffbild.</p>
            <a href="#" class="button">Se mer</a>
          </div>
        </div>
      </div>

      <div class="testomonials">
        <div class="inner">
          <h3>Etablerade nog för stora bolag. Små nog för att se varje kund.</h3>
          <div class="clients">
            <div class="client">
              <img src="<?php echo get_template_directory_uri(); ?>/icons/fjallraven.png" alt="Client">
            </div>
            <div class="client">
              <img src="<?php echo get_template_directory_uri(); ?>/icons/fjallraven.png" alt="Client">
            </div>
            <div class="client">
              <img src="<?php echo get_template_directory_uri(); ?>/icons/fjallraven.png" alt="Client">
            </div>
            <div class="client">
              <img src="<?php echo get_template_directory_uri(); ?>/icons/fjallraven.png" alt="Client">
            </div>
            <div class="client">
              <img src="<?php echo get_template_directory_uri(); ?>/icons/fjallraven.png" alt="Client">
            </div>
            <div class="client">
              <img src="<?php echo get_template_directory_uri(); ?>/icons/fjallraven.png" alt="Client">
            </div>
          </div>
        </div>
      </div>


    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
