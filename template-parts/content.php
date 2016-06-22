<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defisomedia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				get_template_part( 'template-parts/elements/element', 'jumbotron' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

		<?php if ( is_single() ) {
			echo '<div class="blog-container">';
		} ?>
		
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php defisomedia_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
		endif; ?>

		<div class="entry-content">
			<?php
				if ( has_post_thumbnail() ) {
					echo the_post_thumbnail_url();
				}

				if ( is_single() ) {
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'defisomedia' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				} else {
					the_excerpt(); ?>
					<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">Läs mer</a>
				<?php }

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'defisomedia' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php if ( is_single() ) {
			echo '</div>';
		} ?>

	<footer class="entry-footer">
		<?php defisomedia_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->