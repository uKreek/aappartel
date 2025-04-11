<?php
function my_theme_enqueue_styles() {
    // Подключаем Bootstrap из CDN
    wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' );

    // Подключаем свой файл style.css, указывая Bootstrap в качестве зависимости
    wp_enqueue_style( 'my-theme-style', get_stylesheet_uri(), array( 'bootstrap' ) );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

?>