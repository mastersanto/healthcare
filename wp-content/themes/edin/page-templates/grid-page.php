<?php
/**
 * Template Name: Grid Page
 *
 * @package Edin
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'hero' ); ?>

	<?php endwhile; ?>

	<?php rewind_posts(); ?>

	<?php if ( '' != $post->post_content ) : // only display if content not empty ?>

	<div class="content-wrapper">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .content-wrapper -->

	<?php endif; ?>

	<?php
		$child_pages = new WP_Query( array(
			'post_type'      => 'page',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_parent'    => $post->ID,
			'posts_per_page' => 999,
			'no_found_rows'  => true,
		) );
	?>

	<?php if ( $child_pages->have_posts() ) : ?>

		<div id="quaternary" class="grid-area">
			<div class="grid-wrapper clear">

				<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>

					<div class="grid">
						<?php get_template_part( 'content', 'grid' ); ?>
					</div><!-- .grid -->

				<?php endwhile; ?>

			</div><!-- .grid-wrapper -->
		</div><!-- #quaternary -->

	<?php
		endif;
		wp_reset_postdata();
	?>

<?php get_footer(); ?>