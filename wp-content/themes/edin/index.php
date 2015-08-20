<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Edin
 */

get_header(); ?>

	<div class="content-wrapper clear">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php if ( query_posts( array ( 'category_name' => 'answers' ) ) ) : ?>
				<?php //if ( have_posts() ) : ?>


					<!--h2 class="answers-title"><?php echo category_description( get_category_by_slug('answers')->term_id ); ?></h2-->
					<h2 class="answers-title">Get Health Insurance <span>Answers</span></h2>

					<?php if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content-grid', get_post_format() );
							//get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php edin_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

	<?php if ( is_active_sidebar( 'home-useful-tools' ) ) : ?>
	<div id="useful-tools">
		<div class="content-wrapper clear">
			<?php dynamic_sidebar( 'home-useful-tools' ); ?>
		</div>
	</div>
	<?php endif; ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>