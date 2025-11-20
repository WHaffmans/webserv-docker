<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Skewart
 */

get_header();
?>

	<main id="main" class="site-main" role="main">
		<div class="wrap">
			
			<header class="page-header" id="page-header">
				<?php
				the_archive_title( '<h1 class="page-title title">', '</h1>' );
				the_archive_description( '<div class="archive-description subtitle"><p>', '</p></div>' );
				?>
			</header><!-- .page-header -->

			<div class="posts-list">
				<?php
				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content' );
					endwhile;
					
					get_template_part( 'template-parts/pagination' );
	
				else :
				
					get_template_part( 'template-parts/content', 'none' );
					
				endif;
				?>
			</div><!-- .posts-list -->
			
		</div><!-- .wrap -->
	</main><!-- #main -->

<?php
get_footer();
