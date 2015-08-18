<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Edin
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function edin_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'edin_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function edin_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of has-custom-background to blogs with background settings different from default settings.
	if ( get_background_image() || 'ffffff' != get_background_color() ) {
		$classes[] = 'has-custom-background';
	}

	// Adds a class of has-footer-navigation to blogs with footer navigation active.
	if ( has_nav_menu( 'footer' ) ) {
		$classes[] = 'has-footer-navigation';
	}

	// Adds a class of has-header-search to blogs with search form in header.
	if ( 1 == get_theme_mod( 'edin_search_header' ) ) {
		$classes[] = 'has-header-search';
	}

	// Adds a class of navigation-(default|classic) to blogs.
	if ( 'classic' == get_theme_mod( 'edin_menu_style' ) ) {
		$classes[] = 'navigation-classic';
	} else {
		$classes[] = 'navigation-default';
	}

	// Adds a class of no-header-navigation to blogs without a primary and a secondary menu.
	if ( ! has_nav_menu( 'primary' ) && ! has_nav_menu( 'secondary' ) ) {
		$classes[] = 'no-header-navigation';
	}

	// Adds a class of no-sidebar-full, no-sidebar or sidebar-(right|left) to blogs.
	if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/grid-page.php' ) || is_page_template( 'page-templates/full-width-page.php' ) || is_404() || is_post_type_archive( 'jetpack-testimonial' ) ) {
		$classes[] = 'no-sidebar-full';
	} elseif ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	} else {
		$classes[] = 'sidebar-' . get_theme_mod( 'edin_sidebar_position', 'right' );
	}

	// Adds a class of no-image-filter to blogs with the no filter theme option ticked.
	if ( 1 == get_theme_mod( 'edin_featured_image_remove_filter' ) ) {
		$classes[] = 'no-image-filter';
	}

	return $classes;
}
add_filter( 'body_class', 'edin_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function edin_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'edin' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'edin_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function edin_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'edin_setup_author' );

/**
 * Returns the URL from the post.
 *
 * @uses get_the_link() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @return string URL
 */
function edin_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url && has_post_format( 'link' ) ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Use &hellip; instead of [...] for excerpts.
 */
function edin_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'edin_excerpt_more' );

/**
 * Get random posts; a simple, more efficient approach.
 * MySQL queries that use ORDER BY RAND() can be pretty challenging and slow on large datasets.
 * Also it works better with heavy caching.
 */
function edin_get_random_posts( $number = 1, $post_type = 'post' ) {
	$query = new WP_Query( array(
		'posts_per_page' => 100,
		'fields'         => 'ids',
		'post_type'      => $post_type
	) );

	$post_ids = $query->posts;
	shuffle( $post_ids );
	$post_ids = array_splice( $post_ids, 0, $number );

	$random_posts = get_posts( array(
		'post__in'    => $post_ids,
		'numberposts' => count( $post_ids ),
		'post_type'   => $post_type
	) );

	return $random_posts;
}
