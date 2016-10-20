<?php
/**
 * Template Name: SEO Info Page
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


						<!-- ONE TEXT FIELD WITH ROCKET IMAGE -->
						<div class="two-columns">
							<div class="content">
								<div class="columns">
									<div class="column">
										<div class="header">
											<h2><?php echo get_field('seo_intro_title') ?></h2>
										</div>
										<?php echo get_field('seo_intro_text') ?>
									</div>
									<div class="column">
										<img src="<?php echo get_template_directory_uri(); ?>/illustrations/rocket.svg" alt="Raket">
									</div>
								</div>
							</div>
						</div>


						<!-- THREE COLUMNS WITH ICONS OVER -->
						<div class="three-columns gray-bg">
							<div class="content">
								<div class="header-center">
									<h2><?php echo get_field('work_method_title') ?></h2>
								</div>
								<div class="columns">
									<div class="column">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/seo-analysis.svg" alt="Analysen">
										<?php echo get_field('work_method_first_column') ?>
									</div>
									<div class="column">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/seo-continuity.svg" alt="Långsiktigheten">
										<?php echo get_field('work_method_second_column') ?>
									</div>
									<div class="column">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/seo-overview.svg" alt="Överblicken">
										<?php echo get_field('work_method_third_column') ?>
									</div>
								</div>
							</div>
						</div>


						<!-- THREE COLUMNS, SELECTED QUOTES -->
						<?php if ( get_field('featured_quote_testemonials') ) {
							/* @hooked featured_testemonials */
							do_action( 'featured_quote_testemonials' );
						}  ?>


						<!-- CTA BLOCK -->
						<div class="contact-cta">
							<div class="inner">
								<div class="header">
									<h3><?php echo get_field('seo_info_cta_title'); ?></h3>
								</div>
								<?php echo do_shortcode('[contact-form-7 id="279" title="CTA formulär, leads för telefonnummer"]'); ?>
							</div>
						</div>


						<!-- TWO COLUMNS, TEXT ONLY WITH SPACEMAN HELMET UNDER -->
						<div class="two-columns">
							<div class="content">
								<div class="header">
									<h2><?php echo get_field('seo_info_title'); ?></h2>
								</div>
								<div class="columns">
									<div class="column">
										<?php echo get_field('seo_info_first_column'); ?>
									</div>
									<div class="column">
										<?php echo get_field('seo_info_second_column'); ?>
										<img src="<?php echo get_template_directory_uri(); ?>/icons/spaceman.svg" class="media-align-center" alt="Rymdgubbe">
									</div>
								</div>
							</div>
						</div>


						<!-- PROCESS INFO -->
						<div class="process two-columns">
							<div class="content">
								<div class="header-center">
									<h2><?php echo get_field('seo_process_title'); ?></h2>
								</div>
								<div class="steps">
									<div class="step">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/process-analysis.svg" alt="Analys">
										<span>1. Analys</span>
									</div>
									<div class="step">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/process-construction.svg" alt="Konstruktion">
										<span>2. Konstruktion</span>
									</div>
									<div class="step">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/process-inquiry.svg" alt="Förfrågan">
										<span>3. Förfrågan</span>
									</div>
									<div class="step">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/process-results.svg" alt="Resultat">
										<span>4. Resultat</span>
									</div>
									<div class="step">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/process-sales.svg" alt="Försäljning">
										<span>5. Försäljning</span>
									</div>
									<div class="step">
										<img src="<?php echo get_template_directory_uri(); ?>/icons/process-followup.svg" alt="Uppföljning">
										<span>6. Uppföljning</span>
									</div>
								</div>
								<div class="columns">
									<div class="column">
										<?php echo get_field('seo_process_first_column'); ?>
									</div>
									<div class="column">
										<?php echo get_field('seo_process_second_column'); ?>
									</div>
								</div>
							</div>
						</div>


						<!-- TWO COLUMNS, TEXT ONLY -->
						<?php if ( have_rows('seo_repeatable_bottom_info') ): ?>
							<?php
								$rowCounter = 1;
								while ( have_rows('seo_repeatable_bottom_info') ) : the_row();
									$title 					= get_sub_field('seo_repeatable_bottom_info_title');
									$first_column 	= get_sub_field('seo_repeatable_bottom_info_first_column');
									$second_column 	= get_sub_field('seo_repeatable_bottom_info_second_column');
							?>

							<?php if ($rowCounter % 2): ?>
								<div class="two-columns">
							<?php else: ?>
								<div class="two-columns gray-bg">
							<?php endif; ?>
								<div class="content">
									<?php if ($title): ?>
										<div class="header">
											<h2><?php echo $title; ?></h2>
										</div>
									<?php endif; ?>
									<div class="columns">
										<div class="column">
											<?php echo $first_column; ?>
										</div>
										<div class="column">
											<?php echo $second_column; ?>
										</div>
									</div>
								</div>
							</div>

							<?php
								$rowCounter++;
							endwhile;
							// IMPORTANT: destroy/remove variable rowCounter after all rows has been displayed
							unset($rowCounter);
						endif; ?>


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
