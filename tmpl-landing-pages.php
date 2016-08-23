<?php
/**
 * Template Name: Landing Page Info Page
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
						<?php get_template_part( 'template-parts/elements/element', 'jumbotron' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">

						<div class="three-columns">
			        <div class="content">
			          <div class="header">
			            <img class="icon" src="<?php echo get_template_directory_uri(); ?>/icons/search.svg" alt="Sökmotoroptimering">
			            <h2><?php echo get_field('landingpage_header') ?></h2>
			          </div>
			          <div class="columns">
			            <div class="column">
			              <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/telescope.svg" alt="Teleskop">
			              <?php echo get_field('landingpage_first_column') ?>
			            </div>
			            <div class="column">
			              <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/rocket.svg" alt="Raket">
			              <?php echo get_field('landingpage_second_column') ?>
			            </div>
			            <div class="column">
			              <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/moon-landing.svg" alt="Månlandning">
			              <?php echo get_field('landingpage_third_column') ?>
			            </div>
			          </div>
			        </div>
			      </div>

						<?php if ( have_rows('landingpage_repeatable_columns') ): ?>
							<div class="three-columns gray-bg">
								<div class="content">
									<div class="columns">
										<?php while ( have_rows('landingpage_repeatable_columns') ) : the_row();
											$first_column = get_sub_field('landingpage_repeatable_first_column');
											$second_column = get_sub_field('landingpage_repeatable_second_column');
											$third_column = get_sub_field('landingpage_repeatable_third_column');
										?>
											<div class="column">
												<?php echo $first_column; ?>
											</div>
											<div class="column">
												<?php echo $second_column; ?>
											</div>
											<div class="column">
												<?php echo $third_column;?>
											</div>
										<?php endwhile; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<div class="two-columns">
							<div class="content">
								<div class="header">
			            <h2>Exempel på en landningssida</h2>
			          </div>
								<div class="columns">
									<div class="column ">
										<img src="http://placehold.it/800x450?text=screenshot" alt="" />
									</div>
									<div class="column vertical-center">
										<h3>Snygga sidor med hög konverteringsgrad</h3>
										<p>
											Här finns ett exempel på hur en landningssida från Defiso Media kan se ut. Vill du se sidan i sin helhet kan du göra det live genom att göra sökningen ”Elektriker Stockholm” i Google, där den legat som stabil etta i ett antal månader. <strong>Några av nyckelelementen på sidan:</strong>
											<ul>
												<li>Namnet på sidan, tillika huvudsökordet, ”Elektriker Stockholm”, stort och tydligt uppe till vänster.</li>
												<li>Kundens logga, i detta fall Djurstedts, uppe till höger.</li>
												<li>Bilder och texter som är helt anpassade efter kundens verksamhet.</li>
												<li>Kontaktmöjligheter på flera olika ställen (toppmenyn, sidokolumnen och huvudtexten).</li>
												<li>Längst ner på sidan finns vår egen logotype.</li>
											</ul>
										</p>
									</div>
								</div>
							</div>
						</div>

						<div class="two-columns gray-bg">
							<div class="content">
								<div class="columns">
									<div class="column vertical-center">
										<h3>Toppranking i den organiska träfflistan</h3>
										<p>
											Vill du se fler exempel på landningssidor från Defiso Media? Då föreslår vi att du gör nedanstående sökningar i Google och tittar längst upp i den organiska träfflistan:
											<ul>
												<li>”Stamspolning Stockholm”</li>
												<li>”Städning Stockholm”</li>
												<li>”Köksrenovering Stockholm”</li>
												<li>”Bokföring Stockholm”</li>
												<li>”Lediga Kontor Göteborg”</li>
												<li>”Fönster Skellefteå”</li>
											</ul>
											Och det finns många, många fler landningssidor! <a href="http://www.defiso.se/kontakta-oss">Hör av dig till oss</a> så berättar vi mer.
										</p>
									</div>
									<div class="column ">
										<img src="http://placehold.it/800x450?text=screenshot" alt="" />
									</div>
								</div>
							</div>
						</div>

						<?php
							$testemonial = get_field('featured_box_testemonial');

							if( $testemonial ):

								// override $post
								$post = $testemonial;
								setup_postdata( $post );

								?>
									<div class="promo-boxes promo-case">
										<div class="left">
											<div class="content">
												<div class="header">
													<h2><?php the_title(); ?></h2>
												</div>
												<p><?php echo get_field('description'); ?></p>
												<a href="<?php the_permalink(); ?>" class="button">Utforska case</a>
											</div>
										</div>
										<div class="right case-image" style="background-image:url('<?php echo wp_get_attachment_thumb_url(get_post_thumbnail_id()); ?>')"></div>
									</div>
							    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
							<?php endif; ?>

							<div class="two-columns">
								<div class="content">
									<div class="header">
				            <h2>Mer om konvertering</h2>
				          </div>
									<div class="columns">
										<div class="column ">
											<p>
												Konvertering på hemsidor är en mindre vetenskap som bland annat omfattar besökarens beteendemönster (hur ögonen scannar av sidan, och så vidare), vilka färger som används, placering av de olika elementen och förstås hur texterna är formulerade.
											</p>
										</div>
										<div class="column vertical-center">
											<p>
												Vi kommer inte gå in i detalj på allt detta här, men våra tekniker har full koll på konverteringsbiten. Så om ditt företags hemsida träffar bra i sökmotorerna men ändå inte levererar resultat kan vi hjälpa till med att spetsa till den, med (till synes) små, men effektiva medel.
											</p>
										</div>
									</div>
								</div>
							</div>

							<div class="two-columns gray-bg">
								<div class="content">
									<div class="header">
				            <h2>Snabbguide till landningssida</h2>
				          </div>
									<div class="columns">
										<div class="column ">
											<p>
												Med en specialutvecklad landningssida från Defiso Media får ert företag in <strong>mängder av nya kunder och konkreta jobbförfrågningar</strong> via Google och andra sökmotorer. Den unika sidan skapas från grunden av oss på Defiso men <strong>anpassas till 100 procent efter ert företag</strong>, med logotype, bilder samt omfattande information om verksamheten och de tjänster ni erbjuder. Landningssidan <strong>byggs kring ett specifikt sökbegrepp</strong> som valts ut noggrant – och i nära samråd med er – för att ge ert företag maximal effekt. Detta är det snabbaste och säkraste sättet att nå en <strong>topposition i Google</strong>.
											</p>
										</div>
										<div class="column vertical-center">
											<p>
												Sidans tydliga fokus på det aktuella sökbegreppet bekräftar för besökarna att de hamnat rätt, vilket <strong>skapar förtroende och köpvilja</strong>. Kundkonverteringen maximeras med stilren design, säljande texter och <strong>snabba, tydliga kontaktmöjligheter</strong>. Landningssidan genererar högvärdesförfrågningar som går <strong>direkt och enbart till ert företag</strong>, via telefon, e-post eller ett kontaktformulär på sidan. Noggrann uppföljning med till exempel samtalsmätning säkerställer att landningssidan <strong>levererar det resultat som förväntats</strong> – ofta ännu bättre!
											</p>
										</div>
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
