<?php
add_action( 'after_setup_theme', 'head_blog_setup' );

if ( !function_exists( 'head_blog_setup' ) ) :

	/**
	 * Global functions
	 */
	function head_blog_setup() {

		// Theme lang.
		load_theme_textdomain( 'head-blog', get_template_directory() . '/languages' );

		// Add Title Tag Support.
		add_theme_support( 'title-tag' );

		// Register Menus.
		register_nav_menus(
			array(
				'main_menu' => esc_html__( 'Main Menu', 'head-blog' ),
			)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'head-blog-single', 1140, 641, true );
    add_image_size( 'head-blog-archive', 540, 304, true );
		add_image_size( 'head-blog-thumbnail', 120, 90, true );

		// Add Custom Background Support.
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );
		// Add theme support for Custom Header.
		$custom_header_defaults = array(
			'width'       			=> 2000,
			'height'      			=> 450,
			'flex-width'  			=> true,
			'flex-height' 			=> true,
			'default-image' 		=> esc_url( get_template_directory_uri() ) .'/img/bg.jpg',
			'wp-head-callback'   => 'head_blog_header_style',
		);
		add_theme_support( 'custom-header', $custom_header_defaults );
		add_theme_support( 'custom-logo', array(
			'flex-height'	 => true,
			'flex-width'	 => true,
			'header-text'	 => array( 'site-title', 'site-description' ),
		) );

		// Adds RSS feed links to for posts and comments.
		add_theme_support( 'automatic-feed-links' );
	}

endif;

/**
 * Set Content Width
 */
function head_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'head_blog_content_width', 1170 );
}

add_action( 'after_setup_theme', 'head_blog_content_width', 0 );

if ( ! function_exists( 'head_blog_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see head_blog_custom_header_setup().
 */
function head_blog_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style id="twentyseventeen-custom-header-styles" type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		h1.site-title a, 
		.site-title a, 
		h1.site-title, 
		.site-title,
		.site-description
		{
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // End of head_blog_header_style.

/**
 * Register custom fonts.
 */
function head_blog_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Raleway, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$the_font = _x( 'on', 'Raleway font: on or off', 'head-blog' );

	if ( 'off' !== $the_font ) {
		$font_families = array();

		$font_families[] = 'Raleway:300,400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue Styles (normal style.css and bootstrap.css)
 */
function head_blog_theme_stylesheets() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'head-blog-fonts', head_blog_fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7' );
	// Theme stylesheet.
	wp_enqueue_style( 'head-blog-stylesheet', get_stylesheet_uri(), array('bootstrap'), '1.0.9'  );
	// Load Font Awesome css.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );
}

add_action( 'wp_enqueue_scripts', 'head_blog_theme_stylesheets' );

/**
 * Register Bootstrap JS with jquery
 */
function head_blog_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'head-blog-theme-js', get_template_directory_uri() . '/js/customscript.js', array( 'jquery' ), '1.0.9', true );
}

add_action( 'wp_enqueue_scripts', 'head_blog_theme_js' );


/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php' );

/**
 * Widgets
 */
require_once( trailingslashit( get_template_directory() ) . 'includes/widgets.php' );

/**
 * Register Theme Info Page
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/dashboard.php' );

/**
 * Register customizer options notify
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/customizer.php' );

add_action( 'widgets_init', 'head_blog_widgets_init' );

/**
 * Register the Sidebar(s)
 */
function head_blog_widgets_init() {
	register_sidebar(
		array(
			'name'			 => __( 'Section before content', 'head-blog' ),
			'id'			 => 'head-blog-homepage-area',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<div class="widget-title"><h3>',
			'after_title'	 => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name'			 => esc_html__( 'Right Sidebar', 'head-blog' ),
			'id'			 => 'head-blog-right-sidebar',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<div class="widget-title"><h3>',
			'after_title'	 => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name'			 => __( 'Footer Section', 'head-blog' ),
			'id'			 => 'head-blog-footer-area',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s col-md-3">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<div class="widget-title"><h3>',
			'after_title'	 => '</h3></div>',
		)
	);
}

function head_blog_main_content_width_columns() {

	$columns = '12';

	if ( is_active_sidebar( 'head-blog-right-sidebar' ) ) {
		$columns = $columns - 3;
	}

	echo absint( $columns );
}

if ( !function_exists( 'head_blog_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function head_blog_entry_footer() {

		// Get Categories for posts.
		$categories_list = get_the_category_list( ' ' );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', ' ' );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( $categories_list || $tags_list || get_edit_post_link() ) {

			echo '<div class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( $categories_list || $tags_list ) {

					// Make sure there's more than one category before displaying.
					if ( $categories_list ) {
						echo '<div class="cat-links"><span class="space-right">' . esc_html__( 'Category', 'head-blog' ) . '</span>' . wp_kses_data( $categories_list ) . '</div>';
					}

					if ( $tags_list ) {
						echo '<div class="tags-links"><span class="space-right">' . esc_html__( 'Tags', 'head-blog' ) . '</span>' . wp_kses_data( $tags_list ) . '</div>';
					}
				}
			}

			edit_post_link();

			echo '</div>';
		}
	}

endif;

if ( !function_exists( 'head_blog_generate_construct_footer' ) ) :
	/**
	 * Build footer
	 */
	add_action( 'head_theme_generate_footer', 'head_blog_generate_construct_footer' );

	function head_blog_generate_construct_footer() {
		?>
		<p class="footer-credits-text text-center">
			<?php
      /* translators: %s: WordPress name with wordpress.org URL */ 
      printf( esc_html__( 'Proudly powered by %s', 'head-blog' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'head-blog' ) ) . '">WordPress</a>' ); 
      ?>
			<span class="sep"> | </span>
			<?php 
      /* translators: %1$s: Theme name with theme home URL */
      printf( esc_html__( 'Theme: %1$s', 'head-blog' ), '<a href="' . esc_url( 'https://headthemes.com/' ) . '">Head Blog</a>' ); 
      ?>
		</p> 
		<?php
	}

endif;

if ( ! function_exists( 'head_blog_widget_date_comments' ) ) :

	/**
	 * Returns date for widgets.
	 */
	function head_blog_widget_date_comments( ) {
	?>
	<span class="posted-date">
		<?php echo esc_html( get_the_date() ); ?>
	</span>
	<span class="comments-meta">
		<?php
			if ( !comments_open() ) 
				{ esc_html_e('Off','head-blog'); }
			else { ?>
				<a href="<?php echo esc_url( get_comments_link() ); ?>" rel="nofollow" title="<?php esc_html_e( 'Comment on ', 'head-blog' ) . the_title_attribute(); ?>">
					<?php echo absint( get_comments_number() ); ?>
				</a>
			<?php } ?>
		<i class="fa fa-comments-o"></i>
	</span>
	<?php
	}

endif;

if ( ! function_exists( 'head_blog_excerpt_more' ) ) :
	/**
	 * Excerpt more.
	 */
	function head_blog_excerpt_more( $more ) {
		return '&hellip;';
	}
	
	add_filter( 'excerpt_more', 'head_blog_excerpt_more' );
	
endif;

if ( ! function_exists( 'head_blog_thumb_img' ) ) :

	/**
	 * Returns widget thumbnail.
	 */
	function head_blog_thumb_img( $img = 'full', $col = '', $link = true ) {
		if ( function_exists( 'head_plus_thumb_img' ) ) {
			head_plus_thumb_img( $img, $col, $link);
		} elseif ( ( has_post_thumbnail() && $link == true ) ) { ?>
			<div class="news-thumb <?php echo esc_attr( $col ); ?>">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				  <img src="<?php the_post_thumbnail_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" />
        </a>
			</div><!-- .news-thumb -->
		<?php } elseif ( has_post_thumbnail() ) { ?>
			<div class="news-thumb <?php echo esc_attr( $col ); ?>">
				<img src="<?php the_post_thumbnail_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" />
			</div><!-- .news-thumb -->
		<?php
		}
	}

endif;

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     *
     */
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         *
         */
        do_action( 'wp_body_open' );
    }
endif;
