<?php
/**
 * Template part for displaying post content
 *
 * @package Skewart
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header>
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="title">', '</h1>' );
		else :
			the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( is_single() && has_post_thumbnail() ) :
			?>
			<div class="featured-image-wrapper cyberpunk-frame">
				<?php the_post_thumbnail( 'large', array( 'class' => 'featured-image' ) ); ?>
			</div>
			<?php
		endif;
		?>
	</header>

	<div class="entry-content">
		<?php 
		if ( ! is_single() && has_post_thumbnail() ) :
			?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="featured-image-link cyberpunk-frame">
				<?php the_post_thumbnail( 'medium_large', array( 'class' => 'featured-image' ) ); ?>
			</a>
			<?php
		endif;
		
		the_content( esc_html__( 'Continue', 'skewart' ) );
		?>
	</div>

	<footer>
		<?php wp_link_pages(); ?>

		<?php if ( is_single() ) : ?>
			<?php get_template_part( 'template-parts/share' ); ?>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/entry-info' ); ?>
	</footer>
</article>
