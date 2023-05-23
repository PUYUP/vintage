<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Press
 * @since Twenty_Press 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content px-4 xl:px-12 lg:px-8 md:px-6" role="main">

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header mb-4 pt-1 border-b border-t border-solid border-neutral-400 flex justify-end">	
						<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_front_page() && ! is_home() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title italic text-lg md:text-2xl !font-light text-end pb-1 -mb-[1px] inline-block border-b border-solid border-[#e88e5c]">
							<?php the_title(); ?>
						</h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
						wp_link_pages(
							array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentypress' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							)
						);
						?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentypress' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
