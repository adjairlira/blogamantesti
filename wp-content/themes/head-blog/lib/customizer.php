<?php
/**
 * Head Blog Theme Customizer
 *
 * @package Head Blog
 */

$head_blog_sections = array( 'info' );

foreach( $head_blog_sections as $sec ){
    require get_template_directory() . '/lib/customizer/' . $sec . '.php';
}

function head_blog_customizer_scripts() {
    wp_enqueue_style( 'head-blog-customize',get_template_directory_uri().'/lib/customizer/css/customize.css', '', 'screen' );
    wp_enqueue_script( 'head-blog-customize', get_template_directory_uri() . '/lib/customizer/js/customize.js', array( 'jquery' ), '20170404', true );
}
add_action( 'customize_controls_enqueue_scripts', 'head_blog_customizer_scripts' );
