<?php
/**
 * Template part for displaying page content in page.php.
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

	<?php if ('standard_tmpl_content_row') {
		while ( have_rows('standard_tmpl_content_row') ) : the_row();
			$title = get_sub_field('row_title');
			$left_column = get_sub_field('row_left_column');
			$right_column = get_sub_field('row_right_column');
		?>
			<div class="two-columns">
				<div class="content">
					<?php if ($title): ?>
						<div class="header">
							<h2><?php echo $title; ?></h2>
						</div>
					<?php endif; ?>
					<div class="columns">
						<div class="column">
							<?php echo $left_column; ?>
						</div>
						<div class="column">
							<?php echo $right_column; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile;
	} ?>

	<?php if (get_the_content()): ?>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'defisomedia' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

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
