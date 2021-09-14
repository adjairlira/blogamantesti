<?php

// Preview Check
function head_blog_is_preview() {
	$current_url = home_url( '/' );
	if ( esc_url( 'https://wp-themes.com/' ) === $current_url ) { 
		return true; 
	} else { 
		return false;
	};
}

// Random Images
function head_blog_get_preview_img_src( $i = 0 ) {
	// prevent infinite loop
	if ( 6 == $i ) {
		return '';
	}

	$path = get_template_directory() . '/img/demo/';

	// Build or re-build the global dem img array
	if ( !isset( $GLOBALS[ 'head_blog_preview_images' ] ) || empty( $GLOBALS[ 'head_blog_preview_images' ] ) ) {
		$imgs		 = array( 'image_1.jpg', 'image_2.jpg', 'image_3.jpg', 'image_4.jpg', 'image_5.jpg', 'image_6.jpg' );
		$candidates	 = array();

		foreach ( $imgs as $img ) {
			$candidates[] = $img;
		}
		$GLOBALS[ 'head_blog_preview_images' ] = $candidates;
	}
	$candidates	 = $GLOBALS[ 'head_blog_preview_images' ];
	// get a random image name
	$rand_key	 = array_rand( $candidates );
	$img_name	 = $candidates[ $rand_key ];

	// if file does not exists, reset the global and recursively call it again
	if ( !file_exists( $path . $img_name ) ) {
		unset( $GLOBALS[ 'head_blog_preview_images' ] );
		$i++;
		return head_blog_get_preview_img_src( $i );
	}

	// unset all sizes of the img found and update the global
	$new_candidates = $candidates;
	foreach ( $candidates as $_key => $_img ) {
		if ( substr( $_img, 0, strlen( "{$img_name}" ) ) === "{$img_name}" ) {
			unset( $new_candidates[ $_key ] );
		}
	}
	$GLOBALS[ 'head_blog_preview_images' ] = $new_candidates;
	return get_template_directory_uri() . '/img/demo/' . $img_name;
}

// Featured Images
function head_blog_preview_thumbnail( $input ) {
	if ( empty( $input ) && head_blog_is_preview() ) {
		$placeholder = head_blog_get_preview_img_src();
		return '<img src="' . esc_url( $placeholder ) . '" class="attachment wp-post-image">';
	}
	return $input;
}

add_filter( 'post_thumbnail_html', 'head_blog_preview_thumbnail' );

// Widgets
function head_blog_preview_right_sidebar() {
	the_widget( 'head_blog_Extended_Recent_Posts', 'title=' . esc_html__( 'Recent posts', 'head-blog' ), 'before_title=<div class="widget-title"><h3>&after_title=</h3></div>&before_widget=<div class="widget widget_recent_entries">&after_widget=</div>' );
	the_widget( 'WP_Widget_Search', 'title=' . esc_html__( 'Search', 'head-blog' ), 'before_title=<div class="widget-title"><h3>&after_title=</h3></div>&before_widget=<div class="widget widget_search">&after_widget=</div>' );
	the_widget( 'WP_Widget_Archives', 'title=' . esc_html__( 'Archives', 'head-blog' ), 'before_title=<div class="widget-title"><h3>&after_title=</h3></div>&before_widget=<div class="widget widget_archive">&after_widget=</div>' );
	the_widget( 'WP_Widget_Categories', 'title=' . esc_html__( 'Categories', 'head-blog' ), 'before_title=<div class="widget-title"><h3>&after_title=</h3></div>&before_widget=<div class="widget widget_categories">&after_widget=</div>' );
}

// Main Menu
function head_blog_preview_navigation() {
	$pages	 = get_pages();
	$i		 = 0;
	foreach ( $pages as $page ) {
		if ( ++$i > 6 )
			break;
		$menu_name	 = esc_html( $page->post_title );
		$menu_link	 = get_page_link( $page->ID );

		if ( get_the_ID() == $page->ID ) {
			$current_class = " current_page_item current-menu-item active";
		} else {
			$current_class = '';
		}

		$menu_class = "page-item-" . $page->ID;
		echo "<li class='page_item " . esc_attr( $menu_class ) . esc_attr( $current_class ) . "'><a href='" . esc_url( $menu_link ) . "'>" . esc_html( $menu_name ) . "</a></li>";
	}
}
