<?php get_header(); ?>
	<div class="px-4 xl:px-12 lg:px-8 md:px-6">
		<header class="entry-header mb-4 pb-2 border-b border-solid border-neutral-400">	
			<h1 class="entry-title text-xl md:text-2xl !font-light text-end lowercase tracking-widest">
				<?php
					printf(
						/* translators: %s: WordPress. */
						esc_html__( '%1s', 'vintage' ),
						get_bloginfo( 'description' ),
					);
				?>
			</h1>
		</header>
	</div>
<?php get_footer(); ?>