<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>
		</div>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer mt-auto flex-none">
		<div class="w-full xl:w-3/6 lg:w-4/6 md:w-4/5 mx-auto text-neutral-500 text-right italic text-xs">
			<div class="px-4 py-2 xl:px-12 xl:py-2 lg:px-8 lg:py-2 md:px-6 md:py-2">
				<div class="copyright">
					<?php
						printf(
							/* translators: %s: WordPress. */
							esc_html__( '%1s %2s %3s', 'vintage' ),
							'&copy;',
							date( 'Y' ),
							get_bloginfo( 'name' ),
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
