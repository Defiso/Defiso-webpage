<?php
/**
 * Template Name: Contact
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

          <div class="contact" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/contact-background.jpg')">
            <div class="inner">
              <div class="contact-card">
                <div class="contact-header">
                  <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/location.svg" alt="Kontorets placering">
                  <h1>Kontakta oss</h1>
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
                </div>
                <div class="contact-form">
                  <form>
                    <input type="text" placeholder="Namn">
                    <input type="tel" placeholder="Mobiltelefon">
                    <textarea placeholder="Meddelande"></textarea>
                    <button type="button">Skicka meddelande</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="entry-content">

          <?php the_content(); ?>

          <?php if( have_rows('co-workers') ): ?>

            <div class="co-workers">
              <div class="co-workers-container">
                <?php
                  // loop through the rows of data
                  while ( have_rows('co-workers') ) : the_row();

                    $image = get_sub_field('image');
                    $alt = $image['alt'];
                    $url = $image['url'];

                    // thumbnail
                    $size = 'co-workers';
                    $thumb = $image['sizes'][ $size ];

                    ?>

                      <div class="co-worker">
                        <span class="image"><?php if( !empty($image) ): ?> <img src="<?php echo $thumb; ?>" alt="<?php echo $alt ?>;"><?php endif; ?></span>
                        <span class="name"><?php echo the_sub_field('name'); ?></span>
                        <span class="title"><?php echo the_sub_field('job_title'); ?></span>
                        <a class="email" href="<?php echo the_sub_field('email'); ?>"><?php echo the_sub_field('email'); ?></a>
                        <span class="phone"><?php echo the_sub_field('phone'); ?></span>
                      </div>

                  <?php endwhile; ?>
              </div>
            </div>

          <?php endif; ?>

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
