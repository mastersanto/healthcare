<?php
/**
 * Template Name: Front Page
 *
 * @package Edin
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'hero' ); ?>

	<?php endwhile; ?>

	<?php rewind_posts(); ?>

<?php edin_featured_pages(); ?>

<?php //get_sidebar( 'front-page' ); ?>

<?php $testimonials = edin_get_random_posts( 2, 'jetpack-testimonial' ); ?>

<?php if ( ! empty( $testimonials ) && 0 != get_theme_mod( 'edin_testimonials' ) ) : ?>
	<div id="front-page-testimonials" class="front-page-testimonials-area">
		<div class="front-page-testimonials-wrapper clear">
			<?php
				foreach ( $testimonials as $testimonial ) : setup_postdata( $GLOBALS['post'] =& $testimonial );
					get_template_part( 'content', 'testimonial' );
				endforeach;
				wp_reset_postdata();
			?>
		</div><!-- .front-page-testimonials-wrapper -->
	</div><!-- #front-page-testimonials -->
<?php endif; ?>

<?php get_footer(); ?>