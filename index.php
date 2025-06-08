<?php
/*
 * Template Name: Shablone
 * Template Post Type: post, page, product
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Aappartel</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<header>
		<?php
		$onfront = get_option('page_on_front');

		$main_ids = [get_field('logo_image', $onfront), get_field('deutch_image', $onfront), get_field('english_image', $onfront)];
		$main_urls = [];
		foreach ($main_ids as $main_id) {
			if ($main_id) {array_push($main_urls, wp_get_attachment_url($main_id));}
		}
		?>

		<div id="langs-container">
			<button class="svg-button"><a id="en"><img class="lang" id="de-lang" src="<?php echo esc_url($main_urls[1])?>" alt="de"></a></button>
			<button class="svg-button"><a id="de"><img class="lang" id="en-lang" src="<?php echo esc_url($main_urls[2])?>" alt="en"></a></button>
		</div>

		<img id="logo" src="<?php echo esc_url($main_urls[0])?>" alt="Logo">

		<button id="nav-button" class="svg-button" onclick="navigation.show_navigation()">
			<svg width="44" height="43" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
				<mask id="mask0_523_713" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="13" width="44" height="18">
					<path d="M44 13H0V30.1111H44V13Z" fill="white" />
				</mask>
				<g mask="url(#mask0_523_713)">
					<path d="M0 14.5569L44 14.5569" stroke="#2A2722" stroke-width="2.93333" />
					<path d="M44 27.9197L0 27.9198" stroke="#2A2722" stroke-width="2.93333" />
				</g>
			</svg>
		</button>
	</header>

    <?php
    $args = array(
        'post_type'      => 'page',
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'templates/template-settings-page.php',
        'posts_per_page' => 1,
        'fields'         => 'ids',
    );

    $pages_with_template = get_posts( $args );
    $price_page_id = 0;

    if ( ! empty( $pages_with_template ) ) {
        $price_page_id = $pages_with_template[0];
    }


    $price_title = '';
    $booking_link = '';
    $apartment_text = '';
    $apartment_raum_text = '';
    $apartment_family_text = '';
    $pricing_texts = [];
    $pricing_right_text = '';

    if ( $price_page_id ) {
        $price_title = get_field('title_price', $price_page_id );
        $booking_link = get_field('booking_link', $price_page_id );
        $apartment_text = get_field('apartment_text', $price_page_id );
        $apartment_raum_text = get_field('apartment_raum_text', $price_page_id );
        $apartment_family_text = get_field('apartment_family_text', $price_page_id );
        $pricing_right_text = get_field('pricing_right_text', $price_page_id );

        $i = 1;
        while (true) {
            $field_name = 'pricing_text_' . $i;
            $pricing_text = get_field($field_name, $price_page_id);

            if ($pricing_text) {
                array_push($pricing_texts, esc_html($pricing_text));
                $i++;
            } else {break;}
        }
    }
    ?>

	<article id="landing-container">
        <div id="landing-container-divider">
            <!-- Images -->
            <div class="landing-container-divider-images">
                <?php
                $image_id_list = [get_field('main_image_1', $onfront), get_field('main_image_2', $onfront), get_field('main_image_3', $onfront)];
                foreach ($image_id_list as $image_id) {
                    if ($image_id) {
                        $image_url = wp_get_attachment_url($image_id);
                        echo '<div class="landing-image-slide" style="background-image: url(' . esc_url($image_url) . ')"></div>';
                    }
                }
                ?>
            </div>
        </div>
		<div id="landing-container-text">
			<h1>Apartment</h1>
            <h2><span>from </span><?php echo esc_html($price_title); ?><span></span></h2>
		</div>
	</article>


	<?php
	$booking_id = get_field('booking_image', get_option('page_on_front')); // id картинки
	$booking_url = '';
	if ($booking_id) {
		$booking_url = wp_get_attachment_url($booking_id);
	}
	?>

	<article id="booking-container" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo esc_url($booking_url);?>') no-repeat center center / cover;"> <!-- Book now -->
		<div class="titles"> <!-- title -->
			<div class="title-line"></div>
			<h3 class="title">Booking</h3 class="title">
		</div>
		<button class="filled-button"><a href="<?php echo esc_html($booking_link); ?>">Book now</a></button>
	</article>

	<?php
	$feature_ids = [get_field('shower_image', $onfront), get_field('bathtub_image', $onfront), get_field('fridge_image', $onfront),
		get_field('television_image', $onfront), get_field('stove_image', $onfront), get_field('kitchenette_image', $onfront),
		get_field('hairdryer_image', $onfront), get_field('safe_image', $onfront), get_field('terrace_image', $onfront),
		get_field('internet_image', $onfront), get_field('coffee_image', $onfront), get_field('waterheater_image', $onfront),
		get_field('toaster_image', $onfront), get_field('microwave_image', $onfront), get_field('washcenter_image', $onfront)];

	$feature_urls = [];
	foreach ($feature_ids as $feature_id) {
		if ($feature_id) {
			array_push($feature_urls, wp_get_attachment_url($feature_id));
		}
	}
	?>

	<article id="features-container"> <!-- Features -->
		<div class="titles" id="features-title"> <!-- title -->
			<div class="title-line"></div>
			<h3 class="title">Features</h3 class="title">
		</div>

		<div id="features">
            <?php
            $args_features = array(
                'post_type' => 'card',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'card_type',
                        'field' => 'slug',
                        'terms' => 'feature'
                    )
                ),
                'posts_per_page' => -1,
            );
            $features = new WP_Query($args_features);
            if ($features->have_posts()) :
                while ($features->have_posts()) : $features->the_post(); ?>

            <div class="feature">
                <?php if (has_post_thumbnail()) the_post_thumbnail('medium', array('class' => 'feature-img')); ?>
                <p><?php echo esc_html(get_the_title()) . '<br>' . wp_kses_post(get_the_content());?></p>
            </div>

            <?php endwhile;
            wp_reset_postdata();
            else:
                echo '<p>No feature cards found</p>';
            endif;
            ?>
		</div>
	</article>

	<article id="rooms-container"> <!-- Rooms -->
		<div class="titles"> <!-- title -->
			<div class="title-line"></div>
			<h3 class="title">Rooms</h3 class="title">
		</div>
		<div id="rooms">

			<?php
			$apartment_ids = [get_field('apartment_0', $onfront), get_field('apartment_1', $onfront),
				get_field('apartment_2', $onfront), get_field('apartment_3', $onfront),
				get_field('apartment_4', $onfront), get_field('apartment_family_0', $onfront),
				get_field('apartment_family_1', $onfront), get_field('apartment_family_2', $onfront),
				get_field('apartment_family_3', $onfront), get_field('apartment_raum_0', $onfront)];

			$apartment_urls = [];
			foreach ($apartment_ids as $apartment_id) {
				if ($apartment_id) {
					array_push($apartment_urls, wp_get_attachment_url($apartment_id));
				}
			}
			?>

			<div class="room" onclick="room_popups.show_popup('apart0')">
				<img class="room-img" src="<?php echo esc_url($apartment_urls[0])?>" alt="apartment image">
				<div class="room-title-and-description">
					<p id="room-title-1" class="room-title">Apartment</p>
					<p class="room-description"><?php echo esc_html($apartment_text); ?></p>
				</div>
			</div>

			<div class="room" onclick="room_popups.show_popup('apart1')">
				<img class="room-img" src="<?php echo esc_url($apartment_urls[5])?>" alt="apartment image">
				<div class="room-title-and-description">
					<p id="room-title-2" class="room-title">Aappart-raum</p>
					<p class="room-description"><?php echo esc_html($apartment_raum_text); ?></p>
				</div>
			</div>

			<div class="room" onclick="room_popups.show_popup('apart2')">
				<img class="room-img" src="<?php echo esc_url($apartment_urls[9])?>" alt="apartment image">
				<div class="room-title-and-description">
					<p id="room-title-3" class="room-title">Apartment-family</p>
					<p class="room-description"><?php echo esc_html($apartment_family_text); ?></p>
				</div>
			</div>

		</div>
	</article>

	<article id="service-container"> <!-- Service -->
		<div class="titles"> <!-- title -->
			<div class="title-line"></div>
			<h3 class="title">Service</h3 class="title">
		</div>
		<div id="services">
            <div id="service-popups-wrapper" style="z-index: 2;" onclick="carousel.hide()"></div>
            <?php
            $args_services = array(
                'post_type' => 'card',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'card_type',
                        'field' => 'slug',
                        'terms' => 'service'
                    )
                ),
                'posts_per_page' => -1,
            );
            $services = new WP_Query($args_services);
            if ($services->have_posts()) :
                while ($services->have_posts()) :
                    $services->the_post();
                    $popup_content = get_post_meta(get_the_ID(), 'service_popup_content', true);
                    $popup_subtitle = get_post_meta(get_the_ID(), 'service_popup_subtitle', true); ?>

                    <div class="service" onclick="carousel.call(<?php echo get_the_ID(); ?>)">
                        <?php if (has_post_thumbnail()) the_post_thumbnail('medium', array('class' => 'service-img')); ?>
                        <p class="service-description"><?php echo esc_html(get_the_title()) . '<br>' . wp_kses_post(get_the_content());?></p>
                    </div>

                    <div class="service-popup service-popup-text" style="z-index: 3;" id="<?php echo get_the_ID(); ?>">
                        <p class="service-popup-title"><?php echo esc_html(get_the_title()); ?></p>
                        <?php if (!empty($popup_subtitle)) :?>
                            <p class="service-popup-subtitle"><?php echo esc_html($popup_subtitle); ?></p>
                        <?php endif; ?>

                        <?php echo $popup_content; ?>
                    </div>

                <?php endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No service cards found</p>';
            endif;
            ?>
		</div>
	</article>

	<article id="pricing-container"> <!-- Pricing -->
		<div class="titles">
			<div class="title-line"></div>
			<h3 class="title">Pricing</h3 class="title">
		</div>
		<div id="pricing">
			<ul id="pricing-left-text">

                <?php
                if (count($pricing_texts) > 0) {
                    // Предполагаем, что все массивы имеют одинаковую длину
                    $count = count($pricing_texts);

                    for ($i = 0; $i < $count; $i++) {
                        ?>
                        <li><?php echo esc_html($pricing_texts[$i])?></li>
                        <?php
                    }
                } else {
                    echo '<p>There is no available prices</p>';
                }
                ?>
			</ul>
			<div id="pricing-terms">
				<p id="pricing-right-text"><?php echo esc_html($pricing_right_text)?></p>
				<button class="filled-button">Book now</button>
			</div>
		</div>
	</article>

	<article id="gallery-container"> <!-- Gallery -->
		<div class="titles"> <!-- title -->
			<div class="title-line"></div>
			<h3 class="title">Gallery</h3 class="title">
		</div>
		<div id="gallery">
			<?php
            $gallery_ids = [];
            for ($i = 1;; $i++) {
                if (get_field('image_' . $i, get_option($onfront))) {
                    array_push($gallery_ids, get_field('image_' . $i, get_option($onfront)));
                }
                else break;
            }
            foreach ($gallery_ids as $gall_id) {
                if ($gall_id) {
                    $gall_url = wp_get_attachment_url($gall_id);
                    echo '<div class="gallery-img" onclick="gallery_popup.show(\'' . esc_url($gall_url) . '\')" style="cursor: pointer;">';
                    echo '<img class="gallery-img" src="' . esc_url($gall_url) . '" alt="gallery image">';
                    echo '</div>';
                }
            }
            ?>
		</div>
	</article>

	<article id="contact-container"> <!-- Contact -->
		<div class="titles"> <!-- title -->
			<div class="title-line"></div>
			<h3 class="title">Contact</h3 class="title">
		</div>
		<div id="contact">

			<?php
			$contact_ids = [get_field('facebook_image', $onfront), get_field('terminal_image', $onfront)];

			$contact_urls = [];
			foreach ($contact_ids as $contact_id) {
				if ($contact_id) {
					array_push($contact_urls, wp_get_attachment_url($contact_id));
				}
			}
			?>

			<div id="contact-top">
				<div id="contact-info">
					<div id="contact-phones-and-adress">
						<a class="link" href="tel:+4952139952455"><p>+49(0) 521 / 399 524 55</p></a>
						<a class="link" href="tel:+4952139952454"><p>+49(0) 521 / 399 524 54</p></a>
						<a class="link" href="geo:52.02367129984142, 8.535502252825385"><p>Friedrich-Verleger Straße 1, 33602 Bielefeld</p></a>
					</div>
					<div id="contact-buttons">
						<a href="https://www.facebook.com/pages/Aappartel-Boardinghouse-City-Center/160591947426185" class="link">
							<button class="outlined-button">Facebook</button>
						</a>
						<a class="link" href="https://www.youtube.com/@Leon-ly3tq">
                            <button class="outlined-button">See videos</button>
                        </a>
						<a class="link" href="https://mail.google.com/mail/?view=cm&fs=1&to=info@aappartel.de&su=Тема%20сообщения&body=Текст%20сообщения" target="_blank">
                            <button class="outlined-button">info@aappartel.de</button>
                        </a>
					</div>
				</div>
				<div id="contact-terminal">
					<img id="terminal-img" src="<?php echo esc_url($contact_urls[1])?>">
					<div id="terminal-text">
						<p id="terminal-title">24 hours check-in terminal</p>
						<p id="terminal-description">Our check-in machine is available in 4 languages outside of reception hours.<br>No cash payments possible during these times!</p>
					</div>
				</div>
			</div>
			<div id="contact-map">
				<iframe id="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d153.44222514844608!2d8.535457873949545!3d52.02372038652008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ba3d11b82e3a5b%3A0x850334872d4b23a7!2zRnJpZWRyaWNoLVZlcmxlZ2VyLVN0cmHDn2UgMSwgMzM2MDIgQmllbGVmZWxkLCDQk9C10YDQvNCw0L3QuNGP!5e0!3m2!1sru!2sru!4v1740577516499!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
	</article>

    <article id="partners-container">
        <div class="titles"> <!-- title -->
            <div class="title-line"></div>
            <h3 class="title">Our partners</h3 class="title">
        </div>

        <div class="partners-wrapper">

            <?php
            $partner_image_urls = [];

            $i = 1;
            while (true) {
                $field_name = 'partner_image_' . $i;
                $partner_image_id = get_field($field_name, $onfront);

                if ($partner_image_id) {
                    $partner_image_url = wp_get_attachment_url($partner_image_id);
                    array_push($partner_image_urls, esc_url($partner_image_url));
                    $i++;
                }
                else{break;}
            }

            $args = array(
                'post_type'      => 'page',
                'meta_key'       => '_wp_page_template',
                'meta_value'     => 'templates/template-text-settings.php',
                'posts_per_page' => 1,
                'fields'         => 'ids',
            );

            $pages_with_template = get_posts( $args );
            $price_page_id = 0;

            if ( ! empty( $pages_with_template ) ) {
                $price_page_id = $pages_with_template[0];
            }

            $partner_titles = [];
            $partner_descriptions = [];

            if ( $price_page_id ) {
                // titles
                $i = 1;
                while (true) {
                    $field_name = 'partner_title_' . $i;
                    $partner_title = get_field($field_name, $price_page_id);

                    if ($partner_title) {
                        array_push($partner_titles, esc_html($partner_title));
                        $i++;
                    } else {break;}
                }

                // descriptions
                $i = 1;
                while (true) {
                    $field_name = 'partner_description_' . $i;
                    $partner_description = get_field($field_name, $price_page_id);

                    if ($partner_description) {
                        array_push($partner_descriptions, esc_html($partner_description));
                        $i++;
                    } else {
                        break;
                    }
                }
            }

            if (count($partner_image_urls) > 0 && count($partner_titles) > 0 && count($partner_descriptions) > 0) {
                $count = min(count($partner_image_urls), count($partner_titles), count($partner_descriptions));

                for ($i = 0; $i < $count; $i++) {
                    ?>
                    <div class="partner">
                        <img class="partner-logo" alt="partner logo" src="<?php echo esc_url($partner_image_urls[$i]); ?>"/>
                        <div class="partner-text">
                            <h4 class="partner-title"><?php echo esc_html($partner_titles[$i]); ?></h4>
                            <h5 class="partner-description"><?php echo esc_html($partner_descriptions[$i]); ?></h5>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>There is no available partner cards</p>';
            }
            ?>
        </div>
    </article>

	<footer id="footer-container">
		<div id="footer">
			<p class="footer-text">© Aappartel 2011 – <?php echo date('Y'); ?></p>
			<div id="footer-terms">
				<a class="link" onclick="footer_popup.show()" style="cursor: pointer;"><p class="footer-text">Terms and conditions</p></a>
				<a class="link" onclick="footer_popup.show()" style="cursor: pointer;"><p class="footer-text">Privacy policy</p></a>
				<a class="link" onclick="footer_popup.show()" style="cursor: pointer;"><p class="footer-text">Disclaimer</p></a>
			</div>
		</div>
	</footer>

	<?php
	$nav_close_id = get_field('nav_close_image', $onfront);

	if ($nav_close_id) {
		$nav_close_url = wp_get_attachment_url($nav_close_id);
	} ?>

	<!-- Navigation popup -->
	<nav id="nav_container" class="nav-container">
		<button class="svg-button" onclick="navigation.hide_navigation()">
			<svg width="50" height="51" viewBox="0 0 50 51" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect x="12" y="13.4143" width="2" height="35.122" transform="rotate(-45 12 13.4143)" fill="#2A2722" />
				<rect x="12.8936" y="38.2888" width="2" height="35.122" transform="rotate(-135 12.8936 38.2888)" fill="#2A2722" />
			</svg>
		</button>
		<div class="nav-buttons-container">
			<a class="nav-button" href="#booking-container" onclick="navigation.hide_navigation()">Booking</a>
			<a class="nav-button" href="#features-container" onclick="navigation.hide_navigation()">Features</a>
			<a class="nav-button" href="#rooms-container" onclick="navigation.hide_navigation()">Rooms</a>
			<a class="nav-button" href="#service-container" onclick="navigation.hide_navigation()">Service</a>
			<a class="nav-button" href="#pricing-container" onclick="navigation.hide_navigation()">Pricing</a>
			<a class="nav-button" href="#gallery-container" onclick="navigation.hide_navigation()">Gallery</a>
			<a class="nav-button" href="#contact-container" onclick="navigation.hide_navigation()">Contact us</a>
			 <a class="nav-button" href="#partners-container" onclick="navigation.hide_navigation()">Our partners</a>
			<a class="nav-button" href="#footer-container" onclick="navigation.hide_navigation()">About</a>
		</div>
	</nav>

	<!-- Slider for room's popups -->
	<div id="popup-room-wrapper" onclick="room_popups.hide()">
		<div id="popup-room">
			<div class="popup-img-wrapper">
				<img id="popup-room-img" class="popup-room-img" src="https://www.aappartel.de/images/aappartel/rooms/l/IMG_5554-min.jpg" alt="popup room image">
			</div>
			<div class="popup-room-bottom">
				<button class="popup-room-button" id="popup-room-previous" onclick="room_popups.show_prev()"></button>
				<div class="popup-room-text">
					<p id="popup-room-title" class="popup-room-title">Apartment</p>
                    <button class="outlined-button popup-room-description"><a href="<?php echo esc_html($booking_link); ?>">Book now</a></button>
				</div>
				<button class="popup-room-button" id="popup-room-next" onclick="room_popups.show_next()"></button>
			</div>
		</div>
	</div>

    <div id="gallery-popup-wrapper" onclick="gallery_popup.hide()"></div>
    <img id="gallery-popup-image">


	<div id="footer-text-popup" style="display: none;">
		<button class="svg-button" id="footer-text-button" onclick="footer_popup.hide()">
			<svg width="50" height="51" viewBox="0 0 50 51" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect x="12" y="13.4143" width="2" height="35.122" transform="rotate(-45 12 13.4143)" fill="#2A2722" />
				<rect x="12.8936" y="38.2888" width="2" height="35.122" transform="rotate(-135 12.8936 38.2888)" fill="#2A2722" />
			</svg>
		</button>

        <?php
        $args_services = array(
            'post_type' => 'card',
            'tax_query' => array(
                array(
                    'taxonomy' => 'card_type',
                    'field' => 'slug',
                    'terms' => 'footer'
                )
            ),
            'posts_per_page' => -1,
        );
        $services = new WP_Query($args_services);
        if ($services->have_posts()) :
            while ($services->have_posts()) : $services->the_post(); ?>

                <div class="footer-text-div">
                    <?php echo get_the_content();?>
                </div>

            <?php endwhile;
            wp_reset_postdata();
        else:
            echo '<p>No service cards found</p>';
        endif;
        ?>
	</div>


	<?php wp_footer(); ?>
</body>

</html>