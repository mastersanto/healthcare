<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Edin
 */

function addReadMore ($content) {
	//echo $health_information;
	$string = strip_tags($content);								
	//$string = $health_information;

	if (strlen($string) > 100) {

	    // truncate string
	    $stringCut = substr($string, 0, 100);

	    // make sure it ends in a word so assassinate doesn't become ass...
	    $startString = substr($stringCut, 0, strrpos($stringCut, ' ')); 
	    $endString = substr($string, strrpos($stringCut, ' '));
	}
	echo $startString . '<a href="#"class="read-more">Read More</a>' . 
		'<span class="more-text" style="display: none">' . $endString . '<a href="#"class="show-less">Show less</a><span>';
}

get_header(); ?>

	<div class="content-wrapper clear">

		<div id="primary" class="content-area content-states">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						if ( 'jetpack-testimonial' === get_post_type() ) {
							get_template_part( 'content', 'testimonial' );
						} else {
							get_template_part( 'content', 'single' );
						}
						?>

						<div id="accordions">

							<?php
								// PRINT Health Information
								//--------------------------------------------
								$health_information = get_field( 'health_information' );
								if( $health_information ) :
							?>
							<div class="accordion">
								<h4 class="accordion-title">Health Information</h4>
								<div class="accordion-content" style="display: none">
									<?php addReadMore($health_information); ?>
								</div>
							</div>
							<?php endif; ?>

							<?php
								// PRINT Health Highlights
								//--------------------------------------------
								$health_highlights = get_field( 'health_highlights' );
								if( $health_highlights ) :
							?>
							<div class="accordion">
								<h4 class="accordion-title">Health Highlights</h4>
								<div class="accordion-content" style="display: none">
									<?php addReadMore($health_highlights); ?>
								</div>
							</div>
							<?php endif; ?>

							<?php
								// PRINT Health Weaknesses
								//--------------------------------------------
								$health_weaknesses = get_field( 'health_weaknesses' );
								if( $health_weaknesses ) :
							?>
							<div class="accordion">
								<h4 class="accordion-title">Health Weaknesses</h4>
								<div class="accordion-content" style="display: none">
									<?php addReadMore($health_weaknesses); ?>
								</div>
							</div>
							<?php endif; ?>

							<?php
								// PRINT Health Insurance Quotes
								//--------------------------------------------
								$health_insurance_quotes = get_field( 'health_insurance_quotes' );
								if( $health_insurance_quotes ) :
							?>
							<div class="accordion">
								<h4 class="accordion-title">Health Insurance Quotes</h4>
								<div class="accordion-content" style="display: none">
									<?php addReadMore($health_insurance_quotes); ?>
								</div>
							</div>
							<?php endif; ?>

							<?php
								// PRINT Locations
								//--------------------------------------------
								$locations = get_field( 'locations' );
								if( $locations ) :
							?>
							<div class="accordion">
								<h4 class="accordion-title">Insurance and Department of Health Information</h4>
								<div class="accordion-content" style="display: none">
									<?php echo $locations; ?>
								</div>
							</div>
							<?php endif; ?>


						</div>

					<?php edin_post_nav(); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( ( comments_open() || '0' != get_comments_number() ) && 'jetpack-testimonial' != get_post_type() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>