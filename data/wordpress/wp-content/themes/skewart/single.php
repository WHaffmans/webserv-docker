<?php
/**
 * The template for displaying single posts
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
				get_template_part( 'template-parts/content' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				
				// Previous/next post navigation.
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'skewart' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'skewart' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
			endwhile;
			?>
		</div><!-- .wrap -->
	</main><!-- #main -->

<?php
get_footer();
