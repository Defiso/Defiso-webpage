<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package defisomedia
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<div class="jumbotron">
						<div class="inner">
							<div class="content">
								<h1 class="page-title"><?php esc_html_e( 'Oops! Sidan kunde inte hittas', 'defisomedia' ); ?></h1>
							</div>
						</div>
					</div>
				</header><!-- .page-header -->

				<div class="entry-content">
					<h2><?php esc_html_e( 'Sidan kunden inte hittas', 'defisomedia' ); ?></h2>
					<p>Du kan gå tillbaka till startsidan som du hittar <a href="/">här</a></p>


				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
