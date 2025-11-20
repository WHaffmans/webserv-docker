<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
}
?>
	<a class="skip-link button" href="#main"><?php esc_html_e( 'Skip to Content', 'skewart' ); ?></a>

	<header id="header" role="banner"></header>

	<div id="nav">
		<button type="button" class="open-menu skew" aria-expanded="false" aria-controls="main-menu-container">
			<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
				<rect y="4" width="24" height="3" rx="1.5" fill="currentColor"/>
				<rect y="10.5" width="24" height="3" rx="1.5" fill="currentColor"/>
				<rect y="17" width="24" height="3" rx="1.5" fill="currentColor"/>
			</svg>
			<span class="nav-label"><?php esc_html_e( 'Open Menu', 'skewart' ); ?></span>
		</button>

		<div id="main-menu-container" class="menu-closed">
			<nav id="main-menu" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'skewart' ); ?>">
				<button type="button" class="close-menu" aria-label="<?php esc_attr_e( 'Close Menu', 'skewart' ); ?>">
					<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<path fill="currentColor" d="M17.4,18.8L3.8,5.2h2.8l13.6,13.6H17.4z"/>
						<path fill="currentColor" d="M20.2,5.2L6.6,18.8H3.8L17.4,5.2H20.2z"/>
					</svg>
					<span class="nav-label"><?php esc_html_e( 'Close Menu', 'skewart' ); ?></span>
				</button>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'main-menu',
						'container'      => false,
						'depth'          => 2,
						'fallback_cb'    => false,
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'menu',
					)
				);
				?>
			</nav>
		</div><!-- #main-menu-container -->
	</div><!-- #nav -->

	<div id="logo">
		<?php
		if ( has_custom_logo() ) :
			the_custom_logo();
		else :
			?>
			<h1 class="site-title glitch skew" data-text="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</a>
			</h1>
			<?php
		endif;
		?>
	</div>
