<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package defisomedia
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner">
      
      <div class="top">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.svg" alt="Defisos logotype">
      </div>

      <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer' ) ); ?>
      <div class="company-information">
        <ul>
          <li class="header">Defiso Media AB</li>
          <li>Olof Palmes Gata 20B</li>
          <li>111 37 Stockholm</li>
          <li>08-410 344 35 </li>
          <li>info@defiso.se</li>
        </ul>
      </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
