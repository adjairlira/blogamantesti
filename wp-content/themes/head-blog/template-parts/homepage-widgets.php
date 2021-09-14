<?php if ( is_active_sidebar( 'head-blog-homepage-area' ) ) { ?>
	<div class="homepage-widget-area"> 
		<?php
		dynamic_sidebar( 'head-blog-homepage-area' );
		?>
	</div>
<?php
}
