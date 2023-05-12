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

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="post-list" class="site-content pb-6 px-4 xl:px-12 lg:px-8 md:px-6 flex flex-col min-h-full" role="main">
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
