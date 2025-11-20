<?php
/**
 * Template part for displaying entry metadata
 *
 * @package Skewart
 */
?>
<div class="entry-info">
	<p>
		<span class="entry-date">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?>
			</a>
		</span>

		<span class="entry-author">
			<?php esc_html_e( ' by ', 'skewart' ); ?>
			<?php the_author_posts_link(); ?>
		</span>

		<?php
		if ( ! is_singular() ) :
			esc_html_e( ' &ndash; ', 'skewart' );
			comments_popup_link(
				esc_html__( 'Leave a comment', 'skewart' ),
				esc_html__( '1 Comment', 'skewart' ),
				esc_html__( '% Comments', 'skewart' ),
				'entry-comments'
			);
		endif;
		?>
		<br />

		<span class="entry-categories">
			<?php esc_html_e( 'Posted in ', 'skewart' ); ?>
			<?php the_category( ', ' ); ?>
		</span>

		<?php the_tags( '<span class="entry-tags"> &ndash; ' . esc_html__( 'Tags:', 'skewart' ) . ' ', ', ', '</span>' ); ?>
	</p>

	<?php if ( is_single() ) : ?>
		<p>
			<?php previous_post_link( '%link' ); ?> |
			<?php next_post_link( '%link' ); ?>
		</p>
	<?php endif; ?>

	<?php edit_post_link( esc_html__( 'Edit', 'skewart' ) ); ?>
</div>
