<?php
// Remove before production
header("Access-Control-Allow-Origin: *");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * defisomedia functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package defisomedia
 */

if ( ! function_exists( 'defisomedia_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function defisomedia_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on defisomedia, use a find and replace
	 * to change 'defisomedia' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'defisomedia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Huvudmeny', 'defisomedia' ),
		'footer' => esc_html__( 'Sidfot', 'defisomedia' ),
		'off_canvas1' => esc_html__( 'Off Canvas 1', 'defisomedia' ),
		'off_canvas2' => esc_html__( 'Off Canvas 2', 'defisomedia' ),
		'off_canvas3' => esc_html__( 'Off Canvas 3', 'defisomedia' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'defisomedia_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'defisomedia_setup' );

/**
 * Custom post types
 */
 add_action( 'init', 'create_post_type' );
 function create_post_type() {
   register_post_type( 'testemonials',
     array(
       'labels' => array(
         'name' => __( 'Referenser' ),
         'singular_name' => __( 'Referens' )
       ),
       'public' 			=> true,
       'has_archive'	=> false,
			 'rewrite'			=> array( 'slug' => 'referens' ),
			 'supports'			=> array( 'title', 'editor', 'thumbnail' )
     )
   );
 }

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function defisomedia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'defisomedia_content_width', 640 );
}
add_action( 'after_setup_theme', 'defisomedia_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function defisomedia_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'defisomedia' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'defisomedia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'defisomedia_widgets_init' );

/**
 * Define thumnails
 * name, width, height, crop
 * @link https://developer.wordpress.org/reference/functions/add_image_size/
 */

add_image_size ( "co-workers", 250, 312, array( 'center', 'top' ) );
add_image_size ( "frontpage-case-logo", 250, 312, false );
add_image_size ( "frontpage-reporting", 800, 450, false );


/**
 * Enqueue scripts and styles.
 */
function defisomedia_scripts() {
	wp_enqueue_style( 'defisomedia-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery-2', get_template_directory_uri() . '/js/vendor/jquery-2.2.3.min.js', array(), '2.2.3', true );
	wp_enqueue_script( 'defisomedia-js', get_template_directory_uri() . '/js/app.js', array(), '20160410', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'defisomedia_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/hooks.php';
