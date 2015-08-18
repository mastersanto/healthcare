<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Edin
 */

if ( ! function_exists( 'edin_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function edin_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'edin' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous">
					<?php
						if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
							next_posts_link( __( '<span class="meta-nav">&larr;</span> Older testimonials', 'edin' ) );
						} else {
							next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'edin' ) );
						}
					?>
				</div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next">
					<?php
						if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
							previous_posts_link( __( 'Newer testimonials <span class="meta-nav">&rarr;</span>', 'edin' ) );
						} else {
							previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'edin' ) );
						}
					?>
				</div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'edin_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function edin_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'edin' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'edin' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'edin' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'edin_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function edin_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'edin' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'edin' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function edin_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'edin_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'edin_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so edin_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so edin_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in edin_categorized_blog.
 */
function edin_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'edin_categories' );
}
add_action( 'edit_category', 'edin_category_transient_flusher' );
add_action( 'save_post',     'edin_category_transient_flusher' );

if ( ! function_exists( 'edin_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags, comments and edit link.
 */
function edin_entry_meta() {
	if ( has_post_format() ) {
		$format = get_post_format();
		echo '<span class="post-format-link"><a class="genericon genericon-' . $format . '" href="' . esc_url( get_post_format_link( $format ) ) . '" title="' . esc_attr( sprintf( __( 'All %s posts', 'edin' ), get_post_format_string( $format ) ) ) . '"><span class="screen-reader-text">' . get_post_format_string( $format ) . '</span></a></span>';
	}
	/* Hide category and tag text for pages */
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'edin' ) );
		if ( $categories_list && edin_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'edin' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'edin' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'edin' ) . '</span>', $tags_list );
		}
	}

	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'edin' ), __( '1 Comment', 'edin' ), __( '% Comments', 'edin' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'edin' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Change the class of the hero area depending on featured image.
 */
function edin_additional_class() {
	$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

	if ( is_post_type_archive( 'jetpack-testimonial' ) && '' != $jetpack_options['featured-image'] ) {
		$additional_class =  'with-featured-image';
	} elseif ( is_archive() || is_search() || is_404() || '' == get_the_post_thumbnail() ) {
		$additional_class =  'without-featured-image';
	} else {
		$additional_class =  'with-featured-image';
	}

	return $additional_class;
}

/**
 * Add background-image to hero area.
 */
function edin_hero_background() {
	$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

	if ( is_post_type_archive( 'jetpack-testimonial' ) && '' != $jetpack_options['featured-image'] ) {
		$thumbnail = wp_get_attachment_image_src( (int)$jetpack_options['featured-image'], 'edin-hero' );
		$css = '.hero.with-featured-image { background-image: url(' . esc_url( $thumbnail[0] ) . '); }';
		wp_add_inline_style( 'edin-style', $css );
	} elseif ( is_archive() || is_search() || is_404() || '' == get_the_post_thumbnail() ) {
		return;
	} else {
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'edin-hero' );
		$css = '.hero.with-featured-image { background-image: url(' . esc_url( $thumbnail[0] ) . '); }';
		wp_add_inline_style( 'edin-style', $css );
	}
}
add_action( 'wp_enqueue_scripts', 'edin_hero_background' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @return void
 */
function edin_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() || has_post_format() ) {
		return;
	}
?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
		<?php
			if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/grid-page.php' ) ) {
				$ratio = get_theme_mod( 'edin_thumbnail_style' );
				switch ( $ratio ) {
					case 'square':
						the_post_thumbnail( 'edin-thumbnail-square' );
						break;
					default :
						the_post_thumbnail( 'edin-thumbnail-landscape' );
				}
			} else {
				the_post_thumbnail( 'edin-featured-image' );
			}
		?>
	</a>

<?php
}

/**
 * Display featured pages.
 */
function edin_featured_pages() {
	$featured_page_1 = esc_attr( get_theme_mod( 'edin_featured_page_one_front_page', '0' ) );
	$featured_page_2 = esc_attr( get_theme_mod( 'edin_featured_page_two_front_page', '0' ) );
	$featured_page_3 = esc_attr( get_theme_mod( 'edin_featured_page_three_front_page', '0' ) );

	if ( 0 == $featured_page_1 && 0 == $featured_page_2 && 0 == $featured_page_3 ) {
		return;
	}
?>

	<div id="quaternary" class="featured-page-area">
		<div class="featured-page-wrapper clear">

			<?php for ( $page_number = 1; $page_number <= 3; $page_number++ ) : ?>
				<?php if ( 0 != ${'featured_page_' . $page_number} ) : // Check if a featured page has been set in the customizer ?>
					<div class="featured-page">

						<?php
							// Create new argument using the page ID of the page set in the customizer
							$featured_page_args = array(
								'page_id' => ${'featured_page_' . $page_number},
							);
							// Create a new WP_Query using the argument previously created
							$featured_page_query = new WP_Query( $featured_page_args );
						?>

						<?php while ( $featured_page_query->have_posts() ) : $featured_page_query->the_post(); ?>

							<?php get_template_part( 'content', 'grid' ); ?>

						<?php
							endwhile;
							wp_reset_postdata();
						?>
					</div><!-- .featured-page -->
				<?php endif; ?>
			<?php endfor; ?>

		</div><!-- .featured-page-wrapper -->
	</div><!-- #quaternary -->

<?php
}
