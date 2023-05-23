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
	wp_dequeue_script( 'wp-embed' );

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS

	// Add custom fonts, used in the main stylesheet.
	// wp_enqueue_style( 'poralia-fonts', poralia_fonts_url(), array(), null );

	// Loads JavaScript file with functionality specific to Twenty_Press.
	wp_enqueue_script( 'vintage-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20210122', true );
	wp_localize_script( 'vintage-script', 'VINTAGE', array(
		'ajaxURL'	=> admin_url( 'admin-ajax.php' ),
		'nonce' 	=> wp_create_nonce( 'wp_rest' ),
	) );

	// Loads our main stylesheet.
	wp_enqueue_style( 'font-family-style', 'https://rsms.me/inter/inter.css', array(), '20221101' );
	wp_enqueue_style( 'output-style', get_template_directory_uri() . '/css/output.min.css', array(), '20221101' );
	wp_enqueue_style( 'vintage-style', get_stylesheet_uri(), array(), '20221101' );
}
add_action( 'wp_enqueue_scripts', 'vintage_scripts_styles' );


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

	 if ( ! is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', false );
    }
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

/**
 * Add preconnect for Google Fonts.
 *
 * @since Poralia 1.6
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function poralia_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'poralia-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);

		$urls[] = array(
			'href' => 'https://rsms.me',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'poralia_resource_hints', 10, 2 );

if ( ! function_exists( 'poralia_fonts_url' ) ) :
	/**
	 * Register Google fonts for Poralia.
	 *
	 * Create your own poralia_fonts_url() function to override in a child theme.
	 *
	 * @since Poralia 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function poralia_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Inter, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Inter font: on or off', 'poralia' ) ) {
			$fonts[] = 'Inter:400,500,600,700,900';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family'  => urlencode( implode( '|', $fonts ) ),
					'subset'  => urlencode( $subsets ),
					'display' => urlencode( 'fallback' ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Add google analytics
 */
function add_googleanalytics() { ?>
	<?php if ( ! is_preview() && ! is_admin() && ! is_user_logged_in() ) : ?>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-7V52XVZ2W4"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-7V52XVZ2W4');
		</script>
	<?php endif; ?>
<?php }
add_action('wp_footer', 'add_googleanalytics');


if ( ! function_exists( 'paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @since Twenty_Press 1.0
	 */
	function paging_nav() {
		global $wp_query;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation mt-12">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'vintage' ); ?></h1>
			<div class="nav-links grid grid-cols-2 gap-2 justify-between">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="flex items-center"><span class="meta-nav flex items-center justify-center">&larr;</span> <span>Older posts</span></span>', 'twentypress' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next flex justify-end">
					<?php previous_posts_link( __( '<span class="flex items-center"><span>Newer posts</span> <span class="meta-nav flex items-center justify-center">&rarr;</span></span>', 'twentypress' ) ); ?>
				</div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;