<?php
/**
 * Add theme dashboard page
 */

/**
 * Get theme actions required
 *
 * @return array|mixed|void
 */

if ( !function_exists( 'head_blog_admin_scripts' ) ) :

	/**
	 * Enqueue scripts for admin page only: Theme info page
	 */
	function head_blog_admin_scripts( $hook ) {
		wp_enqueue_style( 'head-blog-admin-css', get_template_directory_uri() . '/css/admin.css' );
	}

endif;
add_action( 'admin_enqueue_scripts', 'head_blog_admin_scripts' );

add_action( 'admin_menu', 'head_blog_theme_info' );

function head_blog_theme_info() {

	$menu_title = esc_html__( 'Head Blog theme', 'head-blog' );

	add_theme_page( esc_html__( 'Head Blog dashboard', 'head-blog' ), $menu_title, 'edit_theme_options', 'head_blog', 'head_blog_theme_info_page' );
}

/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
add_action( 'admin_notices', 'head_blog_admin_notice' );

function head_blog_admin_notice() {
	global $current_user;
	$user_id	 = $current_user->ID;
	$theme_data	 = wp_get_theme();
	if ( !get_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ) ) {
		?>
		<div class="notice notice-success head-blog-notice">

			<h1>
				<?php
				/* translators: %1$s: theme name, %2$s theme version */
				printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'head-blog' ), esc_html( $theme_data->Name ), esc_html( $theme_data->Version ) );
				?>
			</h1>

			<p>
				<?php
				/* translators: %1$s: theme name, %2$s link */
				printf( __( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'head-blog' ), esc_html( $theme_data->Name ), esc_url( admin_url( 'themes.php?page=head_blog' ) ) );
				printf( '<a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?' . esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore=0' );
				?>
			</p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=head_blog' ) ) ?>" class="button button-primary button-hero" style="text-decoration: none;">
					<?php
					/* translators: %s theme name */
					printf( esc_html__( 'Get started with %s', 'head-blog' ), esc_html( $theme_data->Name ) )
					?>
				</a>
			</p>
		</div>
		<?php
	}
}

add_action( 'admin_init', 'head_blog_notice_ignore' );

function head_blog_notice_ignore() {
	global $current_user;
	$theme_data	 = wp_get_theme();
	$user_id	 = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) && '0' == $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) {
		add_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore', 'true', true );
	}
}



function head_blog_theme_info_page() {

	$theme_data = wp_get_theme();


	// Check for current viewing tab
	$tab = null;
	if ( isset( $_GET[ 'tab' ] ) ) {
		$tab = sanitize_text_field( wp_unslash( $_GET[ 'tab' ] ) );
	} else {
		$tab = null;
	}

	?>
	<div class="wrap about-wrap theme_info_wrapper">
		<h1>
			<?php
			/* translators: %1$s theme name, %2$s theme version */
			printf( esc_html__( 'Welcome to %1$s - Version %2$s', 'head-blog' ), esc_html( $theme_data->Name ), esc_html( $theme_data->Version ) );
			?>
		</h1>
		<div class="about-text"><?php echo esc_html( $theme_data->Description ); ?></div>
		<h2 class="nav-tab-wrapper">
			<a href="?page=head_blog" class="nav-tab<?php echo is_null( $tab ) ? ' nav-tab-active' : null; ?>"><?php echo esc_html( $theme_data->Name ); ?></a>
      <a href="?page=head_blog&tab=pro_version" class="nav-tab<?php echo $tab == 'pro_version' ? ' nav-tab-active' : ' ht-pro-tab'; ?>"><?php echo esc_html( 'Head Plus' ); ?></a>
			<?php do_action( 'head_blog_admin_more_tabs' ); ?>
		</h2>

		<?php if ( is_null( $tab ) ) { ?>
			<div class="theme_info info-tab-content">
				<div class="theme_info_column clearfix">
					<div class="theme_info_left">
						<div class="theme_link">
							<h3><?php esc_html_e( 'Theme Customizer', 'head-blog' ); ?></h3>
							<p class="about">
								<?php
								/* translators: %s theme name */
								printf( esc_html__( '%s supports the Theme Customizer for all theme settings. Click "Customize" to personalize your site.', 'head-blog' ), esc_html( $theme_data->Name ) );
								?>
							</p>
							<p>
								<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Start customizing', 'head-blog' ); ?></a>
							</p>
						</div>
						<div class="theme_link">
							<h3><?php esc_html_e( 'Theme documentation', 'head-blog' ); ?></h3>
							<p class="about">
								<?php
								/* translators: %s theme name */
								printf( esc_html__( 'Need help in setting up and configuring %s? Please take a look at our documentation page.', 'head-blog' ), esc_html( $theme_data->Name ) );
								?>
							</p>
							<p>
								<a href="<?php echo esc_url( 'https://headthemes.com/head-blog-demo/documentation/' ); ?>" target="_blank" class="button button-secondary">
									<?php
									/* translators: %s theme name */
									printf( esc_html__( '%s Documentation', 'head-blog' ), esc_html( $theme_data->Name ) );
									?>
								</a>
							</p>
						</div>
						<div class="theme_link">
							<h3><?php esc_html_e( 'Having trouble? Need support?', 'head-blog' ); ?></h3>
							<p>
								<a href="<?php echo esc_url( 'https://headthemes.com/contact/' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Contact us', 'head-blog' ); ?></a>
							</p>
						</div>
					</div>

					<div class="theme_info_right">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png" alt="Theme Screenshot" />
					</div>
				</div>
			</div>
		<?php } ?>
    
    <?php if ( $tab == 'pro_version' ) { ?>
			<div class="pro-version-tab info-tab-content">
				<p>
					<a href="<?php echo esc_url( 'https://headthemes.com/head-plus/' ); ?>" target="_blank" class="pro-img">
					   <img src="<?php echo esc_url(  get_template_directory_uri() . '/lib/img/head-pro-ad.jpg' ); ?>">	
					</a>
				</p>
			</div>
		<?php } ?>

	</div> <!-- END .theme_info -->
	<?php
}
