<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Edin
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.ico" />
<link rel="icon" type="image/png" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.png" />

<?php wp_head(); ?>

<link rel="stylesheet" type="text/css" href="">
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'edin' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="header-wrapper clear">

			<div class="content-wrapper clear">
				<div class="site-branding">
					<a class="healthcare-link" href="http://www.healthcare.com">Healthcare.com</a>
				</div><!-- .site-branding -->

				<?php if ( is_active_sidebar( 'sidebar-header-top' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-header-top' ); ?>
				<?php endif; ?>
			</div>


			<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) ) : ?>
				<div id="site-navigation" class="header-navigation">
					<button class="menu-toggle" aria-expanded="false"><?php _e( 'Menu', 'edin' ); ?></button>
					<div class="navigation-wrapper clear">
						<?php if ( has_nav_menu( 'secondary' ) ) : ?>
							<nav class="secondary-navigation" role="navigation">
								<?php
									wp_nav_menu( array(
										'theme_location'  => 'secondary',
										'container_class' => 'menu-secondary',
										'menu_class'      => 'clear',
										'depth'           => 1,
									) );
								?>
							</nav><!-- .secondary-navigation -->
						<?php endif; ?>
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav class="primary-navigation" role="navigation">
								<?php
									wp_nav_menu( array(
										'theme_location'  => 'primary',
										'container_class' => 'menu-primary',
										'menu_class'      => 'clear',
									) );
								?>
							</nav><!-- .primary-navigation -->
						<?php endif; ?>
					</div><!-- .navigation-wrapper -->
				</div><!-- #site-navigation -->
			<?php endif; ?>

			<?php if ( 1 == $search_header ) : ?>
				<div id="site-search" class="header-search">
					<button class="search-toggle" aria-expanded="false"><span class="screen-reader-text"><?php _e( 'Search', 'edin' ); ?></span></button>
				</div><!-- #site-search -->
			<?php endif; ?>
		</div><!-- .header-wrapper -->

		<?php
			$search_header = get_theme_mod( 'edin_search_header' );
			if ( 1 == $search_header ) :
		?>
		<div class="search-wrapper">
			<?php get_search_form(); ?>
		</div><!-- .search-wrapper -->
		<?php endif; ?>


		<div class="hero-wrapper">
			<div class="hero-image-wrapper">
				<?php if ( is_home() && get_header_image() ) : ?>
				<img class="hero-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">			
				<?php endif; // End header image check. ?>
			</div>

			<div class="hero-content-wrapper content-wrapper clear">

				<?php
					edin_the_site_logo();
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif;
				?>

				<?php if ( is_active_sidebar( 'sidebar-banner-assitance' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-banner-assitance' ); ?>
				<?php endif; ?>

				<?php if ( is_home() && is_active_sidebar( 'sidebar-banner-quotes' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-banner-quotes' ); ?>
				<?php endif; ?>
			</div>	

			<?php if ( is_home() && is_active_sidebar( 'home-featured' ) ) : ?>	
			<div id="home-featured">
				<div class="content-wrapper clear">
					<?php dynamic_sidebar( 'home-featured' ); ?>
				</diV>
			</diV>
			<?php endif; // End Home Highlights check. ?>
		</div><!-- .hero-wrapper -->


	</header><!-- #masthead -->

	<div id="content" class="site-content">
