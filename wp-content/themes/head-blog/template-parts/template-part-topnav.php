<?php do_action( 'head_theme_before_head' ); ?>
<div class="site-header container-fluid" style="background-image: url(<?php esc_url( header_image() ); ?>)">
	<div class="custom-header container" >
			<div class="site-heading text-center">
        <?php do_action( 'head_theme_before_title' ); ?>
				<div class="site-branding-logo">
					<?php the_custom_logo(); ?>
				</div>
				<div class="site-branding-text">
					<?php if ( is_front_page() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>

					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
						?>
						<p class="site-description">
							<?php echo esc_html( $description ); ?>
						</p>
					<?php endif; ?>
				</div><!-- .site-branding-text -->
        <?php do_action( 'head_theme_after_title' ); ?>
			</div>
	</div>
</div>
<?php do_action( 'head_theme_before_menu' ); ?> 
<div class="main-menu">
	<nav id="site-navigation" class="navbar navbar-default navbar-center">     
		<div class="container">   
			<div class="navbar-header">
				<?php if ( has_nav_menu( 'main_menu' ) ) : ?>
					<div id="main-menu-panel" class="open-panel" data-panel="main-menu-panel">
						<span></span>
						<span></span>
						<span></span>
					</div>
				<?php endif; ?>
			</div>
			<?php
				wp_nav_menu( array(
					'theme_location'	 => 'main_menu',
					'depth'				 => 5,
					'container'			 => 'div',
					'container_class'	 => 'menu-container',
					'menu_class'		 => 'nav navbar-nav',
					'fallback_cb'		 => 'wp_bootstrap_navwalker::fallback',
					'walker'			 => new wp_bootstrap_navwalker(),
				) );
			?>
		</div>
		<?php do_action( 'head_theme_menu' ); ?>
	</nav> 
</div>
<?php do_action( 'head_theme_after_menu' ); ?>
