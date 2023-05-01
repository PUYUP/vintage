<?php get_header(); ?>
	<div class="px-4 xl:px-12 lg:px-8 md:px-6">
		<header class="entry-header mb-4 border-b border-solid border-neutral-400 flex justify-end">	
			<h1 class="entry-title text-xl md:text-2xl !font-light text-end lowercase tracking-widest pb-2 -mb-[1px] inline-block border-b border-solid border-[#e88e5c]">
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