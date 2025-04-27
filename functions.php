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

    /*
    $onfront = get_option('page_on_front');

    $apartments_id = [get_field('apartment_0', $onfront), get_field('apartment_1', $onfront),
        get_field('apartment_2', $onfront), get_field('apartment_3', $onfront),
        get_field('apartment_4', $onfront), get_field('apartment_family_0', $onfront),
        get_field('apartment_family_1', $onfront), get_field('apartment_family_2', $onfront),
        get_field('apartment_family_3', $onfront), get_field('apartment_raum_0', $onfront)];
    $apartments_id_url = [];
    foreach ($apartments_id as $apartment_id) {
        if ($apartment_id) {
            array_push($apartments_id_url, wp_get_attachment_url($apartment_id));
        }
    }

    $apartment_urls_0 = [esc_url($apartments_id_url[0]), esc_url($apartments_id_url[1]), esc_url($apartments_id_url[2]), esc_url($apartments_id_url[3]), esc_url($apartments_id_url[4])];
    $apartment_urls_1 = [esc_url($apartments_id_url[9])];
    $apartment_urls_2 = [esc_url($apartments_id_url[5]), esc_url($apartments_id_url[6]), esc_url($apartments_id_url[7]), esc_url($apartments_id_url[8])];

    wp_localize_script('rooms_popups', 'apartments', [
        'apart0' => $apartment_urls_0,
        'apart1' => $apartment_urls_1,
        'apart2' => $apartment_urls_2,
    ]);
    */


    $onfront = get_option('page_on_front');
    // Инициализируем массивы для хранения URL изображений
    $apartment_urls_0 = []; // Для полей с префиксом 'apartment_'
    $apartment_urls_1 = []; // Для полей с префиксом 'apartment_raum_'
    $apartment_urls_2 = []; // Для полей с префиксом 'apartment_family_'

    // --- Собираем URL для apart0 (префикс 'apartment_') ---
    $i = 0;
    while (true) {
        $field_name = 'apartment_' . $i;
        $apartment_id = get_field($field_name, $onfront);

        if ($apartment_id) {
            // Если поле найдено, получаем URL вложения
            $image_url = wp_get_attachment_url($apartment_id);

            //$apartment_urls_0[] = esc_url($image_url);
            array_push($apartment_urls_0, esc_url($image_url));

            $i++; // Переходим к следующему индексу
        }
        else{break;}
    }

    // --- Собираем URL для apart1 (префикс 'apartment_raum_') ---
    $i = 0;
    while (true) {
        $field_name = 'apartment_raum_' . $i;
        $apartment_id = get_field($field_name, $onfront);

        if ($apartment_id) {
            // Если поле найдено, получаем URL вложения
            $image_url = wp_get_attachment_url($apartment_id);

            //$apartment_urls_0[] = esc_url($image_url);
            array_push($apartment_urls_1, esc_url($image_url));

            $i++; // Переходим к следующему индексу
        }
        else{break;}
    }

    // --- Собираем URL для apart2 (префикс 'apartment_family_') ---
    $i = 0;
    while (true) {
        $field_name = 'apartment_family_' . $i;
        $apartment_id = get_field($field_name, $onfront);

        if ($apartment_id) {
            // Если поле найдено, получаем URL вложения
            $image_url = wp_get_attachment_url($apartment_id);

            //$apartment_urls_0[] = esc_url($image_url);
            array_push($apartment_urls_2, esc_url($image_url));

            $i++; // Переходим к следующему индексу
        }
        else{break;}
    }

    // Теперь массивы $apartment_urls_0, $apartment_urls_1, $apartment_urls_2
    // содержат все найденные URL для соответствующих префиксов.

    // Передаем данные в JavaScript
    wp_localize_script('rooms_popups', 'apartments', [
        'apart0' => $apartment_urls_0,
        'apart1' => $apartment_urls_1,
        'apart2' => $apartment_urls_2,
    ]);
}

?>