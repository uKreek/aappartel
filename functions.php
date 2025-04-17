<?php

/*
Подключение стилей и скриптов
*/

add_action('wp_enqueue_scripts', 'aappartel_scripts');

function aappartel_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());

    wp_enqueue_script('animations', get_template_directory_uri() . '/js_scripts/animations.js', array(), '1.0', true);
    wp_enqueue_script('contact-us', get_template_directory_uri() . '/js_scripts/contact_us_popup.js', array(), '1.0', true);
    wp_enqueue_script('image-slider', get_template_directory_uri() . '/js_scripts/image_slider.js', array(), '1.0', true);
    wp_enqueue_script('rooms_popups', get_template_directory_uri() . '/js_scripts/rooms_popups.js', array(), '1.0', true);
    wp_enqueue_script('service-popups', get_template_directory_uri() . '/js_scripts/service_popups.js', array(), '1.0', true);
}

?>