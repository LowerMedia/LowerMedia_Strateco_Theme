<?php
/**
 * The template for displaying the footer.
 *
 * @package Bushwick
 */
?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'bushwick_credits' ); ?>
			<p>
				<a href="http://lowermedia.net/" title="<?php esc_attr_e( 'LowerMedia Custom Site', 'lowermedia' ); ?>" rel="generator">
					<?php printf( __( 'A %s Site.', 'lowermedia' ), 'LowerMedia' ); ?>
				</a>
				<?php //printf( __( 'Theme: %1$s by %2$s.', 'bushwick' ), 'Bushwick', '<a href="http://molovo.co.uk" rel="designer">James Dinsdale</a>' ); ?>
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php wp_footer(); ?>

</body>
</html>