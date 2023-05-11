<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Press
 * @since Twenty_Press 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'flex' ); ?>>
	<div class="w-full">
		<header class="entry-header">
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>

			<h1 class="entry-title text-xl md:text-2xl !font-medium"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content text-base md:text-lg lg:text-lg">
			<?php
				the_content(
					sprintf(
						/* translators: %s: Post title. Only visible to screen readers. */
						__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentypress' ),
						the_title( '<span class="screen-reader-text">', '</span>', false )
					)
				);

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
			<div class="flex flex-wrap">
				<div class="entry-meta !w-auto !mx-0">
					<?php edit_post_link( __( 'Edit', 'twentypress' ), '<span class="edit-link">', '</span>' ); ?>
				
					<?php if ( comments_open() && ! is_single() ) : ?>
						<span class="comments-link">
							<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentypress' ) . '</span>', __( 'One comment so far', 'twentypress' ), __( 'View all % comments', 'twentypress' ) ); ?>
						</span><!-- .comments-link -->
					<?php endif; // comments_open() ?>
				</div><!-- .entry-meta -->
			</div>

			<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
				<?php get_template_part( 'author-bio' ); ?>
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</div>
</article><!-- #post -->
