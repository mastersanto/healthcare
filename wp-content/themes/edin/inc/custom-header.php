<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Edin
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses edin_header_style()
 * @uses edin_admin_header_style()
 * @uses edin_admin_header_image()
 */
function edin_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'edin_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '303030',
		'width'                  => 1230,
		'height'                 => 100,
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'edin_header_style',
		'admin-head-callback'    => 'edin_admin_header_style',
		'admin-preview-callback' => 'edin_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'edin_custom_header_setup' );

if ( ! function_exists( 'edin_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see edin_custom_header_setup().
 */
function edin_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // edin_header_style

if ( ! function_exists( 'edin_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see edin_custom_header_setup().
 */
function edin_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			background: #fff;
			font-family: "PT Sans", sans-serif;
		}
		#headimg h1 {
			margin: 30px;
			font-size: 36px;
			line-height: 21.3px;
			text-transform: uppercase;
		}
		#headimg h1 a {
			text-decoration: none;
		}
		#headimg img {
			display: block;
			margin: 0 auto;
			width: 100%;
			height: auto;
		}
	</style>
<?php
}
endif; // edin_admin_header_style

if ( ! function_exists( 'edin_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see edin_custom_header_setup().
 */
function edin_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
<?php
}
endif; // edin_admin_header_image
