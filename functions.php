<?php
show_admin_bar( false );
// add_theme_support( 'post-thumbnails', array( 'post', 'page', 'event' ) ); 

wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.3.1.min.js' );
wp_register_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js' );


function bija_enqueue() {
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'scripts' );
  wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  wp_enqueue_style( 'style', get_stylesheet_uri(), '', '1.0' );
}
add_action( 'wp_enqueue_scripts', 'bija_enqueue' );

if( function_exists('acf_add_options_page') ) {	
	acf_add_options_page();
}

function get_svg( $filename ) {
	$path = get_template_directory_uri() . '/assets/images/' . $filename . '.svg';
	return file_get_contents( $path );
}

// function add_admin_styles() {
//   add_editor_style( get_template_directory_uri() . '/admin.css' );
// }
// add_action( 'init', 'add_admin_styles' );

// flush_rewrite_rules( false );
flush_rewrite_rules();
?>