<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Skewart
 */

get_header();
?>

	<main id="main" role="main">
		<div class="wrap">
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		</div><!-- .wrap -->
	</main><!-- #main -->

<?php
get_footer();
