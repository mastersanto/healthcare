<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Edin
 */

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
								$health_information = get_field( 'health_information' );
								if( $health_information ) :
							?>
							<div class="accordion">
								<h4 class="accordion-title">Health Information</h4>
								<div class="accordion-content" style="display: none">
									<?php
										//echo $health_information;
										$string = strip_tags($health_information);								
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
									?>
								</div>
							</div>
							<?php endif; ?>

						</div>


 
						<?php

							get_post_custom($post_id);
						?>

						<?php
							$custom_fields = get_post_custom();

							if($custom_fields) {

								echo '<div id="accordions">';

								foreach ( $custom_fields as $field_key => $field_values ) {
									if(!isset($field_values[0])) continue;
									if($field_key == 'locations') break;
									if(in_array($field_key, array("_edit_lock","_edit_last"))) continue;
									echo '<div class="accordion"><h4 class="accordion-title">' . $field_key
										. '</h4><div class="accordion-content" style="display: none">';

									$string = strip_tags($field_values[0]);
									//$string = $field_values[0];

									if (strlen($string) > 100) {

									    // truncate string
									    $stringCut = substr($string, 0, 100);

									    // make sure it ends in a word so assassinate doesn't become ass...
									    $startString = substr($stringCut, 0, strrpos($stringCut, ' ')); 
									    $endString = substr($string, strrpos($stringCut, ' '));
									}
									echo $startString . '<a href="#"class="read-more">Read More</a>' . 
										'<span class="more-text" style="display: none">' . $endString . '<a href="#"class="show-less">Show less</a><span></div></div>';

									//. '<a href="#" class="read-more-toggle read-more">Read more</span><span class"show-less">Show less</span></a></div></div>';
								}

								echo '</div>';
							}

						?>

						<?php

							$locations = get_field( 'locations' );

							if( $locations ) {

							echo '<h3>LOCATIONS</h3>' . $locations;

							}
						?>

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