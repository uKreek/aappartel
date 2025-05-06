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
    wp_enqueue_script('navigation', get_template_directory_uri() . '/js_scripts/navigation.js', array(), '1.0', true);

    $onfront = get_option('page_on_front');

    // Инициализируем массивы для хранения URL изображений
    $apartment_urls_0 = [];
    $apartment_urls_1 = [];
    $apartment_urls_2 = [];

    // --- Собираем URL для apart0 ---
    $i = 0;
    while (true) {
        $field_name = 'apartment_' . $i;
        $apartment_id = get_field($field_name, $onfront);

        if ($apartment_id) {
            $image_url = wp_get_attachment_url($apartment_id);
            array_push($apartment_urls_0, esc_url($image_url));
            $i++;
        }
        else{break;}
    }

    // --- Собираем URL для apart1 ---
    $i = 0;
    while (true) {
        $field_name = 'apartment_raum_' . $i;
        $apartment_id = get_field($field_name, $onfront);
        if ($apartment_id) {
            $image_url = wp_get_attachment_url($apartment_id);
            array_push($apartment_urls_1, esc_url($image_url));
            $i++;
        }
        else{break;}
    }

    // --- Собираем URL для apart2 ---
    $i = 0;
    while (true) {
        $field_name = 'apartment_family_' . $i;
        $apartment_id = get_field($field_name, $onfront);

        if ($apartment_id) {
            $image_url = wp_get_attachment_url($apartment_id);
            array_push($apartment_urls_2, esc_url($image_url));
            $i++;
        }
        else{break;}
    }

    // Передаем данные в JavaScript
    wp_localize_script('rooms_popups', 'apartments', [
        'apart0' => $apartment_urls_0,
        'apart1' => $apartment_urls_1,
        'apart2' => $apartment_urls_2,
    ]);
}
?>