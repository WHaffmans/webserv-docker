<?php
/**
 * Template part for displaying pagination
 *
 * @package Skewart
 */

the_posts_pagination(
	array(
		'mid_size'  => 4,
		'prev_text' => esc_html__( '&#9666;', 'skewart' ),
		'next_text' => esc_html__( '&#9656;', 'skewart' ),
		'screen_reader_text' => esc_html__( 'Posts navigation', 'skewart' ),
	)
);
