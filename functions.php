<?php
/**
 * Theme setup
 * 
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses add_theme_support() To add support for automatic feed links, post
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 */
function vintage_setup() {
	load_theme_textdomain( 'vintage' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'vintage' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	/*
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	$logo_width  = 300;
	$logo_height = 100;

	add_theme_support(
		'custom-logo',
		array(
			'height'               => $logo_height,
			'width'                => $logo_width,
			'flex-width'           => true,
			'flex-height'          => true,
			'unlink-homepage-logo' => true,
		)
	);

	add_theme_support( 'title-tag' );

	// Hide toolbar
	if ( ! is_admin() ) {
		show_admin_bar( false );
	}
}
add_action( 'after_setup_theme', 'vintage_setup' );


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty_Press 1.0
 */
function vintage_scripts_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS

	// Loads JavaScript file with functionality specific to Twenty_Press.
	wp_enqueue_script( 'vintage-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20210122', true );
	wp_localize_script( 'vintage-script', 'VINTAGE', array(
		'ajaxURL'	=> admin_url( 'admin-ajax.php' ),
		'nonce' 	=> wp_create_nonce( 'wp_rest' ),
	) );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'inter-fonts', 'https://rsms.me/inter/inter.css', array(), null );

	// Loads our main stylesheet.
	wp_enqueue_style( 'output-style', get_template_directory_uri() . '/css/output.min.css', array(), '20221101' );
	wp_enqueue_style( 'vintage-style', get_stylesheet_uri(), array(), '20221101' );
}
add_action( 'wp_enqueue_scripts', 'vintage_scripts_styles' );

/*
 * Add preconnect for Google Fonts.
 *
 * @since Twenty_Press 2.1
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function vintage_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'vintage-style', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://rsms.me',
				'crossorigin',
			);
		} 
		else {
			$urls[] = 'https://rsms.me';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'vintage_resource_hints', 10, 2 );


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}