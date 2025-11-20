	<footer id="footer" role="contentinfo">
		<?php
		$skewart_description = get_bloginfo( 'description', 'display' );
		if ( $skewart_description || is_customize_preview() ) :
			?>
			<h2 class="site-tagline glitch skew" data-text="<?php echo esc_attr( $skewart_description ); ?>">
				<?php echo esc_html( $skewart_description ); ?>
			</h2>
		<?php endif; ?>
		
		<div class="grid-lg">
			<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			<?php else : ?>
				<div class="widget">
					<h3 class="widget-title underline"><?php esc_html_e( 'Recent Posts', 'skewart' ); ?></h3>
					<ul>
						<?php
						$skewart_recent_posts_args = array(
							'post_type'      => 'post',
							'posts_per_page' => 5,
							'post_status'    => 'publish',
						);
						
						$skewart_recent_posts = new WP_Query( $skewart_recent_posts_args );
						
						if ( $skewart_recent_posts->have_posts() ) :
							while ( $skewart_recent_posts->have_posts() ) :
								$skewart_recent_posts->the_post();
								?>
								<li>
									<a href="<?php echo esc_url( get_permalink() ); ?>">
										<?php the_title(); ?>
									</a>
								</li>
								<?php
							endwhile;
							wp_reset_postdata();
						else :
							?>
							<li><?php esc_html_e( 'No recent posts found.', 'skewart' ); ?></li>
							<?php
						endif;
						?>
					</ul>
					
					<div class="widget-search">
						<h3 class="widget-title underline"><?php esc_html_e( 'Search', 'skewart' ); ?></h3>
						<?php get_search_form(); ?>
					</div>
				</div>
				
				<div class="widget">
					<h3 class="widget-title underline"><?php esc_html_e( 'Calendar', 'skewart' ); ?></h3>
					<?php get_calendar(); ?>
				</div>
			<?php endif; ?>
		</div>
		
		<div class="copyright-line">
			<p>
				<?php
				/* translators: %1$s: current year, %2$s: site name */
				printf(
					esc_html__( '&copy; %1$s %2$s. All rights reserved. Skewart&nbsp;Theme&nbsp;by&nbsp;%3$s.', 'skewart' ),
					esc_html( date_i18n( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) ),
					'<a href="' . esc_url( 'https://photricity.com/' ) . '" target="_blank">Photricity&nbsp;Web&nbsp;Design</a>'
				);
				?>
			</p>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
