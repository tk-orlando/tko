<?php
/**
 * The header for Parallax Page Only
 *
 * @package TKO
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<style type="text/css" media="screen">
</style>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tko' ); ?></a>
<header id="masthead" class="site-header" role="banner">
	<div class="site-branding">
			<div id="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-tko.svg" alt="TKO Logo" width="64" /></a>
			</div><!-- #logo -->			
		<div id="tagline" class="site-description"><span><?php bloginfo( 'description' ); ?></span></div><!-- #tagline -->
	</div><!-- .site-branding -->
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'tko' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->
</header><!-- #masthead -->