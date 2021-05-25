<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/dist/assets/vendor/midnight.jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/dist/assets/vendor/scrolloverflow.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.7/jquery.fullpage.js"></script>
		
		
	</head>
	<body <?php body_class(); ?>>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
		<?php get_template_part( 'template-parts/desktop-off-canvas' ); ?>
	<?php endif; ?>

	<header class="site-header" role="banner">

		<nav class="site-navigation top-bar" role="navigation" id="<?php foundationpress_mobile_menu_id(); ?>" data-aos="fade-down" data-aos-offset="100" data-aos-duration="400" data-aos-delay="400">
			<div class="midnightHeader default">
				<div class="top-bar-left">
					<div class="site-desktop-title top-bar-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/logo-bestaffers.png" alt="<?php bloginfo( 'name' ); ?>"></a>
					</div>
				</div>
				<div class="top-bar-right">
					<?php foundationpress_top_bar_desktop(); ?>
					<div class="menu-button">
						<div class="button_container toggle-menu">
							<span class="top"></span>
							<span class="middle"></span>
							<span class="bottom"></span>
						</div>
					</div>
					
					<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
						<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="midnightHeader white">
				<div class="top-bar-left">
					<div class="site-desktop-title top-bar-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/logo-bestaffers-white.png" alt="<?php bloginfo( 'name' ); ?>"></a>
					</div>
				</div>
				<div class="top-bar-right">
					<?php foundationpress_top_bar_desktop(); ?>
					<!-- <button aria-label="<?php _e( 'Desktop Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="desktop-offcanvas"></button> -->
					<div class="menu-button">
						<div class="button_container toggle-menu">
							<span class="top"></span>
							<span class="middle"></span>
							<span class="bottom"></span>
						</div>
					</div>
					
					<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
						<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="midnightHeader half-white">
				<div class="top-bar-left">
					<div class="site-desktop-title top-bar-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/logo-bestaffers-white.png" alt="<?php bloginfo( 'name' ); ?>"></a>
					</div>
				</div>
				<div class="top-bar-right">
					<?php foundationpress_top_bar_desktop(); ?>
					<!-- <button aria-label="<?php _e( 'Desktop Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="desktop-offcanvas"></button> -->
					<div class="menu-button">
						<div class="button_container toggle-menu">
							<span class="top"></span>
							<span class="middle"></span>
							<span class="bottom"></span>
						</div>
					</div>
					
					<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
						<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
					<?php endif; ?>
				</div>
			</div>
		</nav>
		<div class="overlay" id="overlay">
			<div class="site-navigation top-bar">
				<div class="top-bar-left">
					<div class="site-desktop-title top-bar-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/logo-bestaffers-white.png" alt="<?php bloginfo( 'name' ); ?>"></a>
					</div>
				</div>
				<div class="top-bar-right">
					<?php foundationpress_top_bar_lang(); ?>
					<div class="menu-button">
						<div class="button_container toggle-menu">
							<span class="top"></span>
							<span class="middle"></span>
							<span class="bottom"></span>
						</div>
					</div>
				</div>
			</div>
			<nav class="overlay-menu">
				<?php foundationpress_top_bar_r(); ?>
			</nav>
		</div>
	</header>
