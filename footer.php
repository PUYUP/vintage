<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="w-full xl:w-3/6 lg:w-4/6 md:w-4/5 border-r border-solid border-orange-500">
			<div class="p-4 xl:p-12 lg:p-8 md:p-6">
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
