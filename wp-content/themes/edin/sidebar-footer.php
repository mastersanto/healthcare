<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Edin
 */
?>

<?php if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) ) : ?>

	<div id="tertiary" class="footer-widget-area" role="complementary">
		<div class="footer-widget-wrapper clear">
			<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
				<div class="footer-widget">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div><!-- .footer-widget -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
				<div class="footer-widget">
					<div class="widget-title">
						<a class="healthcare-link" href="http://www.healthcare.com">Healthcare.com</a>
					</div>
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div><!-- .footer-widget -->
			<?php endif; ?>
		</div><!-- .footer-widget-wrapper -->
	</div><!-- #tertiary -->

<?php endif; ?>