<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site flex flex-col h-full">
	<div id="content" class="site-content h-full w-full lg:w-3/5 xl:w-3/6 border-r border-solid border-neutral-500">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'vintage' ); ?></a>

		<div class="site-info">
			<div class="site-name px-4 py-5">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo w-52"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<?php if ( get_bloginfo( 'name' ) && get_theme_mod( 'display_title_and_tagline', true ) ) : ?>
						<?php if ( is_front_page() && ! is_paged() ) : ?>
							<?php bloginfo( 'name' ); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .site-name -->
		</div><!-- .site-info -->


		<div id="primary" class="content-area">
			<main id="main" class="site-main">
