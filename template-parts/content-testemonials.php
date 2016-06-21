<?php
/**
 * Template part for displaying testemonial posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defisomedia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php get_template_part( 'template-parts/elements/element', 'jumbotron' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="testemonials-content">

			<?php if ( get_field('video_url') ) {
				echo '<div id="player" style="max-width:100%"></div>';
			} ?>

			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'defisomedia' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'defisomedia' ),
					'after'  => '</div>',
				) );
			?>
		</div>

		<div class="testemonials-info">
			<img src="<?php echo the_field('logotype') ?>" alt="<?php the_title() ?>">
			<?php if ( has_post_thumbnail() ): ?>
				<img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title() ?>">
			<?php endif; ?>
			<p>
				<?php echo the_field('quote') ?>
			</p>


			 <div class="seo-word-positions">
	 			<h3>Sökordspositioner på Google</h3>
				<?php

				// check if the repeater field has rows of data
				if( have_rows('search_terms') ):

				 	// loop through the rows of data
				    while ( have_rows('search_terms') ) : the_row(); ?>

							<div class="seo-info">
								<span class="seo-word"><?php echo the_sub_field('search_term'); ?></span>
								<span class="seo-word-position"><?php echo the_sub_field('position'); ?></span>
							</div>

				    <?php endwhile;

				endif;

				?>

		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php defisomedia_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php
$video_url = get_field('video_url');

if ( get_field('video_url') ):
	parse_str( parse_url($video_url, PHP_URL_QUERY) );
	?>
	<script>
		var tag = document.createElement("script");
		var videoUrlId = "<?php echo $v ?>";

		console.log("url" + videoUrlId);

		tag.src = "https://www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName("script")[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

		var player;
		function onYouTubeIframeAPIReady() {
			player = new YT.Player("player", {
				height: "480",
				width: "853",
				videoId: videoUrlId
			});
		}
	</script>
<?php endif; ?>
