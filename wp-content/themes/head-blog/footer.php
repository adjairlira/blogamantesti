</div><!-- end main-container -->
</div><!-- end page-area -->
<?php if ( is_active_sidebar( 'head-blog-footer-area' ) ) { ?>  				
	<div id="content-footer-section" class="container-fluid clearfix">
		<div class="container">
			<?php dynamic_sidebar( 'head-blog-footer-area' ) ?>
		</div>	
	</div>		
<?php } ?>
<?php do_action( 'head_theme_before_footer' ); ?> 
<footer id="colophon" class="footer-credits container-fluid">
	<div class="container">
		<?php do_action( 'head_theme_generate_footer' ); ?> 
	</div>	
</footer>
<?php do_action( 'head_theme_after_footer' ); ?> 
<?php wp_footer(); ?>

</body>
</html>
