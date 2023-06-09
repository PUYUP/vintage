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
<div id="page" class="site flex flex-col h-full items-stretch">
	<div id="content" class="grow">
		<div class="w-full h-full xl:w-3/6 lg:w-4/6 md:w-4/5 mx-auto bg-white">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'vintage' ); ?></a>

			<div class="site-info p-4 xl:p-12 lg:p-8 md:p-6">
				<div class="site-name text-7xl md:text-9xl font-black leading-[1] -ml-1">
					<?php if ( has_custom_logo() ) : ?>
						<div class="site-logo w-20 md:w-28 lg:w-28"><?php the_custom_logo(); ?></div>
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
			
				<div class="block">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'nav-menu list-decimal list-inside mt-4 flex flex-wrap items-center gap-3 md:gap-4 text-xs font-semibold uppercase leading-4',
								'menu_id'        => 'primary-menu',
							)
						);
					?>
				</div>
			</div><!-- .site-info -->
