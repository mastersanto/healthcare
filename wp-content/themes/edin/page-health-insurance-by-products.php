<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Edin
 */

get_header(); ?>

	<div class="content-wrapper clear">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
					/*
					*  get all custom fields, loop through them and create a label => value markup
					*/

					$fields = get_field_objects();

					if( $fields )
					{
						foreach( $fields as $field_name => $field )
						{
							echo '<div id="' . $field_name . '">';
								echo '<h2>' . $field['label'] . '</h2>';
								echo $field['value'];
							echo '</div>';
						}
					}

				?>
			</main><!-- #main -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>