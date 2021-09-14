<article>
	<div <?php post_class(); ?>>                    
		<div class="news-item-content news-item text-center">
			<div class="news-text-wrap">
				
				<h2>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<?php
				$categories_list = get_the_category_list( ' ' );
				// Make sure there's more than one category before displaying.
				if ( $categories_list ) {
					echo '<div class="cat-links">' . wp_kses_data( $categories_list ) . '</div>';
				}
				?>
				<?php head_blog_thumb_img( 'head-blog-single' ); ?>
				<div class="post-excerpt">
					<?php the_excerpt(); ?>
				</div><!-- .post-excerpt -->
				<span class="author-meta">
					<span class="author-meta-by"><?php esc_html_e( 'By', 'head-blog' ); ?></span>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>">
						<?php the_author(); ?>
					</a>
				</span>
				<?php head_blog_widget_date_comments(); ?>
				<div class="read-more-button">
					<a href="<?php the_permalink(); ?>">
						<?php esc_html_e( 'Ler mais', 'head-blog' ); ?>
					</a>
					</h2>
				</div><!-- .news-text-wrap -->

			</div><!-- .news-item -->
		</div>
</article>
