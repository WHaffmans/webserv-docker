<?php
/**
 * Template part for displaying a message when posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Skewart
 */

?>

<article <?php post_class( array( 'entry', 'not-found' ) ); ?>>
	<header id="page-header">
		<?php if ( is_404() ) : ?>
			<h1 class="title"><?php esc_html_e( 'System Error 404', 'skewart' ); ?></h1>
		<?php elseif ( is_search() ) : ?>
			<h1 class="title"><?php 
				/* translators: %s: search query */
				printf( esc_html__( 'No Results for: %s', 'skewart' ), '<span>' . get_search_query() . '</span>' ); 
			?></h1>
		<?php else : ?>
			<h1 class="title"><?php esc_html_e( 'Nothing Found', 'skewart' ); ?></h1>
		<?php endif; ?>
	</header><!-- #page-header -->

	<div class="entry-content">
		<?php if ( is_404() ) : ?>
			<p><?php esc_html_e( 'Connection lost. Target data not found in the mainframe. Initiate a new search query below.', 'skewart' ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'No matching data found in the mainframe. Modify search parameters and try again.', 'skewart' ); ?></p>
		<?php else : ?>
			<p><?php esc_html_e( 'The requested information could not be located. Please check back later or try a search.', 'skewart' ); ?></p>
		<?php endif; ?>
		
		<?php get_search_form(); ?>
		
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
				<?php
				/* translators: %1$s: link to new post page */
				printf( 
					wp_kses( 
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'skewart' ),
						array( 'a' => array( 'href' => array() ) )
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- .entry -->
