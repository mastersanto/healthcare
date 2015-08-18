<?php
/**
 * Edin Theme Customizer
 *
 * @package Edin
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function edin_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section( 'edin_theme_options', array(
		'title'    => __( 'Theme Options', 'edin' ),
		'priority' => 130,
	) );

	/* Menu Style */
	$wp_customize->add_setting( 'edin_menu_style', array(
		'default'           => 'default',
		'sanitize_callback' => 'edin_sanitize_menu_style',
	) );
	$wp_customize->add_control( 'edin_menu_style', array(
		'label'             => __( 'Menu Style', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'default' => __( 'Default', 'edin' ),
			'classic' => __( 'Classic', 'edin' ),
		),
	) );

	/* Sidebar Position */
	$wp_customize->add_setting( 'edin_sidebar_position', array(
		'default'           => 'right',
		'sanitize_callback' => 'edin_sanitize_sidebar_position',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'edin_sidebar_position', array(
		'label'             => __( 'Sidebar Position', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 2,
		'type'              => 'radio',
		'choices'           => array(
			'left'  => __( 'Left', 'edin' ),
			'right' => __( 'Right', 'edin' ),
		),
	) );

	/* Thumbnail Aspect Ratio */
	$wp_customize->add_setting( 'edin_thumbnail_style', array(
		'default'           => 'landscape',
		'sanitize_callback' => 'edin_sanitize_thumbnail_style',
	) );
	$wp_customize->add_control( 'edin_thumbnail_style', array(
		'label'             => __( 'Thumbnail Aspect Ratio', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 3,
		'type'              => 'radio',
		'choices'           => array(
			'landscape' => __( 'Landscape (4:3)', 'edin' ),
			'square'    => __( 'Square (1:1)', 'edin' ),
		),
	) );

	/* Header: show breadcrumb navigation */
	if ( function_exists( 'jetpack_breadcrumbs' ) ) {
		$wp_customize->add_setting( 'edin_breadcrumbs', array(
			'default'           => '',
			'sanitize_callback' => 'edin_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'edin_breadcrumbs', array(
			'label'             => __( 'Pages: show breadcrumb navigation', 'edin' ),
			'section'           => 'edin_theme_options',
			'priority'          => 4,
			'type'              => 'checkbox',
		) );
	}

	/* Featured Image: Remove filter */
	$wp_customize->add_setting( 'edin_featured_image_remove_filter', array(
		'default'           => '',
		'sanitize_callback' => 'edin_sanitize_checkbox',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'edin_featured_image_remove_filter', array(
		'label'             => __( 'Featured Image: remove filter', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 5,
		'type'              => 'checkbox',
	) );

	/* Header: show search form */
	$wp_customize->add_setting( 'edin_search_header', array(
		'default'           => '',
		'sanitize_callback' => 'edin_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'edin_search_header', array(
		'label'             => __( 'Header: show search form', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 6,
		'type'              => 'checkbox',
	) );

	/* Front Page: show title */
	$wp_customize->add_setting( 'edin_title_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'edin_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'edin_title_front_page', array(
		'label'             => __( 'Front Page: show title', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 7,
		'type'              => 'checkbox',
	) );

	/* Front Page: Featured Page One */
	$wp_customize->add_setting( 'edin_featured_page_one_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'edin_sanitize_dropdown_pages',
	) );
	$wp_customize->add_control( 'edin_featured_page_one_front_page', array(
		'label'             => __( 'Front Page: Featured Page One', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 8,
		'type'              => 'dropdown-pages',
	) );

	/* Front Page: Featured Page Two */
	$wp_customize->add_setting( 'edin_featured_page_two_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'edin_sanitize_dropdown_pages',
	) );
	$wp_customize->add_control( 'edin_featured_page_two_front_page', array(
		'label'             => __( 'Front Page: Featured Page Two', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 9,
		'type'              => 'dropdown-pages',
	) );

	/* Front Page: Featured Page Three */
	$wp_customize->add_setting( 'edin_featured_page_three_front_page', array(
		'default'           => '',
		'sanitize_callback' => 'edin_sanitize_dropdown_pages',
	) );
	$wp_customize->add_control( 'edin_featured_page_three_front_page', array(
		'label'             => __( 'Front Page: Featured Page Three', 'edin' ),
		'section'           => 'edin_theme_options',
		'priority'          => 10,
		'type'              => 'dropdown-pages',
	) );

	/* Jetpack Testimonial */
	$wp_customize->add_setting( 'edin_testimonials', array(
		'default'           => '',
		'sanitize_callback' => 'edin_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'edin_testimonials', array(
		'label'             => __( 'Show 2 random testimonials on the Front Page Template ', 'edin' ),
		'section'           => 'jetpack_testimonials',
		'priority'          => 90,
		'type'              => 'checkbox',
	) );
}
add_action( 'customize_register', 'edin_customize_register' );

/**
 * Sanitize the Menu Style value.
 *
 * @param string $style.
 * @return string (default|classic).
 */
function edin_sanitize_menu_style( $style ) {
	if ( ! in_array( $style, array( 'default', 'classic' ) ) ) {
		$style = 'default';
	}
	return $style;
}

/**
 * Sanitize the Sidebar Position value.
 *
 * @param string $position.
 * @return string (left|right).
 */
function edin_sanitize_sidebar_position( $position ) {
	if ( ! in_array( $position, array( 'left', 'right' ) ) ) {
		$position = 'right';
	}
	return $position;
}

/**
 * Sanitize the Grid Thumbnail Aspect Ratio value.
 *
 * @param string $ratio.
 * @return string (landscape|square).
 */
function edin_sanitize_thumbnail_style( $ratio ) {
	if ( ! in_array( $ratio, array( 'landscape', 'square' ) ) ) {
		$ratio = 'landscape';
	}
	return $ratio;
}

/**
 * Sanitize the checkbox.
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function edin_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Sanitize the dropdown pages.
 *
 * @param interger $input.
 * @return interger.
 */
function edin_sanitize_dropdown_pages( $input ) {
	if ( is_numeric( $input ) ) {
		return intval( $input );
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function edin_customize_preview_js() {
	wp_enqueue_script( 'edin_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'edin_customize_preview_js' );
