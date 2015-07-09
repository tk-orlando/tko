<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package TKO
 */
?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div><!-- .row -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
    $(document).ready(function() {
        $('#tko-wrap').backgroundVideo({
            pauseVideoOnViewLoss: true,
            preventContextMenu: true,
		    parallaxOptions: {
		        offset: 60,
		        effect: 1.7
		    }
		});
    });
</script>
<script>
$('.slide > div').hover(function () {
    var i = $(this).index();
    $('.about-content h3:eq('+i+')').show();
}, function () {
    $('.about-content h3').hide();
});
</script>
</body>
</html>