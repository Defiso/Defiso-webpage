<?php
/**
 * Template Name: Testemonial Page
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



						<?php
							$type = 'testemonials';
							$args = array('post_type' => $type, 'post_status' => 'publish');
							$testemonials = null;
							$testemonials = new WP_Query($args);

							// save id's from alredy featured testemonials on this page so that we can avoid showing them two times
							$featured_testemonials = get_field('featured_quote_testemonials');
							$featured_testemonials_id = array();

							foreach($featured_testemonials as $post_object):
								array_push($featured_testemonials_id, $post_object -> ID);
							endforeach;

							if ( $testemonials -> have_posts() ) {
								echo '
											<div class="four-columns featured-cases">
												<div class="content">
													<div class="columns">
								';

							  while ( $testemonials -> have_posts() ) : $testemonials -> the_post();

									$image = get_field('logotype', $post_object->ID);
									$url = $image['url'];

									// thumbnail
									$size = 'case-logo';
									$thumb = $image['sizes'][ $size ];


									// check that the case isn't already featured
									if ( !in_array($post->ID, $featured_testemonials_id) ): ?>
										<a class="column" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
											<img src="<?php echo $thumb ?>" alt="<?php the_title(); ?>">
											<h3><?php the_title(); ?></h3>
											<p>
												<?php echo get_field('description') ?>
											</p>
										</a>
							    <?php endif;

							  endwhile;

								echo '
											</div>
										</div>
									</div>
								';
							}
							wp_reset_query();  // Restore global post data stomped by the_post().
						?>



						<div class="contact-cta">
							<div class="inner">
								<div class="header">
									<h3>Få kostnadsfri SEO-rådgivning</h3>
								</div>
								<?php echo do_shortcode('[contact-form-7 id="279" title="CTA formulär, leads för telefonnummer"]'); ?>
							</div>
						</div>



						<?php
						$featured_testemonials = get_field('featured_quote_testemonials');

						if ($featured_testemonials) {
							echo '
										<div class="three-columns featured-cases center">
											<div class="content">
												<div class="columns">
							';
							foreach($featured_testemonials as $post_object):
								$image = get_field('logotype', $post_object->ID);
								$url = $image['url'];

								// thumbnail
								$size = 'case-logo';
								$thumb = $image['sizes'][ $size ];
								echo '
											<div class="column">
												<img src="' . $thumb . '" alt="' . get_the_title($post_object->ID) . '" />
												<h3>' . get_the_title($post_object->ID) . '</h3>
												<p>' . get_field('quote', $post_object->ID) . '</p>
												<a class="button" href="' . get_permalink($post_object->ID) . '">Se case</a>
											</div>
								';
							endforeach;
							echo '
												</div>
											</div>
										</div>
							';
						} ?>



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
