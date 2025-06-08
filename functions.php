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

    // transferring data to JS
    wp_localize_script('rooms_popups', 'apartments', [
        'apart0' => $apartment_urls_0,
        'apart1' => $apartment_urls_1,
        'apart2' => $apartment_urls_2,
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

function add_service_meta_boxes($post_id) {
    $terms = get_the_terms($post_id, 'card_type');
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
?>