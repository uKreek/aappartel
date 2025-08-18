<?php
/*
    connecting styles and scripts
*/

add_action('wp_enqueue_scripts', 'aappartel_scripts');

function aappartel_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('mediaQueryes', get_template_directory_uri() . '/mediaQueryes.css');

    wp_enqueue_script('animations', get_template_directory_uri() . '/js_scripts/animations.js', array(), '1.0', true);
    wp_enqueue_script('image-slider', get_template_directory_uri() . '/js_scripts/image_slider.js', array(), '1.0', true);
    wp_enqueue_script('rooms_popups', get_template_directory_uri() . '/js_scripts/rooms_popups.js', array(), '1.0', true);
    wp_enqueue_script('service-popups', get_template_directory_uri() . '/js_scripts/service_popups.js', array(), '1.0', true);
    wp_enqueue_script('navigation', get_template_directory_uri() . '/js_scripts/navigation.js', array(), '1.0', true);
    wp_enqueue_script('language-changer', get_template_directory_uri() . '/js_scripts/language_changer.js', array(), '1.0', true);
    wp_enqueue_script('contact-us', get_template_directory_uri() . '/js_scripts/contact_us_popup.js', array(), '1.0', true);
    wp_enqueue_script('footer-popup', get_template_directory_uri() . '/js_scripts/footer_popup.js', array(), '1.0', true);
    wp_enqueue_script('gallery-view', get_template_directory_uri() . '/js_scripts/gallery_view.js', array(), '1.0', true);

    // Передача AJAX URL и nonce для contact_us_popup.js
    wp_localize_script('contact-us', 'contact_form_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('contact_form_nonce')
    ));

    $onfront = get_option('page_on_front');

    // initializing arrays to store image urls
    $apartment_urls_0 = [];
    $apartment_urls_1 = [];
    $apartment_urls_2 = [];

    // getting urls for apart0 ---
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

    // getting urls for apart1
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

    // getting urls for apart2
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

    // Texts for apart0
    $apartment_texts_0 = [];
    $i = 0;
    while (true) {
        $field_name = 'apartment_text_' . $i;
        $apartment_text = get_field($field_name, $onfront);

        if ($apartment_text) {
            array_push($apartment_texts_0, esc_html($apartment_text));
            $i++;
        } else {break;}
    }

    // Texts for apart1 (apartment_raum_text_i)
    $apartment_texts_1 = [];
    $i = 0;
    while (true) {
        $field_name = 'apartment_raum_text_' . $i;
        $apartment_text = get_field($field_name, $onfront);

        if ($apartment_text) {
            array_push($apartment_texts_1, esc_html($apartment_text));
            $i++;
        } else {break;}
    }

    // Texts for apart2 (apartment_family_text_i)
    $apartment_texts_2 = [];
    $i = 0;
    while (true) {
        $field_name = 'apartment_family_text_' . $i;
        $apartment_text = get_field($field_name, $onfront);

        if ($apartment_text) {
            array_push($apartment_texts_2, esc_html($apartment_text));
            $i++;
        } else {break;}
    }

    // transferring data to JS
    wp_localize_script('rooms_popups', 'apartments', [
        'apart0' => $apartment_urls_0,
        'apart1' => $apartment_urls_1,
        'apart2' => $apartment_urls_2,
    ]);

    wp_localize_script('rooms_popups', 'apartments_texts', [
        'apart0' => $apartment_texts_0,
        'apart1' => $apartment_texts_1,
        'apart2' => $apartment_texts_2,
    ]);
}
add_theme_support('post-thumbnails');
function create_cpt_with_taxonomy() {
    register_post_type('card',
        array(
            'labels' => array(
                'name' => _('Cards'),
                'singular_name' => _('Card')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );

    register_taxonomy('card_type', 'card', array(
        'label' => _("Card Type"),
        'rewrite' => array('slug' => 'card_type'),
        'hierarchical' => true,
    ));
}
add_action('init', 'create_cpt_with_taxonomy');

function add_service_meta_boxes($post) {
    $terms = get_the_terms($post->ID, 'card_type');
    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            if ($term->slug == 'service') {
                add_meta_box(
                    'service_popup_subtitle',
                    'Popup Subtitle',
                    'render_service_popup_subtitle_meta_box',
                    'card',
                    'normal',
                    'high'
                );

                add_meta_box(
                    'service_popup_content',
                    'Popup Content',
                    'render_service_popup_content_meta_box',
                    'card',
                    'normal',
                    'high'
                );
                break;
            }
        }
    }
}
add_action('add_meta_boxes', 'add_service_meta_boxes');

function render_service_popup_subtitle_meta_box($post) {
    $subtitle = get_post_meta($post->ID, 'service_popup_subtitle', true);
    echo '<input type="text" name="service_popup_subtitle" value="' . esc_attr($subtitle) . '" style="width:100%;" />';
}

function render_service_popup_content_meta_box($post) {
    $content = get_post_meta($post->ID, 'service_popup_content', true);
    wp_editor($content, 'popup_content_editor', array('textarea_name' => 'service_popup_content'));
}

function save_service_popup_meta($post_id) {
    if (array_key_exists('service_popup_subtitle', $_POST)) {
        update_post_meta($post_id, 'service_popup_subtitle', $_POST['service_popup_subtitle']);
    }

    if (array_key_exists('service_popup_content', $_POST)) {
        update_post_meta($post_id, 'service_popup_content', $_POST['service_popup_content']);
    }
}

add_action('save_post', 'save_service_popup_meta');

// Обработка AJAX-запроса для формы Contact Us
function send_contact_form() {
    check_ajax_referer('contact_form_nonce', 'nonce');

    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);
    $send_copy = isset($_POST['send_copy']) && $_POST['send_copy'] === '1';

    // Валидация
    $errors = [];
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    if (empty($email) || !is_email($email)) {
        $errors[] = 'Valid email is required';
    }
    if (empty($subject)) {
        $errors[] = 'Subject is required';
    }
    if (empty($message)) {
        $errors[] = 'Message is required';
    }

    if (!empty($errors)) {
        wp_send_json_error(['message' => implode(', ', $errors)]);
    }

    // Отправка письма администратору
    $to = 'ruslik2806@gmail.com'; // Замените на ваш email
    $email_subject = 'Contact Form: ' . $subject;
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n";
    $email_body .= "Message:\n$message";
    $headers = array(
        'From: Aappartel <ruslik2806@gmail.com>', // Используем email сайта в From для избежания блокировок
        'Reply-To: ' . $name . ' <' . $email . '>', // Добавляем Reply-To с email пользователя
        'Content-Type: text/plain; charset=UTF-8' // Явно указываем тип контента
    );

    $sent = wp_mail($to, $email_subject, $email_body, $headers);

    // Отправка копии пользователю, если выбрано
    if ($sent && $send_copy) {
        $user_subject = 'Copy of Your Contact Form Submission';
        $user_body = "Dear $name,\n\nThank you for contacting us. Below is a copy of your message:\n\n";
        $user_body .= "Subject: $subject\n";
        $user_body .= "Message:\n$message\n\n";
        $user_body .= "Best regards,\nAappartel Team";
        $user_headers = array(
            'From: Aappartel <ruslik2806@gmail.com>',
            'Content-Type: text/plain; charset=UTF-8'
        );
        wp_mail($email, $user_subject, $user_body, $user_headers);
    }

    if ($sent) {
        wp_send_json_success(['message' => 'Email sent successfully']);
    } else {
        // Добавляем логирование ошибки для отладки (проверьте error_log)
        error_log('wp_mail failed: To: ' . $to . ', Subject: ' . $email_subject . ', Headers: ' . print_r($headers, true));
        wp_send_json_error(['message' => 'Failed to send message. Please check server mail configuration.']);
    }
}
add_action('wp_ajax_send_contact_form', 'send_contact_form');
add_action('wp_ajax_nopriv_send_contact_form', 'send_contact_form');
?>