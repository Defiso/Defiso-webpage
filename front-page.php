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

      <div class="three-col-boxes">
        <div class="content">
          <div class="header">
            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/search.svg" alt="Sökmotoroptimering">
            <h2>Varför sökmotoroptimering med Defiso?</h2>
          </div>
          <div class="box">
            <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/telescope.svg" alt="Teleskop">
            <h4>Alla söker på nätet</h4>
            <p>
              Sökmotorer är numera det självklara alternativet för att snabbt och effektivt hitta speciella produkter eller tjänster. Undersökningar visar att 90 procent av alla internetanvändare använder sig av sökmotorer för att hitta den information de söker.
            </p>
          </div>
          <div class="box">
            <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/rocket.svg" alt="Raket">
            <h4>En kraftfull försäljningskanal</h4>
            <p>
              Med sökmotoroptimering når du potentiella i kunder i ett kritiskt skede - mitt i köpprocessen när de precis sökt efter efter en produkt eller tjänst. 75 procent av de beställningar och förfrågningar som sker på hemsidor kommer via sökmotorer.
            </p>
          </div>
          <div class="box">
            <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/moon-landing.svg" alt="Månlandning">
            <h4>Alla söker på nätet</h4>
            <p>
              Resultatet är det enda som räknas – inte enbart rankning utan främst de affärer som genereras i slutändan. Till exempel mäter vi antalet samtal och förfrågningar du får in. SEO med Defiso Media ska alltid löna sig för dig som företagare.
            </p>
            <a href="/resultat">Läs mer om vårt resultatfokus</a>
          </div>
        </div>
      </div>

      <div class="reporting">
        <div class="reporting-header">
          <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/reports.svg" alt="Månadsrapportering">
          <h2>Se resultat med månadsrapportering</h2>
        </div>
        <div class="reporting-content-container">
          <div class="reporting-image">
            <img src="http://placehold.it/800x450">
          </div>
          <div class="reporting-text">
            <h4>Se hur många samtal du har fått</h4>
            <p>
              Via speciella mätnummer analyserar vi antal förfrågningar du har fått in via sökoptimering. Du kan enkelt följa när du fått samtal från din sökoptimering och från vilka du fått det
            </p>
            <h4>Sammanställningar över antal epost</h4>
            <p>
              Vi sammanställer alla de epost du fått under en månad och tillsammans följer vi upp de resultat du fått.
            </p>
          </div>
        </div>
      </div>

      <div class="contact" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/contact-background.jpg')">
        <div class="container">
          <div class="contact-card">
            <div class="contact-header">
              <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/location.svg" alt="Kontorets placering">
              <h2>Kontakta oss</h2>
            </div>
            <div class="contact-information">
              <p>
                Ring vår kundtjänst på 08-410 344 35 för en kostnadsfri SEO-rådgivning för ditt företag, eller om du har några frågor eller funderingar kring sökmotoroptimering i allmänhet.
              </p>
              <p>
                Defiso Media<br>
                Olof Palmes Gata 20B<br>
                111 37 Stockholm<br>
                08-410 344 35<br>
                <a href="mailto:info@defiso.se">info@defiso.se</a>
              </p>
              <a href="/medarbetare" class="button">Kontakta våra medarbetare</a>
            </div>
            <div class="contact-form">
              <form>
                <input type="text" placeholder="Namn">
                <input type="number" placeholder="Mobiltelefon">
                <textarea placeholder="Meddelande"></textarea>
                <button type="button">Skicka meddelande</button>
              </form>
            </div>
          </div>
        </div>
      </div>


    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
