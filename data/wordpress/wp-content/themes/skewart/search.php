<?php
/**
 * The template for displaying search results
 *
 * @package Skewart
 */

get_header();
?>

	<main id="main" role="main">
		<div class="wrap">
			<header id="page-header" class="page-header">
				<h1 class="title"><?php esc_html_e( 'Search Results', 'skewart' ); ?></h1>
				<div class="search-form-container">
					<?php get_search_form(); ?>
				</div>
			</header><!-- .page-header -->

			<div class="posts-list">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'exerpt' );
					endwhile;
					
					get_template_part( 'template-parts/pagination' );
				else :
					?>
					<p>
						<?php 
						/* translators: %s: search query */
						printf( esc_html__( 'No results for "%s". Try another search.', 'skewart' ), get_search_query() ); 
						?>
					</p>
				<?php endif; ?>
			</div><!-- .posts-list -->
		</div><!-- .wrap -->
	</main><!-- #main -->

<?php
get_footer();
