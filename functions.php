<?php
function my_custom_theme_styles() {
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'my_custom_theme_styles');



//function my_theme_enqueue_styles()
//{
//    wp_enqueue_style('main-style', get_stylesheet_uri());
//}
//
//add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


?>