<?php
/*
Template Name: User Profile
*/

if (!is_user_logged_in()) {
    wp_redirect(home_url("/"));
    exit;
}

$user_id = get_current_user_id();
$user = $current_user;

$avatar_url = get_user_meta($user_id, 'avatar_image', true);
$msg;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $displayName = sanitize_user($_POST["display_name"]);
    $new_password = $_POST["new_password"];

    $user_data = array(
        'ID' => $user_id,
        'display_name' => $displayName,
        'user_email' => $email
    );

    if (!empty($new_password)) {
        $user_data['user_pass'] = $new_password;
    }

    $user_updated = wp_update_user($user_data);

    if (is_wp_error($user_updated)) {
        $error_message = $user_updated->get_error_message();
        $errors['user_update'] = "Failed to update user information.";
    } else {
        $user = get_user_by('ID', wp_get_current_user()->ID);
        $msg = "User updated successfully.";
    }
}

$default_avatar_url = get_avatar_url($user_id, array('size' => 150));


if (empty($avatar_url)) {
    $avatar_url = $default_avatar_url;
}


$query = $wpdb->prepare(
    "SELECT start_date_daily, start_date_monthly, ticket_price FROM wp_bookings WHERE user_id = %d ORDER BY booking_date DESC LIMIT 3",
    $user_id
);
$bookings = $wpdb->get_results($query);
get_header();
?>

<div class="container user-profile-container mx-auto flex-col flex mt-2 mb-5 bg-white">
    <?php if (!empty($errors)): ?>
        <div class="error-message text-darkred mt-2 mb-4 text-center bg-softred px-4 py-3 rounded-md">
            <?php foreach ($errors as $error): ?>
                <p>
                    <?= $error ?>
                </p>
            <?php endforeach; ?>
        </div>
    <?php elseif (!empty($msg)): ?>
        <p class="success-message text-darkgreen mt-2 mb-4 text-center bg-softgreen  px-4 py-3 rounded-md">
            <?= $msg ?>
        </p>
    <?php endif; ?>

    <div class="flex justify-around flex-col md:flex-row ">
        <!-- Avatar Section -->
        <div class="flex w-1/6 flex-col items-center space-y-5 mx-auto">
            <div class="flex flex-col items-center">
                <input type="file" name="avatar-input" accept="image/*" id="avatar-input" class="hidden">
                <img class="rounded-full h-44 mb-6 object-cover avatar-photo" src="<?= esc_url($avatar_url); ?>"
                    alt="User Avatar">
                <button id="edit-avatar-button"
                    class="bg-menublue text-light  whitespace-nowrap px-4 mb-4 py-2 rounded hover:bg-hovercolor transition-colors duration-300 ease-in-out ">Change
                    Picture</button>
            </div>
            <div
                class="payment-options-container bg-white-100 rounded-lg  w-30 md:space-y-4 md:space-x-0 hidden md:flex md:flex-col md:items-center md:justify-center">
                <!-- Visa Container -->
                <div
                    class="payment-option w-full bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center">
                    <img src="<?= get_template_directory_uri(); ?>/assets/images/visa.png" alt="Visa Card"
                        class="w-15 h-12">
                </div>
                <!-- PayPal Container -->
                <div
                    class="payment-option  w-full bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center">
                    <img src="<?= get_template_directory_uri(); ?>/assets/images/paypal.png" alt="PayPal"
                        class="w-15 h-12">
                </div>
                <!-- Mastercard Container -->
                <div
                    class=" payment-option w-full bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center">
                    <img src="<?= get_template_directory_uri(); ?>/assets/images/master.png" alt="MasterCard"
                        class="w-15 h-12">
                </div>
            </div>
        </div>

        <div class="flex flex-col md:w-3/4 w-full">
            <div class="user-info-container bg-gray-100 rounded-lg shadow-lg py-2 px-4">
                <h3 class="medium-text font-bold mb-2">User information</h3>
                <form id="edit-info-form" method="POST" class="hidden w-full">

                    <div class="md:flex w-full">
                        <label class="md:w-1/5 block text-gray-500  md:text-right mb-1 md:mb-0 pr-4" for="username">
                            Username
                        </label>
                        <p class="md:w-2/5 mb-4">
                            <?= esc_attr($user->user_login); ?>
                        </p>
                    </div>

                    <div class="flex flex-col w-full">
                        <div class="flex w-full items-center">
                            <label class="md:w-1/5 block text-gray-500  md:text-right mb-1 md:mb-0 pr-4" for="email">
                                Email
                            </label>
                            <input type="email" id="email" name="email" value="<?= esc_attr($user->user_email); ?>"
                                class="md:w-2/5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-600 leading-tight ">
                        </div>
                        <div class="flex w-full items-center">
                            <div class="md:w-1/5 ">
                            </div>
                            <p class="validation-error email-error mt-1 mb-4"></p>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="flex w-full items-center">
                            <label class="md:w-1/5 block text-gray-500  md:text-right mb-1 md:mb-0 pr-4"
                                for="display_name">
                                Display Name
                            </label>
                            <input type="text" id="display_name" name="display_name"
                                value="<?= esc_attr($user->display_name); ?>"
                                class="md:w-2/5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-600 leading-tight ">
                        </div>
                        <div class="flex w-full items-center">
                            <div class="md:w-1/5 ">

                            </div>

                            <p class="validation-error display_name-error mt-1 mb-4"></p>
                        </div>


                    </div>


                    <div class="flex flex-col w-full">
                        <div class="flex md:w-full items-center">
                            <label class="md:w-1/5 block text-gray-500  md:text-right mb-1 md:mb-0 pr-4"
                                for="new_password">
                                New Password
                            </label>
                            <input type="password" id="new_password" name="new_password"
                                class="md:w-2/5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-600 leading-tight"
                                placeholder="Leave blank to keep current password">
                        </div>

                        <div class="flex w-full items-center">
                            <div class="md:w-1/5 ">

                            </div>


                            <p class="validation-error password-error mt-1 mb-4"></p>

                        </div>
                    </div>

                    <div class="md:flex md:items-center">

                        <button type="button" id="cancel-button" class=" text-gray-600 mr-4 ">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-menublue text-light px-4 py-2 rounded hover:bg-hovercolor transition-colors duration-300 ease-in-out"
                            id="save-button">
                            Save Changes
                        </button>
                    </div>
                </form>
                <div id="info-display" class="w-full">
                    <div class="flex mb-2 items-center">
                        <div class="md:w-1/5">
                            <p class="block text-gray-500  md:text-right mb-1 md:mb-0 pr-4">
                                Username
                            </p>
                        </div>
                        <div class="md:w-2/5">
                            <p class="text-gray-800">
                                <?= esc_html($user->user_login); ?>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="md:w-1/5">
                            <p class="block text-gray-500  md:text-right mb-1 md:mb-0 pr-4">
                                Email
                            </p>
                        </div>
                        <div class="md:w-2/5">
                            <p class="text-gray-800">
                                <?= esc_html($user->user_email); ?>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="md:w-1/5">
                            <p class="block text-gray-500  md:text-right mb-1 md:mb-0 pr-4">
                                Display Name
                            </p>
                        </div>
                        <div class="md:w-2/5">
                            <p class="text-gray-800">
                                <?= esc_html($user->display_name); ?>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="md:w-1/5">
                            <p class="block text-gray-500  md:text-right mb-1 md:mb-0 pr-4">
                                Password
                            </p>
                        </div>
                        <div class="md:w-2/5">
                            <p class="text-gray-800">**********</p>
                        </div>
                    </div>
                    <button id="edit-info-button" class="text-blue-500 hover:underline mt-4">
                        Edit User Information
                    </button>
                </div>
            </div>
            <div class="flex w-full flex-col mt-8 space-y-4 space-x-0 md:space-y-0 md:flex-row md:space-x-2">
                <div class="bookings-container  bg-gray-100 rounded-lg shadow-lg py-2 px-4 w-full">
                    <h3 class="medium-text font-bold mb-4">Bookings</h3>
                    <?php
                    if (!empty($bookings) && count($bookings) > 0) {
                        foreach ($bookings as $booking) {
                            echo '<div class="booking-item bg-white rounded-lg shadow-md mb-4 p-4">';
                            echo '<div class="booking-details">';
                            $startDate = $booking->start_date_daily ? $booking->start_date_daily : $booking->start_date_monthly;
                            echo '<p class="text-gray-800"><strong>Start Date:</strong> ' . $startDate . '</p>';
                            echo '<p class="text-gray-800"><strong>Amount Paid:</strong> ' . $booking->ticket_price . ' €</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '<a href="/bookings/" class="text-blue-500 hover:underline mt-2 block">See More</a>';
                    } else {
                        echo '<p class="text-gray-800">No bookings found.</p>';
                    }
                    ?>

                </div>
            </div>
        </div>

    </div>
</div>




<?php get_footer(); ?>