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
			              <?php echo get_field('landingpage_first_column') ?>
			            </div>
			            <div class="column">
			              <img class="illustration" src="<?php echo get_template_directory_uri(); ?>/illustrations/moon-landing.svg" alt="Månlandning">
			              <?php echo get_field('landingpage_first_column') ?>
			            </div>
			          </div>
			        </div>
			      </div>

						<div class="two-columns">
							<div class="content">
								<div class="columns">
									<div class="column ">
										<img src="http://placehold.it/800x450?text=screenshot" alt="" />
									</div>
									<div class="column vertical-center">
										<h3>Fördel</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										</p>
									</div>
								</div>
							</div>
						</div>

						<div class="two-columns gray-bg">
							<div class="content">
								<div class="columns">
									<div class="column vertical-center">
										<h3>Fördel</h3>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
