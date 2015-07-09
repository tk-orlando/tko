<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package TKO
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_page('home') || is_page('portfolio') || is_page('capabilities') || is_page('contact') ) { ?><h1 class="entry-title hidden"><?php the_title(); ?></h1>
		 <?php } elseif (is_page() ) { ?><h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tko' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'tko' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
