<?php
/**
 * The main template file
 *
 * @package Skewart
 */

get_header();
?>

	<main id="main" role="main">
		<div class="wrap posts-list">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content' );
				endwhile;
				
				get_template_part( 'template-parts/pagination' );
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div><!-- .wrap -->
	</main><!-- #main -->

<?php
get_footer();
