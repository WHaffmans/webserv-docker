<?php
/**
 * Skewart theme functions and definitions
 *
 * @package Skewart
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup
 */
function skewart_setup() {
	load_theme_textdomain( 'skewart', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 800, 800 );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
		'navigation-widgets',
	) );

	add_theme_support( 'custom-background', array(
		'default-repeat'     => 'no-repeat',
		'default-position-x' => 'center',
		'default-position-y' => 'center',
		'default-attachment' => 'fixed',
		'default-size'       => 'cover',
		'default-color'      => '#171125',
	) );

	add_theme_support( 'custom-logo', array(
		'height'      => 110,
		'width'       => 110,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => esc_html__( 'Small', 'skewart' ),
			'size' => 12,
			'slug' => 'small',
		),
		array(
			'name' => esc_html__( 'Big', 'skewart' ),
			'size' => 20,
			'slug' => 'big',
		),
		array(
			'name' => esc_html__( 'Huge', 'skewart' ),
			'size' => 28,
			'slug' => 'huge',
		),
	) );

	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'Neon Cyan', 'skewart' ),
			'slug'  => 'primary',
			'color' => '#00f3ff',
		),
		array(
			'name'  => esc_html__( 'Neon Magenta', 'skewart' ),
			'slug'  => 'primary-alt',
			'color' => '#ff00ff',
		),
		array(
			'name'  => esc_html__( 'Hot Pink', 'skewart' ),
			'slug'  => 'accent',
			'color' => '#ff2975',
		),
		array(
			'name'  => esc_html__( 'Electric Purple', 'skewart' ),
			'slug'  => 'accent-alt',
			'color' => '#7700ff',
		),
		array(
			'name'  => esc_html__( 'Neo White', 'skewart' ),
			'slug'  => 'foreground',
			'color' => '#e0e0ff',
		),
		array(
			'name'  => esc_html__( 'Deep Space', 'skewart' ),
			'slug'  => 'background',
			'color' => '#171125',
		),
		array(
			'name'  => esc_html__( 'Midnight Blue', 'skewart' ),
			'slug'  => 'dark-grey',
			'color' => '#242454',
		),
		array(
			'name'  => esc_html__( 'Cyber Slate', 'skewart' ),
			'slug'  => 'light-grey',
			'color' => '#444466',
		),
		array(
			'name'  => esc_html__( 'Ghost Lavender', 'skewart' ),
			'slug'  => 'medium-grey',
			'color' => '#8888aa',
		),
	) );

	add_image_size( 'skewart-featured-large', 1200, 600, true );
	add_image_size( 'skewart-featured-medium', 800, 450, true );

	register_nav_menus( array(
		'main-menu' => esc_html__( 'Main Menu', 'skewart' ),
	) );
}
add_action( 'after_setup_theme', 'skewart_setup' );

/**
 * Set content width
 */
function skewart_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'skewart_content_width', 1200 );
}
add_action( 'after_setup_theme', 'skewart_content_width', 0 );

/**
 * Register widget area
 */
function skewart_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'skewart' ),
		'id'            => 'footer-widgets',
		'description'   => esc_html__( 'Add widgets to the footer.', 'skewart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="underline no-grad">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'skewart_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function skewart_scripts() {
	// Main Stylesheet
	wp_enqueue_style( 'skewart-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	// Google Font
	wp_enqueue_style( 'skewart-fonts', 'https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&family=Oswald:wght@200..700&display=swap', array(), null );

	// Comments Scripts
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Theme Scripts - no jQuery dependency
	wp_enqueue_script( 'skewart-navigation', get_template_directory_uri() . '/js/scripts.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'skewart_scripts' );

/**
 * Customizer additions
 */
function skewart_customize_register( $wp_customize ) {
	// Add setting to use default background
	$wp_customize->add_setting( 'skewart_use_default_background', array(
		'default'           => true,
		'sanitize_callback' => 'skewart_sanitize_checkbox',
		'transport'         => 'refresh',
	) );

	// Add control for the setting
	$wp_customize->add_control( 'skewart_use_default_background', array(
		'label'       => esc_html__( 'Use theme default cyberpunk gradient', 'skewart' ),
		'description' => esc_html__( 'Enable to use the theme\'s default gradient background. Disable to use a solid color or image background.', 'skewart' ),
		'section'     => 'background_image',
		'type'        => 'checkbox',
		'priority'    => 1,
	) );

	// Update description for background section
	$wp_customize->get_section( 'background_image' )->description = esc_html__( 'Control your site background. You can use the theme\'s default cyberpunk gradient or set a custom color/image.', 'skewart' );
	
	// Reorder controls to make the flow more logical
	$wp_customize->get_control( 'background_color' )->priority = 20;
	$wp_customize->get_control( 'background_image' )->priority = 30;
}
add_action( 'customize_register', 'skewart_customize_register', 11 );

/**
 * Sanitize checkbox values
 */
function skewart_sanitize_checkbox( $input ) {
	return ( isset( $input ) && true === $input ) ? true : false;
}

/**
 * Add custom body class
 */
function skewart_body_classes( $classes ) {
	// Add class for default background
	if ( get_theme_mod( 'skewart_use_default_background', true ) ) {
		$classes[] = 'has-default-background';
	}
	
	return $classes;
}
add_filter( 'body_class', 'skewart_body_classes' );

/**
 * Ensure menu items with children have appropriate class
 */
function skewart_menu_item_classes( $classes, $item, $args ) {
	return $classes;
}
add_filter( 'nav_menu_css_class', 'skewart_menu_item_classes', 10, 3 );
