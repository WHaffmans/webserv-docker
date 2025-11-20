<?php
/**
 * The template for displaying all pages
 *
 * @package Skewart
 */

get_header();
?>

	<main id="main" role="main">
		<div class="wrap">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile;
			?>
		</div><!-- .wrap -->
	</main><!-- #main -->

<?php
get_footer();
