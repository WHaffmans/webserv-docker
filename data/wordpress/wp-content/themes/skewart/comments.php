<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Skewart
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="<?php echo esc_attr( comments_open() ? 'comments-area' : 'comments-area comments-closed' ); ?>">

	<?php
	if ( have_comments() ) :
		?>
		<h3 class="comments-title">
			<?php
			$skewart_comment_count = get_comments_number();
			if ( '1' === $skewart_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One Response to &ldquo;%1$s&rdquo;', 'skewart' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Responses to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', $skewart_comment_count, 'comments title', 'skewart' ) ),
					number_format_i18n( $skewart_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h3><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<div class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'div',
					'short_ping'  => true,
					'avatar_size' => 40,
				)
			);
			?>
		</div><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Feedback Channel Offline', 'skewart' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(
		array(
			'title_reply'          => esc_html__( 'Upload Response', 'skewart' ),
			'title_reply_to'       => esc_html__( 'Upload Response to %s', 'skewart' ),
			'comment_notes_before' => esc_html__( 'Your data will be stored in the mainframe. Required fields are marked *', 'skewart' ),
			'label_submit'         => esc_html__( 'Transmit', 'skewart' ),
			'cancel_reply_link'    => esc_html__( 'Cancel Transmission', 'skewart' ),
			'class_submit'         => 'submit button',
		)
	);
	?>

</div><!-- #comments -->
