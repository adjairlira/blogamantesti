<div class="postauthor-container">			  
	<div class="postauthor-title">
		<h3 class="about">
			<?php esc_html_e( 'About The Author', 'head-blog' ); ?>
		</h3>
		<div class="auhor-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 46 ); ?>
		</div>
		<div class="auhor-link">
			<span class="fn">
				<?php the_author_posts_link(); ?>
			</span>
		</div>
	</div>        	
	<div class="postauthor-content">	             						           
		<p>
			<?php the_author_meta( 'description' ) ?>
		</p>					
	</div>	 		
</div>
