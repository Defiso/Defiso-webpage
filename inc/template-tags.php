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
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'defisomedia' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'defisomedia' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

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
          <strong>Håller din hemsida måttet SEO-mässigt? Testa direkt här.</strong>
          <form role="form" action='.$url.' class="text-center" method="POST">
            <div class="form-group">
              <input id="url-input" type="text" value="http://" name="url" class="form-control" placeholder="Domän" required>
              <input id="keyword-input" type="text" name="keywords" class="form-control" placeholder="Sökord" required>
              <input id="email-input" type="email" name="email" class="form-control" placeholder="Email" required>
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
			echo '
						<div class="column">
							<img src="' . get_field('logotype', $post_object->ID) . '" alt="' . get_the_title($post_object->ID) . '" />
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

if (! function_exists( 'seo_process' ) ) {
	/**
   * Display SEO process
   * @since  1.0.0
   * @return void
   */
	function seo_process() {
		echo '
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
		';
	}
}
