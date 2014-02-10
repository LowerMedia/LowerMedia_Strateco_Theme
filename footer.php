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
			<p class='lm-footer-cp'>
				<a href="http://lowermedia.net/" title="<?php esc_attr_e( 'LowerMedia Custom Site', 'lowermedia' ); ?>" rel="generator">
					<?php printf( __( 'A %s Site.', 'lowermedia' ), 'LowerMedia' ); ?>
				</a>
				<?php //printf( __( 'Theme: %1$s by %2$s.', 'bushwick' ), 'Bushwick', '<a href="http://molovo.co.uk" rel="designer">James Dinsdale</a>' ); ?>
			</p>
			<p class='company-footer-cp'>
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="generator">
				<?php 
					global $lm_options;
					$lm_settings = get_option( 'lm_options', $lm_options ); 
					echo $lm_settings['footer_copyright']; 
				?>
				</a>	
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php wp_footer(); ?>

</body>
</html>