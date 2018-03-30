<?php
show_admin_bar( false );
// add_theme_support( 'post-thumbnails', array( 'post', 'page', 'event' ) ); 

wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.3.1.min.js' );
wp_register_script( 'bootstrap', get_template_directory_uri() . 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', null, null, true );

// wp_register_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.js' );
// wp_register_script( 'transit', get_template_directory_uri() . '/assets/js/transit.js' );
// wp_register_script( 'masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js' );
wp_register_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js' );


function bija_enqueue() {
  wp_enqueue_script( 'jquery' );
  // wp_enqueue_script( 'imagesloaded' );
  // wp_enqueue_script( 'transit' );
  // wp_enqueue_script( 'masonry' );
  wp_enqueue_script( 'scripts' );
  wp_enqueue_style( 'style', get_stylesheet_uri(), '', '1.0' );
}
add_action( 'wp_enqueue_scripts', 'bija_enqueue' );


// function add_admin_styles() {
//   add_editor_style( get_template_directory_uri() . '/admin.css' );
// }
// add_action( 'init', 'add_admin_styles' );

// flush_rewrite_rules( false );
flush_rewrite_rules();
?>