<?php

require_once (__DIR__ . '/stripe-php/init.php');
$stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

function enqueue_all_scripts()
{
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/output.css');
    wp_enqueue_style('custom', get_template_directory_uri() . '/assets/sass/custom.css');
    wp_enqueue_script('common-js', get_template_directory_uri() . '/assets/js/common.js', array(), false, true);
    wp_enqueue_script('validator', get_template_directory_uri() . '/assets/js/validator.js', array(), false, true);



    if (is_front_page()) {
        wp_enqueue_script('scroll-to-top', get_template_directory_uri() . '/assets/js/scroll-to-top.js');
        wp_enqueue_script('banner', get_template_directory_uri() . '/assets/js/banner.js', array(), false, true);
        wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), '3.5.7');
        wp_enqueue_script('offers-menu', get_template_directory_uri() . '/assets/js/offers-menu.js', array(), false, true);
        wp_enqueue_script('faq', get_template_directory_uri() . '/assets/js/faq.js', array(), false, true);
        wp_enqueue_script('review-slider', get_template_directory_uri() . '/assets/js/review-slider.js', array(), false, true);
    }

    if (is_page_template('template-parts/map-booking.php')) {
        wp_enqueue_style('leaflet-css', get_template_directory_uri() . '/assets/css/leaflet.css');
        wp_enqueue_script('leaflet-js', get_template_directory_uri() . '/assets/js/leaflet.js', array(), false, true);
        wp_enqueue_script('map', get_template_directory_uri() . '/assets/js/map.js', array(), false, true);

        wp_localize_script(
            'map',
            'map_vars',
            array(
                'markerIcon' => get_template_directory_uri() . '/assets/images/marker-icon.png',
                'markerShadow' => get_template_directory_uri() . '/assets/images/marker-shadow.png',
                'ajax_url' => admin_url('admin-ajax.php')
            )
        );
    }
    if (is_page_template("template-parts/payment.php")) {
        wp_enqueue_script('stripe-js', "https://js.stripe.com/v3/", array(), false, null);

        wp_enqueue_script('payment', get_template_directory_uri() . '/assets/js/payment.js', array(), false, true);

        wp_localize_script(
            'payment',
            'payment_vars',
            array(
                'ajax_url' => admin_url('admin-ajax.php')
            )
        );
    }

    if (is_page_template(("template-parts/help-support.php"))) {
        wp_enqueue_script('help-support', get_template_directory_uri() . '/assets/js/help-support.js', array(), false, true);

        $pages = get_pages();
        $page_data = array();
        $skip_pages = array("Booking Confirmation", "Payment", "Reset Password");
        $skip_pages_logged_in = array("Login", "Forgot Password", "Sign Up");

        foreach ($pages as $page) {
            if (in_array($page->post_title, $skip_pages)) {
                continue;
            }
            if (is_user_logged_in()) {
                if (in_array($page->post_title, $skip_pages_logged_in)) {
                    continue;
                }
            }
            $page_data[] = array(
                'title' => $page->post_title,
                'url' => get_permalink($page->ID),
            );
        }

        wp_localize_script(
            'help-support',
            'autocompleteData',
            $page_data
        );
    }

    if (is_page_template("template-parts/sign-up.php")) {
        wp_enqueue_script('sign-up', get_template_directory_uri() . '/assets/js/sign-up.js', array(), false, true);
    }
    if (is_page_template("template-parts/login.php")) {
        wp_enqueue_script('login', get_template_directory_uri() . '/assets/js/login.js', array(), false, true);
    }
    if (is_page_template("template-parts/forgot-password.php")) {
        wp_enqueue_script('forgot-password', get_template_directory_uri() . '/assets/js/forgot-password.js', array(), false, true);
    }
    if (is_page_template("template-parts/reset-password.php")) {
        wp_enqueue_script('reset-password', get_template_directory_uri() . '/assets/js/reset-password.js', array(), false, true);
    }
    if (is_page_template("template-parts/user-profile.php")) {
        wp_enqueue_script('user-profile-js', get_template_directory_uri() . '/assets/js/user-profile.js', array(), false, true);
        wp_localize_script(
            'user-profile-js',
            'ajax',
            array(
                'url' => admin_url('admin-ajax.php')
            )
        );
    }
    if (is_page_template("template-parts/dashboard.php")) {
        wp_enqueue_script('fullcalendar', 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/fullcalendar.min.js', array('jquery'), null, true);
        wp_enqueue_style('fullcalendar-css', 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/fullcalendar.min.css');
    }
    if (is_page_template(("template-parts/leave-review.php"))) {
        wp_enqueue_script('reviews-js', get_template_directory_uri() . '/assets/js/reviews.js', array(), false, true);
    }
    if (is_page_template(("template-parts/contact-us.php"))) {
        wp_enqueue_script('contact-us', get_template_directory_uri() . '/assets/js/contact-us.js', array(), false, true);
    }
}

add_action('wp_enqueue_scripts', 'enqueue_all_scripts');


function setup_theme()
{
    add_theme_support('menus');
    add_theme_support('admin-bar', array('callback' => '__return_false'));

    register_nav_menus(
        array(
            'primary-menu' => ('Top Menu'),
            'footer-menu' => ('Footer Menu'),
            'user-profile-menu' => ('User Profile Menu')
        )
    );
}

add_action('init', 'setup_theme');
add_filter('show_admin_bar', '__return_false');


function setup_widget()
{
    register_sidebar(
        array(
            'name' => 'Footer Area',
            'id' => 'footer-widget-1',
            'class' => 'footer-widget',
            'description' => 'Footer area widget for adding social media links',
            'before_widget' => '<section id="%1$s" class="widget %2$s social-links-footer">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'setup_widget');

function add_custom_class_to_footer_menu_parents($classes, $item, $args)
{
    if ($args->theme_location == 'footer-menu' && $item->menu_item_parent == 0) {
        $classes[] = 'parent';
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'add_custom_class_to_footer_menu_parents', 10, 3);


class Tailwind_WP_Nav_Menu_Walker extends Walker_Nav_Menu
{

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-menu-parent menu-item-' . $item->ID;

        $has_children = in_array('menu-item-has-children', $classes);
        if ($has_children) {
            $classes[] = 'nav-menu-parent-children relative mx-auto';
            $arrow_svg = '<svg class="mb-[2px] dropdown-toggle inline w-4 ml-1 h-4  transition-transform duration-200 transform" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m16.843 10.211c.108-.141.157-.300.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.750.367-.750.755 0 .157.050.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.360.290.592.290.230 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" fill="#fff"></path></svg>';
        } else {
            $arrow_svg = '';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<div' . $class_names . '>';

        $atts = array(
            'title' => !empty($item->attr_title) ? $item->attr_title : '',
            'target' => !empty($item->target) ? $item->target : '',
            'rel' => !empty($item->xfn) ? $item->xfn : '',
            'href' => !empty($item->url) ? esc_url($item->url) : '',
            'class' => 'block px-4 py-2 hover:bg-buttonblue text-center',
        );

        if ($depth === 0 && $has_children) {
            $atts['class'] .= '';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . esc_attr($attr) . '="' . esc_attr($value) . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . $arrow_svg;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</div>\n";
    }
}

function mailtrap($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = MAILTRAP_USERNAME;
    $phpmailer->Password = MAILTRAP_PASSWORD;
}

add_action('phpmailer_init', 'mailtrap');

function get_parking_lots()
{
    global $wpdb;

    $bookingType = $_POST['bookingType'] ?? null;
    $startDateMonthly = $_POST['startDateMonthly'] ?? null;
    $startDateDaily = $_POST['startDateDaily'] ?? null;
    $exitDateDaily = $_POST['exitDateDaily'] ?? null;


    if ($bookingType !== 'monthly' && $bookingType !== 'daily') {
        wp_send_json_error("Error: Invalid booking type.", 400);
        wp_die();
    }

    if ($bookingType === 'monthly') {
        if (!strtotime($startDateMonthly)) {
            wp_send_json_error("Error: Invalid start date for monthly booking.", 400);
            wp_die();
        }

    } else {
        if (!strtotime($startDateDaily) || !strtotime($exitDateDaily)) {
            wp_send_json_error("Error: Invalid start or exit date for daily booking.", 400);
            wp_die();
        }
    }

    if ($bookingType == 'monthly') {
        $exitDateMonthly = date('Y-m-d', strtotime('last day of', strtotime($startDateMonthly)));

        $query = $wpdb->prepare("
            SELECT DISTINCT pl.id, pl.name, pl.monthly_rate, pl.hourly_rate, pl.latitude, pl.longitude
            FROM wp_parking_lots pl
            JOIN wp_parking_spots ps ON pl.id = ps.parking_id
            LEFT JOIN (
                SELECT DISTINCT b.spot_id
                FROM wp_bookings b
                WHERE (%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY)) OR
                      (%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY)) OR
                      (b.start_date_daily BETWEEN %s AND %s) OR
                      (b.exit_date_daily BETWEEN %s AND %s)
            ) booked_spots ON ps.spot_id = booked_spots.spot_id
            WHERE booked_spots.spot_id IS NULL
        ", $startDateMonthly, $exitDateMonthly, $startDateMonthly, $exitDateMonthly, $startDateMonthly, $exitDateMonthly);
    } else {
        $query = $wpdb->prepare("
    SELECT DISTINCT pl.id, pl.name, pl.monthly_rate, pl.hourly_rate, pl.latitude, pl.longitude
    FROM wp_parking_lots pl
    JOIN wp_parking_spots ps ON pl.id = ps.parking_id
    LEFT JOIN (
        SELECT DISTINCT b.spot_id
        FROM wp_bookings b
        WHERE 
            (b.start_date_daily BETWEEN %s AND %s) OR
            (b.exit_date_daily BETWEEN %s AND %s) OR
            (
                (%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY))
            ) AND (
                (b.plan = 'monSun') OR
                (
                    b.plan = 'monFri' AND (DATEDIFF(%s, %s) > 1 OR DAYOFWEEK(%s) BETWEEN 2 AND 6 OR DAYOFWEEK(%s) BETWEEN 2 AND 6)
                )
            )
    ) booked_spots ON ps.spot_id = booked_spots.spot_id
    WHERE booked_spots.spot_id IS NULL
", $startDateDaily, $exitDateDaily, $startDateDaily, $exitDateDaily, $startDateDaily, $exitDateDaily, $startDateDaily, $exitDateDaily, $startDateDaily, $exitDateDaily, $exitDateDaily, $startDateDaily);

    }

    $results = $wpdb->get_results($query);

    if (!$results) {
        error_log('Database error: ' . $wpdb->last_error);
        wp_send_json_error("Error: Fetching parking lots failed. " . $wpdb->last_error, 404);
        wp_die();
    }

    wp_send_json_success($results);
    wp_die();
}

add_action('wp_ajax_get_parking_lots', 'get_parking_lots');
add_action('wp_ajax_nopriv_get_parking_lots', 'get_parking_lots');


function create_payment_intent()
{
    global $stripe;
    $ticketPrice = $_POST['ticket_price'];
    try {
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => round($ticketPrice * 100),
            'currency' => 'eur',
            'confirmation_method' => 'automatic',
        ]);

        $output = [
            'clientSecret' => $paymentIntent->client_secret,
        ];
        wp_send_json($output);
    } catch (Error $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
add_action('wp_ajax_create_payment_intent', 'create_payment_intent');
add_action('wp_ajax_nopriv_create_payment_intent', 'create_payment_intent');

function process_booking_data()
{
    global $wpdb;

    $bookingType = $_POST['bookingType'] ?? null;
    $parkingId = $_POST['parkingId'] ?? null;
    $ticketPrice = $_POST['ticketPrice'] ?? null;
    $startDateMonthly = $_POST['startDateMonthly'] ?? null;
    $plan = ($_POST['plan']) ?? null;
    $startDateDaily = $_POST['startDateDaily'] ?? null;
    $exitDateDaily = $_POST['exitDateDaily'] ?? null;

    if (!is_numeric($parkingId)) {
        $error_message = "Error: Parking ID should be a numeric value.";
        wp_send_json_error($error_message, 400);
        wp_die();
    }
    if (!is_numeric($ticketPrice)) {
        $error_message = "Error: Ticket Price should be a numeric value.";
        wp_send_json_error($error_message, 400);
        wp_die();
    }
    if ($bookingType !== 'monthly' && $bookingType !== 'daily') {
        wp_send_json_error("Error: Invalid booking type.", 400);
        wp_die();
    }
    if ($bookingType == 'monthly') {
        if (empty($startDateMonthly)) {
            $error_message = "Error: Start Date is required for monthly booking.";
            wp_send_json_error($error_message, 400);
            wp_die();
        }
    } else {
        if (empty($startDateDaily) || empty($exitDateDaily)) {
            $error_message = "Error: Start Date and Exit Date are required for daily booking.";
            wp_send_json_error($error_message, 400);
            wp_die();
        }
    }

    if ($bookingType == 'monthly') {
        $exitDateMonthly = date('Y-m-d', strtotime('last day of', strtotime($startDateMonthly)));

        $query = $wpdb->prepare("
            SELECT ps.spot_id
            FROM wp_parking_spots ps
            LEFT JOIN wp_bookings b ON ps.spot_id = b.spot_id
            WHERE ps.parking_id = %d
            AND (
                b.spot_id IS NULL OR
                ps.spot_id NOT IN (
                    SELECT DISTINCT b.spot_id
                    FROM wp_bookings b
                    WHERE b.spot_id = ps.spot_id AND (
                        (%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY)) OR 
                        (%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY)) OR
                        (b.start_date_daily BETWEEN %s AND %s) OR
                        (b.exit_date_daily BETWEEN %s AND %s)
                    )
                )
            )
            LIMIT 1
        ", $parkingId, $startDateMonthly, $exitDateMonthly, $startDateMonthly, $exitDateMonthly, $startDateMonthly, $exitDateMonthly);
    } elseif ($bookingType == "daily") {
        $query = $wpdb->prepare("
            SELECT ps.spot_id
            FROM wp_parking_spots ps
            LEFT JOIN wp_bookings b ON ps.spot_id = b.spot_id
            WHERE ps.parking_id = %d
            AND (
                b.spot_id IS NULL OR
                ps.spot_id NOT IN (
                    SELECT DISTINCT b.spot_id
                    FROM wp_bookings b
                    WHERE b.spot_id = ps.spot_id AND (
                        (b.start_date_daily BETWEEN %s AND %s) OR
                        (b.exit_date_daily BETWEEN %s AND %s) OR
                        (
                            (
                                ((%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY)) OR 
                                (%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY))) AND 
                                b.plan = 'monSun'
                            ) OR
                            (
                                ((%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY)) OR 
                                (%s BETWEEN b.start_date_monthly AND DATE_ADD(b.start_date_monthly, INTERVAL 30 DAY))) AND 
                                b.plan = 'monFri' AND (DATEDIFF(%s, %s) > 1 OR DAYOFWEEK(%s) BETWEEN 2 AND 6 OR DAYOFWEEK(%s) BETWEEN 2 AND 6)
                            )
                        )
                    )
                )
            )
            LIMIT 1
        ", $parkingId, $startDateDaily, $exitDateDaily, $startDateDaily, $exitDateDaily, $startDateDaily, $exitDateDaily, $startDateDaily, $exitDateDaily, $exitDateDaily, $startDateDaily, $startDateDaily, $exitDateDaily);
    }

    $parkingSpot = $wpdb->get_var($query);

    if (!$parkingSpot) {
        $error_message = "Error: No available parking spot.";
        wp_send_json_error($error_message, 404);
        wp_die();
    }

    $data = array(
        'spot_id' => $parkingSpot,
        'user_id' => get_current_user_id(),
        'booking_type' => $bookingType,
        'start_date_daily' => $startDateDaily,
        'exit_date_daily' => $exitDateDaily,
        'start_date_monthly' => $startDateMonthly,
        'plan' => $plan,
        'parking_id' => $parkingId,
        'ticket_price' => $ticketPrice,
        "payment_status" => 'Pending'
    );

    $results = $wpdb->insert("{$wpdb->prefix}bookings", $data);

    if (!$results) {
        $error_message = "Error: Booking insertion failed.";
        wp_send_json_error($error_message, 500);
        wp_die();
    }

    $insert_id = $wpdb->insert_id;

    $ticket_price = $wpdb->get_var($wpdb->prepare("SELECT ticket_price FROM {$wpdb->prefix}bookings WHERE id = %d", $insert_id));

    if (!$ticket_price) {
        $error_message = "Error: Failed to fetch booking data.";
        wp_send_json_error($error_message, 500);
        wp_die();
    }

    $booking_token = wp_generate_uuid4();

    $paymentData = array("booking_token" => $booking_token, "booking_id" => $insert_id, "ticket_price" => $ticket_price);
    set_transient('payment_data', $paymentData, 600);

    wp_send_json_success($booking_token);
    wp_die();
}

add_action('wp_ajax_process_booking_data', 'process_booking_data');
add_action('wp_ajax_nopriv_process_booking_data', 'process_booking_data');

function validate_field($value, $fieldName)
{
    if (empty($value)) {
        $error_message = "Error: $fieldName is required.";
        wp_send_json_error($error_message, 400);
        wp_die();
    }
}

function update_booking_data()
{
    global $wpdb;

    $bookingId = $_POST['booking_id'] ?? null;
    $ticketPrice = $_POST['ticket_price'] ?? null;
    $paymentStatus = $_POST['payment_status'] ?? null;
    $vehiclePlate = $_POST['vehicle_plate'] ?? null;
    $transactionId = $_POST['transaction_id'] ?? null;

    validate_field($bookingId, 'Booking ID');
    validate_field($ticketPrice, 'Ticket Price');
    validate_field($paymentStatus, 'Payment Status');
    validate_field($vehiclePlate, 'Vehicle Plate');
    validate_field($transactionId, 'Transaction ID');

    $data = array(
        'ticket_price' => $ticketPrice,
        'payment_status' => $paymentStatus,
        'vehicle_plate' => $vehiclePlate,
        'transaction_id' => $transactionId,
    );

    $where = array(
        'id' => $bookingId,
    );

    $result = $wpdb->update("{$wpdb->prefix}bookings", $data, $where);

    if (!$result) {
        $error_message = "Error: Booking update failed.";
        wp_send_json_error($error_message, 500);
        wp_die();
    }

    $updated_booking_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}bookings WHERE id = %d", $bookingId));

    if (!$updated_booking_data) {
        $error_message = "Error: Failed to fetch updated booking data.";
        wp_send_json_error($error_message, 500);
        wp_die();
    }

    wp_send_json_success($updated_booking_data);
    wp_die();
}

add_action('wp_ajax_update_booking_data', 'update_booking_data');
add_action('wp_ajax_nopriv_update_booking_data', 'update_booking_data');



function send_booking_confirmation_email()
{
    $userId = $_POST['user_id'];
    $parkingId = $_POST['parking_id'];
    $bookingType = $_POST['booking_type'];
    $bookingId = $_POST['id'];
    $bookingDate = $_POST['booking_date'];
    $paymentStatus = $_POST['payment_status'];
    $startDateDaily = $_POST['start_date_daily'];
    $exitDateDaily = $_POST['exit_date_daily'];
    $startDateMonthly = $_POST['start_date_monthly'];
    $plan = $_POST['plan'];
    $ticketPrice = $_POST['ticket_price'];
    $vehiclePlate = $_POST['vehicle_plate'];

    global $wpdb;

    $query = $wpdb->prepare("SELECT name FROM {$wpdb->prefix}parking_lots WHERE id = %d", $parkingId);
    $parkingLotName = $wpdb->get_var($query);
    $query = $wpdb->prepare("SELECT display_name,user_email FROM {$wpdb->prefix}users WHERE ID = %d", $userId);
    $user = $wpdb->get_row($query);

    $bookingInfo = array('booking_id' => $bookingId, 'booking_date' => $bookingDate, 'parking_lot' => $parkingLotName, 'ticket_price' => $ticketPrice, 'user_name' => $user->display_name, 'user_email' => $user->user_email, 'booking_type' => $bookingType, 'payment_status' => $paymentStatus);

    $subject = 'Booking Confirmation - #' . $bookingId;

    $message = "<p>Dear $user->display_name,</p>";
    $message .= "<p>Your booking has been confirmed. Please find attached QR code.<br>Thank you for booking with us.</p>";
    $message .= "<table>";
    $message .= "<tr><th>Booking Details</th><th></th></tr>";
    $message .= "<tr><td>Booking Date</td><td>$bookingDate</td></tr>";
    if ($parkingLotName) {
        $message .= "<tr><td>Parking Lot</td><td>$parkingLotName</td></tr>";
    }
    $message .= "<tr><td>Vehicle Registration Plate</td><td>$vehiclePlate</td></tr>";
    if ($bookingType === 'monthly') {
        $message .= "<tr><td>Booking Type</td><td>Monthly</td></tr>";
        $message .= "<tr><td>Start Date</td><td>" . date('Y-m-d', strtotime($startDateMonthly)) . "</td></tr>";
        $message .= "<tr><td>Plan</td><td>" . ($plan == 'monFri' ? 'Mon-Fri' : 'Mon-Sun') . "</td></tr>";
        $monthly = array('start_date' => $startDateMonthly, 'plan' => $plan);
        $bookingInfo = array_merge($bookingInfo, $monthly);
    } else {
        $message .= "<tr><td>Booking Type</td><td>Daily/Hourly</td></tr>";
        $message .= "<tr><td>Start Date/Time</td><td>" . date('Y-m-d H:i:s', strtotime($startDateDaily)) . "</td></tr>";
        $message .= "<tr><td>Exit Date/Time</td><td>" . date('Y-m-d H:i:s', strtotime($exitDateDaily)) . "</td></tr>";
        $daily = array('start_date' => $startDateDaily, 'exit_date' => $exitDateDaily);
        $bookingInfo = array_merge($bookingInfo, $daily);
    }
    $message .= "<tr><td>Ticket Price</td><td>$ticketPrice €</td></tr>";
    $message .= "<tr><td>Payment Status</td><td>$paymentStatus </td></tr>";
    $message .= "<tr><td>User Email</td><td>$user->user_email</td></tr>";
    $message .= "</table>";

    $email_body = generate_html_email_body($subject, $message);

    $headers[] = 'Content-Type: text/html; charset=UTF-8';

    $qrCodePath = generate_qr_code($bookingInfo);
    if ($qrCodePath) {
        $qrCodeSentFileName = 'booking_' . $bookingId . '.png';
        $attachments = array($qrCodeSentFileName => $qrCodePath);

        $result = wp_mail($user->user_email, $subject, $email_body, $headers, $attachments);

        if ($result) {
            unlink($qrCodePath);
            wp_send_json_success("Booking confirmation email sent successfully.");
            wp_die();
        }
    } else {
        $error_message = "Error: Failed to send booking confirmation email.";
        wp_send_json_error($error_message, 500);
        wp_die();
    }
}


add_action('wp_ajax_send_booking_confirmation_email', 'send_booking_confirmation_email');
add_action('wp_ajax_nopriv_send_booking_confirmation_email', 'send_booking_confirmation_email');

function generate_qr_code($bookingInfo)
{
    include (get_template_directory() . '/qrlib/phpqrcode.php');

    $errorCorrectionLevel = 'L';
    $matrixPointSize = 4;

    $bookingInfoJson = json_encode($bookingInfo);

    $qrCodeFilename = 'booking_' . $bookingInfo['booking_id'] . '.png';
    $qrCodeFile = get_template_directory() . '/qrlib/' . $qrCodeFilename;

    QRcode::png($bookingInfoJson, $qrCodeFile, $errorCorrectionLevel, $matrixPointSize);

    return $qrCodeFile;
}


function get_bookings_callback()
{
    global $wpdb;
    $bookings = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}bookings", ARRAY_A);
    $events = [];
    foreach ($bookings as $booking) {
        $events[] = [
            'id' => $booking['id'],
            'title' => 'Booking ' . $booking['id'],
            'start' => $booking['start_date_daily'],
            'end' => $booking['exit_date_daily']
        ];
    }
    echo json_encode($events);
    wp_die();
}

add_action('wp_ajax_get_bookings', 'get_bookings_callback');
add_action('wp_ajax_nopriv_get_bookings', 'get_bookings_callback');


function get_booking_details_callback()
{
    if (isset($_POST['eventId'])) {
        $booking_id = $_POST['eventId'];
        $booking_details = "Booking ID: $booking_id";
        echo $booking_details;
    }
    wp_die();
}

add_action('wp_ajax_get_booking_details', 'get_booking_details_callback');
add_action('wp_ajax_nopriv_get_booking_details', 'get_booking_details_callback');


function add_icon_and_url_to_logout_menu_item($atts, $item, $args)
{
    if ($item->title == 'Logout') {
        $atts['class'] = 'logout-link';
        $atts['href'] = wp_logout_url(home_url('/login'));
    }
    return $atts;
}

add_filter('nav_menu_link_attributes', 'add_icon_and_url_to_logout_menu_item', 10, 3);


function update_avatar()
{
    if (isset($_FILES['avatar-input'])) {
        $user_id = get_current_user_id();
        $avatar_data = wp_handle_upload($_FILES['avatar-input'], array('test_form' => false));

        if ($avatar_data && !isset($avatar_data['error'])) {
            update_user_meta($user_id, 'avatar_image', $avatar_data['url']);
            wp_send_json_success(get_user_meta($user_id, 'avatar_image', true));

        } else {
            wp_send_json_error("Failed to update avatar.", 500);
        }
    } else {
        wp_send_json_error("Invalid request", 404);
    }

    wp_die();
}

add_action('wp_ajax_update_avatar', 'update_avatar');
add_action('wp_ajax_nopriv_update_avatar', 'update_avatar');

function generate_html_email_body($subject, $message)
{
    $logoUrl = get_template_directory_uri() . "/assets/images/PrishtinaP.png";

    $html_body = '<html><head><style>';
    $html_body .= 'table { border-collapse: collapse; width: 100%; }';
    $html_body .= 'th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }';
    $html_body .= 'th { background-color: #f2f2f2; }';
    $html_body .= 'h2 { color: #3282B8; }';
    $html_body .= '.img-container {text-align: center;}';
    $html_body .= '</style></head><body>';
    $html_body .= "<div class='img-container'>";
    $html_body .= "<img src='$logoUrl' alt='Company Logo' style='max-width: 150px;'>";
    $html_body .= "</div>";
    $html_body .= "<h2>$subject</h2>";
    $html_body .= $message;
    $html_body .= "<p>Regards,<br>PrishtinaParking Team</p>";
    $html_body .= "</body></html>";

    return $html_body;
}
function generate_contact_form_submission_body($full_name, $email_address, $phone_number, $message)
{
    $body = "<div class='bg-gray-100 rounded-lg shadow-md p-6'>";
    $body .= "<table class='w-full'>";
    $body .= "<tr>";
    $body .= "<td class='py-2 px-4 font-semibold text-gray-800'>Name:</td>";
    $body .= "<td class='py-2 px-4 text-gray-600'>$full_name</td>";
    $body .= "</tr>";
    $body .= "<tr>";
    $body .= "<td class='py-2 px-4 font-semibold text-gray-800'>Email:</td>";
    $body .= "<td class='py-2 px-4 text-gray-600'>$email_address</td>";
    $body .= "</tr>";
    $body .= "<tr>";
    $body .= "<td class='py-2 px-4 font-semibold text-gray-800'>Phone:</td>";
    $body .= "<td class='py-2 px-4 text-gray-600'>$phone_number</td>";
    $body .= "</tr>";
    $body .= "<tr>";
    $body .= "<td class='py-2 px-4 font-semibold text-gray-800'>Message:</td>";
    $body .= "<td class='py-2 px-4 text-gray-600'>$message</td>";
    $body .= "</tr>";
    $body .= "</table>";
    $body .= "</div>";

    return $body;
}



function theme_register_menus() {
    register_nav_menus(
        array(
            'user-profile-menu' => __( 'User Profile Menu' ),
        )
    );
}
add_action( 'init', 'theme_register_menus' );

function enqueue_fullcalendar() {
    wp_enqueue_script('fullcalendar', 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/fullcalendar.min.js', array('jquery'), null, true);
    wp_enqueue_style('fullcalendar-css', 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/fullcalendar.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_fullcalendar');



// Save avatar URL via AJAX
add_action('wp_ajax_save_avatar_url', 'save_avatar_url');
function save_avatar_url() {
    $avatar_url = isset($_POST['avatar_url']) ? sanitize_text_field($_POST['avatar_url']) : '';
    $user_id = get_current_user_id();
    if (!empty($avatar_url) && $user_id) {
        update_user_meta($user_id, 'avatar_image', $avatar_url);
        echo 'Avatar URL saved successfully.';
    } else {
        echo 'Error: Avatar URL not saved.';
    }
    wp_die();
}


function replace_plan_description($plan) {
    $replacements = array(
        'monFri' => 'Monday-Friday',
        'monSun' => 'Monday-Sunday',
    );

    foreach ($replacements as $search => $replace) {
        $plan = str_replace($search, $replace, $plan);
    }

    return $plan;
}

