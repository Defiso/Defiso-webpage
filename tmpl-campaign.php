<?php
/**
 * Template Name: Campaign
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

      <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <div class="jumbotron" <?php if ( get_field('jumbotron_background') ): ?> style="background-image: url('<?php echo get_field('jumbotron_background') ?>')" <?php endif; ?>>
              <div class="inner">
                <div class="content">
                  <?php
                    the_title('<h1 class="entry-title">','</h1>');
                  ?>
                  <p>Personlig kontakt och totalt resultatfokus. Säkra inflödet av jobb med sökmotoroptimering.</p>
                  <a class="button" href="#kostnadsfri-radgivning">Boka kostnadsfri rådgivning</a>
                </div>
              </div>
            </div>

          </header><!-- .entry-header -->

          <div class="entry-content">

            <div class="intro">

              <div class="left">
                <div class="content">
                  <div class="header">
                    <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/seo.svg" alt="Sökmotoroptimering">
                    <h2>Effektiv sökmotoroptimering</h2>
                  </div>
                  <p>Defiso Media är en renodlad SEO-byrå som hjälpt hundratals företag, små som stora, att få in affärer via Google. Vi har arbetat framgångsrikt med SEO i över 10 år och har kunder i alla tänkbara branscher:
                  bygg &amp; hantverk, juridik &amp; ekonomi, flytt &amp; städ, vård &amp; omsorg, skönhet &amp; hälsa och många fler.</p>
                </div>
              </div>

              <div class="right">
                <ul class="checkmarks">
                  <li>Få nya kunder och öka din försäljning</li>
                  <li>Extremt bra ROI (Return of investment)</li>
                  <li>100% resultatfokuserat</li>
                  <li>Personlig kontakt, tät uppföljning</li>
                </ul>
              </div>

            </div>

            <div class="testomonials">
              <div class="inner">
              <?php $pageID = 2; ?>
                <h2 class="base-weight-header"><?php echo the_field('cases_title', $pageID); ?></h2>
                <div class="clients">

                  <?php if( have_rows('cases', $pageID) ): ?>

                  <?php
                    // loop through the rows of data
                    while ( have_rows('cases', $pageID) ) : the_row();

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

            <div class="references">
              <div class="inner">

                <h2>Våra kunder älskar vårt resultatfokus</h2>

                <div class="left">

                  <div class="reference">
                    <img class="reference-image" src="<?php echo get_template_directory_uri(); ?>/images/jonasd.jpg" alt="Referens">

                    <div class="quote">
                      <p class="text">"Tack vare Defiso Media har vi konkurrerat ut jättarna i elektrikerbranschen i toppen på Google. Detta har genererat mängder av både små och stora jobb, bland annat ett prestigefyllt uppdrag från Tesla."</p>
                      <p class="by">- Jonas Djurstedt, Djurstedts El</p>
                    </div>
                  </div>

                </div>

                <div class="right">

                  <div class="reference">
                    <img class="reference-image" src="<?php echo get_template_directory_uri(); ?>/images/rami.jpg" alt="Referens">

                    <div class="quote">
                      <p class="text">"Med hjälp av Defiso har vi på bara några få år gått från nystartat företag till ett av Mälardalens största städbolag inom flyttstädning. Vi har till dags dato utfört över 5 000 flyttstädningar och fortsätter växa."</p>
                      <p class="by">- Rami, Gefle Renservice</p>
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="chess">

              <div class="row">
                <div class="left bg-image">
                  <div class="content">
                  </div>
                </div>

                <div class="right">
                  <div class="content">
                    <h2>SEO – extremt effektiv marknadsföring</h2>
                    <p>Idag söker i princip alla människor efter varor och tjänster på nätet och de har ofta nära till köp. En topplacering på ett attraktivit sökord kan öka ditt företags omsättning och vinst rejält. Vi hjälper er ta fram bästa möjliga sökstrategi för detta.</p>

                    <p>Görs det på rätt sätt erbjuder SEO en enorm potential till en relativt sett liten investering. Defisos unika koncept är både kostnadseffektivt och bevisat framgångsrikt.
                    </p>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="left">
                  <div class="content">
                    <h2>Unikt resultatfokus</h2>
                    <p>De flesta SEO-byråer kan mäta ranking och trafik, men Defiso tar det ett steg längre och har full koll på vad vårt arbete genererar i form av konkreta affärer. Detta tack vare lösningar som vi är ensamma om i branschen.</p>

                    <p>Det är viktigt för oss att våra kunder kan se att deras investering hos oss lönar sig. När de upptäcker hur mycket sökmotoroptimering kan generera vill de många gånger utöka samarbetet.</p>

                    <p>Vi är fullt transparenta och helt öppna med vad vi gör och varför vi gör det. Alla våra kunder har en dedikerad kontaktperson som de alltid kan höra av sig till.</p>
                  </div>
                </div>

                <div class="right grey">
                  <div class="content">
                    <div class="icon-section-wrap">
                      <div class="icon-wrapper">
                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/sales-icon.png" alt="Försäljning">
                        Försäljning
                      </div>
                      <div class="icon-wrapper">
                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/result-icon.png" alt="Resultat">
                        Resultat
                      </div>
                      <div class="icon-wrapper">
                        <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/followup-icon.png" alt="Uppföljning">
                        Uppföljning
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="form-area" id="kostnadsfri-radgivning">
              <div class="inner">
                <div class="left">
                  <div class="header">
                    <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/seo.svg" alt="Sökmotoroptimering">
                    <h2>Få kostnadsfri rådgivning</h2>
                  </div>
                    <p>Boka ett möte med en av våra erfarna SEO-konsulter, som presenterar en lösning för just ditt företag. Helt utan förpliktelser!
                    </p>
                    <p>Ring oss på <strong>08 - 410 344 02</strong> eller fyll i formuläret så tar vi kontakt med er inom 24h.</p>
                </div>
                <div class="right">
                  <?php echo do_shortcode('[contact-form-7 id="591" title="Kampanjsida"]'); ?>
                </div>
              </div>
            </div>

            <?php
              the_content();

              wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'defisomedia' ),
                'after'  => '</div>',
              ) );
            ?>
          </div><!-- .entry-content -->

          <footer class="entry-footer">
            <?php
              edit_post_link(
                sprintf(
                  /* translators: %s: Name of current post */
                  esc_html__( 'Edit %s', 'defisomedia' ),
                  the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ),
                '<span class="edit-link">',
                '</span>'
              );
            ?>
          </footer><!-- .entry-footer -->
        </article><!-- #post-## -->

      <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
