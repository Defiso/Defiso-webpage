<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package defisomedia
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<script>
  (function(d) {
    var config = {
      kitId: 'ivm2ldm',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav class="menu-wrapper">
  <?php wp_nav_menu( array( 'theme_location' => 'off_canvas', 'menu_id' => 'off-canvas-menu' ) ); ?>
</nav>

<div id="page" class="site main-wrapper">
  <div id="wrapperBackground"></div>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'defisomedia' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="inner">
			<div class="site-branding">
				<?php if ( get_header_image() ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" alt="Logotyp">
					</a>
				<?php endif; ?>
			</div>

			<div class="right">
				<nav id="site-navigation" class="inline-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
        <button type="button" id="openMenu">Meny</button>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
