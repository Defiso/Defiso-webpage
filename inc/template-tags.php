<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package defisomedia
 */

if ( ! function_exists( 'defisomedia_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function defisomedia_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Skriven %s', 'post date', 'defisomedia' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'defisomedia' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'defisomedia_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function defisomedia_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'defisomedia' ) );
		if ( $categories_list && defisomedia_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'defisomedia' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'defisomedia' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'defisomedia' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'defisomedia' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'defisomedia' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function defisomedia_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'defisomedia_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'defisomedia_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so defisomedia_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so defisomedia_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in defisomedia_categorized_blog.
 */
function defisomedia_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'defisomedia_categories' );
}
add_action( 'edit_category', 'defisomedia_category_transient_flusher' );
add_action( 'save_post',     'defisomedia_category_transient_flusher' );

if ( ! function_exists( 'seotool' ) ) {
  /**
   * Display SEO form
   * @since  1.0.0
   * @return void
   */
  function seotool() {
    $url = home_url("result");
    echo '
          <strong>Håller din hemsida måttet SEO-mässigt? Testa här.</strong>
          <form role="form" action='.$url.' class="text-center" method="POST">
            <div class="form-group">
              <input id="url-input" type="text" name="url" class="form-control" placeholder="Din hemsideadress" required>
              <input id="keyword-input" type="text" name="keywords" class="form-control" placeholder="Sökord du vill synas på" required>
              <input id="email-input" type="email" name="email" class="form-control" placeholder="Din e-postadress (för att skicka analysen)" required>
              <button class="btn" onclick="analyze()">Analysera</button>
              <p class="error-text"></p>
            </div>
          </form>

          <div class="row result_row">
            <div class="loader-placeholder">
            <img src="/wp-content/themes/defisomedia/inc/seotool/img/svg-loaders/puff.svg" id="loader"/>
            <h2 class="text-center loader-text"></h2>
            </div>
          </div>
        </div>
        <div class="result"> </div>
    ';
  }
}

if ( ! function_exists( 'featured_quote_testemonials' ) ) {
  /**
   * Display featured testemonials with quote
   * @since  1.0.0
   * @return void
   */
  function featured_quote_testemonials() {
		$testemonials = get_field('featured_quote_testemonials');
		echo '
					<div class="three-columns center">
						<div class="content">
							<div class="header-center">
								<h2>Det här säger våra kunder</h2>
							</div>
							<hr>
							<div class="columns">
		';
		foreach($testemonials as $post_object):

      $image = get_field('logotype', $post_object->ID);
      $url = $image['url'];

      // thumbnail
      $size = 'case-logo';
      $thumb = $image['sizes'][ $size ];

			echo '
						<div class="column">
							<div class="client-logotype">
							<img src="' . $thumb . '" alt="' . get_the_title($post_object->ID) . '" />
							</div>
							<h3>' . get_the_title($post_object->ID) . '</h3>
							<p>' . get_field('quote', $post_object->ID) . '</p>
						</div>
			';
		endforeach;
		echo '
							</div>
						</div>
					</div>
		';

  }
}
