<!-- start content container -->
<div class="row">      
			<article class="col-md-<?php head_blog_main_content_width_columns(); ?>">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                         
					<div <?php post_class(); ?>>
						<div class="single-wrap col-md-12">
							<?php head_blog_thumb_img( 'head-blog-single', '', false ); ?>
							<?php the_title( '<h1 class="single-title">', '</h1>' ); ?>
							<div class="single-meta text-center">
								<?php head_blog_widget_date_comments(); ?>
								<span class="author-meta">
									<span class="author-meta-by"><?php esc_html_e( 'By', 'head-blog' ); ?></span>
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>">
										<?php the_author(); ?>
									</a>
								</span>
							</div>	
							<div class="single-content"> 
								<div class="single-entry-summary">
									<?php do_action( 'head_theme_before_content' ); ?>
    							<?php the_content(); ?>
    							<?php do_action( 'head_theme_after_content' ); ?>
								</div><!-- .single-entry-summary -->
								<?php wp_link_pages(); ?>
								<?php head_blog_entry_footer(); ?>
							</div>
						</div>
						<?php
						$authordesc = get_the_author_meta( 'description' );
						if ( !empty( $authordesc ) ) {
							?>
							<div class="single-footer row">
								<div class="col-md-12 text-center">
									<?php get_template_part( 'template-parts/template-part', 'postauthor' ); ?>
								</div>
								<div class="col-md-12">
									<?php comments_template(); ?> 
								</div>
							</div>
						<?php } else { ?>
							<div class="single-footer">
								<?php comments_template(); ?> 
							</div>
						<?php } ?>
					</div>        
				<?php endwhile; ?>        
			<?php else : ?>            
				<?php get_template_part( 'content', 'none' ); ?>        
			<?php endif; ?>    
		</article> 
		<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->
