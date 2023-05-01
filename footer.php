<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="w-full lg:w-3/5 xl:w-3/6 border-r border-solid border-orange-500">
			<div class="px-4 py-5">
				<div class="copyright">
					<?php
					printf(
						/* translators: %s: WordPress. */
						esc_html__( '%1s %2s %3s - %4s', 'vintage' ),
						'&copy;',
						date( 'Y' ),
						get_bloginfo( 'name' ),
						get_bloginfo( 'description' ),
					);
					?>
				</div><!-- .copyright -->
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
