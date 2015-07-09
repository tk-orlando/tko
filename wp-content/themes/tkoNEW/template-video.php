<?php	 	 
/**
* Template name: Video Home Page
* @package TKO
**/	 
get_header(); ?>
<div id="outer-wrap">
	<div id="video-wrap" class="video-wrap"> 
		<a class="arrow-wrap" href="#content"><span class="arrow"></span></a>
		<video preload="metadata" autoplay loop id="tko-video">
			<source src="<?php echo esc_url( home_url( '/' ) ); ?>/wp-content/uploads/clip.mp4" type="video/mp4">
			<source src="<?php echo esc_url( home_url( '/' ) ); ?>/wp-content/uploads/clip.webm" type="video/webm">
			<source src="<?php echo esc_url( home_url( '/' ) ); ?>/wp-content/uploads/clip.ogv" type="video/ogv">
			<source src="<?php echo esc_url( home_url( '/' ) ); ?>/wp-content/uploads/clip.flv" type="video/flv">
		</video>
	</div><!-- #video-wrap -->
</div><!-- #outer-wrap -->
<div id="content-wrap">
	<div id="content" class="site-content">
	 	<div id="primary" class="content-area">
			<main id="main" class="site-main fw" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
				 			<?php the_content(); ?>
						</div><!-- .entry-content -->	
					</article><!-- #post-## -->
				<?php endwhile; // end of the loop. ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->
</div><!-- #content-wrap -->
<?php get_footer();	?>