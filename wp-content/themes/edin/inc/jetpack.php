<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Edin
 */

function edin_jetpack_setup() {
	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'footer_widgets' => array(
			'sidebar-2',
			'sidebar-3',
			'sidebar-4',
		),
		'footer'         => 'page',
		'render'    	 => 'edin_infinite_scroll_render',
	) );

	/**
	 * Add theme support for Responsive Videos.
	 */
	add_theme_support( 'jetpack-responsive-videos' );

	/**
	 * Add theme support for Testimonial CPT.
	 */
	add_theme_support( 'jetpack-testimonial' );

	/**
	 * Add theme support for Logo upload.
	 */
	add_image_size( 'edin-logo', 583, 192 );
	add_theme_support( 'site-logo', array( 'size' => 'edin-logo' ) );
}
add_action( 'after_setup_theme', 'edin_jetpack_setup' );

/**
 * Define the code that is used to render the posts added by Infinite Scroll.
 *
 * Includes the whole loop. Used to include the correct template part for the Testimonial CPT.
 */
function edin_infinite_scroll_render() {
	while( have_posts() ) {
		the_post();
		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			get_template_part( 'content', 'testimonial' );
		} else {
			get_template_part( 'content', get_post_format() );
		}
	}
}

/**
 * Flush the Rewrite Rules for the Testimonial CPT after the user has activated the theme.
 */
function edin_flush_rewrite_rules() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'edin_flush_rewrite_rules' );

/**
 * Return early if Site Logo is not available.
 */
function edin_the_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	} else {
		jetpack_the_site_logo();
	}
}

/**
 * Remove sharedaddy from excerpt.
 */
function edin_remove_sharedaddy() {
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'edin_remove_sharedaddy' );
