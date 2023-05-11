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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-item border-t border-dashed border-neutral-300 flex' ); ?>>
	<div class="w-full">
		<header class="entry-header !mb-2">
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>

			<h3 class="entry-title text-base lg:text-xl !font-medium">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>
		</header><!-- .entry-header -->

		<div class="entry-summary text-sm text-neutral-600">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-meta flex flex-wrap">
			<div class="entry-meta !w-auto !mx-0">
				<?php edit_post_link( __( 'Edit', 'twentypress' ), '<span class="edit-link">', '</span>' ); ?>
			
				<?php if ( comments_open() && ! is_single() ) : ?>
					<span class="comments-link">
						<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentypress' ) . '</span>', __( 'One comment so far', 'twentypress' ), __( 'View all % comments', 'twentypress' ) ); ?>
					</span><!-- .comments-link -->
				<?php endif; // comments_open() ?>
			</div><!-- .entry-meta -->
		</footer><!-- .entry-meta -->
	</div>
</article><!-- #post -->
