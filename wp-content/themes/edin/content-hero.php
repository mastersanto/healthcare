<?php
/**
 * The template used for displaying hero content in page.php and page-templates.
 *
 * @package Edin
 */
?>

<div class="hero <?php echo edin_additional_class(); ?>">
	<?php if ( is_post_type_archive( 'jetpack-testimonial' ) ) : ?>

		<div class="hero-wrapper">
			<h1 class="page-title">
				<?php
					$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

					if ( '' != $jetpack_options['page-title'] ) {
						echo esc_html( $jetpack_options['page-title'] );
					} else {
						_e( 'Testimonials', 'edin' );
					}
				?>
			</h1>
		</div>

	<?php elseif ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>

		<?php the_title( '<div class="hero-wrapper"><h1 class="page-title">', '</h1></div>' ); ?>

	<?php else : ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
				if ( 1 == get_theme_mod( 'edin_title_front_page' ) ) {
					the_title( '<header class="entry-header"><h1 class="page-title">', '</h1></header>' );
				}
			?>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before'      => '<div class="page-links">' . __( 'Pages:', 'edin' ),
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php edit_post_link( __( 'Edit', 'edin' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
		</article><!-- #post-## -->

	<?php endif; ?>
</div><!-- .hero -->

<?php
	if ( ! function_exists( 'jetpack_breadcrumbs' ) || 0 == get_theme_mod( 'edin_breadcrumbs' ) || ! is_page() || is_page_template( 'page-templates/front-page.php' ) || is_front_page() ) {
		return;
	}
?>

<div class="breadcrumbs-wrapper">
	<?php jetpack_breadcrumbs(); ?>
</div><!-- .breadcrumbs-wrapper -->
