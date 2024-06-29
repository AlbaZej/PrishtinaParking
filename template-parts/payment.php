<?php
/* 
Template Name: Payment
*/
if (!get_transient("payment_data") || !isset($_GET['t']) || !is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

$token = isset($_GET['t']);
$paymentData = get_transient("payment_data");


$expectedToken = $paymentData['booking_token'];

if ($token != $expectedToken) {
    wp_redirect(home_url());
    exit;
}
get_header() ?>

<form id="payment-form"
    class="text-footerblack payment-container bg-gray-100 min-h-screen flex flex-col justify-between">
    <div class="max-w-full mx-2 mt-10 px-4">
        <a href="/locations/"
            class="flex w-32 items-center bg-gray-500 hover:bg-gray-700 text-light font-bold mb-5 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            <span class="whitespace-nowrap"> Go Back</span> </a>
        <div id="payment-container" class=" bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-form">
            <input hidden id="booking_id" value="<?= $paymentData['booking_id'] ?>">
            <div class="mb-4">
                <p class="block text-xl font-semibold text-center text-buttonblue">Total Amount: <span
                        id="payment-amount" class="font-bold">
                        <?= $paymentData['ticket_price'] ?>
                    </span>
                    <span class="font-bold">€</span>
                </p>
            </div>
            <div class="mb-3">
                <label class="block text-gray-600 mb-0.5">
                    Vehicle registration plate:
                </label>
                <input
                    class="border-gray-200 border rounded w-full py-2.5 px-3 text-gray-600 leading-tight focus:ring focus:ring-blue-200 focus:outline-none focus:shadow-sm focus:border-blue-300"
                    id="vehicle-plate" type="text" placeholder="01-234-AB">
                <p class="vehicle-plate-message validation-error"></p>
            </div>
            <div id="payment-spinner" class="payment-spinner mx-auto"></div>
            <div id="credit-card-form">
                <div id="payment-element" class="mb-4">
                </div>
            </div>
            <button id="pay-btn" class="bg-menublue hidden" disabled>
                <div id="button-spinner" class="button-spinner hidden"></div>
                <span id="button-text">Pay now</span>
            </button>
            <div id="payment-message" class="hidden"></div>
        </div>
    </div>
</form>
<?php get_footer() ?>