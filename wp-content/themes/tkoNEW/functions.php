<?php
/**
 * TKO functions and definitions
 *
 * @package TKO
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}

if ( ! function_exists( 'tko_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tko_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on TKO, use a find and replace
	 * to change 'tko' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tko', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tko' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tko_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // tko_setup
add_action( 'after_setup_theme', 'tko_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tko_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tko' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Social', 'tko' ),
		'id'            => 'social',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
	) );	register_sidebar( array(
		'name'          => __( 'Footer', 'tko' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'tko_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tko_scripts() {
	wp_enqueue_style( 'tko-style', get_stylesheet_uri() );
	wp_enqueue_style( 'tko-my-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300', true );
	
	wp_enqueue_script( 'tko-jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js', array(), '20150116', true );
	wp_enqueue_script( 'tko-modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', true );
	wp_enqueue_script( 'tko-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'tko-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'tko-background-video', get_template_directory_uri() . '/js/backgroundVideo.min.js', array(), '20150602', true );
	wp_enqueue_script( 'tko-scroll-arrow', get_template_directory_uri() . '/js/scroll.js', array(), '20150603', true );
	// wp_enqueue_script( 'parallax', get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js', array(), '1.1.3', true );
	// wp_enqueue_script( 'nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array(), '3.6.0', true );
	// wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tko_scripts' );

/** Register Custom Parallax Post Type 
	 	 
add_action( 'init', 'custom_post_type' );
function custom_post_type() {
$labels = array(
	'name' => _x( 'Parallax', 'general name' ),
	'singular_name' => _x( 'Page', 'singular name' ),
	'add_new' => _x( 'Add New', 'parallax' ),
	'add_new_item' => __( 'Add New Page' ),
	'edit_item' => __( 'Edit Page' ),
	'new_item' => __( 'New Page' ),
	'all_items' => __( 'All Pages' ),
	'view_item' => __( 'View Page' ),
	'search_items' => __( 'Search Pages' ),
	'not_found' => __( 'No pages found' ),
	'not_found_in_trash' => __( 'No pages found in the Trash' ),
	'parent_item_colon' => '',
	'menu_name' => 'Parallax'
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'menu_position' => null,
	'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes' ),
	'has_archive' => true,
);
register_post_type( 'parallax', $args);
}
**/
/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */
// function remove_empty_p( $content ) {
//     $content = force_balance_tags( $content );
//     $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
//     $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
//     return $content;
// }
// add_filter('the_content', 'remove_empty_p', 20, 1);
