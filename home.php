<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

$page_for_posts = get_option( 'page_for_posts' );
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="post-list" class="site-content pb-6 px-4 xl:px-12 lg:px-8 md:px-6 flex flex-col min-h-full" role="main">
			<header class="entry-header mb-4 pt-1 border-b border-t border-solid border-neutral-400 flex justify-end">	
				<h1 class="entry-title italic text-lg md:text-2xl !font-light text-end pb-1 -mb-[1px] inline-block border-b border-solid border-[#e88e5c]">
					<?php echo get_the_title( $page_for_posts ); ?>
				</h1>
			</header><!-- .entry-header -->

			<?php if ( have_posts() ) : ?>

				<div class="post-list">
					<?php
					// Start the loop.
					while ( have_posts() ) :
						the_post();
						?>
						<?php get_template_part( 'content', 'item' ); ?>
					<?php endwhile; ?>
				</div>

				<?php paging_nav(); ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div><!-- #post-list -->
	</div><!-- #primary -->

<?php get_footer(); ?>
