<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Edin
 */

get_header(); ?>

<div class="hero <?php echo edin_additional_class(); ?>">
	<?php if ( have_posts() ) : ?>

		<div class="hero-wrapper">
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'edin' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>

	<?php else : ?>

		<div class="hero-wrapper">
			<h1 class="page-title"><?php _e( 'Nothing Found', 'edin' ); ?></h1>
		</div>

	<?php endif; ?>
</div><!-- .hero -->

<div class="content-wrapper clear">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'content', 'search' );
					?>

				<?php endwhile; ?>

				<?php edin_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>