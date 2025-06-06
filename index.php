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

		<button class="svg-button" onclick="navigation.show_navigation()">
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
		<div class="tittles"> <!-- Tittle -->
			<div class="tittle-line"></div>
			<h3 class="tittle">Booking</h3 class="tittle">
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
		<div class="tittles" id="features-tittle"> <!-- Tittle -->
			<div class="tittle-line"></div>
			<h3 class="tittle">Features</h3 class="tittle">
		</div>

		<div id="features">

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[0])?>" alt="shower image">
				<p>Shower</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[1])?>" alt="bathtub image">
				<p>Bathtub<br>partially</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[2])?>" alt="fridge image">
				<p>Fridge</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[3])?>" alt="television image">
				<p>Television</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[4])?>" alt="stove image">
				<p>Stove</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[5])?>" alt="kitchenette image">
				<p>Kitchenette</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[6])?>" alt="hair dryer image">
				<p>Hair dryer</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[7])?>" alt="safe image">
				<p>Safe</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[8])?>" alt="terrace image">
				<p>Terrace<br>(partially)</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[9])?>" alt="internet image">
				<p>Internet<br>(free of cost)</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[10])?>" alt="coffee machine image">
				<p>Coffee<br>machine</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[11])?>" alt="water heater image">
				<p>Water heater</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[12])?>" alt="toaster image">
				<p>Toaster</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[13])?>" alt="microwave image">
				<p>Microwave</p>
			</div>

			<div class="feature">
				<img class="feature-img" src="<?php echo esc_url($feature_urls[14])?>" alt="wash center image">
				<p>Washcenter<br>(during opening hours)</p>
			</div>

		</div>
	</article>

	<article id="rooms-container"> <!-- Rooms -->
		<div class="tittles"> <!-- Tittle -->
			<div class="tittle-line"></div>
			<h3 class="tittle">Rooms</h3 class="tittle">
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
				<div class="room-tittle-and-description">
					<p id="room-tittle-1" class="room-tittle">Apartment</p>
					<p class="room-description"><?php echo esc_html($apartment_text); ?></p>
				</div>
			</div>

			<div class="room" onclick="room_popups.show_popup('apart1')">
				<img class="room-img" src="<?php echo esc_url($apartment_urls[5])?>" alt="apartment image">
				<div class="room-tittle-and-description">
					<p id="room-tittle-2" class="room-tittle">Aappart-raum</p>
					<p class="room-description"><?php echo esc_html($apartment_raum_text); ?></p>
				</div>
			</div>

			<div class="room" onclick="room_popups.show_popup('apart2')">
				<img class="room-img" src="<?php echo esc_url($apartment_urls[9])?>" alt="apartment image">
				<div class="room-tittle-and-description">
					<p id="room-tittle-3" class="room-tittle">Apartment-family</p>
					<p class="room-description"><?php echo esc_html($apartment_family_text); ?></p>
				</div>
			</div>

		</div>
	</article>

	<article id="service-container"> <!-- Service -->
		<div class="tittles"> <!-- Tittle -->
			<div class="tittle-line"></div>
			<h3 class="tittle">Service</h3 class="tittle">
		</div>
		<div id="services">

			<?php
			$service_ids = [get_field('roomservice_image', $onfront), get_field('kitchen_image', $onfront),
				get_field('breakfast_image', $onfront), get_field('reception_image', $onfront),
				get_field('linentowels_image', $onfront), get_field('laundrette_image', $onfront),
				get_field('inventory_image', $onfront), get_field('service_internet_image', $onfront),
				get_field('pets_image', $onfront)];

			$service_urls = [];
			foreach ($service_ids as $service_id) {
				if ($service_id) {
					array_push($service_urls, wp_get_attachment_url($service_id));
				}
			}

            // $service_image_ids = [];
            // $service_label_ids = [];

            // for ($i = 1;; $i++) {
            //     if (get_field('service_image_' . $i, get_option($onfront))) {
            //         array_push($service_image_ids, get_field('service_image_' . $i, get_option($onfront)));
            //     }
            //     else break;

            //     if ($price_page_id){
            //         if (get_field('service_text_' . $i, $price_page_id)) {
            //             array_push($service_label_ids, get_field('service_text_' . $i, $price_page_id));
            //         }
            //         else break;
            //     }
            //     else break;

            //     $image_url = wp_get_attachment_url(get_field('service_image_' . $i, get_option($onfront)));
            //     $id = 'id';
            //     echo '<div class="service" onclick="carousel.call(' . $id . ')">';
            //     echo '<img class="service-img" src=' . esc_url($image_url) . '>';
            //     echo '<p class="service-description">' . esc_html(get_field('service_text_' . $i, $price_page_id)) . '</p>';
            //     echo '</div>';
            // }

        //    foreach ($service_label_ids as $label_id) {
        //        if ($label_id) {
        //            $label_html = wp_get_attachment_url($label_id);

        //            echo '<div class="service" onclick="carousel.call(' . "id" .')">';
        //            echo '<img class="service-img" src=' . esc_url($service_image_ids) . '>';
        //            echo '<p class="service-description">' . esc_html($label_html) . '</p>';
        //            echo '</div>';
        //        }
        //    }
           ?>


			<div class="service" onclick="carousel.call('service-popup-room')">
				<img class="service-img" src="<?php echo esc_url($service_urls[0])?>" alt="Room service">
				<p class="service-description">Room service</p>
			</div>

			<div class="service" onclick="carousel.call('service-popup-kitchenette')">
				<img class="service-img" src="<?php echo esc_url($service_urls[1])?>" alt="Kitchen">
				<p class="service-description">Kitchen</p>
			</div>

			<div class="service" onclick="carousel.call('service-popup-breakfast')">
				<img class="service-img" src="<?php echo esc_url($service_urls[2])?>" alt="Breakfast">
				<p class="service-description">Breakfast</p>
			</div>

			<div class="service" onclick="carousel.call('service-popup-reception')">
				<img class="service-img" src="<?php echo esc_url($service_urls[3])?>" alt="Reception">
				<p class="service-description">Reception</p>
			</div>

			<div class="service" onclick="carousel.call('service-popup-bed')">
				<img class="service-img" src="<?php echo esc_url($service_urls[4])?>" alt="Bed Linen and Hand Towels">
				<p class="service-description">Bed Linen and Hand Towels</p>
			</div>

			<div class="service" onclick="carousel.call('service-popup-laundry')">
				<img class="service-img" src="<?php echo esc_url($service_urls[5])?>" alt="Laundrette Facilities">
				<p class="service-description">Laundrette Facilities</p>
			</div>

			<div class="service" onclick="carousel.call('id')">
				<img class="service-img" src="<?php echo esc_url($service_urls[6])?>" alt="Inventory">
				<p class="service-description">Inventory</p>
			</div>

			<div class="service" onclick="carousel.call('service-popup-internet')">
				<img class="service-img" src="<?php echo esc_url($service_urls[7])?>" alt="Internet">
				<p class="service-description">Internet</p>
			</div>

			<div class="service" onclick="carousel.call('service-popup-pets')">
				<img class="service-img" src="<?php echo esc_url($service_urls[8])?>" alt="Pets">
				<p class="service-description">Pets</p>
			</div>

		</div>
	</article>

	<article id="pricing-container"> <!-- Pricing -->
		<div class="tittles">
			<div class="tittle-line"></div>
			<h3 class="tittle">Pricing</h3 class="tittle">
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

<!--				<li>At exhibition times in Bielefeld and surroundings price-changes are possible</li>-->
<!--				<li>Cot (maximum two per room): 10.00 Euro per night</li>-->
<!--				<li>Babybed/cot (maximum two per room) for children up to 12 years: 10.00 Euro per night</li>-->
<!--				<li>Children in parents bed free of charge</li>-->
<!--				<li>Apartment with terrace: 10.00 € per night extra charge</li>-->
<!--				<li>Electric - and Washutensil:<br>Deposit variabel depending on item / no user fee</li>-->
<!--				<li>WLAN free of charge in the Apartments</li>-->
<!--				<li>Invoice payable at check-in<br>After our opening times our check-in-terminal is available in four languanges. At that time you can only pay by credit or bank card.</li>-->
<!--				<li>To check-in at the terminal you need your reservationnumber or the guest name.</li>-->
			</ul>
			<div id="pricing-terms">
				<p id="pricing-right-text"><?php echo esc_html($pricing_right_text)?></p>
				<button class="filled-button">Book now</button>
			</div>
		</div>
	</article>

	<article id="gallery-container"> <!-- Gallery -->
		<div class="tittles"> <!-- Tittle -->
			<div class="tittle-line"></div>
			<h3 class="tittle">Gallery</h3 class="tittle">
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
                    echo '<img class="gallery-img" src="' . esc_url($gall_url) . '" alt="gallery image"></img>';
                }
            }
            ?>
		</div>
	</article>

	<article id="contact-container"> <!-- Contact -->
		<div class="tittles"> <!-- Tittle -->
			<div class="tittle-line"></div>
			<h3 class="tittle">Contact</h3 class="tittle">
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
						<p id="terminal-tittle">24 hours check-in terminal</p>
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
        <div class="tittles"> <!-- Tittle -->
            <div class="tittle-line"></div>
            <h3 class="tittle">Our partners</h3 class="tittle">
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
			<p class="footer-text">© Aappartel 2011 – 2025</p>
			<div id="footer-terms">
				<a class="link" href=""><p class="footer-text">Terms and conditions</p></a>
				<a class="link" href=""><p class="footer-text">Privacy policy</p></a>
				<a class="link" href=""><p class="footer-text">Disclaimer</p></a>
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
			<a class="nav-button" href="#booking-container">Booking</a>
			<a class="nav-button" href="#features-container">Features</a>
			<a class="nav-button" href="#rooms-container">Rooms</a>
			<a class="nav-button" href="#service-container">Service</a>
			<a class="nav-button" href="#pricing-container">Pricing</a>
			<a class="nav-button" href="#gallery-container">Gallery</a>
			<a class="nav-button" href="#contact-container">Contact us</a>
			<!-- <a class="nav-button" href="#footer-container">Our partners</a> -->
			<a class="nav-button" href="#footer-container">About</a>
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
					<p id="popup-room-tittle" class="popup-room-tittle">Apartment</p>
                    <button class="outlined-button popup-room-description"><a href="<?php echo esc_html($booking_link); ?>">Book now</a></button>
				</div>
				<button class="popup-room-button" id="popup-room-next" onclick="room_popups.show_next()"></button>
			</div>
		</div>
	</div>

	<!-- Slider for service's popups -->
	<div id="service-popups-wrapper" onclick="carousel.hide()"></div>

	<div class="service-popup" id="service-popup-room" onclick="carousel.call('service-popup-room')">
		<p class="service-popup-tittle">room</p>
		<p class="service-popup-subtittle">Room cleaning</p>
		<p class="service-popup-text">Apartment cleaning every 2 days (excluding bed linen).<br>For bookings of 7 nights or more: additional weekly bed linen change</p>
		<p class="service-popup-subtittle">Final cleaning</p>
		<p class="service-popup-text">Final cleaning of the apartment is included in all overnight rates, except for long-term stays of 30 nights or more.</p>
	</div>

	<div class="service-popup" id="service-popup-kitchenette" onclick="carousel.call('service-popup-kitchenette')">
		<p class="service-popup-tittle">Kitchenette</p>
		<p class="service-popup-text">Every one of our apartments has an open plan Kitchenette fitted.<br>Here you can put your kitchen skills to the test</p>
	</div>

	<div class="service-popup" id="service-popup-breakfast" onclick="carousel.call('service-popup-breakfast')">
		<p class="service-popup-tittle">Breakfast</p>
		<p class="service-popup-text">Breakfast will be from 7:00 to 9:30<br>in the hotel and costs 14€ per person</p>
	</div>

	<div class="service-popup" id="service-popup-reception" onclick="carousel.call('service-popup-reception')">
		<p class="service-popup-tittle">Reception</p>
		<div class="service-popup-info-body">
			<p class="service-popup-subtittle">Hotel Reception – Opening Times</p>
			<p class="service-popup-text">Monday to Sunday from 7:00 to 15:00<br>Check-in after reception time is possible by a Check-in-Terminal</p>
		</div>
	</div>

	<div class="service-popup" id="service-popup-bed" onclick="carousel.call('service-popup-bed')">
		<p class="service-popup-tittle">Bed Linen and Hand Towels</p>
		<p class="service-popup-text">Of course there are towels and bed linen in your apartment</p>
	</div>

	<div class="service-popup" id="service-popup-laundry" onclick="carousel.call('service-popup-laundry')">
		<p class="service-popup-subtittle">Car wash</p>
		<table>
			<tr>
				<td>washing machine</td>
				<td>3.50 euros</td>
			</tr>
			<tr>
				<td>dryer</td>
				<td>3.50 euros</td>
			</tr>
		</table>
	</div>

	<div class="service-popup" id="service-popup-internet" onclick="carousel.call('service-popup-internet')">
		<p class="service-popup-tittle">Internet</p>
		<p class="service-popup-text">High Speed Wireless LAN for free</p>
	</div>

	<div class="service-popup" id="service-popup-pets" onclick="carousel.call('service-popup-pets')">
		<p class="service-popup-tittle">Pets</p>
		<p class="service-popup-text">No pets allowed</p>
	</div>

	<?php wp_footer(); ?>
</body>

</html>