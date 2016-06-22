<?php
/**
 * Template Name: Process
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

						<div class="two-columns">
							<div class="content">
								<div class="columns">
									<div class="column">
										<div class="header">
											<h2>Var på topp och öka försäljningen</h2>
										</div>
										<p>
											Att synas i sökmotorer - och då framförallt Google - blir allt viktigare för alla typer av företag. Syns man inte i sökmotorerna tappar man potentiella kunder – det är den enkla sanningen.
										</p>
										<p>
												Det är här sökmotoroptimering, SEO, kommer in i bilden. Vi på Defiso Media arbetar med att ta fram skräddarsydda SEO-lösningar för företag i alla tänkbara branscher. Oavsett om ditt företag är litet eller stort, och oavsett vilket verksamhetsområdet är, så kan vi hjälpa dig att klättra mot toppen i sökresultaten.
										</p>
									</div>
									<div class="column">
										<img src="<?php echo get_template_directory_uri(); ?>/illustrations/rocket.svg" alt="Raket">
									</div>
								</div>
							</div>
						</div>

						<div class="process two-columns">
							<div class="content">
								<div class="header-center">
									<h2>Mer om hur en SEO-analys utförs</h2>
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
										<h3>Sökmotoroptimering för små och stora företag</h3>
										<p>
											Att synas i sökmotorer - och då framförallt Google - blir allt viktigare för alla typer av företag. Syns man inte i sökmotorerna tappar man potentiella kunder – det är den enkla sanningen.
										</p>
										<p>
											Det är här sökmotoroptimering, SEO, kommer in i bilden. Vi på Defiso Media arbetar med att ta fram skräddarsydda SEO-lösningar för företag i alla tänkbara branscher. Oavsett om ditt företag är litet eller stort, och oavsett vilket verksamhetsområdet är, så kan vi hjälpa dig att klättra mot toppen i sökresultaten.
										</p>
										<h3>Sökmotoroptimering på rätt sätt</h3>
										<p>
											Vi hjälper dig dessutom att synas på rätt sätt i sökmotorerna. Detta genom att hitta de optimala sökfraserna för just ditt företag - det vill säga, vad skulle en person som vill köpa just era tjänster eller produkter skriva in i en sökmotor? Du kan läsa mer om detta i högerspalten.
										</p>
										<p>
											När vi identifierat de optimala sökorden riktar vi in våra optimeringsinsatser mot dessa och ingenting annat. Rankingen på dessa konverterande sökord är det enda som räknas. Vi kastar inte bort resurser på sådant som inte ger något i slutändan.
										</p>
										<p>
											SEO är ett precisionsarbete och träffar man rätt kan det vara mycket lönsamt. Defiso Media träffar alltid rätt!
										</p>
									</div>
									<div class="column">
										<h3>Våra unika arbetsmetoder för sökmotoroptimering</h3>
										<p>
											Klassisk sökmotoroptimering är att ta en befintlig hemsida och se till att den rankar på de sökord som är aktuella. Det är något vi har arbetat med i många år och behärskar till fullo - och gärna hjälper till med - men det som gör att Defiso Media sticker ut i mängden bland SEO-byråer är en unik produkt som kallas för landningssida.
										</p>
										<p>
											Du kan läsa mer om detta på sidan där vi presenterar konceptet landningssida, men kortfattat går det ut på att vi bygger en sida från grunden som är helt och hållet anpassad för ditt företag – med er logga och era kontaktuppgifter - och optimerad på de mest lönsamma sökorden.
										</p>
										<p>
											Alla företag har ju inte en egen hemsida och en landningssida är då ett perfekt sätt att så snabbt som möjligt vinna mark i den hårda kampen i sökmotorerna. Vi har hjälpt en mängd företag på detta vis, i branscher som städ, måleri, VVS och mycket mer.
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
