<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'ciccarone-style', get_stylesheet_directory_uri() . '/style.css' );
}

function company_name() {
  return 'Rise Capital Funding';
}
add_shortcode('company_name', 'company_name');
