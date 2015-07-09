<?php	 	 
/**
* Template name: Full Width Page
* @package TKO
**/	 
get_header(); ?>
<div id="content-wrap">
	<div id="content" class="site-content">
	 	<div id="primary" class="content-area">
			<main id="main" class="site-main fw" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->
</div><!-- #content-wrap -->
<?php get_footer();	?>